<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Deployement Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                              DEPLOYEMENT REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage();
$supplier = '<table cellspacing="0" style="width:100%;" cellpadding="0">
<tr>
<th style="border-right:1px solid black;width:25%;background-color:#f1f1f1">Name</th>
<td style="width:25%;border-right:1px solid black;">'.$deployement_data->suppliername.'</td>
<th style="border-right:1px solid black;width:25%;background-color:#f1f1f1">Contact No</th>
<td style="width:25%;">
'.$deployement_data->suppliercontact_no.'
</td>
</tr>
<tr>
<th style="border-right:1px solid black;border-top:1px solid black;width:25%;background-color:#f1f1f1">Address</th>
<td style="width:75%;border-top:1px solid black;">'.$deployement_data->supplieraddress.'</td>
</tr>
</table>';
$service_provider= '<table cellspacing="0" style="width:100%;" cellpadding="0">
<tr>
<th style="border-right:1px solid black;width:25%;background-color:#f1f1f1">Name</th>
<td style="border-right:1px solid black;width:25%;">'.$deployement_data->vendorname.'</td>
<th style="border-right:1px solid black;width:25%;background-color:#f1f1f1">Contact No</th>
<td style="width:25%;">
'.$deployement_data->vendorcontact_no.'
</td>
</tr>
<tr>
<th style="border-right:1px solid black;border-top:1px solid black;width:25%;background-color:#f1f1f1">Address</th>
<td style="width:75%;border-top:1px solid black;">'.$deployement_data->vendoraddress.'</td>
</tr>
</table>';
$dc_no= '<table cellspacing="0" style="width:100%;" cellpadding="0">
<tr>
<td style="border-right:1px solid black;width:15%;"></td>
<th style="border-right:1px solid black;width:15%;background-color:#f1f1f1">Date</th>
<td style="border-right:1px solid black;width:15%;"></td>
<th style="border-right:1px solid black;width:15%;background-color:#f1f1f1">Invoice No</th>
<td style="border-right;1px solid black;width:15%;"></td>
<th style="border-right:1px solid black;width:15%;background-color:#f1f1f1">Date</th><td style="width:10%;">
</td>
</tr>
</table>';
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
              <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Date</th>
                <td style="border:1px solid black;width:25%;">'.date('d-m-Y').'</td>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Time</th>
                <td style="border:1px solid black;width:25%;">'.date('h:i A').'</td>
             </tr>
            <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Department</th>
                <td style="border:1px solid black;width:25%;">'.$deployement_data->DEPT_ID.'</td>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Branch</th>
                <td style="border:1px solid black;width:25%;">'.$deployement_data->branchname.'</td>
             </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Ref.Indent No.and Date</th>
            <td style="border:1px solid black;width:25%;"></td>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Indented Item</th>
            <td style="border:1px solid black;width:25%;"></td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Name of the Equipment</th>
            <td style="border:1px solid black;width:75%;">'.$deployement_data->E_NAME.' </td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> OEM / Make Company</th>
            <td style="border:1px solid black;width:75%;">'.$deployement_data->C_NAME.' </td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Model No.</th>
            <td style="border:1px solid black;width:25%;">'.$deployement_data->E_MODEL.'</td>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">S.No.</th>
            <td style="border:1px solid black;width:25%;">'.$deployement_data->ES_NUMBER.'</td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">List Of Accessories(With SI.No.s if any)</th>
            <td style="border:1px solid black;width:75%;"> '.$deployement_data->ACCSSORIES.'</td>
        </tr>
        <tr>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">List of Consumables For First time use:</th>
        <td style="border:1px solid black;width:75%;"> '.$deployement_data->ACCSSORIES.'</td>
        </tr>
        <tr>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Remarks / comments of users: </th>
        <td style="border:1px solid black;width:75%;"></td>
        </tr>
          <tr>
        <td height="40" style="border-left:1px solid black;border-top:1px solid black;border-right:1px solid black;width:100%"></td>
        </tr>
         <tr valign="bottom">
            <th style="width:50%;text-align:left;border-left:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Handed over By <br>(Name & Signature of BME)</th>
            <th style="width:50%;text-align:right;border-right:1px solid black;">Handed over to&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>(Name & Signature of the user)</th>
        </tr>
        <tr>
        <td height="40" style="border-left:1px solid black;border-top:1px solid black;border-right:1px solid black;width:100%"></td>
        </tr>
        <tr valign="bottom">
            <th style="width:50%;text-align:left;border-left:1px solid black;">Name & Signature of the HOD</th>
            <th style="width:50%;text-align:right;border-right:1px solid black;">Name & Signature of the Hospital Administrator</th>
        </tr>

        <tr>
        <th style="border:1px solid black;width:100%;text-align:center">(For Biomedical Use)</th>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Equp.Id(Allotted by BME)</th>
            <td  style="border:1px solid black;width:25%;">'.$deployement_data->E_ID.'</td>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Ref.P.O.No & Date:</th>
            <td  style="border:1px solid black;width:25%;"> '.$deployement_data->PONO.'<br>'.$deployement_data->PDATE.'</td>
        </tr>
        <tr>
        <th style="border:1px solid black;width:100%;text-align:center">Contract Information</th>
        </tr>
        <tr>
            <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">
                Supplier
            </th>
            <td style="border:1px solid black;width:75%;" >
               '.$supplier.'
            </td>

        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">
                Service Provider
            </th>
          <td style="border:1px solid black;width:75%;" >
               '.$service_provider.'
            </td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">
                DC No
            </th>
          <td style="border:1px solid black;width:75%;" >
               '.$dc_no.'
            </td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Short Shipments if any</th>
            <td style="border:1px solid black;width:75%;"></td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">List of accessories,which can<br>
                Be used by BME Dept.only
            </th>
            <td style="border:1px solid black;width:75%;">
                '.$deployement_data->ACCSSORIES.'
            </td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Date of Installation</th>
            <td style="border:1px solid black;width:25%;"></td>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Installed by(Service Engr)</th>
            <td style="border:1px solid black;width:25%;"></td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Warranty starts from</th>
            <td style="border:1px solid black;width:25%;"></td>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Expires on</th>
            <td style="border:1px solid black;width:25%;"></td>
        </tr>
        <tr>
            <th style="border:1px solid black;width:25%;background-color:#f1f1f1">
                Remarks / comments if any
            </th>
            <td style="border:1px solid black;width:75%;">'.$deployement_data->REMARKS.'</td>
        </tr>
         <tr>
        <td height="40" style="border-left:1px solid black;border-top:1px solid black;border-right:1px solid black;width:100%"></td>
        </tr>
        <tr  valign="bottom">
        <th  style="border-left:1px solid black;border-bottom:1px solid black;width:50%;">(Name & Signature of the BME)</th>
        <th style="border-right:1px solid black;border-bottom:1px solid black;width:50%;text-align:right">(Signature of Bio-Medical Dept.In-Charge </th>
        </tr>

    </table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>