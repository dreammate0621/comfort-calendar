<?php

include('config.php');
include('function.php');

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html" />
	<title>Comfort Calendar</title>
	<meta name="author" content="Andrew Zhang">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="Social Soup" />
	<!-- The fav icon -->
	<link rel="shortcut icon" href="admin/img/favicon.ico">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>assets/lib/bootstrap-datepicker/bootstrap-datepicker.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>assets/css/main.css" />
</head>

<body>
	<header>
		<img src="<?php echo SITEURL; ?>/assets/img/logo.png" alt"Logo Image" />
	</header>
	<div class="container main-wrapper">
		<form id="pdf_form" action="/generate.php">
			<div class="form-layout">
				<div class="form-field">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label class="field-title" for="pdf_image">Upload Photo</label>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="sub-form-field">
								<label for="pdf_image" class="btn btn-default">Choose File</label>
								<label class="choosen-file-name"></label>
								<input type="file" id="pdf_image" name="pdf_image" class="pdf-image hidden" />
							</div>
						</div>
					</div>
				</div>
				<div class="form-field">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label class="field-title" for="pdf_date">Treatment Start Date</label>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="input-group date" data-provide="datepicker">
								<input data-provide="datepicker" />
								<div class="input-group-addon">
					        <span class="glyphicon glyphicon-th"></span>
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-field">
				<div class="row">
					<div class="col-xs-12 text-center">
						<a class="btn btn-success" class="btn-preview">Generate</a>
					</div>
				</div>
			</div>
			<div class="preview-layout">
				<div class="preview-pdf-img-container">
					<img class="preview-pdf-img" src="<?php echo SITEURL; ?>uploads/ChelseyandMongo_3129.jpg" />
				</div>
				<div class="preview-pdf-title">
					<h2><span class="title-year">2017</span> Comfort Calendar</h2>
				</div>

				<div class="preview-pdf-calendar">
					<?php
						for($i = 1; $i <= 12; $i++):
							echo draw_calendar($i, 2017);
						endfor;
					?>
				</div>

				<div class="preview-pdf-footer">
					<div class="left-section">
						<img class="footer-img" src="<?php echo SITEURL; ?>assets/img/img-book.png" />
						<div class="footer-content">
							<h2>
								<span class="content-top">YOUR FURRY FRIEND THANKS YOU</span>
								<br/>
								<span class="content-bottom">For always looking out for them</span>
							</h2>
							<div class="content-comment"></div>
						</div>
					</div>
					<div class="right-section">
					</div>
				</div>
			</div>
		</form>
	</div>
	<footer>
	</footer>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="<?php echo SITEURL; ?>assets/lib/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
</body>
