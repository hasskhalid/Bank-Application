<?php
require(__DIR__ . "/../../partials/nav.php");

if (is_logged_in(true)) {
}

$id = get_user_id();
$db = getDB();

$stmt = $db->prepare("SELECT * FROM Accounts where user_id = :uid AND isActive = 1");
$accounts = [];

try{
  $stmt->execute([":uid"=>$id]);
  $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if($r){ ?>

<link rel="stylesheet" href="styles.css">

<table border='4' class='accounts' cellspacing='0'>
    <tr>
        <td class='hed' colspan='8' align="center">My Accounts</td>
    </tr>
    <tr>
        <th>Account Number</th>
        <th>Balance</th>
        <th>Account Type</th>
        <th>APY</th>
    </tr>

<?php  
    $accounts = $r;
    $i = 0;
    foreach($accounts as $row){
        $acc = $row['account'];
        $bal = $row['balance'];
        $created = $row['created'];
        $acctype = $row['account_type'];
        echo "<tr> \n";
        echo "<td> <a href= 'account_info.php?acc=$acc&bal=$bal&type=$acctype&created=$created'>" . print_r($row['account'], true) . "</a></td>";
        echo "<td>" .  print_r($row['balance'], true) . "</td>";
        echo "<td>" .  print_r($row['account_type'], true) . "</td>";
        
        if($acctype !== 'savings'){
          echo "<td>" . print_r("-", true) . "</td>";
        }else{
          echo "<td>" . "0.06%" . "</td>";
        }
        echo "</tr>";

        if($i++ > 5) break;
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