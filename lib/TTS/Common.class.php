<?php 

header('Access-Control-Allow-Origin: *');
Class Common{
	
	public static $__TWF_DB;
	/**
	 * Retourne un tableau des mois
	 *
	 * @return array
	 */
	public static function getMonths($add_empty = true) {
		$months = array(
				'' => '',
				1 => 'Janvier',
				2 => 'F&eacute;vrier',
				3 => 'Mars',
				4 => 'Avril',
				5 => 'Mai',
				6 => 'Juin',
				7 => 'Juillet',
				8 => 'Ao&ucirc;t',
				9 => 'Septembre',
				10 => 'Octobre',
				11 => 'Novembre',
				12 => 'D&eacute;cembre'
		);
	
		if(!$add_empty)
		{
			unset($months[array_search('', $months)]);
		}
		return $months;
	}
	
	public static function setTracabilite($module, $code, $operation,$id_user, $db){
		 
		$date = date("d/m/Y");
		$heure = date('H:i:s');
		
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		    $adresse_ip =  $_SERVER['HTTP_CLIENT_IP'];
		}
		// IP derrière un proxy
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $adresse_ip =  $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		// Sinon : IP normale
		else {
		    $adresse_ip = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
		}
		$machine = ISSET($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : '';
		
		$oFormC = new Form("tts_tracabilite","id",$db);
		$oFormC->setFixedValue("id_user", $id_user);
		$oFormC->setFixedValue("date", $date);
		$oFormC->setFixedValue("operation", $operation);
		$oFormC->setFixedValue("heure", $heure);
		$oFormC->setFixedValue("module", $module);
		$oFormC->setFixedValue("code", $code);
		$oFormC->setFixedValue("adresse_ip", $adresse_ip);
		$oFormC->setFixedValue("machine", $machine);
		
		$oFormC->save(true);
		
		return 1;
		 
	}
	
	public static function getAnnees($range = 10, $add_empty = false) {
		$annees = array();
		 
		if($add_empty)
			$annees[''] = '';
	
		for ($i = date('Y') - $range; $i <= date('Y') + $range; $i++) {
			$annees[$i] = $i;
		}
		return $annees;
	}
	
	public static function getCompteur($compteur,$table = 'tts_compteur',$db = 'erp', $permutation = false) {
		$code = "";
		
		$db = self::$__TWF_DB ? self::$__TWF_DB : $db;
		$connection = Doctrine_Manager::getInstance()->getConnection($db);
		$dbh = $connection->getDbh();
		
		$info = $dbh->query("select * from $table where compteur='$compteur'")->fetch();
		
		if(!empty($info["suffixe"])){
			$val_suffixe = $info["suffixe"];
			preg_match_all("/\:([a-z]+)\:/",$info["suffixe"],$matches);
			foreach($matches[1] as $each){
				switch ($each){
					case "y":
						$val_suffixe = str_replace(":$each:",date("y"),$val_suffixe);
					break;
				}
			}
			if($info["val_suffixe"] != $val_suffixe){
				$dbh->query("update $table set n = '1' where compteur = '$info[compteur]'");
				$info = $dbh->query("select * from $table where compteur='$compteur'")->fetch();
			}
			$dbh->query("update $table set val_suffixe = '$val_suffixe' where compteur = '$info[compteur]'");
			$info["val_suffixe"] = $val_suffixe;
		}else{
			$info["val_suffixe"] = "";
		}
		$info["prefixe"] = str_replace(":y:",date("y"),$info["prefixe"]);
		if(!$permutation){
			$code = $info["prefixe"].sprintf("%0$info[longueur]d",$info["n"]).$info["val_suffixe"];
		}
		else {
			$code = $info["prefixe"].$info["val_suffixe"].sprintf("%0$info[longueur]d",$info["n"]);
		}
		return $code;
	}
	
	public static function getDataWhere($select,$from,$where,$fetch = "one"){
		$connection = Doctrine_Manager::getInstance()->getConnection('erp');
		$dbh = $connection->getDbh();
		$query = "select $select from $from where $where";
		if($fetch == "one") $info = $dbh->query($query)->fetch();
		elseif ($fetch == "all") $info = $dbh->query($query)->fetchall();
		
		if($select != "*" and $fetch == "one") return $info[$select];
		else return $info;
	
		$connection->close();
	}
	
	public static function validCompteur($compteur,$table = 'tts_compteur',$db = 'erp', $info_table = array() ) {
		

		$db = self::$__TWF_DB ? self::$__TWF_DB : $db;
		$connection = Doctrine_Manager::getInstance()->getConnection($db);
		$dbh = $connection->getDbh();
		$dbh->query("update $table set n=n+1 where compteur='$compteur'");
		
		if(!empty($info_table)){
			$query ="
					update b set b.$info_table[attr] = new
					from (
					select * from (
					select id, $info_table[attr], LEFT($info_table[attr], p) +LEFT(RIGHT($info_table[attr], longueur), longueur-len(new))+cast(new as nvarchar)+RIGHT($info_table[attr], s) as new from (
					select id, $info_table[attr], s,p, prefixe,  cast (SUBSTRING($info_table[attr], p+1, len($info_table[attr])-s +1)as int)+ delta as new, longueur from (
					select id, $info_table[attr],  
					(row_number() over (partition by $info_table[attr] order by  $info_table[attr]))-1 as delta, isnull(LEN(val_suffixe),0) as s,  isnull(LEN(prefixe),0) as p, prefixe, longueur
					from $info_table[table] 
					inner join $table c on 
					c.compteur = '$compteur'
					where $info_table[attr] in (
					select $info_table[attr]  from $info_table[table] 
					group by $info_table[attr]
					 having(COUNT($info_table[attr])> 1)
					 )
					 )aff)aff2)aff3
					 where not exists (select $info_table[attr] from  $info_table[table] where $info_table[attr] = aff3.new)
					 ) v
					 inner join $info_table[table] b on b.id = v.id
					
					";
			$dbh->query($query);
			
		}
		$connection->close();
	}
	
	public static function ValidSEQ($compteur,$db) {
		$connection = Doctrine_Manager::getInstance()->getConnection($db);
		$dbh = $connection->getDbh();
		 $dbh->query("update SEQUENCE_TABLE set NEXT_VAL=NEXT_VAL+1 where SEQUENCE_NAME='$compteur'");
		 
		$connection->close();
		
	}
	
	public static function getSEQ($compteur,$db){
		$connection = Doctrine_Manager::getInstance()->getConnection($db);
		$dbh = $connection->getDbh();
		$code = $dbh->query("select NEXT_VAL+1 from SEQUENCE_TABLE where SEQUENCE_NAME='$compteur'")->fetch();
		return $code[0];
	}
	
	public static function NbJours($debut, $fin) {
	
		$tDeb = explode("-", $debut);
		$tFin = explode("-", $fin);
	
		$diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
		mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
	
		return(($diff / 86400)+1);
	}
	
	
	public static function loadExcel($request){
		$data = array();
		$title = array();
		$first = 1;
		if ($request->isMethod('post')) {
			$file = $request->getFiles('excel');
			if ($file['error'] == 0) {
				// no errors
				$excelFile = PHPExcel_IOFactory::load($file['tmp_name']);
				$sheet = $excelFile->getActiveSheet();
				foreach ($sheet->getRowIterator() as $k=>$row) {
					$dataLine = array();
					$cellIterator = $row->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(true);
					foreach ($cellIterator as $kc=>$cell) {
						if(!is_object($cell)) continue;
						if($k == $first) {
							array_push($dataLine,$cell->getValue());
						}
						else {
							//changer la cl� du tableau pour qu'il ressemble aux titres de fichier excel
							$dataLine[$title[$kc]] = $cell->getValue();
						}
					}
					array_push($data,$dataLine);
					if($k == 1) $title = $dataLine; //recuperer les titres pour les utiliser des cl�s
				}
			}
	
			return $data;
		}
	
	}
	
	public static function loadExcelStd($request){
		$data = array();
		$title = array();
		$first = 1;
		if ($request->isMethod('post')) {
			$file = $request->getFiles('excel');
			if ($file['error'] == 0) {
				// no errors
				$excelFile = PHPExcel_IOFactory::load($file['tmp_name']);
				$sheet = $excelFile->getActiveSheet();
				foreach ($sheet->getRowIterator() as $k=>$row) {
					$dataLine = array();
					$cellIterator = $row->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(true);
					foreach ($cellIterator as $kc=>$cell) {
						if(!is_object($cell)) continue;
						array_push($dataLine,$cell->getValue());
					}
					array_push($data,$dataLine);
				}
			}
	
			return $data;
		}
	
	}
	
	public static function changeDateByMonth($date,$m){
		return date("d/m/Y",strtotime("$m month",strtotime($date)));
	}
	
	public static function changeDateByDay($date,$d){
		return date("d/m/Y",strtotime("$d day",strtotime($date)));
	}
	
	public static function convert_date($date,$format){
		if(!$date) return $date;
		if($format == 'Y-m-d'){
			list($d, $m, $y) = preg_split('/\//', $date);
			return sprintf('%4d-%02d-%02d', $y, $m, $d);
		}elseif($format == 'd/m/Y'){
			if($date == "0000-00-00" || $date == "") return "";
			if(count(preg_split('/\-/', $date)) != 3) return $date;
			list($y, $m, $d) = preg_split('/\-/', $date);
			return sprintf('%02d/%02d/%4d', $d, $m, $y);
		}
	}
	
	public static function getDataBase($con){
	
		$connection = Doctrine_Manager::getInstance()->getConnection($con);
		/* get database name -----------------------------------------*/
		$db = $connection->getOptions();
		$dsn = $db['dsn'];
		preg_match("/;Database=(.+)/",$dsn,$base_ERP);
		$db_name = $base_ERP[1];
		/*------------------------------------------------------------*/
		$connection->close();
	
		return $db_name;
	}
	
	public static function in_multiarray($multiarray ,$key ,$search) {
		if(!is_array($multiarray)) return false;
		foreach ($multiarray as $k=>$c) {
			if ($c[$key] == $search) {
				return $k;
			}
		}
		return false;
	}
	
	public static function NumberToLetter($number){
	
		$nel = array();
	
		$lettre = new ChiffreEnLettre();
		$enl_n = $lettre->Conversion(intval($number));
		$virgule = round(($number - intval($number))*100);
			
		$enl_v = $lettre->Conversion($virgule);
			
		if($virgule < 10 && $virgule > 0) $enl_v = "zéro ".$enl_v;
	
		$nel[0] = utf8_encode($enl_n);
		$nel[1] = utf8_encode($enl_v);
	
		return $nel;
	
	}
	
	public static function nbreJoursMois($date){
	
		$date2 = explode("/", $date);
	
		$m = $date2[1];
		$y = $date2[2];
	
		$mois = mktime( 0, 0, 0, $m, 1, $y );
	
		$nombreDeJours = intval(date("t",$mois));
	
		return $nombreDeJours;
	}
	
	public static function loadCSV($request){
		$dataExcel = array();
		if ($request->isMethod('post')) {
			$file = $request->getFiles('importExcel');
			if ($file['error'] == 0) {
				$fp = fopen($file['tmp_name'], "r");
				$dataExcel = array();
				$keys = array();
				$first = true;
				while($line = fgets($fp,1000)){
	
					if($first) {
						$keys = array_map('trim',explode(";",$line));
						$first = !$first;
						array_push($dataExcel,$keys);
					}else{
						$data = array_map('trim',explode(";",utf8_encode($line)));
						array_push($dataExcel,array_combine($keys,array_values($data)));
					}
				}
			}
		}
		return $dataExcel;
	}
	
	
	public static function envmail($post_form, $user, $pass){
	
		$PHPMailer = new PHPMailer();
		//$PHPMailer->SetLanguage("en", 'PHPMailer/language/');
		//$pfname="=?ISO-8859-1?Q?".quoted_printable_decode($post_form['nomC'])."?=\n";
		$To = $post_form['to'];
		$SMTPAuth = ISSET($post_form['SMTPAuth']) ? $post_form['SMTPAuth'] : null;
		$cc = !empty($post_form['cc']) ? $post_form['cc'] : null;
		$From = $post_form['from'];
		$FromName = $post_form['fromName'];
		$Subject = $post_form['subject'];
		$Message = $post_form['message'];
		$attachment_path = !empty($post_form['attachment_path']) ? $post_form['attachment_path'] : null;
		$attachment_name = !empty($post_form['attachment_name']) ? $post_form['attachment_name'] : null;
		$host = !empty($post_form['host']) ? $post_form['host'] : 'smtp.gmail.com';
		$secure = !empty($post_form['secure']) ? $post_form['secure'] : null;
		$port = !empty($post_form['port']) ? $post_form['port'] : '465';
		if($host == 'smtp.gmail.com'){
			$secure  = 'ssl';
		}
		
		$PHPMailer->IsSMTP();
		$PHPMailer->SMTPDebug = 0;
		if(!$SMTPAuth) $PHPMailer->SMTPAuth = true;
		if($secure) $PHPMailer->SMTPSecure = $secure;
		$PHPMailer->Host = $host;
		$PHPMailer->Port = $port;
		$PHPMailer->Username = $user;
		$PHPMailer->Password = $pass;
	
	
		$PHPMailer->isHtml(true);
		$PHPMailer->CharSet = "UTF-8";
		$PHPMailer->From = $From;
	
	
	
	
	
		$PHPMailer->FromName = $FromName;
		if($cc) {
			if(!is_array($cc)){
				$PHPMailer->AddCC($cc);
			}else{
				foreach($cc as $eachcc){
					$PHPMailer->AddCC($eachcc);
				}
			}
		}
		
		if($attachment_path) $PHPMailer->AddAttachment($attachment_path, $attachment_name);
		if(!is_array($To)){
		    $PHPMailer->AddAddress($To);
		}else{
		    foreach($To as $eachto){
		        $PHPMailer->AddAddress($eachto);
		    }
		}
		$PHPMailer->AddReplyTo($From);
		$PHPMailer->Subject  = $Subject;
		//$PHPMailer->Body = $Message;
		$PHPMailer->MsgHTML($Message);
		if($PHPMailer->Send())
		{
			//echo "message bien envoye";
			return 1;
		}
		else
		{
			//echo "Error :".$PHPMailer->ErrorInfo;
			return 0;
		}
	
	}
	
	public static function getDynmCompteur($table,$prefixe,$longueur,$attr){
		$connection = Doctrine_Manager::getInstance()->getConnection('erp');
		$dbh = $connection->getDbh();
		$code_max = $dbh->query("select MAX( CAST(REPLACE($attr,'$prefixe','')AS UNSIGNED)) from $table")->fetch();
		$code_max = intval($code_max[0]);
		$code = $prefixe.sprintf("%0{$longueur}d",$code_max+1);
		return $code;
	}

	public static function impact_stock($article,$qte_old,$qte_new,$pmp_old = null,$pmp_new = null, $db = 'erp'){
		// set connection ---------------------------------------------------------
		$connection = Doctrine_Manager::getInstance()->getConnection($db);
		$dbh = $connection->getDbh();
		// ------------------------------------------------------------------------
	
		if($pmp_old !== null && $qte_new != 0){
			$pmp = " case when (Qte + $qte_new) != 0 then ( (PMP * Qte) + ($pmp_new * $qte_new) ) / ( Qte + $qte_new ) Else $pmp_new end ";
		}else{
			$pmp = 0;
		}
	
		if($pmp_old !== null){
			$update_pmp = " PMP = ($pmp) ";
		}else{
		$update_pmp = "";
		}
		//trigger -----------------------------------------------------------------
	
		$pmp_new = $pmp_new ? $pmp_new : 0;
	
		$query = "
		set @id_stock = (select id FROM tts_stock_article WHERE id_article = '$article' limit 1 );
		UPDATE tts_stock_article SET $update_pmp,  Qte = Qte - $qte_old + $qte_new  WHERE id = @id_stock;
		INSERT INTO tts_stock_article (id_article,qte,pmp) select $article,$qte_new,$pmp_new from par_tts_information where @id_stock is null limit 1
		";
	
		$dbh->query($query);
		// ------------------------------------------------------------------------
		
		$connection->close();
	}
	
	public static function impact_stock_affaire($article,$affaire,$qte_old,$qte_new,$pmp_old = null,$pmp_new = null, $db = 'erp'){
		// set connection ---------------------------------------------------------
		$connection = Doctrine_Manager::getInstance()->getConnection($db);
		$dbh = $connection->getDbh();
		// ------------------------------------------------------------------------
	
		if($pmp_old !== null && $qte_new != 0){
			$pmp = " case when (Qte + $qte_new) != 0 then ( (PMP * Qte) + ($pmp_new * $qte_new) ) / ( Qte + $qte_new ) Else $pmp_new end ";
		}else{
			$pmp = 0;
		}
	
		if($pmp_old !== null){
			$update_pmp = " PMP = ($pmp) ";
		}else{
			$update_pmp = "";
		}
		//trigger -----------------------------------------------------------------
	
		$pmp_new = $pmp_new ? $pmp_new : 0;
	
		$query = "
		set @id_stock = (select id FROM tts_stock_article WHERE id_article = '$article' and id_affaire = '$affaire' limit 1 );
		UPDATE tts_stock_article SET $update_pmp,  Qte = Qte - $qte_old + $qte_new  WHERE id = @id_stock;
		INSERT INTO tts_stock_article (id_article,id_affaire,qte,pmp) select $article,$affaire,$qte_new,$pmp_new from par_tts_information where @id_stock is null limit 1
		";
	
		$dbh->query($query);
		// ------------------------------------------------------------------------
	
		$connection->close();
	}

	public static function showArbre($arbre,$fils,$trait,$marge = 0,$func_id = null){
		$class = 'tree-parent';
		echo "<ul class='$class'>";
		 
		foreach($arbre as $k=>$elem){
		//var_dump($elem);die;
			$pas = 15;
	
			if(!empty($elem[$fils])){
			$img = "niveaux.png";
		}else{
		$img = "article.png";
		}
		 
		//echo "<li style=\"background: url('/img/$img') no-repeat; padding-left:24px\">";
		echo "<li style='margin-left:$marge"."px' id=\"$k"."__li__"."\" ".(empty($elem[$fils]) ? "class=\"tree-li-last\"" : "").">";
		echo "<img src='/images/$img'>";
		echo "<span style=\"margin-left:7px\" ".(is_callable($func_id) ? "id=\"".$func_id($elem)."__li__span__\"" : "").">";
		$trait($elem);
		echo "</span>";
		if(!empty($elem[$fils])){
		Common::showArbre($elem[$fils],$fils,$trait,$marge+$pas,$func_id);
		}
		echo "</li>";
	
		}
		echo "</ul>";
	}
	
	public static function fin_mois($date){
		$nbre_jrs = common::nbreJoursMois($date);
		$date_ = $nbre_jrs."/".date("m/Y",strtotime((Common::convert_date($date, 'Y-m-d'))));
		return $date_;
	}

	public static function getDateWeek($annee,$week,$d){
		if(intval($week) < 10) $week = "0$week";
		return self::changeDateByDay(date(
				"Y-m-d",
				strtotime("{$annee}W{$week}")),$d);
	}
	
	
	public static  function Migration($cnx_source,$cnx_dest)
	{
		$connection = Doctrine_Manager::getInstance()->getConnection("$cnx_source");
		$dbh = $connection->getDbh();
		$connection_dest = Doctrine_Manager::getInstance()->getConnection("$cnx_dest");
		$dbh_dest = $connection_dest->getDbh();
	
		//Get info base dest-----------------------------------//
		$liste_vue = $dbh_dest->query("SELECT * FROM TTS_vue_synchro")->fetchAll();
	
		//------------------------------------------------------------------------------------------//
		foreach ($liste_vue  as $Vue){
			$Vue = $Vue["VUE"];
	
			//verification de l'existence de la table--------------------------------------------------//
				
			$exist=$dbh_dest->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$Vue' and Table_type!='VIEW'")->fetch();
	
			//Recuperation des champs qui se trouve dans la vue avec leurs types------------------------//
				
			$req=$dbh->query("SELECT COLUMN_NAME,IS_NULLABLE,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$Vue'")->fetchAll();
				
			//Si la table existe deja dans la BD  on la supprime --------------------------------------//
			if($exist){
				$create_table = "DROP TABLE $Vue Create Table $Vue( ";
			}else{
				$create_table="Create Table $Vue(";
			}
	
			//----------------------------------------------------------------------------------------//
			$colonne="";
	
			foreach ($req as $c){
	
				if($c["DATA_TYPE"] == "numeric") $c["DATA_TYPE"] = "numeric(18,2)";
				$create_table .='['.$c["COLUMN_NAME"].']' .' ';
				$colonne .='['.$c["COLUMN_NAME"].']';
				$create_table .= $c["DATA_TYPE"].($c["CHARACTER_MAXIMUM_LENGTH"] ? '('.$c["CHARACTER_MAXIMUM_LENGTH"].')' :'').' ';
				$create_table .=($c["IS_NULLABLE"]=="NO") ? ' NOT NULL' : ' NULL';
				$create_table .=",";
				$colonne.=",";
			}
				
			$colonne=substr($colonne, 0,-1);
			$create_table=substr($create_table, 0,-1);
			$create_table .=" )";
	
			//Creation de la table --------------------------------------------------------------//
			$dbh_dest->query("$create_table");
	
			//Recuperer DB_SOURCE ---------------------------------------------------------------//
			$DB_SRC = Common::GetDB($cnx_source);
	
			//Insertion des donnees-------------------------------------------------------------//
			$dbh_dest->query("insert into $Vue ($colonne) select $colonne from $DB_SRC.dbo.$Vue");
		}
	
		Return 1;
	}
	
	public static  function GetDB($connexion){
		$all_db = sfYaml::load('../config/databases.yml');
		$all_db = $all_db['all'];
		preg_match("/Server\=([^;]+);[ ]*Database=(.+)/",$all_db["$connexion"]["param"]["dsn"],$rgexp_dst);
		$DB_SRC = $rgexp_dst[2];
		return $DB_SRC;
	}
	//---------------------------//
	public static function printPDF($html, $annexe = false, $stopExecution = true, $docName = '', $avecLogo = true, $SetMargins = true, $annexe2 = false, $printImageFoteer = true,$marge = array(),$paysage) {
	
		// pdf object
		if($paysage){
			$pdf = new sfTCPDF($paysage, PDF_UNIT, PDF_PAGE_FORMAT, true);
		}else{
			$pdf = new sfTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);
		}
		// le chemain de l'image est : plugins/sfTCPDFPlugin/lib/tcpdf/images/centrelec_logo.png
		// Pour changer header ! voir class sfTCPDF, methode : header()
	
		//----- set margins ----//
		if($SetMargins)
			$pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);
		elseif(count($marge))
		$pdf->SetMargins($marge["left"],$marge["top"],$marge["right"],$marge["bottom"]);
	
		//--- print image foooter ----//
		if(!$printImageFoteer)
			$pdf->setImageFooter(false);
	
	
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set font
		$pdf->SetFont('times', '', 10);
	
		if(!$avecLogo)
		{
			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
		}
		// Add a page
		$pdf->AddPage();
		 
		// Print text using writeHTML()
		$pdf->writeHTML($html);
		 
		if($annexe){
			// Add a page
			$pdf->AddPage();
			// Print text using writeHTML()
			$pdf->writeHTML($annexe);
		}
	
		if($annexe2){
			// Add a page
			$pdf->AddPage();
			// Print text using writeHTML()
			$pdf->writeHTML($annexe2);
		}
	
		$pdf->setFontSubsetting(false);
	
		// Close and output PDF document
		$pdf->Output($docName);
	
		if ($stopExecution) {
			// Stop symfony process
			throw new sfStopException();
		}
	}
	
	public static function getTTSDependanceChoice($request){
	
		
		$depend = !empty($_POST["d"]) ? $_POST["d"] : array();
		$add_where = !empty($_POST["where"]) ? $_POST["where"] : array();
		$all = !empty($_POST["all"]) ? $_POST["all"] : "";
		$add_query = !empty($_POST["add_query"]) ? $_POST["add_query"] : "";
		$data = array();
		
		if(!$depend){
			return $data;
		}
		$tempDepend = $depend;
		$F = $depend['0'];
		$E = $depend['1'];
		$D = $depend['2'];
		$source = $E[0];
	
		foreach($D as $k=>$c){
			$except_attr = preg_match("/\(.*\)/", $c);
			if(!$except_attr) $attr[$k] = $source.".".$c;
			else $attr[$k] = $c;
		}
	
		$select = "SELECT DISTINCT ".join(",",$attr)." FROM $E[0]\n";
		
		$where = "WHERE $E[0].$E[1] = $F[3] \n";
		
		if($add_where){
			$where .= " AND ".join(" AND ",$add_where);
		}
	
		$query = "$select\n$where\n$add_query";
		//echo $query;die;
	
		$connection = Doctrine_Manager::getInstance()->getConnection(self::$__TWF_DB);
		$dbh = $connection->getDbh();
	
		$res = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
	
		/*$res = array_map(function($elem){
		 return array_map('utf8_encode',$elem);
				},$res);*/
	
		return $res;
	
	}
	
	public static function TTSConnect(){
		$connection = Doctrine_Manager::getInstance()->getConnection(self::$__TWF_DB);
		$dbh = $connection->getDbh();
		return $dbh;
		 
	}
	
	public static function joint($dir, $fileName, $id){
		if(empty($_FILES[$fileName]["name"])) return;
		if(!is_dir($dir)){
			mkdir($dir);
		}
		$oUP = new TTSUpload($dir,$fileName);
		//$oUP->setExt(array_merge(TTSUpload::$EXT_DOC,TTSUpload::$EXT_IMG,TTSUpload::$EXT_MSG));
		$name_file = substr($_FILES['file']['name'],0,-4);
		//var_dump($name_file);die;
		$oUP->setName($name_file);
		$oUP->setMaxSize(10000);
		$res = $oUP->execute();
		//var_dump($res);die;
		if($res == "1") {
			return 1;
		}else{
			return 0;
		}
	}
	
	public static function Get_Fichier($dir){
		if(!is_dir($dir)) return;
		$fichier = array();
		if(is_dir($dir)){
			$d = opendir($dir) or die('Erreur! Dossier introuvable !');
			while($e = @readdir($d)) {
				if(is_file($dir.'/'.$e) && $e != '.' && $e != '..') {
					array_push($fichier,$dir.$e);
				}
			}
			closedir($d);
		}
		return $fichier;
	}

}


?>