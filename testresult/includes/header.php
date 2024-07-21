<?php
// Get the root URL of the website
$rootUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . "localhost/ai/";


// If your application is in a subfolder, append the folder name to the root URL
// For example, if your app is located in the 'myapp' folder, uncomment the line below and replace 'myapp' with the actual folder name
// $rootUrl .= '/myapp';
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?php echo $rootUrl; ?>assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="<?php echo $rootUrl; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?php echo $rootUrl; ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?php echo $rootUrl; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="<?php echo $rootUrl; ?>assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="<?php echo $rootUrl; ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo $rootUrl; ?>assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="<?php echo $rootUrl; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $rootUrl; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="<?php echo $rootUrl; ?>assets/css/app.css" rel="stylesheet">
	<link href="<?php echo $rootUrl; ?>assets/css/icons.css" rel="stylesheet">
	<link href="<?php echo $rootUrl; ?>assets/css/main.css" rel="stylesheet">
	
	
	<title>99Notes- Study Smart</title>
</head>

<body class="bg-theme bg-theme2">
    <?php include'./includes/sidebar.php';?>
    <?php include'./includes/navbar.php';?>
    <div class="page-wrapper">
			<div class="page-content">
				<div class="row ">