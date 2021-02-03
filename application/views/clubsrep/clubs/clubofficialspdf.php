<?php
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // //Page header
    // public function Header() {
    //     // Logo
    //     $image_file = K_PATH_IMAGES.'DSC_0138.jpg';
    //     $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    //     // Set font
    //     $this->SetFont('helvetica', 'B', 20);
    //     // Title
    //     $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    // }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', '', 8);//second set italic if u want
        
        // Page number
        $this->Cell(0, 10, '© 2017 The Phenom Research Center, Strathmore Research Club                                                                                                     Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

    }
}

// 
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Strathmore DoS');
$pdf->SetTitle('Strathmore University Club Officials');
$pdf->SetSubject('Strathmore University Club Officials');
$pdf->SetKeywords('Strathmore University Club Officials');
// foreach ($clubofficials as $record) 
// {}
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, "Current Club Officials\nDownloaded:".date_format( date_create(date('c')), ' j F Y, g:i A' ), array(0,0,0), array(0,0,0));

$pdf->setFooterData(array(0,64,0),array(0,64,128));

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
$pdf->SetFont('times', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage('L');

// set text shadow effect
// $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));



// $heading = <<<EOD
// <h2 style="text-align:center">List of Clubs</h2>
// EOD;



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', '', 0, 1, 0, true, '', true);
$pdf->Ln(0);
$table='<table border="1" style="margin-left:30px" >';

$table .='<thead >';
$table .='<tr >';
$table .='<th width="5%"  style="text-align:center">#</th>';
$table .='<th width="7%" style="text-align:center;font-weight:bold">SU ID</th>';
$table .='<th width="15%" style="text-align:center;font-weight:bold">Full Names</th>';
$table .='<th width="8%" style="text-align:center;font-weight:bold">Gender</th>';
$table .='<th width="10%" style="text-align:center;font-weight:bold">Phone</th>';
$table .='<th width="30%" style="text-align:center;font-weight:bold">Club</th>';
$table .='<th width="25%" style="text-align:center;font-weight:bold">Role</th>';
$table .='</tr>';
$table .='</thead>';
$count=1;
foreach ($clubofficials as $record) 
{

    $table .='<tr>';
    $table .='<th width="5%" style="text-align:center">'.$count.'</th>';
    $table .='<th width="7%"style="text-align:center" >'.$record['suID'].'</th>';
    $table .='<th width="15%">'.$record['firstName']." " .$record['lastName'].'</th>';
    $table .='<th width="8%" style="text-align:center">'.$record['gender'].'</th>';
    $table .='<th width="10%" >'.$record['telNo'].'</th>';
    $table .='<th width="30%" >'.$record['clubName'].'</th>';
    $table .='<th width="25%">'.$record['roleName'].'</th>';
    $table .='</tr>';
    $count=$count+1;
 
}
$table .='</table>';

$pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, '', true);
                 
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('listofcurrentclubofficials.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
