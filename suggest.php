<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = trim(filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING));
		$email = trim(filter_input(INPUT_POST,"email", FILTER_SANITIZE_STRING));
		$category = trim(filter_input(INPUT_POST,"category", FILTER_SANITIZE_STRING));
		$title = trim(filter_input(INPUT_POST,"title", FILTER_SANITIZE_STRING));
		$format = trim(filter_input(INPUT_POST,"format", FILTER_SANITIZE_STRING));
		$genre = trim(filter_input(INPUT_POST,"genre", FILTER_SANITIZE_STRING));
		$year = trim(filter_input(INPUT_POST,"year", FILTER_SANITIZE_STRING));
		$details = trim(filter_input(INPUT_POST,"details", FILTER_SANITIZE_SPECIAL_CHARS));

		if ($name == "" || $email == "" || $category == "" || $title == "" ) {
			$error_message = "Please fill in the required fields: Name, Email, Category and Title";
		}
		if ($_POST["address"] != "") {
			$error_message = "Bad form input";
		}

		require('/includes/phpmailer/class.phpmailer.php');

		$mail = new PHPmailer;
		if (!$mail->ValidateAddress($email)) {
			$error_message = "Invalid Email Address";
		}

		if(!isset($error_message)) {

			$email_body = "";
			$email_body .= "Name " . $name . "\n";
			$email_body .= "Email " . $email . "\n";
			$email_body .= "Suggsted Item\n";
			$email_body .= "Category " . $category . "\n";
			$email_body .= "Title " . $title . "\n";
			$email_body .= "Format " . $format . "\n";
			$email_body .= "Genre " . $genre . "\n";
			$email_body .= "Year " . $year . "\n";
			$email_body .= "Details " . $details . "\n";

			$mail->setFrom($email, $name);
			$mail->addAddress('treehouse@localhost', 'Shan');     // Add a recipient

			$mail->isHTML(false);                                  // Set email format to HTML

			$mail->Subject = 'Personal Media Library Suggestion from ' . $name;
			$mail->Body    = $email_body;

			if($mail->send()) {
				header('location:suggest.php?status=thanks');
				exit;
			}
			    $error_message = 'Message could not be sent.';
			    $error_message .= 'Mailer Error: ' . $mail->ErrorInfo;
			}
		}
	}

	$pageTitle = 'Suggest Page';
	$section = 'suggest';
	include('/includes/header.php');

?>

	<div class="page-header">
		<div class="section page">
			<div class="wrapper">
				<h1><?php echo $pageTitle; ?></h1>
				<?php if (isset ($_GET['status']) && $_GET['status'] == 'thanks') {
					echo "<p>Thanks for the email! I&rsquo;ll check out your suggestions shortly!</p>";
				} else {
				?>
				<p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an email.</p>
				<form method="post" action="suggest.php">
					<table>
						<tr>
							<th><label for="name">Name (required)</label></th>
							<td><input type="text" name="name" id="name" /></td>
						</tr>
						<tr>
							<th><label for="email">Email (required)</label></th>
							<td><input type="text" name="email" id="email" /></td>
						</tr>
						<tr>
							<th><label for="category">Category (required)</label></th>
							<td>
								<select name="category" id="category">
									<option value="">Select One</option>
									<option value="Books">Book</option>
									<option value="Movies">Movie</option>
									<option value="Music">Music</option>
								</select>
							</td>
						</tr>
						<tr>
							<th><label for="title">Title (required)</label></th>
							<td><input type="text" name="title" id="title" /></td>
						</tr>
						<tr>
							<th><label for="format">Format</label></th>
							<td>
								<select name="format" id="format">
									<option value="">Select One</option>
									<optgroup label="Books">
										<option value="Audio">Audio</option>
										<option value="Ebook">Ebook</option>
										<option value="Hardback">Hardback</option>
										<option value="Paperback">Paperback</option>
									</optgroup>
									<optgroup label="Movies">
										<option value="Blu-ray">Blu-ray</option>
										<option value="DVD">DVD</option>
										<option value="Streaming">Streaming</option>
										<option value="VHS">VHS</option>
									</optgroup>
									<optgroup label="Music">
										<option value="Cassette">Cassette</option>
										<option value="CD">CD</option>
										<option value="MP3">MP3</option>
										<option value="Vinyl">Vinyl</option>
									</optgroup>
								</select>
							</td>
						</tr>
						<tr>
							<th><label for="year">Year</label></th>
							<td><input type="text" name="year" id="year" /></td>
						</tr>
						<tr>
							<th><label for="details">Additional Details</label></th>
							<td><textarea name="details" id="details"></textarea></td>
						</tr>
						<tr style = "display: none;">
							<p style="display: none;>Please leave this field blank</p>
							<th><label for="address">Address</label></th>
							<td><input type="text" name="address" id="address" /></td>
						</tr>
					</table>
					<input type="submit" value="send"/>
				</form>
				<?php } ?>
			</div>
		</div>
	</div>

<?php
	include('/includes/footer.php');
?>