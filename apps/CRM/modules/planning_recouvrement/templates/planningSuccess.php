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
						   		 if(!$sf_user->hasCredential('allencaissement')):
						   		    $cond_commercial=" and u.id in ($ids_users_affecte)";
						   		 endif;
						   		 
						   			echo TTSList::getListBox(array(
										"query" => "select u.id,concat(u.nom,' ',u.prenom) as login from tts_utilisateur u where actif = 1  and id_service in (3, 11)  $cond_commercial order by nom",
										"value" => "id",
										"libel" => "login",
										"key" => "operateur",
										"db" => "crm",
		                                "class" => "select",
									)); 
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
					<div id="calendar12"></div>
				</div>
				<div class="col-md-2">

					<br><br><br><br><br>
					<div class="row">
					    <div class="col-md-12">
					        <input type="color" disabled="disabled" value="#5C6BC0" style="width: 50px;height:20px;"> Appels Prévus
					    </div>
					</div>
				    <div class="row">
					    <div class="col-md-12">
					        <input type="color" disabled="disabled" value="#4CAF50" style="width: 50px;height:20px;"> Visites Prévues
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
	var dayy = '<?php echo "03" ?>';
	$('#calendar12').fullCalendar({
		date: dayy,
		header: {
			left: 'month,agendaWeek,title',
			center: '',
			right: '',
		},
		
		
		defaultDate: annee+'-'+mois+'-'+dayy,
		lang: 'fr',
		columnFormat:{week:"ddd d/M"},
		firstDay:1,
		editable: true,
		droppable: false, 
		header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
		events: [


			 		
		         <?php  foreach ($appels as $appel):?>
		         { 		
			         title : "  <?php echo $appel["firme"] ?>",
			         start: "<?php echo $appel["date"]?> ?>",
			         allDay : true,
			         url: '<?php echo url_for("ConsulterRecouvrement",array("id"=>$appel['id_encai']))?>',
			         target: '_blank',
			         color: '#5C6BC0'
			        
		         },
		         <?php  endforeach;?>
		         <?php  foreach ($visites as $visite):?>
		         { 		
			         title : "  <?php echo $visite["firme"];?>",
			         start: "<?php echo $visite["date"]?>",
			         allDay : true,
			         url: '<?php echo url_for("ConsulterRecouvrement",array("id"=>$visite['id_encai']))?>',
			         color: '#4CAF50'
		         },
		         
		         <?php  endforeach;?>
		         
		 		],
		         eventClick: function(event) {
				    if (event.url) {
				        window.open(event.url, "_blank");
				        return false;
				    }
				},

		     dayClick: function(date, allDay, jsEvent, view) {

		    	 if (allDay) {
			          var odate = new Date(date);
		        	 var now = new Date();
		        	 var fulldate = odate.getDate()+'/'+(odate.getMonth()+1)+'/'+odate.getFullYear();
		        	 var fullnow = now.getDate()+'/'+(now.getMonth()+1)+'/'+now.getFullYear();
		        	 var fullnoww = $.datepicker.parseDate('dd/mm/yy',fullnow);
		        	 var fulldatee = $.datepicker.parseDate('dd/mm/yy',fulldate);
			        		
		         }
		}
	});
	$('#calendar').fullCalendar('gotoDate', "12/12/2017");

});

</script>
