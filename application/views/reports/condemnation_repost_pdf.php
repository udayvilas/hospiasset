<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Condemnation Report');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'CONDEMNATION REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage();
$html ='<h3 style="font-weight:700;text-align: center;">
<center>MEDICAL EQUIPMENT DISPOSAL REQUISITION REPORT</center>
</h3>';
$html.='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Date</th>
        <td style="border:1px solid black;width:35%;"> '.$cr['date'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Time</th>
        <td style="border:1px solid black;width:35%;">'.$cr['time'].'</td>
    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Branch</th>
        <td style="border:1px solid black;width:35%;">'.$cr['branchname'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Department</th>
        <td style="border:1px solid black;width:35%;">'.$cr['department'].'</td>
    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">From</th>
        <td style="border:1px solid black;width:35%;">HOSPITAL ADMINISTRATION</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">To</th>
        <td style="border:1px solid black;width:35%;">BIOMEDICAL ENGINEERING</td>
    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Eq. Name</th>
        <td style="border:1px solid black;width:85%;">'.$cr['equp_name'].'</td>
    </tr>
    <tr>

        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Eq. ID</th>
        <td style="border:1px solid black;width:35%;">'.$cr['EQUP_ID'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Model</th>
        <td style="border:1px solid black;width:35%;">'.$cr['model'].'</td>

    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">OEM(Make)</th>
        <td style="border:1px solid black;width:85%;">'.$cr['comany_name'].'</td>
    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Sl.No.</th>
        <td style="border:1px solid black;width:18%;">'.$cr['es_number'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Eq.Value</th>
        <td style="border:1px solid black;width:18%;">'.$cr['equp_val'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Yr.of.Purchase</th>
        <td style="border:1px solid black;width:19%;">'.$cr['year_of_purchage'].'</td>
    </tr>
    <tr>
    <td height="15"></td>
    </tr>
    <tr valign="top">
        <td style="width:100%;"><br>The above mentioned equipment is no longer needed in our department due to one or more of the following reasons</td>
    </tr>
    <tr>
    <td style="width:100%;border: 1px solid black;">';
      foreach($cr['reasons'] as $reason)
      {
          $html.= ' &nbsp;'.$reason.'<br>';
      }
  $html.='</td>
    </tr>
   <tr>
       <td style="width:100%;">To the best of our knowledge this equipment does not contain any bio-hazardous material ; nor does it contains any material that is inflammable ,infection,environmentally unsafe,toxic or radioactive.</td>
   </tr>
   <tr>
    <td height="30"></td>
    </tr>
    <tr valign="top">
        <td style="width:100%;">Recommendation if any, on aspects related to hazards to ensure safe disposal:
        </td>
    </tr>
    <tr>
        <td style="width:100%;border: 1px solid black;height: 100px;">'.$cr['FEEDBACK2'].'</td>
    </tr>
    <tr>
    <td height="20"></td>
    </tr>
    <tr valign="top">
        <td style="width:100%;">It is therefore requested to remove the above equipment from our department</td>
    </tr>
    <tr>
    <td height="45"></td>
    </tr>
    <tr valign="top">
        <th style="width:5%;"></th>
        <th style="width:45%;">Head of the Department</th>
        <th style="width:45%;text-align:right">Chief Hospital Administrator</th>
        <th style="width:5%;"></th>
    </tr>
    <tr>
    <td height="45"></td>
    </tr>
    <tr valign="top">
        <th style="width:5%;"></th>
        <th style="width:95%;">Biomedical Receipt Date &amp; Time:<br>EDR No.:<br>Received By:</th>
    </tr>
    </table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->AddPage();
$html='
<h3 style="font-weight:700;text-align: center;">
<center>MEDICAL EQUIPMENT CONDEMNATION CONFIRMATION NOTE</center>
</h3>';
$html.='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
     <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Date</th>
        <td style="border:1px solid black;width:35%;"> '.$cr['date'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Time</th>
        <td style="border:1px solid black;width:35%;">'.$cr['time'].'</td>
    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Branch</th>
        <td style="border:1px solid black;width:35%;">'.$cr['branchname'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Department</th>
        <td style="border:1px solid black;width:35%;">'.$cr['department'].'</td>
    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">From</th>
        <td style="border:1px solid black;width:35%;">HOSPITAL ADMINISTRATION</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">To</th>
        <td style="border:1px solid black;width:35%;">BIOMEDICAL ENGINEERING</td>
    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Eq. Name</th>
        <td style="border:1px solid black;width:85%;">'.$cr['equp_name'].'</td>
    </tr>
    <tr>

        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Eq. ID</th>
        <td style="border:1px solid black;width:35%;">'.$cr['EQUP_ID'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Model</th>
        <td style="border:1px solid black;width:35%;">'.$cr['model'].'</td>

    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">OEM(Make)</th>
        <td style="border:1px solid black;width:85%;">'.$cr['comany_name'].'</td>
    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Sl.No.</th>
        <td style="border:1px solid black;width:18%;">'.$cr['es_number'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Eq.Value</th>
        <td style="border:1px solid black;width:18%;">'.$cr['equp_val'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Yr.of.Purchase</th>
        <td style="border:1px solid black;width:19%;">'.$cr['year_of_purchage'].'</td>
    </tr>
    <tr>
    <td height="15"></td>
    </tr>
    <tr valign="top">
        <th style="width:100%;">REASON(S) FOR CONDEMNATION</th>
    </tr>
    <tr>
    <td style="width:100%;border: 1px solid black;">';
      foreach($cr['reasons'] as $reason)
      {
          $html.= ' &nbsp;'.$reason.'<br>';
      }
  $html.='</td>
    </tr>
    <tr>
    <td height="15"></td>
    </tr>
   <tr valign="top">
       <td style="width:100%;">
           The above mentioned equipment is decommissioned and disposed of from your department with effect from:
       </td>
   </tr>
   <tr>
    <td height="15"></td>
    </tr>
    <tr valign="top">
       <td style="width:100%;"><b>* Note : This from must accompany replacement indent.</b></td>
    </tr>
    <tr>
    <td height="45"></td>
    </tr>
    <tr valign="top">
        <th style="padding-right:15px;width:100%;">
            Unit Head-Biomedical Engineering Dept.<br>
            Name:<br>
            Unit Name:
        </th>
    </tr></table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->AddPage();
