<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <base href="http://codingwiki.net" />
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
    <?php if ($title_for_layout == 'CodingWiki - Home'): ?>
	<title><?php echo $title_for_layout ?></title>
    <?php else: ?>
    <title><?php echo $title_for_layout ?> - CodingWiki</title>
    <?php endif; ?>
    <?php if (!empty($description_for_layout)): ?>
	   <meta name="description" content="<?php echo $description_for_layout ?>">
    <?php else: ?>
        <meta name="description" content="CodingWiki. By Coders. For Coders.">
    <?php endif; ?>
    <?php if (!empty($author_for_layout)): ?>
	   <meta name="author" content="<?php echo $author_for_layout ?>">
    <?php else: ?>
        <meta name="author" content="CodingWiki">
    <?php endif; ?>
    <script src="/ckeditor/ckeditor.js"></script>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="stylesheet" href="css/layout.css">

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

</head>
<body>



	<!-- Primary Page Layout
	================================================== -->

	<!-- Delete everything in this .container and get started on your own site! -->
    
	<div class="container">
    <h1><a href="/">CodingWiki</a></h1>

    <?php echo $this->element('navigation'); ?>
        <?php echo $this->Session->flash(); ?>
    <?php if ($this->Session->flash()): ?>
    <div class="clear"></div>
    <?php endif; ?>
        <?php echo $content_for_layout ?>
	</div><!-- container -->



	<!-- JS
	================================================== -->
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="js/tabs.js"></script>

<!-- End Document
================================================== -->
</body>
</html>