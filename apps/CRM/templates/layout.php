<html xmlns="http://www.w3.org/1999/xhtml" class="">
<head>
	
	<?php include_http_metas() ?>
    <?php include_metas() ?>
    <title>
    <?php echo $sf_request->getParameter('module')." - TechTrend Solutions"?>
    </title>

<link rel="icon" href="/images/logo.ico">
   	<?php include_stylesheets() ?>

    <?php include_javascripts() ?>

    <style type="text/css">
table.dataTable.cell-border tbody th,table.dataTable.cell-border tbody td
	{
	border-top: 1px solid #ddd;
	border-right: 1px solid #ddd
}

table.dataTable.cell-border tbody tr th:first-child,table.dataTable.cell-border tbody tr td:first-child
	{
	border-left: 1px solid #ddd
}

table.dataTable.cell-border tbody tr:first-child th,table.dataTable.cell-border tbody tr:first-child td
	{
	border-top: none
}


th {
	font-weight: bold;
	text-align: center;
}

.dtresult {
	border: 1px solid #ddd;
	padding-top: 15px;
	margin-left: 5px;
	margin-right: 5px;
}

table.display {
	border: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
}
table.dataTable {
	border: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
}

table.display th,  table.dataTable th {
	border: 1px solid #ddd;
	background-color: #efefef
}

table.display tr,  table.dataTable tr {
	border-bottom: 1px solid #ddd;
}
table.display td,  table.dataTable td {
	border-left: 1px solid #ddd;
	padding-left: 2px
}

.table>thead>tr>th,.table>tbody>tr>th,.table>tfoot>tr>th,.table>thead>tr>td,.table>tbody>tr>td,.table>tfoot>tr>td
	{
	padding: 1px 1px;
}
</style>


</head>
<script>
      <?php echo str_replace("&#039;","'",$sf_user->getAttribute('secure')); ?>
      </script>
<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo url_for('dashboard') ?>">CRM
				EDICOM</a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i
						class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i
						class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i
						class="icon-paragraph-justify3"></i></a></li>
                    
                  <?php include_partial('global/alerte') ?>
				
			</ul>

			<ul class="nav navbar-nav navbar-right">

				<li class="dropdown dropdown-user"><a class="dropdown-toggle"
					data-toggle="dropdown"> <i class="icon-user  "
						style="font-size: 26px;"></i> <span><?php echo $sf_user->getAttribute("login")?></span>
						<i class="caret"></i>
				</a>




					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo url_for('MonProfil') ?>"><i
								class="icon-user-plus"></i> Mon profil</a></li>
						<li><a href="<?php echo url_for('Login') ?>"><i
								class="icon-switch2"></i> Se deconnecter</a></li>
					</ul></li>
			</ul>

			<ul class="navbar-text navbar-right">
				<span class="label bg-success-300"><a
					href="javascript:history.go(-1)">Retour</a></span>


			</ul>
		</div>
	</div>
	<!-- /main navbar -->

	<div id='tts_load_page'></div>

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

                  <?php include_partial('global/hmenu') ?>
                

				</div>
			</div>
			<!-- /main sidebar -->

			<div class="content-wrapper">
       			<?php  echo $sf_content; ?>
			</div>

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
