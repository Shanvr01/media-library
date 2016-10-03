<?php
	include('includes/data.php');
	include('includes/functions.php');
	$pageTitle = 'Catalog';
	$section = null;

	if (isset($_GET['id'])) {
		$id = $_GET["id"];
	}

	include('/includes/header.php');
