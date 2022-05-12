<?php
require(__DIR__ . "/../../partials/nav.php");

if (is_logged_in(true)) {
}

$id = get_user_id();
$db = getDB();

try{
    if(isset($_POST["transaction_type"]) && isset($_POST["choose_account"]) && isset($_POST["amount"]) && isset($_POST["memo"])) {
        $type = $_POST['transaction_type'];
        $accsource = se($_POST, "choose_account", "", false);
        $acc2 = se($_POST, "acc2", "", false);
        $amount = $_POST ['amount'];
        $memo = se($_POST, "memo", "", false);

        $db = getDB();
        $stmt = $db->prepare("SELECT balance FROM Accounts WHERE id = :accsource");
        $stmt->execute([":accsource"=>$accsource]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $balance = $result['balance'];
        $world = -1;

        switch($type){
            case 'deposit':
                transaction($amount, $type, $world, $accsource, $memo);
                break;
            case 'withdraw':
                if($amount > $balance){
                    flash("Amount exceeds balance!");
                }else{
                    transaction($amount, $type, $accsource, $world, $memo);
                }
                break;
            case 'transfer':
                if($amount > $balance){
                    flash("Amount exceeds balance!");
                }else{ 
                    transaction($amount, $type, $accsource, $acc2, $memo);
                    break;
                }
        }
    }
    $stmt = $db->prepare("SELECT id, account, balance, account_type FROM Accounts WHERE user_id = :uid AND isActive = 1");
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
<h1>Make a Transaction!</h1>

<div class ="container-fluid">
    <form onsubmit="return validcate(this)" method="POST">

        <div class="mb-3">
            <label class="form-label" for="transaction type">Transaction Type</label>
            <select id="transaction_type" name="transaction_type" onchange="hideDiv()">
                <option value="deposit">Deposit</option>
                <option value="withdraw">Withdraw</option>
                <option value="transfer">Transfer</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="account">Choose Account</label>
            <select id="choose_account" name="choose_account">
                <?php foreach($accounts as $account): ?>
                <option value ="<?php se($account['id']) ?>" >
                <?php se($account['account']); se(" $" . $account['balance']); se(" - " . $account['account_type']); endforeach; ?>
            </option>
            </select>
        </div>
        
        <div class="mb-3" id="second_account" style="display: none">
            <label class="form-label" for="account">Choose Second Account</label>
            <select id="acc2" name="acc2">
                <?php foreach($accounts as $account): ?>
                <option value ="<?php se($account['id']) ?>" >
                <?php se($account['account']); se(" $" . $account['balance']); se(" - " . $account['account_type']); endforeach; ?>
            </option>
            </select>
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
<a href= "dashboard.php" class="sideP"><- Go Back</a>

<script>
    function validate(form){
        return true;
    }
    function hideDiv() {
        var x = document.getElementById("second_account");
        if(document.getElementById("transaction_type").value === 'transfer'){
            x.style.display = "block";
        }
        else{
            x.style.display = "none";
        }
    }
</script>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>