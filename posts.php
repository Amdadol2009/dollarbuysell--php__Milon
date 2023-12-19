<div class="flex between center mb-2">
  <h2>Posts</h2>
  <a class="btn btn-outline-secondary flex center" href="?posts&add#add-post-anchor">
    <span class="material-icons">add</span>
    Create Post
  </a>
</div>
<div class="table-responsive mb-5">
  <?php
  $stmt = $mysqli->query("SELECT *, (SELECT `id` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `senderId`, (SELECT `id` FROM `dollarbuysell--currencies` WHERE `gateway_receiver`=`id`) as `receiverId`, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `from`, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `gateway_receiver`=`id`) as `to`, (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `icon`, (SELECT `icon` FROM `dollarbuysell--currencies` WHERE `gateway_receiver`=`id`) as `icon2`, (SELECT `stock` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `stock`, (SELECT `prefix` FROM `dollarbuysell--currencies` WHERE `gateway_sender`=`id`) as `prefix`, `account_no` FROM `dollarbuysell--posts` ORDER BY `id` DESC");
  if ($stmt->num_rows > 0) {
  ?>
    <table>
      <thead>
        <tr>
          <th>&nbsp;</th>
          <th>Send gateway</th>
          <th>Receive gateway</th>
          <th>Amount sent</th>
          <th>Amount receive</th>
          <th>Account No</th>
          <th>...</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $folder_path = "./media/icons/";

        while ($item = $stmt->fetch_object()) { ?>
          <tr>
            <td class="muted">
              <?php
              echo '#' . $item->id . ' ';
              ?>
            </td>
            <td class="text-capitalize has-icon">
              <?php
              if ($item->icon != null) {
                echo "<img src='" . $folder_path . $item->icon . "'/>";
              }
              echo $item->from;
              // echo $item->senderId;
              ?>
            </td>
            <td class="has-icon"><?php 
              if ($item->icon2 != null) {
                echo "<img src='" . $folder_path . $item->icon2 . "'/>";
                ?><?php echo $item->to; 
                // echo ' '.$item->receiverId;
              } 
            ?></td>
            <td><?php echo $item->amount_send; ?></td>
            <td class="text-upper"><?php echo $item->amount_receive; ?></td>
            <td><?php echo $item->account_no; ?></td>
            <td><a href="?posts&edit&id=<?php echo $item->id; ?>"><span class="material-icons">edit</span></a></td>
          </tr><?php
              }
                ?>
      </tbody>
    </table>
  <?php } else {
  ?>
    <div class="card-body flex center justify" style="height: 220px; border: 1px solid #ffe69c; border-radius: 4px;">
      <div class="alert alert-warning">No posts found</div>
    </div>
  <?php
  } ?>

</div>