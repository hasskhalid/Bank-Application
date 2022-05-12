<?php
require(__DIR__ . "/../../partials/nav.php");

if (is_logged_in(true)) {
}

$id = get_user_id();
$db = getDB();

try{
    if(isset($_POST["choose_account"])){
        $acc = se($_POST, "choose_account", "", false);

        $db = getDB();
        $stmt = $db->prepare("SELECT balance FROM Accounts WHERE id = :accsource");
        $stmt->execute([":accsource"=>$acc]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $balance = $result['balance'];

        switch($balance){
            case $balance > 0:
                flash("There is still a balance, please transfer/withdraw all funds before closing.");
                break;
            case $balance < 0:
                flash("Account under 0, please deposit $" . $balance . " to close account");
                break;
            case $balance = 0:
                close_account($acc);   
                break;
        }
        header( "refresh:2;url=my_accounts.php" );
    }
    $stmt = $db->prepare("SELECT id, account, balance FROM Accounts WHERE user_id = :uid AND isActive = 1");
    $accounts = [];
    $stmt->execute([":uid"=>$id]);
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $accounts = $r;
} 
catch(PDOException){
    flash(var_export($e, true));
}  
?>

<link rel="stylesheet" href="styles.css">
<h1>Close an Account</h1>

<div class ="container-fluid">
    <form onsubmit="return validcate(this)" method="POST">

        <div class="mb-3">
            <label class="form-label" for="account">Choose Account</label>
            <select id="choose_account" name="choose_account">
                <?php foreach($accounts as $account): ?>
                <option value ="<?php se($account['id']) ?>" >
                <?php se($account['account']); se(" $" . $account['balance']); endforeach; ?>
            </option>
            </select>
        </div>
        <input type="submit" class="mt-3 btn btn-primary" value="Submit">
    </form>
</div>
<a href= "dashboard.php" class="sideP"><- Go Back</a>

<script>
    function validate(form){
        return true;
    }
</script>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>