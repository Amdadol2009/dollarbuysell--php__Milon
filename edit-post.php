<?php

include_once 'db.php';
include 'functions.php';

if ($_GET) {
  //load post
  if (!isset($_GET['delete'])) {
    $id = $_GET['id'];
    $stmt = $mysqli->query("SELECT * FROM `dollarbuysell--posts` WHERE `id`='$id' ORDER BY `id` DESC");
    if ($stmt->num_rows > 0) {
      $item = $stmt->fetch_object();
      $options1 = listPosts($item->gateway_sender);
      $options2 = listPosts($item->gateway_receiver);
    }
?>
    <form class="flex-column" action="edit-post.php" method="post" id="edit-post-anchor">
      <div class="card mb-3">
        <div class="card-header">
          <a class="me-1" href="javascript:void(0)" onclick="history.back();">
            <span class="material-icons">keyboard_backspace</span>
          </a>
          <h4>Edit/change post</h4>
        </div>
        <?php
        if ($stmt->num_rows > 0) {
        ?>
          <div class="card-body">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="flex mb-3">
              <div style="width:50%;" class="me-1">
                <label for="gateway_sender">Gateway sender</label>
                <select id="gateway_sender" name="gateway_sender" required class="form-select form-select-lg" aria-label="Large select example">
                  <option value="">Choose gateway</option>
                  <?php
                  echo $options1;
                  ?>
                </select>
              </div>
              <div style="width:50%" class="ms-1">
                <label for="gateway_receiver">Gateway receiver</label>
                <select id="gateway_receiver" name="gateway_receiver" required class="form-select form-select-lg" aria-label="Large select example">
                  <option value="">Choose gateway</option>
                  <?php
                  echo $options2;
                  ?>
                </select>
              </div>
            </div>

            <div class="flex mb-3">
              <div style="width:50%;" class="me-1">
                <div class="form-floating">
                  <input class="form-control" required type="number" step="0.01" name="amount_send" id="amount_send" value="<?php echo $item->amount_send; ?>">
                  <label for="sale_price">Amount send</label>
                </div>
              </div>
              <div style="width:50%" class="ms-1">
                <div class="form-floating">
                  <input class="form-control" required type="number" step="0.01" name="amount_receive" id="amount_receive" value="<?php echo $item->amount_receive; ?>">
                  <label for="buy_price">Amount receive</label>
                </div>
              </div>
            </div>

            
            <div class="form-floating">
              <input class="form-control" type="text" maxLength="11" min="11" value="<?php echo $item->account_no; ?>" name="account_no" id="account_no">
              <label for="account_no">Account no (017XXXXXXXXX)</label>
            </div>

          </div>
          <div class="card-footer">
            <a  class="btn btn-outline-secondary flex center" role="button" href="edit-post.php?delete&id=<?php echo $item->id; ?>"><span class="material-icons">delete</span>Delete</a>
            <div class="flex end">
              <button type="submit" class="btn btn-primary">Update post</button>
            </div>
          </div>
        <?php
        } else {
        ?>
          <div class="card-body flex center justify" style="height: 220px;">
            <div class="alert alert-danger">No records found for this item</div>
          </div>

        <?php
        }
        ?>
      </div>
    </form>
  <?php
  } else {
    //delete post
    $id = $_GET['id'];
    $stmt = $mysqli->query("DELETE FROM `dollarbuysell--posts` WHERE `id`='$id' ORDER BY `id` DESC");
    ?>
    <script>
      history.clear()
    </script>
    <?php
    header("location: index.php?posts");
  }
}


//Update post
if ($_POST) {
  $id = $_POST['id'];
  $sender = $_POST['gateway_sender'];
  $receiver = $_POST['gateway_receiver'];
  $amount_send = $_POST['amount_send'];
  $amount_receive = $_POST['amount_receive'];
  $account_no = $_POST['account_no'];

  $sql = "UPDATE `dollarbuysell--posts` SET `gateway_sender`=?, `gateway_receiver`=?, `amount_send`=?, `amount_receive`=?, `account_no`=? WHERE `id`=?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('iiddsi', $sender, $receiver, $amount_send, $amount_receive, $account_no, $id);
  $stmt->execute();
  header('location: index.php?posts');
}
    ?>