$html='
<h3 style="font-weight:700;text-align: center;">
<center>EQUIPMENT CONDEMNATION RECOMMENDATION</center>
</h3>';
$html.='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Date</th>
        <td style="border:1px solid black;width:35%;"> '.$cr['date'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Time</th>
        <td style="border:1px solid black;width:35%;">'.$cr['time'].'</td>
    </tr>
    <tr>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Branch</th>
        <td style="border:1px solid black;width:35%;">'.$cr['branchname'].'</td>
        <th style="background-color:#f1f1f1;border:1px solid black;width:15%;">Department</th>
        <td style="border:1px solid black;width:35%;">'.$cr['department'].'</td>
    </tr>
    <tr height="100" valign="top">
        <td style="border:1px solid black;width:50%;">
            To <b>UNIT FINANCE</b><br>
            UNIT STORES:<br>
            UNIT HOD:<br>
            UNIT CHA:<br>
            UNIT MED DIR:<br>
        </td>
        <td style="border:1px solid black;width:50%;">
            COPIES:CORP BIOMEDICAL:<br>
            CORP FINANCE:<br>
            CORP COO:<br>
        </td>
    </tr>
    <tr>
    <td height="15"></td>
    </tr>
    <tr valign="top">
        <td style="width:100%;">
            The following Biomedical Equipments which is part of the Biomedical Asset List are no longer fit to be used, and need to be removed from the premises after due process.Broadly, the reason for condemnation falls within one or more of the following parameters mentioned below:
            </td>
    </tr>
    <tr>
    <td style="width:100%;border: 1px solid black;">';
      foreach($cr['reasons'] as $reason)
      {
          $html.= ' &nbsp;'.$reason.'<br>';
      }
  $html.='</td>
    </tr>
    <tr>
    <td height="15"></td>
    </tr>
    <tr valign="top">
    <th style="background-color:#f1f1f1;border:1px solid black;width:32%;">Eq.Name</th>
    <th style="background-color:#f1f1f1;border:1px solid black;width:32%;">Eq.ID</th>
    <th style="background-color:#f1f1f1;border:1px solid black;width:8%;">Dept</th>
    <th style="background-color:#f1f1f1;border:1px solid black;width:10%;">Purchase</th>
    <th style="background-color:#f1f1f1;border:1px solid black;width:8%;">Value</th>
    <th style="background-color:#f1f1f1;border:1px solid black;width:10%;">Dt.of Inst.</th>
    </tr>
    <tr>
        <td style="border:1px solid black;width:32%;">'.$cr['equp_name'].'</td>
        <td style="border:1px solid black;width:32%;">'.$cr['EQUP_ID'].'</td>
        <td style="border:1px solid black;width:8%;">'.$cr['DEPT_ID'].'</td>
        <td style="border:1px solid black;width:10%;">'.$cr['year_of_purchage'].'</td>
        <td style="border:1px solid black;width:8%;">'.$cr['equp_val'].'</td>
        <td style="border:1px solid black;width:10%;">'.$cr['year_of_purchage'].'</td>
    </tr>
    <tr>
    <td height="15"></td>
    </tr>
   <tr valign="top">
       <td style="width:100%;">
           Hazardous / polluting parts from the above equipment are segregated , handed over to waste management for safe disposal.
       </td>
   </tr>
   <tr>
    <td height="15"></td>
    </tr>
    <tr valign="top">
       <td style="width:100%;">
           Reusable parts /modules salvaged in spare part store.<br>
           Other unusable parts can be disposed by one of the following methods
       </td>
    </tr>
    <tr>
    <td height="15"></td>
    </tr>
    <tr>
    <td style="width:100%;border:1px solid black;">';
        foreach($cr['reusableparts'] as $reusableparts)
        {
            $html .= $reusableparts.',<br>';
        }
        $html.='</td>
    </tr>
    <tr>
    <td height="15"></td>
    </tr>
    <tr valign="top">
        <th style="width:45%;">Expected Value</th>
        <td style="width:5%;">:</td>
        <th style="width:45%;border-bottom:1px solid black;">'.$cr['EXPECTED_COST'].'</th>
    </tr>
  <tr>
  <tr>
    <td height="15"></td>
    </tr>
<td style="width:100%;">It is therfore requested to remove the above equipment from the biomedical asset list as well as company fixed assets register </td>
  </tr>
    <tr>
    <td height="45"></td>
    </tr>
    <tr height="100" valign="bottom">
        <th style="width:5%;"></th>
        <th style="width:30%;">
            Unit Head-Biomedical Engineering <br>
            Name :<br>
            Unit Name:
        </th>
        <th style="width:30%">
            Unit Head-Finance Department<br>
            Name :<br>
            Unit Name:
        </th>
        <th style="width:5%;"></th>
        <th style="width:30%">General Manager<br>Biomedical Engineering</th>
    </tr>
    </table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>