<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<h1>Dashboard</h1>
<?php

if (is_logged_in(true)) {

    $id = get_user_id();
    $db = getDB();

    $stmt = $db->prepare("SELECT fname, lname FROM Users where id = :uid");
    $full_name = [];

    try{
    $stmt->execute([":uid"=>$id]);
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //$fname = $name['fname'];

    $full_name = $r;

    foreach($full_name as $name){
        $first_name = $name['fname'];
        $last_name = $name['lname'];
        break;
    }
    
    echo "Hello, " . $first_name . " " . $last_name;
    //comment this out if you don't want to see the session variables  
    } 
    catch(PDOException $e){
        flash(var_export($e, true));
    }
}
?>

<link rel="stylesheet" href="styles.css">
<ul>
    <li class="dash-link"><a href="create_account.php">Create Account</a></li>
    <li class="dash-link"><a href="my_accounts.php">My Accounts</a></li>
    <li class="dash-link"><a href="transactions.php">Start a Transaction</a></li>
    <li class="dash-link"><a href= "profile.php">Profile</a></li>
</ul>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>