<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<h1>Home</h1>
<?php

if (is_logged_in(true)) {
}

// $id = get_user_id();
// $db = getDB();

// $query = "SELECT * FROM Accounts WHERE user_id = $id";
// $stmt = $db->prepare($query);
//$stmt->execute();

$id = get_user_id();
$db = getDB();

$stmt = $db->prepare("SELECT * FROM Accounts where user_id = :uid");
$accounts = [];

try{
  $stmt->execute([":uid"=>$id]);
  $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if($r){ ?>

<link rel="stylesheet" href="styles.css">

<table border='4' class='accounts' cellspacing='0'>
    <tr>
        <td class='hed' colspan='8' align="center">All Accounts</td>
    </tr>
    <tr>
        <th>Account Number</th>
        <th>Balance</th>
        <th>Account Type</th>
    </tr>

<?php    
    $accounts = $r;
    foreach($accounts as $row){
        echo "<tr> \n";
        echo "<td>" .  print_r($row['account'], true) . "</td>";
        echo "<td>" .  print_r($row['balance'], true) . "</td>";
        echo "<td>" .  print_r($row['account_type'], true) . "</td>";
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