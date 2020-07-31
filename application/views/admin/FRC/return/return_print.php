<?php
// set document information
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Nicola Asuni');
// $pdf->SetTitle('TCPDF Example 050');
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 050', PDF_HEADER_STRING);

// // set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

// set image scale factor
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set style for barcode
$style = array(
    'position' => '',
    'align' => 'L',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => TRUE,
    'font' => 'helvetica',
    'fontsize' => 9,
    'stretchtext' => 4
);
// set font

$pdf->SetFont('times', 'B', 8,'', 'false');

// $date = my_date_show($data->created_date);
/// add a page
 $pdf->AddPage('L','A8');

// chmod($image_file, 0600)



$pdf->write1DBarcode($data->parent_barcode, 'C128', 2, 0, 0, 16, 0.4, $style, 'T');

$pdf->Ln(0);


$html = <<<EOD
<style>

.main-text{
  text-align:left;
}
</style>

<table  width="2.0in" >
  <tr class="first_part">
    <td>
      <table>
        <tr>
          <td colspan="2" class=" main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class=" main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class=" main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class=" main-text"></td>
        </tr>
         <tr>
          <td> &nbsp;&nbsp; BARCODE</td>
          <td >:-  $data->parent_barcode</td>
        </tr>
        
        <tr>
          <td> &nbsp;&nbsp; FABRIC</td>
          <td >:-  $data->fabricName</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; HSN</td>
          <td >:- $data->hsn</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; SIZE</td>
          <td >:- $data->current_stock   $data->stock_unit</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; COLOR</td>
          <td >:- $data->color_name</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; CHALLAN NO</td>
          <td >:-  $data->challan_no</td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
EOD;

$pdf->writeHTMLCell(5, 5, 1, 1, $html,  0, 0, 0, true, 'L', true);
//Close and output PDF document



$pdf->Output('example_050.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
