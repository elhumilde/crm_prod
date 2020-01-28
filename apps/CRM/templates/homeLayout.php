<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/images/logo.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <!-- BEGIN BODY -->
    <body>
        <!-- Page container -->
        <div class="page-container login-container">

                  <?php echo $sf_content ?>
                  

        </div>
        <!-- /page container -->
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="/images/slide-1.jpg" style="width:100%;">
                </div>
                <div class="item">
                    <img src="/images/slide-2.jpg" style="width:100%;">
                </div>
                <div class="item">
                    <img src="/images/slide-3.jpg" style="width:100%;">
                </div>
                <div class="item">
                    <img src="/images/slide-4.jpg" style="width:100%;">
                </div>       
            </div>
        </div>
    </body>
</html>