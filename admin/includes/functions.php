<?php

function get_category_title_by_id($cat_id) {
    $title = '';
    $result = get_category_by_id($cat_id);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['cat_title'];
        return $title;
    }
   if ($result == null) { 
       echo "row not found";
   }
    return $title;
} 

?>