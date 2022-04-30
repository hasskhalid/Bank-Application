<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<h1>Account Information</h1>
<?php

if (is_logged_in(true)) {
}


$id = get_user_id();
$db = getDB();

$acc = $_GET['acc'];

$bal = $_GET['bal'];
$acctype = $_GET['type'];
$created = $_GET['created'];

// we want AccountSrc (##) to equal account (00000##)
$stmt = $db->prepare("SELECT A.account AS AccountSrc, B.account AS AccountDest,
                    BalanceChange, TransactionType, Memo, ExpectedTotal
                    FROM Transactions
                    JOIN Accounts A ON Transactions.AccountSrc = A.id
                    JOIN Accounts B ON Transactions.AccountDest = B.id
                    WHERE AccountSrc = :acc LIMIT 10");
$transactions = [];

try{
  $stmt->execute([":acc"=>$acc]);
  $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if($r){ ?>

<link rel="stylesheet" href="styles.css">

<h3>Account Number: <?=$acc?> </h3> 
<h3>Account Balance: $<?=$bal?> </h3>
<h3>Account Type: <?=$acctype?> </h3>
<h3>Account Created: <?=$created?> </h3>

<table border='4' class='accounts' cellspacing='0'>
    <tr>
        <td class='hed' colspan='8' align="center">Transaction History</td>
    </tr>
    <tr>
        <th>AccountSrc</th>
        <th>AccountDest</th>
        <th>BalanceChange</th>
        <th>TransactionType</th>
        <th>Memo</th>
        <th>ExpectedTotal</th>
    </tr>

<?php    
    $transactions = $r;
    foreach($transactions as $row){
        echo "<tr> \n";
        echo "<td>" . print_r($row['AccountSrc'], true) . "</td>";
        echo "<td>" .  print_r($row['AccountDest'], true) . "</td>";
        echo "<td>" .  print_r($row['BalanceChange'], true) . "</td>";
        echo "<td>" .  print_r($row['TransactionType'], true) . "</td>";
        echo "<td>" .  print_r($row['Memo'], true) . "</td>";
        echo "<td>" .  print_r($row['ExpectedTotal'], true) . "</td>";
        echo "</tr>";
    }
  }
}
catch(PDOException $e){
  flash(var_export($e, true));
}

?>

</table>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>