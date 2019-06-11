<?php
	
require 'include/parameters.php';
require 'include/convertions.php';
require 'include/database.php';

$sessionId = $_GET['sessionId'];

if (!isSessionIdValid($sessionId)){
	echo "FAIL: Invalid SessionId";
	exit();
}

$redirectionUrl = $_GET['redirectionUrl'];
if(!isRedirectionUrlValid($redirectionUrl)){
	echo "FAIL: Invalid RedirectionUrl";
	exit();
}

$dbHost = 'localhost'; // адрес сервера 
$dbName = 'LinkBridge'; // имя базы данных
$dbLogin = 'root'; // имя пользователя
$dbPassword = 'qUvflemFeCcMT3azsKiQ'; // пароль

$dbConnection = mysqli_connect($dbHost, $dbLogin, $dbPassword, $dbName);
if (mysqli_connect_errno()){ 
	echo "FAIL: Connection failed", mysqli_connect_error();
	exit();
}

$deletionQuery ="DELETE FROM redirectioninfo WHERE SessionId = '$sessionId'";
//echo "DEBUG: ", $deletionQuery;

 
$deletionResult = mysqli_query($dbConnection, $deletionQuery);

if ($deletionResult === FALSE){ 
	echo "FAIL: Deletion failed";
	mysqli_close($dbConnection);
	exit();
}

$insertionQuery ="INSERT INTO redirectioninfo VALUES (NOW(), '$sessionId','$redirectionUrl')";
//echo "DEBUG: ", $insertionQuery;

$insertionResult = mysqli_query($dbConnection, $insertionQuery);

if ($insertionResult === FALSE){ 
	echo "FAIL: Insertion failed";
	mysqli_close($dbConnection);
	exit();
}

echo "OK";

mysqli_close($dbConnection);
?>
