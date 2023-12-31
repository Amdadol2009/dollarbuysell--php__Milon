<?php 
include_once 'functions.php';
?>
<div class="mb-2">
    <h2>Unprocessed Requests</h2>
</div>
<div class="table-responsive mb-3">
<?php
    $stmt = $mysqli->query("SELECT *, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `sender`, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `receiver`, (SELECT `name` FROM `dollarbuysell--users` WHERE `id`=`user_id`) as `name`, `status` FROM `dollarbuysell--orders` WHERE `account_no` IS NOT NULL AND `account_no` IS NOT NULL AND `status`=0 ORDER BY `status` ASC");
    if ($stmt->num_rows > 0) {
    ?>
    <table class='table table-striped'>
      <thead>
          <tr>
              <th>Send</th>
              <th>Receive</th>
              <th>Amount Sent</th>
              <th>Amount Receive</th>
              <th>Trx ID</th>
              <th>To account</th>
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
                  <td style="color: green; text-transform:uppercase"><?php echo $item->trx_id; ?></td>
                  <td style="color: blue; text-transform:uppercase"><?php echo $item->account_no; ?></td>
                  <td><?php echo $item->name; ?></td>
                  <td><?php echo $item->date; ?></td>
                  <td>
                      <div class="flex center justify">
                          <a href="javascript:void(0)" 
                          id="row-id-<?php echo $item->id;?>" 
                          onclick="toggleStats(<?php echo $item->id;?>,<?php echo $item->user_id;?>,this.id)" 
                          class="me-1">
                            <span class="material-icons">
                                <?php echo $item->status == 0 ? 'downloading' : 'download_done'; ?>
                            </span>
                        </a>
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


<div id="processed-requests">
    <div class="mb-2 flex between">
        <h2 style="flex-grow: 1;">Processed requests</h2>
        <input class="form-control" id="datepicker" type="date"
         name="date" style="width: 25%"
         min="2023-12-01" 
         max="2130-12-31"
         onchange="pickDate()" value="<?php echo isset($_GET['date'])?$_GET['date']:'';?>"/>
    </div>
    <div class="table-responsive mb-5">
    <?php
    if(isset($_GET['date'])){
        $date = $_GET['date'];
        $stmt = $mysqli->query("SELECT *, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `sender`, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `receiver`, (SELECT `name` FROM `dollarbuysell--users` WHERE `id`=`user_id`) as `name`, `status` FROM `dollarbuysell--orders` WHERE `date`='$date' AND `status`=1 ORDER BY `status` ASC");
        
    }else{
        $stmt = $mysqli->query("SELECT *, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`send_gateway`) as `sender`, (SELECT `name` FROM `dollarbuysell--currencies` WHERE `id`=`receive_gateway`) as `receiver`, (SELECT `name` FROM `dollarbuysell--users` WHERE `id`=`user_id`) as `name`, `status` FROM `dollarbuysell--orders` WHERE `date`=CURDATE() AND `status`=1 ORDER BY `status` ASC");
    }
        if ($stmt->num_rows > 0) {
        ?>
        <table class='table table-striped'>
        <thead>
            <tr>
                <th>Send</th>
                <th>Receive</th>
                <th>Amount Sent</th>
                <th>Amount Receive</th>
                <th>Trx ID</th>
                <th>To account</th>
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
                    <td style="color: green; text-transform:uppercase"><?php echo $item->trx_id; ?></td>
                    <td style="color: blue; text-transform:uppercase"><?php echo $item->account_no; ?></td>
                    <td><?php echo $item->name; ?></td>
                    <td><?php echo $item->date; ?></td>
                    <td>
                        <div class="flex center justify">
                            <a href="javascript:void(0)" 
                            id="row-id-<?php echo $item->id;?>" 
                            onclick="toggleStats(<?php echo $item->id;?>,<?php echo $item->user_id;?>,this.id)" 
                            class="me-1">
                                <span class="material-icons">
                                    <?php echo $item->status == 0 ? 'downloading' : 'download_done'; ?>
                                </span>
                            </a>
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
</div>

<script>
    function pickDate () {
        let date = document.getElementById('datepicker').value;
        console.log(date)
        window.location.href = "?date="+date+'#processed-requests';
    }
</script>