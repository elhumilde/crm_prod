<?php

error_reporting(E_ALL);


require_once('../../lib/vendor/symfony/lib/yaml/sfYaml.php');

//get applications ------------------------------------------------------------------
$all_apps = array_diff(scandir('../../apps/'), array('..', '.', '.svn'));
//-----------------------------------------------------------------------------------

//get DataBases ---------------------------------------------------------------------
$all_db = sfYaml::load('../../config/databases.yml');
$all_db = $all_db['all'];
//-----------------------------------------------------------------------------------

if(!empty($_GET["app"])){
	
	//get DataBases Migrations ----------------------------------------------------------
	$app = $_GET["app"];
	//-----------------------------------------------------------------------------------
	
}

if(!empty($_GET["bd_dest"])){
	//get sources from server --------------------------------------------------------
	$bd_dest = $_GET["bd_dest"];
	$dsn = $all_db[$bd_dest]["param"]["dsn"];
	
	
	if(strstr($dsn, "SQL Server")){
		$query = "SELECT name FROM sys.databases
	              WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb');";
	}
	elseif(strstr($dsn, "mysql")){
		$query = " select table_schema FROM information_schema.tables 
				where table_schema not in ('information_schema', 'mysql', 'performance_schema') 
				group by table_schema ";
		
	}elseif(strstr($dsn, "pgsql")){
		$query = " select table_catalog FROM information_schema.tables  
				group by table_catalog ";
		
	}
	$pdo = new PDO($dsn, $all_db[$bd_dest]["param"]["username"], $all_db[$bd_dest]["param"]["password"]);
	$list_src = $pdo->query("
	$query		
	")->fetchAll(PDO::FETCH_COLUMN);
	//-----------------------------------------------------------------------------------
}

if(!empty($_GET["bd_src"])){

	//get files of migration --------------------------------------------------------
	$bd_src = $_GET["bd_src"];
	$files = array();
	
	$dir = "../../apps/$app/data/migration/";
	$odir = opendir($dir);
	while($f=readdir($odir)){
		if(is_file($dir.$f)) array_push($files,$f);
	}
	//-----------------------------------------------------------------------------------
}

if(!empty($_POST)){
	
	require_once "libs/connection.php" ;
	require_once "libs/array.php" ;
	require_once("../../config/ProjectConfiguration.class.php");
	try {
	    require_once("../../lib/TTS/TTSMigr.class.php");
	    require_once("../../lib/TTS/TTSTable.class.php");
	} catch (Exception $e) {
	}
	
	if(strstr($dsn, "SQL Server")){
		preg_match("/Server\=([^;]+);[ ]*Database=(.+)/",$all_db[$bd_dest]["param"]["dsn"],$rgexp_dst);
	
	}
	elseif(strstr($dsn, "mysql")){
		preg_match("/host\=([^;]+);[ ]*dbname=(.+)/",$all_db[$bd_dest]["param"]["dsn"],$rgexp_dst);
	}elseif(strstr($dsn, "pgsql")){
		preg_match("/host\=([^;]+);[ ]*dbname=(.+)/",$all_db[$bd_dest]["param"]["dsn"],$rgexp_dst);
	}
	$server = $rgexp_dst[1];
	$user = $all_db[$bd_dest]["param"]["username"];
	$password = $all_db[$bd_dest]["param"]["password"];
	
	CONNECT::setConnection("$server","$user","$password", "$dsn");

	define("DB_SRC",$bd_src);
	define("DB_DSTN",$rgexp_dst[2]);

	$files = $_POST["file_mg"];
	
	foreach($files as $f){
		include "../../apps/$app/data/migration/$f";
	}
	
}

include "./view/index.php";