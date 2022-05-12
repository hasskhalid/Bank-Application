<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<link rel="stylesheet" href="styles.css">
<div id ="title">
    <h1>Meta Bank</h1> 
    <h2>(in the metaverse)</h2>
</div>
<?php

if (is_logged_in(true)) {
    ?>
    <h2 id="sideTitle">
        <?php echo "Welcome, " . get_username() . "!";?>
    </h2>
    <a href="dashboard.php" class="dashlink">-> Head over to the Dashboard!</a>

    <?php
    //comment this out if you don't want to see the session variables
    // echo "<pre>" . var_export($_SESSION, true) . "</pre>";
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>