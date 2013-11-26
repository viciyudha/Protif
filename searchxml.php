<?php

$nim_search = isset($_GET['nim']) ? intval($_GET['nim']) : 0;

$mahasiswa = null;
$xml = simplexml_load_file('./data.xml');

$element_count = $xml->count();
for ($i = 0; $i < $element_count; $i++) {
    $nim = $xml->mahasiswa[$i]->nim;
    if ($nim == $nim_search) {
        $mahasiswa = $xml->mahasiswa[$i];
        break;
    }
}

if ($mahasiswa != null) {
    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($mahasiswa->asXML());
    $out = $dom->saveXML();
} else {
    $out = "NOT FOUND!\n";
}

header('Content-type: text/plain');
echo $out;
