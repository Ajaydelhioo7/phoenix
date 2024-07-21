<?php
require 'vendor/autoload.php';

// Retrieve data from the form submission
$data = json_decode($_POST['data'], true);

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your School or Institution Name');
$pdf->SetTitle('Test Score Report');
$pdf->SetSubject('Detailed Test Score');

// Set default header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Set some content to print
$html = <<<EOD
<h1 style="text-align: center; color: #007BFF;">Test Score Details</h1>
<table border="1" cellpadding="5" cellspacing="0" align="center">
    <tr>
        <td><strong>Roll No:</strong></td>
        <td>{$data['rollno']}</td>
    </tr>
    <tr>
        <td><strong>Batch:</strong></td>
        <td>{$data['batch']}</td>
    </tr>
    <tr>
        <td><strong>Test Name:</strong></td>
        <td>{$data['testname']}</td>
    </tr>
    <tr>
        <td><strong>Right Questions:</strong></td>
        <td>{$data['right_question']}</td>
    </tr>
    <tr>
        <td><strong>Wrong Questions:</strong></td>
        <td>{$data['wrong_question']}</td>
    </tr>
    <tr>
        <td><strong>Not Attempted:</strong></td>
        <td>{$data['not_attempted']}</td>
    </tr>
    <tr>
        <td><strong>Max Marks:</strong></td>
        <td>{$data['max_marks']}</td>
    </tr>
    <tr>
        <td><strong>Marks Obtained:</strong></td>
        <td>{$data['marks_obtained']}</td>
    </tr>
    <tr>
        <td><strong>Percentage:</strong></td>
        <td>{$data['percentage']}%</td>
    </tr>
    <tr>
        <td><strong>Award for Wrong:</strong></td>
        <td>{$data['award_for_wrong']}</td>
    </tr>
    <tr>
        <td><strong>Award for Right:</strong></td>
        <td>{$data['award_for_right']}</td>
    </tr>
    <tr>
        <td><strong>Accuracy:</strong></td>
        <td>{$data['accuracy']}%</td>
    </tr>
</table>
EOD;

// Print text using writeHTML()
$pdf->writeHTML($html, true, false, true, false, '');

// Embed chart image if exists
if (isset($_POST['chartData'])) {
    $chartData = $_POST['chartData'];
    $img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $chartData));
    $pdf->Image('@' . $img, 15, 140, 180, 0, 'PNG', '', 'T', false, 300, '', false, false, 1, false, false, false);
}

// Close and output PDF document
$pdf->Output('test_score_details.pdf', 'I'); // Sends the PDF inline to the browser
