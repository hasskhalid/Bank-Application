<?php
require(__DIR__ . "/../../partials/nav.php");

if (is_logged_in(true)) {
}
$id = get_user_id();
$db = getDB();


if(isset($_GET['acc'])){
  $acc = $_GET['acc'];
  $bal = $_GET['bal'];
  $acctype = $_GET['type'];
  $created = $_GET['created'];

  if (session_status() == PHP_SESSION_ACTIVE){
    $_SESSION['acc'] = $acc;
    $_SESSION['bal'] = $bal;
    $_SESSION['type'] = $acctype;
    $_SESSION['created'] = $created;
  }
}

?>
<h1>Account Information</h1>
<div class="container-fluid">
  <h3>Account Number: <?=$_SESSION['acc']?> </h3> 
  <h3>Account Balance: $<?=$_SESSION['bal']?> </h3>
  <h3>Account Type: <?=$_SESSION['type']?> </h3>
  <h3>Account Created: <?=$_SESSION['created']?> </h3>
</div>

  <div class="container-fluid">

  <form class="row row-cols-auto g-3 align-items-center" method="GET">
    <div class="col">
      <div class="input-group-text">Sort</div>
      <select class="form-control bg-info" name="col" value="TransactionType">
        <option value="deposit">Deposit😁</option>
        <option value="withdraw">Withdraw🥹</option>
        <option value="transfer">Transfer💸</option>
      </select>
    </div>
    <div class="col">
        <div class="input-group">
          <input type="submit" class="btn btn-primary" value="Apply" />
        </div>
    </div>
  </form>

  <?php
    $limit = 10;
    $count;
    if(!isset($_GET['page'])){
      $page_num = 1;
    } else{
      $page_num = $_GET['page'];
    }
    $initial_page = ($page_num-1)*$limit;

    if(isset($_GET['col'])){
      $transtype = $_GET['col'];

      $stmt = $db->prepare("SELECT A.account AS AccountSrc, B.account AS AccountDest,
                      BalanceChange, TransactionType, Memo, ExpectedTotal
                      FROM Transactions
                      JOIN Accounts A ON Transactions.AccountSrc = A.id
                      JOIN Accounts B ON Transactions.AccountDest = B.id
                      WHERE AccountSrc = :acc AND TransactionType = :transtype");
      $r = $stmt->execute([":acc"=>$_SESSION['acc'], ":transtype"=>$transtype]);
      $count = $stmt->rowCount();
      $stmt2 = $db->prepare("SELECT A.account AS AccountSrc, B.account AS AccountDest,
                      BalanceChange, TransactionType, Memo, ExpectedTotal
                      FROM Transactions
                      JOIN Accounts A ON Transactions.AccountSrc = A.id
                      JOIN Accounts B ON Transactions.AccountDest = B.id
                      WHERE AccountSrc = :acc AND TransactionType = :transtype
                      LIMIT $initial_page, $limit");
      $r2 = $stmt2->execute([":acc"=>$_SESSION['acc'], ":transtype"=>$transtype]);
    } else{
      $stmt = $db->prepare("SELECT A.account AS AccountSrc, B.account AS AccountDest,
                    BalanceChange, TransactionType, Memo, ExpectedTotal
                    FROM Transactions
                    JOIN Accounts A ON Transactions.AccountSrc = A.id
                    JOIN Accounts B ON Transactions.AccountDest = B.id
                    WHERE AccountSrc = :acc");
      $r = $stmt->execute([":acc"=>$_SESSION['acc']]); 
      $count = $stmt->rowCount();
      $stmt2 = $db->prepare("SELECT A.account AS AccountSrc, B.account AS AccountDest,
                    BalanceChange, TransactionType, Memo, ExpectedTotal
                    FROM Transactions
                    JOIN Accounts A ON Transactions.AccountSrc = A.id
                    JOIN Accounts B ON Transactions.AccountDest = B.id
                    WHERE AccountSrc = :acc ORDER BY Transactions.Created desc
                    LIMIT $initial_page, $limit");
      $r2 = $stmt2->execute([":acc"=>$_SESSION['acc']]);  
    } 
    $results = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $total_pages = ceil($count / $limit);

    for($page_number = 1; $page_number<= $total_pages; $page_number++) {  
      if(isset($transtype))
        echo '<a href = "account_info.php?page=' . $page_number . '&col=' . $transtype . '">' . $page_number . ' </a>'; 
      else
        echo '<a href = "account_info.php?page=' . $page_number  . '">' . $page_number . ' </a>';
    }    


  ?>
    <div class = "list-group">
      <?php if (isset($results) && count($results)): ?>
        <div class="list-group-item font-weight-bold">
          <div class="row">
            <div class="col">
              AccountSrc
            </div>
            <div class="col">
              AccountDest
            </div>
            <div class="col">
              BalanceChange
            </div>
            <div class="col">
              TransactionType
            </div>
            <div class="col">
              Memo
            </div>
            <div class="col">
              ExpectedTotal
            </div>
          </div>
        </div>
    </div>
    <?php foreach($results as $r2): ?>
      <div class="list-group-item">
        <div class="row">
          <div class="col">
            <?php se($r2['AccountSrc']); ?>
          </div>
          <div class="col">
            <?php se($r2['AccountDest']); ?>
          </div>
          <div class="col">
            <?php se($r2['BalanceChange']); ?>
          </div>
          <div class="col">
            <?php se($r2['TransactionType']); ?>
          </div>
          <div class="col">
            <?php se($r2['Memo']); ?>
          </div>
          <div class="col">
            <?php se($r2['ExpectedTotal']); ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>