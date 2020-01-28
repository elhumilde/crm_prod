
<?php
include 'TTSParametrage.php';


    $connexion=mysql_connect($Serveur, $user_db, $password_db) or die(mysql_error());
    mysql_select_db($db, $connexion) or die(mysql_error());
    set_time_limit(0); 
    ini_set('memory_limit', '-1');
    if ($handle = opendir($repertoire_source)) {
        $msg="";
        /* Ceci est la fa�on correcte de traverser un dossier. */
        while (false !== ($entry = readdir($handle))) {
             if($entry != "." && $entry != ".." && $entry != ".svn"){
                $error = 0;
                $table_array =  explode("__", $entry) ;
                $table= $table_array[0];
                $f_data = fopen($repertoire_source.$entry,"r+");
                $f_data_log = fopen($repertoire_log.$entry.".log","c");
                ftruncate($f_data_log,0);

                fwrite($f_data_log,$table."_".date("Y-m-d-h-i-s")."\n");
                $i=-1;
                while (($ligne = fgets($f_data)) !== false)
        	   {
        	    $i++;
        	    if($i!=0)
        	    {
        	        $insert=$table_col;
        	        $insert.=" VALUES(";
        	        $data = explode($separator_csv, $ligne);
        	        foreach ($data as $row) {
        	            $insert.="'".$row."',";
        	        }
        	        $insert=substr($insert, 0, -1);
        	        $insert.=");";
                    fwrite ($f_data_log,$insert . "\n");
        	        try{
                        $result=mysql_query($insert);
                        if($result==1) {
                            fwrite($f_data_log,"la ligne ".$i." a ete inseree avec succes !!! \n");
                        }
                        else {                            
                            throw new Exception("erreur dans la ligne ".$i." : ".$result);
                        }
                    }
                    catch (Exception $e){
                        fwrite($f_data_log,$e." !!! \n");
                        echo mysql_errno() . ": " . mysql_error() . "\n";
                        fwrite ($f_data_log,mysql_errno() . ": " . mysql_error() . "\n");
                        $error = 1;
                    }
           	    }
        	    else
            	    {
            	        
            	        $table_col="insert into $table (";
            	        $data = explode($separator_csv, $ligne);
            	           foreach ($data as $row) {
            	           	$table_col.=$row.",";
            	           }
            	        $table_col=substr($table_col, 0, -1);   
            	        $table_col.=")";
            	    }
        	   }
        	   
        	   fclose($f_data_log);
               fclose($f_data);
               if($error){
                   rename($repertoire_source.$entry, $repertoire_error.$entry);
               }
        	   else{
        	       rename($repertoire_source.$entry, $repertoire_destination.$entry);
        	   }
               //unlink($repertoire_source.$entry);
            }
        }
        
        
        closedir($handle);
    }
    
?>