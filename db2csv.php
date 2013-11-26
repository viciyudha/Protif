<?php

$dbh = new PDO('mysql:host=localhost;dbname=protif', 'root', '');
$col = false;

header('Content-type: text/plain');
foreach($dbh->query('SELECT * FROM mahasiswa', PDO::FETCH_ASSOC) as $row) {
    if (!$col) {
        echo row2csv_columns($row);
        $col = true;
    }

    echo row2csv($row);
}


function row2csv_columns($array)
{
    $str = '';
    $array = array_keys($array);
    $len = count($array);

    for ($i = 0; $i < $len; $i++) {
        $str .= $array[$i] . ($i < $len - 1 ? "," : "\n");
    }

    return $str;
}

function row2csv($array)
{
    $str = '';
    $len = count($array);
    $i = 0;

    foreach ($array as $key => $val) {
         $str .= $array[$key] . ($i++ < $len - 1 ? "," : "\n");
    }

    return $str;
}

