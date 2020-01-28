<script type="text/javascript">
    $(document).on('click', '#actualiser_alerte',function(){
    	  $.ajax({
    	    url: "<?php echo url_for("Get_Alerte")?>",
    	    success: function(data) {
    	    	 
       	    	 jsArray = JSON.parse(data);
       	    	 var alertes="";
       	    	$.each( jsArray, function( key, value ) {
       	    		alertes+='<li class="media">'
          				+'<div class="media-left">'
          			    +'<a href="<?php echo url_for('Detail') ?>?alerte='+key+'" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm">'
          			    +'<i class="'+value["class"]+'"></i></a></div>'
          			    +'<div class="media-body">'+value["result"]+' '+value["libelle"]+'</div></li>';
       	    	});      	    	
       	       $('#notification').html(alertes);
    	    }
    	  });
    });
</script>

<li class="dropdown"><a href="#" class="dropdown-toggle"
	data-toggle="dropdown"> <i class="icon-warning"></i> <span
		class="badge bg-warning-400">
		<?php 
		      $alertes= $sf_user->getAttribute('alertes');
		      
		      echo count($alertes);
		 ?>
		</span>
</a>

	<div class="dropdown-menu dropdown-content">
		<div class="dropdown-content-heading">
			Alertes
			<ul class="icons-list">
				<li>
					<button type="button" class="btn btn-default"
						id="actualiser_alerte">
						<a data-action="reload"> </a>
					</button>
				</li>
			</ul>
		</div>

		<ul class="media-list dropdown-content-body width-350"
			id="notification">
		   <?php foreach ($alertes as $k => $alerte): ?>
		      <li class="media">
				<div class="media-left">
				<a href="<?php echo url_for('Detail',array("alerte" => $k)) ?>"
						class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm">
						<i class=" <?php echo $alerte["class"] ;?>"></i></a>
				
				</div>
				<div class="media-body">
            			<?php echo $alerte["result"].' '.$alerte["libelle"]; ?> 
                </div> 
            	


			</li>
	    	<?php endforeach; ?>
		</ul>

		<div class="dropdown-content-footer">
			<a href="#" data-popup="tooltip" title="All activity"><i
				class="icon-menu display-block"></i></a>
		</div>
	</div></li>
