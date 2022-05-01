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
    create_account();
?>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>