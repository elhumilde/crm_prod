<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Administrateur</a></li>
      <li class="active">Gestion des couleurs</li>
    </ul>
    <div class="heading-elements">
        <div class="heading-btn-group">
          <a href="<?php echo url_for('Couleur', array("act" => "reinitialiser")) ; ?>">
            <button type="button" class="btn border-slate text-slate-800 btn-flat">
              <i class="icon-add position-left"></i> 
              R&eacute;initialiser les Couleur
            </button>
          </a>
        </div>
      </div>
  </div>
</div>
<!-- /page header -->


	<!-- Content area -->
	<div class="content">



		<!-- Basic layout-->
		<form method="post">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Modifier mes couleurs</h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
						</ul>
					</div>
				</div>

				<div class="panel-body">
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label>Header (entete):</label> <input type="color"  class="form-control" <?php echo $form["couleur_header"]?>>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Menu:</label> <input type="color"  class="form-control"  <?php echo $form["couleur_menu"]?>>
							</div>
						</div>
						
						
					</div>
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label>Body (contenu):</label> <input type="color"  class="form-control" <?php echo $form["couleur_body"]?>>
							</div>
						</div>

						
						
					</div>
					
					
					
                    <div class="col-md-6">
					<div class="text-right">
						<button type="submit" class="btn btn-primary">
							Enregistrer <i class="icon-arrow-right14 position-right"></i>
						</button>
					</div>
					</div>
				</div>
			</div>

		<!-- /basic layout -->
        </form>

	</div>
	<!-- /content area -->
