<?php
$id = $_GET['edit'];
$stmt = $mysqli->query("SELECT * FROM `dollarbuysell--currencies` WHERE `id`=$id ORDER BY `id` ASC");
if ($stmt->num_rows > 0) {
    $arr = array();
    while ($item = $stmt->fetch_object()) {
        $id = $item->id;
        $name = $item->name;
        $prefix = $item->prefix;
        $stock = $item->stock;
        $min = $item->min;
        $accNo = $item->accNo;
        $src = './media/icons/' . $item->icon;
    }
}
?>
<form class="flex-column" action="post.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="edit" value="<?php echo $id; ?>" />
    <div class="card mb-3">
        <div class="card-header">
            <a class="me-1" href="javascript:void(0)" onclick="history.back();">
                <span class="material-icons">keyboard_backspace</span>
            </a>
            <h2>Edit/Change currency</h2>
        </div>
        <div class="card-body">
            <div class="flex" style="margin-bottom: 1rem;">
                <div style="width:75%;" class="me-1">
                    <div class="form-floating">
                        <input class="form-control" required type="text" name="name" id="name" value="<?php echo $name; ?>">
                        <label for="name">Name</label>
                    </div>
                </div>
                <div style="width:25%" class="ms-1">
                    <div class="form-floating">
                        <input class="form-control" required placeholder="USD/BDT" type="text" name="prefix" id="prefix" value="<?php echo $prefix; ?>">
                        <label for="prefix">Prefix</label>
                    </div>
                </div>
            </div>

            <div class="flex" style="margin-bottom: 1rem;">
                <div style="width:75%;" class="me-1 form-floating">
                    <div class="form-floating">
                        <input class="form-control" required type="text" name="stock" id="stock" value="<?php echo $stock; ?>">
                        <label for="stock">Current Stock</label>
                    </div>
                </div>
                <div style="width:25%" class="ms-1 form-floating">
                    <input class="form-control" required placeholder="0" type="text" name="min" id="min" value="<?php echo $min; ?>">
                    <label for="min">Min Order</label>
                </div>
            </div>

            <div class="flex-column" style="margin-bottom: 1rem;">
                <label for="icon">Choose Icon</label>
                <input class="form-control" type="file" name="icon" id="icon">
            </div>

            <div class="form-floating">
                <input class="form-control" required placeholder="Account No" type="text" name="accNo" id="accNo" value="<?php echo $accNo; ?>">
                <label for="accNo">Account No</label>
            </div>
            
        </div>
        <div class="card-footer">
            <button class="btn btn-outline-secondary" type="reset">Clear</button>
            <div class="flex end">
                <button type="submit" class="btn btn-primary">Update changes</button>
            </div>
        </div>
    </div>
</form>