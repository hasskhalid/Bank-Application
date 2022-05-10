<?php
require(__DIR__ . "/../../partials/nav.php");

if (is_logged_in(true)) {
}

$id = get_user_id();
$db = getDB();

try{
    if(isset($_POST["choose_account"]) && isset($_POST["amount"]) && isset($_POST["memo"])) {
        $type = 'ext-transfer';
        $accsource = se($_POST, "choose_account", "", false);
        $user_last = se($_POST, "user_last", "", false);
        $accdest = (int)se($_POST, "acc2", "", false);
        $amount = $_POST ['amount'];
        $memo = se($_POST, "memo", "", false);

        $db = getDB();

        $stmt = $db->prepare("SELECT Accounts.id
                            FROM Users
                            Inner JOIN Accounts ON Users.id = Accounts.user_id
                            WHERE Users.lname = :user_last AND Accounts.id = :accdest ");
        $stmt->execute([":user_last"=>$user_last, ":accdest"=>$accdest]);
        $re = $stmt->fetch(PDO::FETCH_ASSOC);
        $acc2 = $re['id'];

        $stmt = $db->prepare("SELECT balance FROM Accounts WHERE id = :accsource");
        $stmt->execute([":accsource"=>$accsource]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $balance = $result['balance'];

        if($amount > $balance){
            flash("Amount exceeds balance!");
        }else{ 
            transaction($amount, $type, $accsource, $acc2, $memo);
        }
    }
    $stmt = $db->prepare("SELECT id, account, balance FROM Accounts WHERE user_id = :uid");
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
<h1>External Transfers</h1>

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

        <div class="mb-3" id="user_last">
            <label class="form-label" for="user_last">Other User's Last Name</label>
            <input class="form-control" type="text" name="user_last"/>
        </div>
        
        <div class="mb-3" id="second_account">
            <label class="form-label" for="account">Choose Second Account (Last 4 Digits)</label>
            <input class="form-control" type="text" maxlength="4" name="acc2"/>
        </div>

        <div class="mb-3">
            <label class="form-label" for="amount">Amount (No less than 0)</label>
            <input class="form-control" name="amount" min="0" placeholder="$0.00"/>
        </div>
        <div class="mb-3">
            <label class="form-label" for="memo">Memo</label>
            <input class="form-control" type="text" name="memo"/>
        </div>
        <input type="submit" class="mt-3 btn btn-primary" value="Submit">
    </form>
</div>

<script>
    function validate(form){
        return true;
    }
</script>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>