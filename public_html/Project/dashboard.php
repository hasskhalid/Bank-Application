<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<h1>Dashboard</h1>
<?php

if (is_logged_in(true)) {
    echo "Hello, " . get_username();
    //comment this out if you don't want to see the session variables  
}
?>

<link rel="stylesheet" href="styles.css">
<ul>
    <li class="dash-link"><a href="create_account.php">Create Account</a></li>
    <li class="dash-link"><a href="my_accounts.php">My Accounts</a></li>
    <li class="dash-link"><a href="transactions.php">Start a Transaction</a></li>
    <li class="dash-link"><a href="<?php echo get_url('profile.php'); ?>">Profile</a></li>
</ul>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>