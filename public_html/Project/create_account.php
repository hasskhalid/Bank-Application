<?php
require(__DIR__ . "/../../partials/nav.php");

if (is_logged_in(true)) {
}
?>

<link rel="stylesheet" href="styles.css">
<h1>Create a Checking Account</h1>

<div class ="container-fluid">
    <form onsubmit="return validcate(this)" method="POST">
        <div class="mb-3">
            <label class="form-label" for="account type">Account Type</label>
            <select id="account_type" name="account_type">
                <option value="checking">Checking</option>
                <option value="saving">Saving</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="deposit">Deposit (min $5 required)</label>
            <input class="form-control" type="text" name="depost"/>
        </div>
        <input type="submit" class="mt-3 btn btn-primary" value="Create">
    </form>
</div>

<script>
    function validate(form){
        return true;
    }
</script>

<?php
   if(isset($_POST["account_type"]) && isset($_POST["deposit"])){
    $type = se($_POST, "account_type", "", false);
    $deposit = se($_POST, "deposit", 0, false);
    if(!empty($type) && $deposit >= 5){
        $query = "INSERT INTO Accounts(account_number, account_type, user_id) VALUES (null, :at, :uid)";
        $db = getDB();
        $stmt = $db->prepare($query);
        $id = $db->lastInsertId();
        $account_number = str_pad($id, "0", 12, STR_PAD_LEFT);
        $query2 = "UPDATE Accounts SET account_number = :an WHERE id = :id";
        $stmt = $id->prepare($query2);
    }
}   
?>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>