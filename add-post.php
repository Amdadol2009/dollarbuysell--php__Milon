<?php

//Insert post
if ($_POST) {
  include 'db.php';
  $sender = $_POST['gateway_sender'];
  $receiver = $_POST['gateway_receiver'];
  $amount_send = $_POST['amount_send'];
  $amount_receive = $_POST['amount_receive'];
  $account_no = $_POST['account_no'];

  $sql = "INSERT INTO `dollarbuysell--posts` ( `gateway_sender`, `gateway_receiver`, `amount_send`, `amount_receive`,account_no) VALUES (?,?,?,?,?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('iidds', $sender, $receiver, $amount_send, $amount_receive, $account_no);
  $stmt->execute();

  header('location: ' . $_SERVER['HTTP_REFERER']);
} else {
?>

  <form class="flex-column mb-5" action="add-post.php" method="post" id="add-post-anchor">
    <div class="card mb-3">
      <div class="card-header">
          <a class="me-1" href="javascript:void(0)" onclick="history.back();">
            <span class="material-icons">keyboard_backspace</span>
          </a>
          <h2>Create post</h2>
      </div>
      <?php
      include 'functions.php';
      $options = listPosts();
      ?>
      <div class="card-body">
        <input type="hidden" name="add-post" />
        <div class="flex mb-3">
          <div style="width:50%;" class="me-1">
            <label for="gateway_sender">Choose sender</label>
            <select id="gateway_sender" name="gateway_sender" required class="form-select form-select-lg" aria-label="Large select example">
              <option selected value="-1">Choose gateway</option>
              <?php
              echo $options;
              ?>
            </select>
          </div>
          <div style="width:50%" class="ms-1">
            <label for="gateway_receiver">Choose receiver</label>
            <select id="gateway_receiver" name="gateway_receiver" required class="form-select form-select-lg" aria-label="Large select example">
              <option selected value="-1">Choose gateway</option>
              <?php
              echo $options;
              ?>
            </select>
          </div>
        </div>

        <div class="flex mb-3">
          <div style="width:50%;" class="me-1">
            <div class="form-floating">
              <input class="form-control" required type="number" step="0.01" value="0" name="amount_send" id="amount_send">
              <label for="sale_price">Amount send</label>
            </div>
          </div>
          <div style="width:50%" class="ms-1">
            <div class="form-floating">
              <input class="form-control" required type="number" step="0.01" value="0" name="amount_receive" id="amount_receive">
              <label for="buy_price">Amount receive</label>
            </div>
          </div>
        </div>
        
        <div class="form-floating">
          <input class="form-control" type="text" maxLength="11" min="11" name="account_no" id="account_no">
          <label for="account_no">Account no (017XXXXXXXXX)</label>
        </div>

      </div>
      <div class="card-footer">
        <button class="btn btn-outline-secondary" type="reset">Clear</button>
        <div class="flex end">
          <button type="submit" class="btn btn-primary">Save post</button>
        </div>
      </div>
    </div>
  </form>
<?php } ?>