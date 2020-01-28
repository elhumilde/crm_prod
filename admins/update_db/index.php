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

if(!empty($_POST)){
	
	//get param and get DB --------------------------------------------------------
	$app = $_POST["app"];
	$info_db = sfYaml::load("../../apps/$app/data/schema/tdb.yml");
	$db = $info_db["TDB"]["connection"];
	$db2 = $info_db["TDB"]["connection2"];
	//------------------------------------------------------------------

	$dsn = $all_db[$db]["param"]["dsn"];
	$dsn2 = $all_db[$db2]["param"]["dsn"];
	$user = $all_db[$db]["param"]["username"];
	$pass = $all_db[$db]["param"]["password"];
	
	require_once("../../config/ProjectConfiguration.class.php");
	require_once("../../lib/TTS/TTSUpdateDB.class.php");
	$tdb = new TDB($dsn, $user, $pass);
	$tdb->setSchema("../../apps/$app/data/schema/schema.yml");
	$tdb->execute();
	$tdb = new TDB($dsn2, $user, $pass);
	$tdb->setSchema("../../apps/$app/data/schema/schema2.yml");
	$tdb->execute();
	
}

include "./view/index.php";