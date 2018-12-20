<?php
$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('SC Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                             Scheduled Calls REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage("P","A4");
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
              <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Date</th>
                <td style="border:1px solid black;width:25%;">'.date('d-m-Y').'</td>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Time</th>
                <td style="border:1px solid black;width:25%;">'.date('h:i A').'</td>
            </tr>
                <tr>
                 <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Branch</th>
                <td  style="border:1px solid black;width:25%;" >'.$scr->branch_name.'</td>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Department</th>
                <td  style="border:1px solid black;width:25%;">'.$scr->department.'</td>
                </tr>
                <tr>
               <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Eq. Id</th>
                    <td  style="border:1px solid black;width:75%;">'.$scr->EID.'</td>
                </tr>
                    <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Eq.Name</th>
                    <td  style="border:1px solid black;width:75%;">'.$scr->equp_name.'</td>
                </tr>

                 <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Assigned By</th>
                    <td  style="border:1px solid black;width:75%;">'.$scr->Attended_by.'</td>
                   </tr>

                   <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Completed  By</th>
                    <td  style="border:1px solid black;width:75%;">'.$scr->completed_by.'</td>
                    </tr>

    </table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>