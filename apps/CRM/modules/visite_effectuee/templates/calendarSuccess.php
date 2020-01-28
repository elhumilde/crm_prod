<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li class="active">Gestion des visites</li>
    </ul>
  </div>
</div>
<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Calendrier</h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>
			<form method="get">
				<div class="row">
						<label class="col-md-1" for="selectError">Ann&eacute;e</label>
						<div class="col-md-2">
							<select name="annee" id="idannee" class="select">
								<?php for($listannee=date('Y')-5;$listannee<=2040;$listannee++){?>
								<option value="<?php echo $listannee?>"
									<?php if($annee==$listannee) echo 'selected';?>>
									<?php echo $listannee?>
								</option>
								<?php }?>
							</select>
						</div>

					
						<label class="col-md-1 col-md-offset-1" for="selectError">Mois</label>
						<div class="col-md-2">
						    <select name="mois" id="mois" class="select">
								<?php for($m=1;$m<=12;$m++){?>
								<option value="<?php echo $m?>"
									<?php if($m==$mois) echo 'selected';?>>
									<?php echo $m ?>
								</option>
								<?php }?>
							</select>
							
						</div>
				        
					    <label class="col-md-1 col-md-offset-1" for="selectError">Utilisateur</label>
						   <div class="col-md-2">
						   		<?php 
						   		$cond_commercial="";
						   		 if(!$sf_user->hasCredential('allvisite')):
						   		    $cond_commercial=" and u.id in ($ids_users_affecte)";
						   		 endif;
						   		 
						   			echo TTSList::getListBox(array(
										"query" => "select u.id,concat(u.nom,' ',u.prenom) as login from tts_utilisateur u where actif = 1 $cond_commercial order by nom",
										"form" => $filter,
										"oForm" => $oFilter,
										"value" => "id",
										"libel" => "login",
										"key" => "id",
										"db" => "crm",
		                                "class" => "select"
									)); 
						   		?>
						   </div>
					</div>
					<div class="row">
						<label class="col-md-1" for="selectError">Résultat de la visite</label>
						<div class="col-md-2">
							<?php
							
									echo TTSList::getListBox ( array (
									"query" => "select * from par_tts_visite_resultat",
									"oForm" => $oFilter,
									"value" => "id",
									"libel" => "resultat",
									"key" => "id_resultat_visite",
									"value_default" => $id_resultat_visite,
									"db" => "crm",
									"class" => "select"
							) );
							?>
               			</div>

					</div>
					
				<div class="row">
					<div class="col-md-2">
						<button type="submit" class="btn btn-primary btn-xs">
							Recherche 
						</button>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-md-10">
					<div id="calendar11"></div>
				</div>
				<div class="col-md-2">

					<br><br><br><br><br>
					<div class="row">
					    <div class="col-md-12">
					        <input type="color" disabled="disabled" value="#5C6BC0" style="width: 50px;height:20px;"> V. réalisée
					    </div>
					</div>
				    <div class="row">
					    <div class="col-md-12">
					        <input type="color" disabled="disabled" value="#4CAF50" style="width: 50px;height:20px;"> V. Planifiée
					    </div>
					</div>
				</div>
			</div>
		
	</div>
</div>
<script>
$(document).ready(function(){
	var annee = '<?php echo $annee ?>';
	var mois = '<?php echo $mois < 10 ? "0".$mois : $mois;  ?>';
	var dayy = '<?php echo $day ?>';
	$('#calendar11').fullCalendar({
		 header: {
            left: 'prev,today,next',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        allDayDefault: true,
        defaultDate: annee+'-'+mois+'-'+dayy,
        defaultView: 'basicWeek',
		events: [


			 		
		         <?php  foreach ($visitesR as $visite):?>
		         { 		
			         title : "  <?php echo $visite["heure"]." - ".$visite["firme"]." ".$visite["resultat"] ?>",
			         start: "<?php echo $visite["date"]?> <?php echo $visite["heure"] ?>",
			         url: '<?php echo url_for("AjouterVisitesR",array("id"=>$visite['id']))?>',
			         color: '#5C6BC0'
			        
		         },
		         
		         <?php  endforeach;?>
		         <?php  foreach ($visitesP as $visite):?>
		         { 		
			         title : "  <?php echo $visite["heure"]." - ".$visite["firme"]." Visite Planifiee "?>",
			         start: "<?php echo $visite["date"]?> <?php echo $visite["heure"] ?>",
			         url: '<?php echo url_for("AjouterVisitesP",array("id"=>$visite['id']))?>',
			         <?php echo "color: '#4CAF50'"; ?>
		         },
		         
		         <?php  endforeach;?>
		         
		 		],

		     dayClick: function(date, allDay, jsEvent, view) {

		    	 if (allDay) {
			          var odate = new Date(date);
		        	 var now = new Date();
		        	 var fulldate = odate.getDate()+'/'+(odate.getMonth()+1)+'/'+odate.getFullYear();
		        	 var fullnow = now.getDate()+'/'+(now.getMonth()+1)+'/'+now.getFullYear();
		        	 var fullnoww = $.datepicker.parseDate('dd/mm/yy',fullnow);
		        	 var fulldatee = $.datepicker.parseDate('dd/mm/yy',fulldate);
		        	 if($.datepicker.parseDate('dd/mm/yy',fullnow) >= $.datepicker.parseDate('dd/mm/yy',fulldate)){
		        		 window.open("<?php echo url_for("AjouterVisitesR")?>"+"?date="+fulldate);
		        	 }
		        	 else
		        		 {window.open("<?php echo url_for("AjouterVisitesP")?>"+"?date="+fulldate);}
			        		
		         }
		}
	});
	$('#calendar').fullCalendar('gotoDate', "12/12/2017");
});

</script>
