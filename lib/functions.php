<?php
require_once(__DIR__ . "/db.php");
$BASE_PATH = '/Project/'; //This is going to be a helper for redirecting to our base project path since it's nested in another folder
function se($v, $k = null, $default = "", $isEcho = true)
{
    if (is_array($v) && isset($k) && isset($v[$k])) {
        $returnValue = $v[$k];
    } else if (is_object($v) && isset($k) && isset($v->$k)) {
        $returnValue = $v->$k;
    } else {
        $returnValue = $v;
        //added 07-05-2021 to fix case where $k of $v isn't set
        //this is to kep htmlspecialchars happy
        if (is_array($returnValue) || is_object($returnValue)) {
            $returnValue = $default;
        }
    }
    if (!isset($returnValue)) {
        $returnValue = $default;
    }
    if ($isEcho) {
        //https://www.php.net/manual/en/function.htmlspecialchars.php
        echo htmlspecialchars($returnValue, ENT_QUOTES);
    } else {
        //https://www.php.net/manual/en/function.htmlspecialchars.php
        return htmlspecialchars($returnValue, ENT_QUOTES);
    }
}
//TODO 2: filter helpers
function sanitize_email($email = "")
{
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}
function is_valid_email($email = "")
{
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
}
//TODO 3: User Helpers
function is_logged_in($redirect = false, $destination = "login.php")
{
    $isLoggedIn = isset($_SESSION["user"]);
    if ($redirect && !$isLoggedIn) {
        flash("You must be logged in to view this page", "warning");
        die(header("Location: $destination"));
    }
    return $isLoggedIn; //se($_SESSION, "user", false, false);
}
function has_role($role)
{
    if (is_logged_in() && isset($_SESSION["user"]["roles"])) {
        foreach ($_SESSION["user"]["roles"] as $r) {
            if ($r["name"] === $role) {
                return true;
            }
        }
    }
    return false;
}
function get_username()
{
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "username", "", false);
    }
    return "";
}
function get_user_email()
{
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "email", "", false);
    }
    return "";
}
function get_user_id()
{
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "id", false, false);
    }
    return false;
}
//TODO 4: Flash Message Helpers
function flash($msg = "", $color = "info")
{
    $message = ["text" => $msg, "color" => $color];
    if (isset($_SESSION['flash'])) {
        array_push($_SESSION['flash'], $message);
    } else {
        $_SESSION['flash'] = array();
        array_push($_SESSION['flash'], $message);
    }
}

function getMessages()
{
    if (isset($_SESSION['flash'])) {
        $flashes = $_SESSION['flash'];
        $_SESSION['flash'] = array();
        return $flashes;
    }
    return array();
}
//TODO generic helpers
function reset_session()
{
    session_unset();
    session_destroy();
    session_start();
}
function users_check_duplicate($errorInfo)
{
    if ($errorInfo[1] === 1062) {
        //https://www.php.net/manual/en/function.preg-match.php
        preg_match("/Users.(\w+)/", $errorInfo[2], $matches);
        if (isset($matches[1])) {
            flash("The chosen " . $matches[1] . " is not available.", "warning");
        } else {
            //TODO come up with a nice error message
            flash("<pre>" . var_export($errorInfo, true) . "</pre>");
        }
    } else {
        //TODO come up with a nice error message
        flash("<pre>" . var_export($errorInfo, true) . "</pre>");
    }
}
function get_url($dest)
{
    global $BASE_PATH;
    if (str_starts_with($dest, "/")) {
        //handle absolute path
        return $dest;
    }
    //handle relative path
    return $BASE_PATH . $dest;
}

function get_random_str($length)
{
    //https://stackoverflow.com/a/13733588
    //$bytes = random_bytes($length / 2);
    //return bin2hex($bytes);

    //https://stackoverflow.com/a/40974772
    return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 36)), 0, $length);
}

function account_balance($account_id){
    if(is_logged_in(true)){
        $query = "UPDATE Accounts set balance = (SELECT IFNULL(SUM(BalanceChange),0)
        from Transactions WHERE AccountSrc = :accountsrc) WHERE id = :accountsrc";
        $db = getDB();
        $stmt = $db -> prepare($query);
        try{
            $stmt->execute([":accountsrc" => $account_id]);
        } catch (PDOException $e){
            flash("Error");
        }
    }
}

function create_account(){
    if(isset($_POST["account_type"]) && isset($_POST["deposit"])){
    $type = se($_POST, "account_type", "", false);
    $deposit = se($_POST, "deposit", 0, false);
    $transaction_type = "deposit";

        if(!empty($type) && $deposit >= 5){
            $query = "INSERT INTO Accounts(account, user_id, account_type) VALUES (null, :user_id, '$type')";
            $db = getDB();
            $stmt = $db->prepare($query);
            $stmt->execute([":user_id" => get_user_id()]);

            $id = $db->lastInsertId();
            $account_number = str_pad($id, 12, "0", STR_PAD_LEFT);
            //$query2 = "UPDATE Accounts SET account = :account, balance = :balance WHERE id = $id";
            $query2 = "UPDATE Accounts SET account = :account WHERE id = $id";
            $stmt = $db->prepare($query2);

            try {
                //$stmt->execute([":account" => $account_number, ":balance" => $deposit]);
                $stmt->execute([":account" => $account_number]);
                transaction($deposit, $transaction_type, -1, $id, "");
                flash("Successfully Created!");
                header("Location: my_accounts.php");
                exit();
            } 
            catch (Exception $e) {
                flash("Not Created Successfully");
            }
        }
    }
}

function transaction($cashflow, $transaction_type, $accountsrc, $accountdest, $memo = ""){
    if($cashflow > 0){

        $query1 = "SELECT balance FROM Accounts WHERE id = :accountsrc";
        $db = getDB();
        $stmt = $db->prepare($query1);
        $stmt->execute([":accountsrc" => $accountsrc]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total1 = (int)$result["balance"];

        $acc1change = $cashflow*-1;
        $expectedtotal1 = $total1 + $acc1change;

        $query2 = "SELECT balance FROM Accounts WHERE id = :accountdest";
        $db = getDB();
        $stmt = $db->prepare($query2);
        $stmt->execute([":accountdest" => $accountdest]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total2 = (int)$result["balance"];

        $acc2change = $cashflow;
        $expectedtotal2 = $total2 + $acc2change;

        $query = "INSERT INTO Transactions (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo, ExpectedTotal)
        VALUES (:acc1, :accd1, :acc1change, :reason, :memo, :expectedtotal1),
        (:acc2, :accd2, :acc2change, :reason, :memo, :expectedtotal2)";
        $params[":acc1"] = $accountsrc;
        $params[":accd1"] = $accountdest;
        $params[":reason" ] = $transaction_type;
        $params[":memo" ] = $memo;
        $params[":acc1change"] = $acc1change;
        $params[":expectedtotal1"] = $expectedtotal1;
        $params[":acc2"] = $accountdest;
        $params[":accd2" ] = $accountsrc;
        $params[":acc2change"] = $acc2change;
        $params[":expectedtotal2"] = $expectedtotal2;
        $db = getDB();
        $stmt = $db->prepare($query);
        try{
            $stmt->execute($params);
            account_balance($accountsrc);
            account_balance($accountdest);
            flash("Transaction Successful!");

        } catch (PDOException $e){
            flash("Error!");
        }
    }
}

