<?php
$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('NSC Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                             Non Scheduled Calls REPORT', array(0,64,55), array(0,64,128));
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
                <td  style="border:1px solid black;width:25%;" >'.$nscr->branch_name.'</td>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Department</th>
                <td  style="border:1px solid black;width:25%;">'.$nscr->department.'</td>
                </tr>
                <tr>
               <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Eq. Id</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->EID.'</td>
                </tr>
                    <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Eq.Name</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->equp_name.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Serial no</th>
                    <td  style="border:1px solid black;width:25%;">'.$nscr->serial_number.'</td>
                     <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Down Time</th>
                     <td  style="border:1px solid black;width:25%;">'.$nscr->DOWN_TIME.'</td>
                </tr>

              <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Raised By</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->CALLER_NAME.'</td>
                    </tr><tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Raised Date & Time</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->CDATE.'.'.$nscr->CTIME.'</td>
                </tr>
                 <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Raised Reason</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->NATURE_OF_COMP.'</td>

                </tr>
                 <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Assigned By</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->Attended_by.'</td>
                    </tr><tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Attended Date & Time</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->ATTENDED_DATE.'.'.$nscr->ATTENDED_TIME.'</td>
                </tr>
                 <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Pending By</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->Attended_by.'</td>
                    </tr><tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Pending Reasons</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->PENDING_REASON.'</td>
                </tr>
                 <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Responded By</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->Responded_by.'</td>
                    </tr><tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Responded Date & Time</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->RESPONDED_DATE.'.'.$nscr->RESPONDED_TIME.'</td>
                </tr>

                   <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Completed  By</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->Attended_by.'</td>
                    </tr>
                    <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Completed Date&Time</th>
                    <td  style="border:1px solid black;width:75%;">'.$nscr->JOBCOMPLETED_DATE.'.'.$nscr->JOBCOMPLETED_TIME.' </td>
                </tr>

    </table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>