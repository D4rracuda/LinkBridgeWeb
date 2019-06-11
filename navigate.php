<?php
require 'include/parameters.php';
require 'include/database.php';


//require '../include/convertions.php';

$sessionId = $_GET['sessionId'];

if (!isSessionIdValid($sessionId)){
	echo "FAIL: Invalid SessionId";
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

$selectionQuery ="SELECT RedirectionUrl FROM redirectioninfo WHERE SessionId = '$sessionId'";
//echo "DEBUG: ", $selectionQuery;

 
$selectionResult = mysqli_query($dbConnection, $selectionQuery,  MYSQLI_USE_RESULT);

if ($selectionResult === FALSE){ 
	echo "FAIL: Selection failed";
	mysqli_close($dbConnection);
	exit();
}

$rowResult = mysqli_fetch_row($selectionResult);
mysqli_free_result($selectionResult);

if ($rowResult === FALSE){ 
	echo "FAIL: Fetching failed";
	exit();
}

$redirectionUrl = $rowResult[0];
if(!isRedirectionUrlValid($redirectionUrl)){
	echo "FAIL: Invalid redirection url";
    mysqli_close($dbConnection);
	exit();
}

$deletionQuery ="DELETE FROM redirectioninfo WHERE SessionId = '".$sessionId."'";
//echo "DEBUG: ", $deletionQuery;

$deletionResult = mysqli_query($dbConnection, $deletionQuery);

if ($deletionResult === FALSE){ 
	echo "FAIL: Deletion failed";
	mysqli_close($dbConnection);
	exit();
}
mysqli_close($dbConnection);
//header("Location:"."http://rambler.ru");
//header('Location:'.$redirectionUrl);
echo "OK: ", $redirectionUrl;
//echo "OK: ", "http://rambler.ru";
?>