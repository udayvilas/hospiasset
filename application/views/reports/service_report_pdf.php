<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Services Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                              SERVICE REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage('L','A4');
$work_hours = '<table  cellspacing="0" style="width:100%;" cellpadding="2">
<tr><td style="width:4%"></td><td style="border:1px solid black;width:28%;"></td>
<td style="width:70%;">Work Hours</td></tr>
</table>';


$minutes = '<table  cellspacing="0" style="width:100%;" cellpadding="2">
<tr><td style="width:4%"></td><td style="border:1px solid black;width:28%;"></td><td style="width:70%;">Minutes</td></tr></table>';

$job_completed = '<table  cellspacing="0" style="width:100%;" border="0" cellpadding="2"><tr><td style="border:0px solid black;width:30%;"></td><td style="width:70%;">Job Completed</td></tr></table>';

$job_pending = '<table  cellspacing="0" style="width:100%;" cellpadding="2"><tr><td style="border:1px solid black;width:30%;"></td><td style="width:70%;">Job Pending</td></tr></table>';

$cmc = '<table  cellspacing="0" style="width:100%;" cellpadding="2"><tr><td style="border:1px solid black;width:30%;"></td><td style="width:70%;">CMC</td></tr></table>';

$amc = '<table cellspacing="0" style="width:100%;" cellpadding="2"><tr><td style="border:1px solid black;width:30%;"></td><td style="width:70%;">AMC</td></tr></table>';
$no_con = '<table  cellspacing="0" style="width:100%;" cellpadding="2"><tr><td style="border:1px solid black;width:30%;"></td><td style="width:70%;">No Contract</td></tr></table>';
$hours_table = '<table cellspacing="0" style="width:100%;" cellpadding="2" border="0">
                <tr>
                    <td style="border-bottom:1px solid black;width:100%;">
                    '.$job_completed.'</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid black;width:100%;" height="5">
                    '.$job_pending.'</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid black;width:100%;">
                    '.$amc.'</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid black;width:100%;">
                    '.$cmc.'</td>
                </tr>
                <tr>
                    <td style="width:100%;padding-left:0px;">
                    '.$no_con.'</td>
                </tr>
                </table>';
$materials_table = '<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
                <tr>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:15%;background-color:#f1f1f1;">NO</td>
                    <th style="border-right:1px solid black;border-bottom:1px solid black;width:35%;background-color:#f1f1f1;">Materials Used</th>
                    <th style="border-right:1px solid black;border-bottom:1px solid black;width:15%;background-color:#f1f1f1;">Quality</th>
                    <th style="border-bottom:1px solid black;width:35%;background-color:#f1f1f1;">Document References</th>
                </tr>
                <tr>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:15%;"></td>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:35%;"></td>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:15%;"></td>
                    <td style="border-bottom:1px solid black;width:35%;"></td>
                </tr>
                <tr>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:15%;"></td>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:35%;"></td>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:15%;"></td>
                    <td style="border-bottom:1px solid black;width:35%;"></td>
                </tr>
                <tr>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:15%;"></td>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:35%;"></td>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:15%;"></td>
                    <td style="border-bottom:1px solid black;width:35%;"></td>
                </tr>
                <tr>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:15%;"></td>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:35%;"></td>
                    <td style="border-right:1px solid black;border-bottom:1px solid black;width:15%;"></td>
                    <td style="border-bottom:1px solid black;width:35%;"></td>
                </tr>
        </table>';
$html='<table cellspacing="0" cellpadding="2" style="width:100%;" border="0">
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Date</th>
        <td style="border:1px solid black;width:35%;">'.date('d-m-Y').'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Time</th>
        <td style="border:1px solid black;width:35%;">'.date('h:i A').'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Branch</th>
        <td style="border:1px solid black;width:35%;">'.$ser->branchname.'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Dept</th>
        <td style="border:1px solid black;width:35%;">'.$ser->DEPT_ID.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Eq. Name</th>
        <td style="border:1px solid black;width:35%;">'.$ser->E_NAME.'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Eq. ID</th>
        <td style="border:1px solid black;width:35%;">'.$ser->E_ID.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1;">Make/Model</th>
        <td style="border:1px solid black;width:35%;">'.$ser->E_MODEL.'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Serial No.</th>
        <td style="border:1px solid black;width:35%;">'.$ser->ES_NUMBER.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:10%;background-color:#f1f1f1;">Eq. Location</th>
        <td style="border:1px solid black;width:10%;">'.$ser->PHY_LOCATION.'</td>
        <th style="border:1px solid black;width:10%;background-color:#f1f1f1;">CALL DATE</th>
        <td style="border:1px solid black;width:10%;">'.(($ser->cdate != '') ? date('d-m-Y',strtotime($ser->cdate)) : '').'</td>
        <th style="border:1px solid black;width:10%;background-color:#f1f1f1;">CALL TIME</th>
        <td style="border:1px solid black;width:10%;">'.date('h:i A',strtotime($ser->ctime)).'</td>
        <th style="border:1px solid black;width:10%;background-color:#f1f1f1;">JOB COMPLETED DATE</th>
        <td style="border:1px solid black;width:10%;">'.(($ser->cms->JOBCOMPLETED_DATE != '') ? date('d-m-Y',strtotime($ser->cms->JOBCOMPLETED_DATE)): '').'</td>
        <th style="border:1px solid black;width:10%;background-color:#f1f1f1;">TIME</th>
        <td style="border:1px solid black;width:10%;">'.date('h:i A',strtotime($ser->JOBCOMPLETED_TIME)).'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1;">Fault Reported</th>
        <td style="border:1px solid black;width:85%;"></td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;"></td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1;">Engineers Observations</th>
        <td style="border:1px solid black;width:85%;"></td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;"></td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1;">Diagnosis</th>
        <td style="border:1px solid black;width:85%;"></td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;"></td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1;">Work Done</th>
        <td style="border:1px solid black;width:85%;"></td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;"></td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:80%;background-color:#f1f1f1;">Remarks '.$ser->REMARKS.'</th>
        <td style="border:1px solid black;width:20%;">'.$work_hours.'</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:80%;"></td>
        <td style="border:1px solid black;width:20%">'.$minutes.'</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:80%;">'.$materials_table.'</td>
        <td style="border:1px solid black;width:20%;">'.$hours_table.'</td>
    </tr>
    <tr>
    <td height="45" style="width:100%"></td>
    </tr>
    <tr>
        <th style="width:34%;">Dept in-charge Signature</th>

        <th style="width:33%;text-align:center">Engineer Name</th>

        <th style="width:33%;text-align:right">Engineer Signature</th>

    </tr></table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output();
?>