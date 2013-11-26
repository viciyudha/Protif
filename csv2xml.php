<?php

$mahasiswa = array();
$file = file('./data.csv');
$line_num = count($file);

$line = str_replace("\n", "", $file[0]);
$columns = explode(',', $line);
$col_num = count($columns);

for ($i = 1; $i < $line_num; $i++) {
    $row = array();

    $line = str_replace("\n", "", $file[$i]);
    $row_data = explode(',', $line);

    for ($j = 0; $j < $col_num; $j++) {
        $row[$columns[$j]] = $row_data[$j];
    }

    $mahasiswa[] = array(
        'mahasiswa' => $row,
    );
}

function array2xml($array, &$xml) {
    foreach ($array as $k => $v) {
        if (is_array($v)) {
            if (!is_numeric($k)) {
                $subnode = $xml->addChild("$k");
                array2xml($v, $subnode);
            }
            else {
                array2xml($v, $xml);
            }
        }
        else {
            $xml->addChild("$k", "$v");
        }
    }
}

$xml = new SimpleXMLElement("<data_mahasiswa/>");

array2xml($mahasiswa, $xml);
$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());

header('Content-type: text/plain');
echo $dom->saveXML();
