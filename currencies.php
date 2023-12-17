<?php
include_once 'db.php';
if (isset($_GET['delete'])) {
    //delete post
    $id = $_GET['id'];
    $stmt = $mysqli->query("DELETE FROM `dollarbuysell--currencies` WHERE `id`='$id' ORDER BY `id` DESC");
    header('location: ' . $_SERVER['HTTP_REFERER']);

}
?>
<div class="flex between center mb-2">
  <h2>Currencies</h2>
  <a class="btn btn-outline-secondary flex center" href="?currency&add">
    <span class="material-icons">add</span>
    Add
  </a>
</div>
<div class="table-responsive mb-3">
  <?php
$stmt = $mysqli->query("SELECT * FROM `dollarbuysell--currencies` ORDER BY `id` ASC");
if ($stmt->num_rows > 0) {
    ?><table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Stock</th>
          <th>Min. Order</th>
          <th>Prefix</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>

        <?php
$folder_path = "./media/icons/";

    while ($item = $stmt->fetch_object()) {?>
          <tr>
            <td class="text-capitalize has-icon"><?php if ($item->icon != null) {
        echo "<img src='" . $folder_path . $item->icon . "'/>";
    }?> <a href="?currency&edit=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></td>
            <td><?php echo $item->stock; ?></td>
            <td><?php echo $item->min; ?></td>
            <td class="text-upper"><?php echo $item->prefix; ?></td>
            <td class="flex center justify"><a href="currencies.php?delete&id=<?php echo $item->id; ?>"><span class="material-icons">delete</span></a></td>

          </tr><?php
}

    // if ($stmt->num_rows <= 5) {
    //     for ($i = 0; $i < 5; $i++) {
    ?>
        <!-- <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr> -->
        <?php
// }
    // }
    ?>
      </tbody>
    </table>
  <?php }?>

</div>