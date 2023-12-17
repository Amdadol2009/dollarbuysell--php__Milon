<form class="flex-column" action="post.php" method="post" enctype="multipart/form-data">
    <div class="card mb-3">
        <div class="card-header">
            <a class="me-1" href="javascript:void(0)" onclick="history.back();">
                <span class="material-icons">keyboard_backspace</span>
            </a>
            <h2>Add currency</h2>
        </div>
        <div class="card-body">
            <input type="hidden" name="add" />
            <div class="flex" style="margin-bottom: 1rem;">
                <div style="width:75%;" class="me-1 form-floating">
                    <input class="form-control" required type="text" name="name" id="name" value="<?php echo $name; ?>">
                    <label for="name">Name</label>
                </div>
                <div style="width:25%" class="ms-1 form-floating">
                    <input class="form-control" required placeholder="USD/BDT" type="text" name="prefix" id="prefix" value="<?php echo $prefix; ?>">
                    <label for="prefix">Prefix</label>
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
        </div>
        <div class="card-footer">
            <button class="btn btn-outline-secondary" type="reset">Clear</button>
            <div class="flex end">
                <button type="submit" class="btn btn-primary">Save currency</button>
            </div>
        </div>
    </div>
</form>