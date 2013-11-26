<?php

$dbh = new PDO('mysql:host=localhost;dbname=protif', 'root', '');

$mahasiswa = array();
foreach($dbh->query('SELECT * FROM mahasiswa', PDO::FETCH_ASSOC) as $row) {
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
