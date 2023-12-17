
<?php

function listPosts($selected = null)
{
    global $mysqli;

    $stmt = $mysqli->query("SELECT * FROM `dollarbuysell--currencies` WHERE `active`<>0 ORDER BY `id` ASC");
    if ($stmt->num_rows > 0) {
        $options = '';
        while ($item = $stmt->fetch_object()) {
            $id = $item->id;
            $name = $item->name;
            $prefix = $item->prefix;
            if ($selected !== null) {
                if ($selected === $id) {
                    $options .= '<option value="' . $id . '" selected>' . $name . ' ' . $prefix . '</option>';
                } else {
                    $options .= '<option value="' . $id . '">' . $name . ' ' . $prefix . '</option>';
                }
            } else {
                $options .= '<option value="' . $id . '">' . $name . ' ' . $prefix . '</option>';
            }
        }
        return $options;
    }
}

