<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<h1 id ="title">Online Banking</h1>
<?php

if (is_logged_in(true)) {
    ?>
    <h2 id ="sidetitle">Dashboard</h2>
    <?php
}
?>

<link rel="stylesheet" href="styles.css">
<p class="sideP">Please select the following: </p>
<ul>
    <li class="dash-link"><a href="create_account.php">Create Account</a></li>
    <li class="dash-link"><a href="my_accounts.php">My Accounts</a></li>
    <li class="dash-link"><a href="transactions.php">Make a Transaction</a></li>
    <li class="dash-link"><a href="ext_transfer.php">External Transfers</a></li>
    <li class="dash-link"><a href= "profile.php">Profile</a></li>
    <li class="dash-link"><a href= "close.php">Close Account</a></li>
</ul>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>