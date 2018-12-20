<?php
//print_r($tnscs);
//die();
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('NSC Report PDf');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'CMS REPORT', array(0,64,55), array(0,64,128));
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
        <th style="border:1px solid black;width:4%;">Dept.</th>
        <th style="border:1px solid black;width:10%;">Serial No.</th>
        <th style="border:1px solid black;width:44%;">Additional Details</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($tnscs as $tnsc)
    {
        $attended_date = $tnsc[$this->cms->ATTENDED_DATE]!=NULL ? date("d-m-Y h:i A",strtotime($tnsc["ATTENDED_DATE"]." ".$tnsc["ATTENDED_TIME"])) : "";
        $responded_date = $tnsc[$this->cms->RESPONDED_DATE]!=NULL ? date("d-m-Y h:i A",strtotime($tnsc["RESPONDED_DATE"]." ".$tnsc["RESPONDED_TIME"])) : "";
        $jobcompleted_date = $tnsc[$this->cms->JOBCOMPLETED_DATE]!=NULL ? date("d-m-Y h:i A",strtotime($tnsc["JOBCOMPLETED_DATE"]." ".$tnsc["JOBCOMPLETED_TIME"])) : "";
        $jobcompleted_by = $tnsc[$this->cms->JOBCOMPLETED_DATE]!=NULL ? $tnsc["Attended_by"] : "";
        $small_table = '<table cellpadding="2">
    <tr>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">Task</td>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">Name</td>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">Date</td>
        <td style="border-bottom:1px solid black;">Reason</td>
    </tr>
    <tr>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">Raised</td>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">'.$tnsc["CALLER_NAME"].'</td>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">'.date("d-m-Y h:i A",strtotime($tnsc["CDATE"]." ".$tnsc["CTIME"])).'</td>
        <td style="border-bottom:1px solid black;">'.$tnsc["NATURE_OF_COMP"].'</td>
    </tr>
    <tr>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">Responded</td>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">'.$tnsc["Responded_by"].'</td>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">'.$responded_date.'</td>
        <td style="border-bottom:1px solid black;"></td>
    </tr>
    <tr>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">Attended</td>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">'.$tnsc["Attended_by"].'</td>
        <td style="border-bottom:1px solid black;border-right:1px solid black;">'.$attended_date.'</td>
        <td style="border-bottom:1px solid black;"></td>
    </tr>';
        if($tnsc["PENDING_REASON"]!=NULL)
        {
            $small_table .= '<tr>
            <td style="border-bottom:1px solid black;border-right:1px solid black;">Pending</td>
            <td style="border-bottom:1px solid black;border-right:1px solid black;">'.$tnsc["Attended_by"].'</td>
            <td style="border-bottom:1px solid black;border-right:1px solid black;">'.date("d-m-Y h:i A",strtotime($tnsc["ATTENDED_DATE"]." ".$tnsc["ATTENDED_TIME"])).'</td>
            <td style="border-bottom:1px solid black;"></td>
            </tr>';
        }
        $small_table .= '<tr>
        <td style="border-right:1px solid black;">Completed</td>
        <td style="border-right:1px solid black;">'.$jobcompleted_by.'</td>
        <td style="border-right:1px solid black;">'.$jobcompleted_date.'</td>
        <td></td>';
        $small_table .= '</tr></table>';
        $html.='<tr>
        <td style="border:1px solid black;width:2%;">'.$i.'</td>
        <td style="border:1px solid black;width:20%;">'.$tnsc[$this->cms->EID].'</td>
        <td style="border:1px solid black;width:20%;">'.$tnsc["equp_name"].'</td>
        <td style="border:1px solid black;width:4%;">'.$tnsc["CALLER_DEPT"].'</td>
        <td style="border:1px solid black;width:10%;">'.$tnsc["serial_number"].'</td>
        <td style="border:1px solid black;width:44%;">'.$small_table.'</td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>