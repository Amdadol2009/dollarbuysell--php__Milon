<?php 
include_once 'functions.php';
?>
<div class="flex between center mb-2">
<h2>Requests</h2>
</div>
<div class="table-responsive mb-5">
<?php
$stmt = $mysqli->query("SELECT *, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `sender`, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `receiver`,`status` FROM `dollarbuysell--orders` ORDER BY `id` DESC");
if ($stmt->num_rows > 0) {
?><table class='table table-striped'>
      <thead>
          <tr>
              <th>Send</th>
              <th>Receive</th>
              <th>Amount Sent</th>
              <th>Amount Receive</th>
              <th>Trx ID</th>
              <th>User Name</th>
              <th>Date</th>
              <th>Status</th>
          </tr>
      </thead>
      <tbody>

          <?php
          $folder_path = "./media/icons/";

          while ($item = $stmt->fetch_object()) { ?>
              <tr>
                  <td><?php echo $item->sender; ?></td>
                  <td><?php echo $item->receiver; ?></td>
                  <td><?php echo $item->amount_sent; ?></td>
                  <td><?php echo $item->amount_receive; ?></td>
                  <td><?php echo $item->trx_id; ?></td>
                  <td><?php echo $item->user_id; ?></td>
                  <td><?php echo $item->date; ?></td>
                  <td>
                      <div class="flex center justify">
                          <a href="#" class="me-1"><span class="material-icons"><?php echo $item->status == 0 ? 'downloading' : 'download_done'; ?></span></a>
                      </div>
                  </td>
              </tr>
              <?php
              }
              if($stmt->num_rows < 6){
                  for ($i=0; $i < 6 - $stmt->num_rows; $i++) { 
                      ?>
                      <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                      </tr>
                      <?php 
                  }
              }
          ?>
      </tbody>
  </table>
<?php } else {
?>
  <div class="card-body flex center justify" style="height: 220px; border: 1px solid #ffe69c; border-radius: 4px;">
      <div class="alert alert-warning">No request found</div>
  </div>
<?php
} ?>

</div>