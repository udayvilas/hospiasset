<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('STOCK Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                              STOCK REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage();
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Date</th>
        <td style="border:1px solid black;width:35%;">'.date('d-m-Y').'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Time</th>
        <td style="border:1px solid black;width:35%">'.date('h:i A').'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Branch</th>
        <td style="border:1px solid black;width:85%;">'.$single_stock->branch_name.'</td>
    </tr>
    <tr>

        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Indent. ID</th>
        <td style="border:1px solid black;width:70%;">'.$single_stock->INDENT_ID.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Eq. Name</th>
        <td style="border:1px solid black;width:70%;">'.$single_stock->E_NAME.'</td>
    </tr>
     <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Accessories</th>
        <td style="border:1px solid black;width:70%;">'.$single_stock->ACCSSORIES.'</td>
    </tr>
     <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Spares</th>
        <td style="border:1px solid black;width:70%;">'.$single_stock->SPARES.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Make</th>
        <td style="border:1px solid black;width:70%;">'.$single_stock->make.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Model</th>
        <td style="border:1px solid black;width:70%;">'.$single_stock->E_MODEL.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Serial No.</th>
        <td style="border:1px solid black;width:70%;">'.$single_stock->ES_NUMBER.'</td>
    </tr>

    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1"> Cost</th>
        <td style="border:1px solid black;width:70%;">'.$single_stock->E_COST.'</td>
    </tr>
       <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Category</th>
        <td style="border:1px solid black;width:70%;">'.$single_stock->eq_cat.'</td>
    </tr>

    </table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output();
?>