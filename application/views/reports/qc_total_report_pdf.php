<?php
//print_r($tqc);
//die();
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Calibration Report PDf');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'Calibration REPORT', array(0,64,55), array(0,64,128));
$pdf->setFooterData(array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 9);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('L','A4');
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <thead>
    <tr>
        <th style="border:1px solid black;width:2%;">SN</th>
        <th style="border:1px solid black;width:20%;">Eq. ID</th>
        <th style="border:1px solid black;width:20%;">Eq. Name</th>
        <th style="border:1px solid black;width:4%;">Dept</th>
        <th style="border:1px solid black;width:10%;">Serial No.</th>
        <th style="border:1px solid black;width:44%;">Additional Details</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($tqcs as $tqc)
    {
        $small_table = '<table cellpadding="2">
    <tr>
        <th style="border-bottom:1px solid black;border-right:1px solid black">Task</th><th style="border-right:1px solid black;border-bottom:1px solid black">Name</th><th style="border-right:1px solid black;border-bottom:1px solid black">Date</th><th style="border-bottom:1px solid black">Reason</th>
    </tr>
    <tr>
        <td style="border-bottom:1px solid black;border-right:1px solid black">Assigned by</td><td style="border-bottom:1px solid black;border-right:1px solid black">'.$tqc["assigned_by"].'</td><td style="border-bottom:1px solid black;border-right:1px solid black">Done On: '.date("d-m-Y",strtotime($tqc["QC_DONE"])).'</td><td style="border-bottom:1px solid black;">'.$tqc["ASSIGN_REMARKS"].'</td>
    </tr>
    <tr>
        <td style="border-right:1px solid black">Completed by</td><td style="border-right:1px solid black">'.$tqc["Completed_by"].'</td><td style="border-right:1px solid black">Due Date: '.date("d-m-Y",strtotime($tqc["QC_DUE"])).'</td><td>'.$tqc["COMPLETED_REMARKS"].'</td>
    </tr></table>';
        $html.='<tr>
        <td style="border:1px solid black;width:2%;">'.$i.'</td>
        <td style="border:1px solid black;width:20%;">'.$tqc['EID'].'</td>
        <td style="border:1px solid black;width:20%;">'.$tqc["equp_name"].'</td>
        <td style="border:1px solid black;width:4%;">'.$tqc["dept_id"].'</td>
        <td style="border:1px solid black;width:10%;">'.$tqc["es_number"].'</td>
        <td style="border:1px solid black;width:44%;">'.$small_table.'</td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>