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
		<link href="<?php echo $site; ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">	
		<link href="<?php echo $site; ?>/css/bootstrap-responsive.css" rel="stylesheet">

		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
	
	<section id="body">

		<header>			
			<h2><?php echo $lang['PAGE_NAME']; ?></h2>
			<div id="homeLogout">
				<a href="<?php echo $site; ?>indexSite">Inicio</a>
			<?php 
			if (isset($sessionSite)) {
			?>
				<a href="<?php echo $site; ?>user/logout">Logout</a>
			<?php 
			}
			?>
			</div>
		</header>

		<section id="content">
			<!-- Exito -->
			<section id="alert">
				<article id="alert_msg"></article>
			</section>
			<br>
			
			<?php			
			include($body);
			?>
		</section>
		<br>
		<footer>
		  	<address>
		  		<?php echo $lang['FOOTER_SITE']; ?>
		  	</address>
		</footer>
		
		<section id="loading"></section>
		
		<section id="dialog-form">
			<section id="form-data"></section>
		</section>
		
	</section>
	
	</body>
</html>
