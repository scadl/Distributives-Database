<?php

$dbsrv_descriptor=@mysqli_connect("localhost","root","password");
if($dbsrv_descriptor==0){
   $dbsrv_status="Не удалось подключиться MySQL серверу!<br>".mysql_error()."<br>";
} else {	
	$dbsrv_status="Подключение к MySQL серверу успешно.<br>";
}

//$dbname="_personal";
function DBConn($dbname, $dbdscr){
$req_res=@mysqli_select_db($dbname, $dbdscr);
if($req_res==0){        
		//return $sdres="БД '".$dbname."' не найдена!<br>".mysql_error()."<br>".$req_res;
		return $sdresid=0;
    } else {        
		//return $sdres="БД '".$dbname."' отрыта успешно.<br>";
		return $sdresid=1;
    }
}

?>