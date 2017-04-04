<?php

require_once 'config.php';
require_once 'function.php';
require 'vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

$image_url = 'ChelseyandMongo_3129.jpg';

if ( 0 < $_FILES['pdf_image']['error'] ) {
	echo 'Error: ' . $_FILES['pdf_image']['error'] . '<br>';
}
else {
	move_uploaded_file($_FILES['pdf_image']['tmp_name'], 'uploads/' . $_FILES['pdf_image']['name']);
	$image_url = $_FILES['pdf_image']['name'];
}

$pdf_date_month = $_POST['pdf_date_month'];
$pdf_date_day = $_POST['pdf_date_day'];

donwloadAsPDF($image_url, $pdf_date_month, $pdf_date_day);


function donwloadAsPDF($image_url = '', $pdf_date_month = 0, $pdf_date_day = 0) {
	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->set_option('isRemoteEnabled', true);


	$html = '
		<div class="result-layout">
			<div class="preview-pdf-container">
				<div class="preview-pdf-img-container" style="border: 20px solid #a1c2e6;">
					<img class="preview-pdf-img" src="' . SITEURL . 'uploads/' . $image_url . '" style="width:100%; min-height:300px; object-fit: cover;"/>
				</div>
				<div class="preview-pdf-title">
					<h2 style="font-size: 60px; font-weight: bold; color: #007ec5; font-family: Nimbus; text-align: center;"><span class="title-year" style="color: #df2027;">2017</span> Comfort Calendar</h2>
				</div>

				<div class="preview-pdf-calendar" style="display: block; text-align: center; width: 100%;">';

		
		for($i = 1; $i <= 12; $i++):
			$html .= draw_calendar($i, 2017, $pdf_date_month, $pdf_date_day);
			if($i % 4 == 0) {
				$html .= '<div style="clear: both;"></div>';
			}
		endfor;

		$html .= '
				</div>

				<div class="preview-pdf-footer" style="display: block; font-size: 0; letter-spacing: -2px; margin-top: 30px;">
					<div class="left-section" style="display: inline-block; vertical-align: bottom; width: 70%;">
						<img class="footer-img" src="' . SITEURL . 'assets/img/img-book.png" style="width: 75px; display: inline-block; vertical-align: bottom;" />
						<div class="footer-content" style="display: inline-block; vertical-align: bottom; width: 500px; text-align: left; padding-left: 10px;">
							<h2 style="margin-bottom: 0;">
								<span class="content-top" style="font-size: 24px; font-weight: bold; color: #df2027;">YOUR FURRY FRIEND THANKS YOU</span>
								<br/>
								<span class="content-bottom" style="font-size: 24px; font-weight: bold; color: #007ec5;">For always looking out for them</span>
							</h2>
							<div class="content-comment" style="font-size: 18px; font-weight: bold; color: #000000;">
								<span style="display: inline-block; vertical-align: top; width: 25px; height: 20px; background-color: #df2027;"></span>
								YOUR COMFORTIS PLUS TREATMENT IS DUE
							</div>
						</div>
					</div>
					<div class="right-section" style="display: inline-block; vertical-align: bottom; width: 30%; text-align: right;">
						<img class="footer-logo" src="' . SITEURL . 'assets/img/logo.png" alt="Logo Image" style="max-width: 100%; width: 155px;" />
					</div>
				</div>
			</div>
		</div>';


	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$image_size = getimagesize ( 'uploads/' . $image_url);
	$customPaper = array(0,0,595, 595 / $image_size[0] * $image_size[1] + 633);
	$dompdf->setPaper($customPaper, 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream('myCalendar.pdf');
}
