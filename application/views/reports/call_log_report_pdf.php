<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Call Log Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                                                                                                      CALL LOG REPORT', array(0,64,55), array(0,64,128));
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
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2"  colspan="4">Equp ID</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Eq Name</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Vendor</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Reasons</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2" colspan="2">Call date & Time</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Raised</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2" colspan="2">Responded By</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Pending</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Closed</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2">Call Cost </th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2" colspan="2">Responded Time</th>
        <th style="border:1px solid black;background-color:#f1f1f1;" rowspan="2" colspan="2">Completed Time</th>
    </tr>
  </thead><tbody>';
    foreach($clogs as $clog)
    {
       $html.='<tr>
       <td style="border:1px solid black;"  colspan="4">'.$clog['EID'].'</td>
       <td style="border:1px solid black;">'.$clog['eq_name'].'</td>
       <td style="border:1px solid black;">'.$clog['vendorname'].'</td>
       <td style="border:1px solid black;">'.$clog['NATURE_OF_COMP'].'</td>
       <td style="border:1px solid black;"colspan="2"">'.$clog['CDATE'].','.$clog['CTIME'].'</td>
       <td style="border:1px solid black;">'.$clog['CALLER_NAME'].'</td>
       <td style="border:1px solid black;"colspan="2">'.$clog['RESPONDED_BY_NAME'].'</td>
       <td style="border:1px solid black;">'.$clog['ATTENDEE_NAME'].'</td>
       <td style="border:1px solid black;">'.$clog['ATTENDEE_NAME'].'</td>
       <td style="border:1px solid black;">'.$clog['COST'].'</td>
       <td style="border:1px solid black;" colspan="2">'.$clog['RESPONDED_TIME'].' %</td>
       <td style="border:1px solid black;" colspan="2">'.$clog['JOBCOMPLETED_TIME'].'</td>
    </tr>';
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>