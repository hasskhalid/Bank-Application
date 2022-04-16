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
            <input class="form-control" type="text" name="deposit"/>
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
        $query = "INSERT INTO Accounts(account, user_id) VALUES (null, :user_id)";
        $db = getDB();
        $stmt = $db->prepare($query);
        $stmt->execute([":user_id" => get_user_id()]);

        $id = $db->lastInsertId();
        $account_number = str_pad($id, 12, "0", STR_PAD_LEFT);
        $query2 = "UPDATE Accounts SET account = :account, balance = :balance WHERE id = $id";
        $stmt = $db->prepare($query2);

        try {
            $stmt->execute([":account" => $account_number, ":balance" => $deposit]);
            flash("Successfully Created!");
        } catch (Exception $e) {
            flash("Not Created Successfully");
        }

        //transaction ledger

        $accountsrc = $account_number;
        $accountdest = "SELECT account FROM Accounts WHERE id = -1";

        $query = "INSERT INTO Transactions (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo, ExpectedTotal)
        VALUES (:1account1, :1account2, :1change1, :transactiontype, :memo, :total1), 
        (:2account2, :2account1, :2change2, :transactiontype, :memo, :total2)";

        $stmt = $db->prepare($query);
        $params [":1account1"] = $accountsrc;
        $params [":1account2"] = $accountdest;
        $params [":1change1"] = $deposit;
        $params [":transactiontype"] = $type;
        $params [":memo"] = "initial deposit";
        $params [":total1"] = $accountdest;
        
    }
}   
?>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>