<?php

include "MySQL_Connect.php";
//echo $dbsrv_status;

$db='_personal';
$tb='distributives';

$req_res=mysqli_select_db($dbsrv_descriptor, $db);
if($req_res==0){
        echo "БД '".$db."' не найдена!<br>";
    } else {
        //echo "БД '".$db."' отрыта успешно.<br>";
    }

	//echo '[' . $_POST['soft_name'] . ']';
	
		 mysqli_query($dbsrv_descriptor, 'SET NAMES utf8');
$req_res=mysqli_query($dbsrv_descriptor, "SELECT * FROM ".$tb." WHERE (LOCATE(LOWER('".$_POST['soft_name']."'),lower(A))>0) ORDER BY B DESC;");
if ($req_res){
	$col1=array();
	$col2=array();
	//if (mysql_fetch_array($req_res)=='') {echo "<tr><td align='center'>Уточните имя программы<br>или инсталляционного файла</td></tr>";}
	while($drow=mysqli_fetch_array($req_res)){
		$col1[]=$drow['A'];
		$col2[]=$drow['B'];
	}
	
	
	$localdb = 0;
	
	/*
	$dir = scandir('C:/[Distributives]/');
	foreach ($dir as $dind => $fold){ 
		if ($_POST['soft_name']==""){
			$col1[]=$fold;
			$col2[]='Distributives (C:)';
		} else {
			if ( stristr($fold, $_POST['soft_name']) ){ //Возвращает позицию первого вхождения подстроки без учета регистра
				$col1[]=$fold;
				$col2[]='Distributives (C:)';
			}
		}
	}
	$localdb+=count($dir);
	
	$dir = scandir('D:/Additional uTorrent/!Software/');
	foreach ($dir as $dind => $fold){ 
		if ($_POST['soft_name']==""){
			$col1[]=$fold;
			$col2[]='Add_uTorrent/Soft (D:)';
		} else {
			if ( stristr($fold, $_POST['soft_name']) ){ //Возвращает позицию первого вхождения подстроки без учета регистра
				$col1[]=$fold;
				$col2[]='Add_uTorrent/Soft (D:)';
			}
		}
	}
	$localdb+=count($dir);
	
	$dir = scandir('D:/Additional uTorrent/!OSs/');
	foreach ($dir as $dind => $fold){ 
		if ($_POST['soft_name']==""){
			$col1[]=$fold;
			$col2[]='Add_uTorrent/OSs (D:)';
		} else {
			if ( stristr($fold, $_POST['soft_name']) ){ //Возвращает позицию первого вхождения подстроки без учета регистра
				$col1[]=$fold;
				$col2[]='Add_uTorrent/OSs (D:)';
			}
		}
	}
	$localdb+=count($dir);
	
	*/
	
	$result = "";
	foreach ($col1 as $ind => $dat){
		//echo "<tr><td align='left' class='cell'>".$drow['A']."</td><td align='center' class='cell'>".$drow['B']."</tr>";
		$result = $result . $dat."*".$col2[$ind]."|";
	}
	
	if ( count($col1)<1 ){ echo "Уточните имя программы<br>или инсталляционного файла*|"; }
	
	
	$tb_length=mysqli_query($dbsrv_descriptor, "SELECT COUNT(*) FROM ".$tb.";");
	$tb_length=mysqli_fetch_array($tb_length);
	//echo "<div class='block' style='width:540px'><i>У нас в базе<br><b>".$tb_length[0]."</b><br>наименований программ.</i></div>";
	echo $result . ($tb_length[0] + $localdb) ;
	
} else {
	echo mysqli_error($dbsrv_descriptor);
}
	
?>