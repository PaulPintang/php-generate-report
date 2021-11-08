<?php 

// Include the main TCPDF library (search for installation path).
require_once('TCPDF/tcpdf.php');

$db = mysqli_connect('localhost', 'root', '', 'report');
$student = mysqli_query($db,'SELECT * FROM student');

if (isset($_GET['generate'])) {
    $name = $_GET['name'];
    $age = $_GET['age'];

    $getStudent = mysqli_query($db, 'SELECT * FROM student');
    while($row = mysqli_fetch_array($getStudent)){
        $name = $row['name'];
        $age = $row['age'];
    }
}

class PDF extends TCPDF{
    // PAGE HEADER
    public function Header(){
        $imageFile = K_PATH_IMAGES.'img.png';
        // $this->Image($imageFile, 40, 10, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Ln(5);
        $this->SetFont('helvetica', 'B', 9);
        // width
        $this->Cell(189, 5, 'Bicol University Polangui Campus', 0, 1, 'C');
        $this->Cell(189, 5, 'Polangui, Albay', 0, 1, 'C');
    }


    // PAGE FOOTER
    public function Footer(){
    // test some inline CSS
        $html = '<p style="color:#CC0000;">Note: Invalid without signature</p>';
        $this->writeHTML($html, true, false, true, false, '');
    }
}

// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Administrator');
$pdf->SetTitle('Student Profile');
$pdf->SetSubject('Student Information');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);


// Add a page
// This method has several options, check the source code documentation for more information.
 $pdf->AddPage();

//  BODY OF THE PAGE
     $html = '<p>Name: '.$name.'</i>';
     $pdf->writeHTML($html, true, false, true, false, '');
// END

$pdf->Output('example_001.pdf', 'I');
?>