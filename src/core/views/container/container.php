<!DOCTYPE html>
<html lang="<?php echo $lang_site ?>" >
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html" />
		<meta name="Description" content="<?php echo $lang['PAGE_NAME']; ?> - <?php echo $lang['PAGE_TITLE']; ?> : <?php if (isset($welcome)) { echo $welcome; } ?>" />
		<meta name="keywords" content="" />
		<meta name="robots" content="index, follow, noarchive" />
		<meta name="googlebot" content="noarchive" />	
		<title><?php echo $lang['PAGE_NAME']; ?> - <?php echo $lang['PAGE_TITLE']; ?></title>
		<!--  CSS -->
		<link href="<?php echo $site; ?>/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">	
		<link href="<?php echo $site; ?>/dist/css/bootstrap-theme.css" rel="stylesheet">	
		<link href="<?php echo $site; ?>/css/default.css" rel="stylesheet">

		<!--[if lt IE 9]>
		<script src="<?php echo $site; ?>/assets/js/html5shiv.js"></script>
		<![endif]-->

	</head>
	<body>

		<div class="container">
	      <div class="header">
	        <ul class="nav nav-pills pull-right">
	          <li class="active"><a href="<?php echo $site; ?>indexSite">Inicio</a></li>
	          <?php 
			if (isset($sessionSite)) {
			?>
				<li><a href="<?php echo $site; ?>user/logout">Logout</a></li>
			<?php 
			}
			?>
				<li><a href="#">About</a></li>
          		<li><a href="#">Contact</a></li>
	        </ul>
	        <h3 class="text-muted"><?php echo $lang['PAGE_NAME']; ?></h3>
	      </div>

      <div class="row marketing">
        <?php			
			include($body);
			?>
      </div>

      <div class="footer">
        <p>&copy; <?php echo $lang['FOOTER_SITE']; ?></p>
      </div>

    </div> <!-- /container -->
	
	<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo $site; ?>/assets/js/jquery-ui-1.10.2.custom.js"  type="text/javascript"></script>
		<script src="<?php echo $site; ?>/js/jquery.validationEngine.js" type="text/javascript"></script>
		<script src="<?php echo $site; ?>/js/languages/jquery.validationEngine-<?php echo $lang_site ?>.js" type="text/javascript"></script>
		<script src="<?php echo $site; ?>/js/jquery.dataTables.js" type="text/javascript"></script>
		<script src="<?php echo $site; ?>/js/default.js" type="text/javascript"></script>
		<script src="<?php echo $site; ?>/dist/js/bootstrap.js"  type="text/javascript"></script>
		<script src="<?php echo $site; ?>/js/jquery.enter.js" type="text/javascript"></script>
	
	</body>
</html>
