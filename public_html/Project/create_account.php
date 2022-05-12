<?php
require(__DIR__ . "/../../partials/nav.php");

if (is_logged_in(true)) {
}
?>

<link rel="stylesheet" href="styles.css">
<h1 id="title">Create an Account</h1>

<div class ="container-fluid">
    <form onsubmit="return validcate(this)" method="POST">
    <div class="mb-3">
            <label class="form-label" for="account type">Account Type</label>
            <select id="account_type" name="account_type" onchange="hideDiv()">
                <option value="checking">Checking</option>
                <option value="savings">Savings</option>
            </select>
        </div>

        <div class="mb-3" id="apy" style="display: none">
            <label class="form-label" for="apy">APY:</label>
            <?php echo"0.06%"; ?>
        </div>

        <div class="mb-3">
            <label class="form-label" for="deposit">Deposit (min $5 required)</label>
            <input class="form-control" type="text" name="deposit"/>
        </div>
        <input type="submit" class="mt-3 btn btn-primary" value="Create">
    </form>

    <a href= "dashboard.php" class="sideP"><- Go Back</a>
</div>

<script>
    function validate(form){
        return true;
    }
    function hideDiv() {
        var x = document.getElementById("apy");
        if(document.getElementById("account_type").value === 'savings'){
            x.style.display = "block";
        }
        else{
            x.style.display = "none";
        }
    }

</script>

<?php
    create_account();
?>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>