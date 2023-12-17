<?php
include_once 'functions.php';
?>

<div class="flex between center mb-2">
    <h2>Users</h2>
    <a class="btn btn-outline-secondary flex center" href="?posts&add">
        <span class="material-icons">add</span>
        Create user
    </a>
</div>
<div class="table-responsive mb-3">
    <?php
    $stmt = $mysqli->query("SELECT * FROM `dollarbuysell--users` ORDER BY `id` DESC");
    if ($stmt->num_rows > 0) {
    ?><table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Trx Count</th>
                    <th>Mobile</th>
                    <th>Reg Date</th>
                    <th align="center">...</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $folder_path = "./media/icons/";

                while ($item = $stmt->fetch_object()) { ?>
                    <tr>
                        <td class="text-capitalize has-icon">
                            <?php
                            echo $item->name;
                            ?>
                        </td>
                        <td><?php echo $item->email; ?></td>
                        <td><?php echo $item->trx_count; ?></td>
                        <td><?php echo $item->mobile; ?></td>
                        <td><?php echo $item->reg_date; ?></td>
                        <td>
                            <div class="flex center justify">
                                <a href="?users&edit&id=<?php echo $item->id; ?>" class="me-1"><span class="material-icons">delete</span></a>
                                <a href="?users&edit&id=<?php echo $item->id; ?>"><span class="material-icons">edit</span></a>
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