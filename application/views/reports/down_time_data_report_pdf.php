<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Down Time Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                                                                                                      DOWN TIME REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 9);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage("L","A4");
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
	<thead>
    <tr>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Date of Failure</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Dept</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Equipment</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">OEM</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Serial No</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Date Of Installation</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Action Taken</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Problems</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Standard by Status</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Total No.of Eq. Same Type </th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Total Down Time (Hrs%)</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" colspan="3">Finally Equipments is Repaired Date</th>
    </tr>
    <tr>
        <th style="border:1px solid black;background-color:#f1f1f1;"> Repaired Dates</th>
        <th style="border:1px solid black;background-color:#f1f1f1;"> Delay (days)</th>
        <th style="border:1px solid black;background-color:#f1f1f1;"> Delay (Hrs)</th>
    </tr></thead><tbody>';
    foreach($dts['list'] as $dt)
    {
       $html.='<tr>
       <td style="border:1px solid black;">'.$dt['CDATE'].'</td>
       <td style="border:1px solid black;">'.$dt['CALLER_DEPT'].'</td>
       <td style="border:1px solid black;">'.$dt['equp_name'].'</td>
       <td style="border:1px solid black;">'.$dt['cmpny_name'].'</td>
       <td style="border:1px solid black;">'.$dt['serial_no'].'</td>
       <td style="border:1px solid black;">'.$dt['date_of_install'].'</td>
       <td style="border:1px solid black;">'.$dt['NATURE_OF_COMP'].'</td>
       <td style="border:1px solid black;">'.$dt['ACTION_TAKEN'].'</td>
       <td style="border:1px solid black;">'.$dt['STATUS'].'</td>
       <td style="border:1px solid black;">'.$dt['no_same_equpts'].'</td>
       <td style="border:1px solid black;">'.$dt['total_down_time'].' %</td>
       <td style="border:1px solid black;">'.$dt['JOBCOMPLETED_DATE'].'</td>
       <td style="border:1px solid black;">'.$dt['TIME_TO_REPAIR'].'</td>
       <td style="border:1px solid black;">'.$dt['Deal_in_Hours'].'</td>
    </tr>';
    }
    $html.='<tr>
       <td style="border:1px solid black;background-color:#f1f1f1;" colspan="9">Total</td>
       <td style="border:1px solid black;">'.$dts['total_no_same_equpts'].'</td>
       <td style="border:1px solid black;">'.$dts['all_total_down_time'].' %</td>
       <td style="border:1px solid black;"></td>
       <td style="border:1px solid black;">'.$dts['total_delay_in_days'].'</td>
       <td style="border:1px solid black;">'.$dts['total_delay_in_hours'].'</td>
    </tr></tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>