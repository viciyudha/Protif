<?php
        error_reporting(0);
        $i = 0;
        $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $xmldb = file_get_contents('http://localhost/Protif/db2xml.php', false, $context);
 	$xmldb = simplexml_load_string($xmldb);
	$xmlcsv = file_get_contents('http://localhost/Protif/csv2xml.php', false, $context);
 	$xmlcsv = simplexml_load_string($xmlcsv);
	$xml = simplexml_load_file('data.xml');

	$mhsdb = $xmldb->mahasiswa;
	$mhscsv = $xmlcsv->mahasiswa;
	$mhs = $xml->mahasiswa;

	if(isset($_GET['nama'])){
		$nama = $_GET['nama'];
		echo('Data XML : <br>');
		echo("<table><tr><td>ID</td><td>Nama</td><td>NIM</td></tr>");
		for($i=0;$i<count($mhs);$i++){
			if($nama == $mhs[$i]->nama){
  				echo("<tr>");
  				echo("<td>".$mhs[$i]->id."</td>");
				echo("<td>".$mhs[$i]->nama."</td>");	
				echo("<td>".$mhs[$i]->nim."</td>");
				echo("</tr>");
			}
		}
		echo("</table>");
		echo('<br>Data DB : <br>');
		echo("<table><tr><td>ID</td><td>Nama</td><td>NIM</td></tr>");
		for($i=0;$i<count($mhsdb);$i++){
			if($nama == $mhsdb[$i]->nama){
				echo("<tr>");
  				echo("<td>".$mhsdb[$i]->id."</td>");
				echo("<td>".$mhsdb[$i]->nama."</td>");	
				echo("<td>".$mhsdb[$i]->nim."</td>");
				echo("</tr>");
			}
		}
		echo("</table>");
		echo('<br>Data CSV : <br>');
		echo("<table><tr><td>ID</td><td>Nama</td><td>NIM</td></tr>");
		for($i=0;$i<count($mhscsv);$i++){
			if($nama == $mhscsv[$i]->nama){
  				echo("<tr>");
  				echo("<td>".$mhscsv[$i]->id."</td>");
				echo("<td>".$mhscsv[$i]->nama."</td>");	
				echo("<td>".$mhscsv[$i]->nim."</td>");
				echo("</tr>");
			}
		}
		echo("</table>");
	}else{
		echo('Data XML : <br>');
		echo("<table><tr><td>ID</td><td>Nama</td><td>NIM</td></tr>");
		for($i=0;$i<count($mhs);$i++){
  			echo("<tr>");
  			echo("<td>".$mhs[$i]->id."</td>");
			echo("<td>".$mhs[$i]->nama."</td>");	
			echo("<td>".$mhs[$i]->nim."</td>");
			echo("</tr>");
		}
		echo("</table>");
		echo('<br>Data DB : <br>');
		echo("<table><tr><td>ID</td><td>Nama</td><td>NIM</td></tr>");
		for($i=0;$i<count($mhsdb);$i++){
			echo("<tr>");
  			echo("<td>".$mhsdb[$i]->id."</td>");
			echo("<td>".$mhsdb[$i]->nama."</td>");	
			echo("<td>".$mhsdb[$i]->nim."</td>");
			echo("</tr>");
		}
		echo("</table>");
		echo('<br>Data CSV : <br>');
		echo("<table><tr><td>ID</td><td>Nama</td><td>NIM</td></tr>");
		for($i=0;$i<count($mhscsv);$i++){  				echo("<tr>");
  			echo("<td>".$mhscsv[$i]->id."</td>");
			echo("<td>".$mhscsv[$i]->nama."</td>");	
			echo("<td>".$mhscsv[$i]->nim."</td>");
			echo("</tr>");
		}
		echo("</table>");

	}
?>