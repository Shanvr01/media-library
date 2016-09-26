<?php
	$catalog = array(
		'Beethoven',
		'Spud',
		'Something'
		);

	$pageTitle = 'Catalog';
	if (isset($_GET['cat'])) {
		if ($_GET['cat'] == 'books') {
			$pageTitle = 'Books';
			$section = 'books';
		} if ($_GET['cat'] == 'movies') {
			$pageTitle = 'Movies';
			$section = 'movies';
		} if ($_GET['cat'] == 'music') {
			$pageTitle = 'Music';
			$section = 'music';
		}
	}
	include('/includes/header.php');
?>

	<div class="page-header">
		<h1><?php echo $pageTitle; ?></h1>

		<?php foreach ($catalog as $item) {
			echo "<li>". $item ."</li>";
		}
		?>
	</div>

<?php

	include('/includes/footer.php');
?>