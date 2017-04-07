<?php
$search_options = array();
$fields = array();
foreach ($_POST as $key => $val) {
    if($key == "Search")
        continue;
    $fields[] = $key;
    if($val != "")
        $search_options[$key] = $val;
    
}