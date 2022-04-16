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

function account_balance(){
    if(is_logged_in(true)){
        $query = "UPDATE Accounts set balance = (SELECT IFNULL(SUM(BalanceChange),0)
        from Transactions WHERE AccountSrc = :accountsrc) WHERE id = :accountsrc";
        $db = getDB();
        $stmt = $db -> prepare($query);
        try{
            $stmt->execute([":accountsrc" => get_user_id()]);
            //create_account();
        } catch (PDOException $e){
            flash("Error");
        }
    }
}

function create_account(){
    if(isset($_POST["account_type"]) && isset($_POST["deposit"])){
        $type = se($_POST, "account_type", "", false);
        $deposit = se($_POST, "deposit", 0, false);

        if(!empty($type) && $deposit >= 5){
            $query = "INSERT INTO Accounts(account, user_id) VALUES (null, :user_id)";
            $db = getDB();
            $stmt = $db->prepare($query);
            $stmt->execute([":user_id" => get_user_id()]);

            $id = $db->lastInsertID();
            $account_number = str_pad($id, 12, "0", STR_PAD_LEFT);
            $query2 = "UPDATE Accounts SET account = :account WHERE id = $id";
            $stmt = $db ->prepare($query2);

            try{
                $stmt->execute([":execute" => $account_number, ":balance" => $deposit]);
                flash("Successfully Created!");
            } catch (Exception $e){
                flash("Not Created Successfully");
            }
        }
    }
}

function transaction($account1, $type, $accountsrc = -1, $accountdest = -1, $memo = ""){
    if($account1 > 0){
        $query = "INSERT INTO Transactions (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo)
        VALUES (:acc1, :accd1, :acclchange, :reason, :memo),
        (:acc2, :accd2, :acc2change, :reason, :memo)";
        $params [":acc1"] = $accountsrc;
        $params [":accd1"] = $accountdest;
        $params[":reason" ] = $type;
        $params [":memo" ] = $memo;
        $params [":acc1change"] = ($account1*-1);

        $params[":acc2"] = $accountdest;
        $params [":accd2" ] = $accountsrc;
        $params [":acc2change"] = $account1;
        $db = getDB();
        $stmt = $db->prepare($query);
        try{
            $stmt->execute($params);
            account_balance() ;
        } catch (PDOException $e){
            flash("Error!");
        }
    }
}
