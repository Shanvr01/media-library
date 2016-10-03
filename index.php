<?php
	include('includes/data.php');
	include('includes/functions.php');
	$pageTitle = "Shan's Media Library";
	$section = null;
	include('/includes/header.php');
?>
		<div class="page-header">
			<div class="section catalog random">
				<div class="wrapper">
					<h1>Welcome to my Media Library</h1>
					<ul class="items">
						<?php
						$random = array_rand($catalog, 4);
						foreach ($random as $id) {
							echo get_item_html($id, $catalog[$id]);
						}
						?>
					</ul>
				</div>
			</div>
		</div>

<?php

	include('/includes/footer.php');

?>
