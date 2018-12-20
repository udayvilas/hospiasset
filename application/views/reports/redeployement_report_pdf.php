<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Redeployement Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                              REDEPLOYEMENT REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage();
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
              <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Date</th>
                <td style="border:1px solid black;width:25%;">'.date('d-m-Y').'</td>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Time</th>
                <td style="border:1px solid black;width:25%;">'.date('h:i A').'</td>
             </tr>
             <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Department</th>
                <td  style="border:1px solid black;width:25%;">'.$redeployement_data->DEPT_ID.'</td>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Branch</th>
                <td  style="border:1px solid black;width:25%;">'.$redeployement_data->branchname.'</td>
            </tr>
                <tr>
                    <td style="border:1px solid black;width:100%;text-align:right">Returnable/non-Returnable</td>
                </tr>
                    <tr>
                        <th style="border:1px solid black;width:50%;background-color:#f1f1f1; text-align:left">FM : The office of the CHA / Medical Director</th>
                        <th style="border:1px solid black;width:50%;background-color:#f1f1f1; text-align:right">TO : Biomedical Engineering Department</th>
                    </tr>
                        <tr>
                        <td style="border:1px solid black;width:100%;">Kindly shift the equipment for temporary / routine / urgent requirement as described below.I have  already got the consent of the departments concerned.(Inter hospital shifting will require the consent of both HA\'s and may be ordered only by the Medical Director.)</td>
                        </tr>
                    <tr>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Desired to be done in</th>
                        <td style="border:1px solid black;width:25%;"></td>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">hrs./days or before</th>
                        <td style="border:1px solid black;width:25%;">(date)</td>
                    </tr>
                    <tr>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">From (Location & Dept.)</th>
                        <td style="border:1px solid black;width:25%;"></td>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Contact person & Name</th>
                        <td style="border:1px solid black;width:25%;"></td>
                    </tr>
                    <tr>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">to (Location & Dept.)</th>
                        <td style="border:1px solid black;width:25%;"></td>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Contact person & Name</th>
                        <td style="border:1px solid black;width:25%;"></td>
                    </tr>
                    <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Name & Description of the Equipment</th>
                        <td style="border:1px solid black;width:25%;"></td>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Qty</th>
                        <td style="border:1px solid black;width:25%;"></td>
                    </tr>
                    <tr>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Expected Date of Return</th>
                        <td style="border:1px solid black;width:25%;"></td>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Purpose of Shifting</th>
                        <td style="border:1px solid black;width:25%;"></td>
                    </tr>
                   <tr valign="bottom">
                        <td height="50" style="border:1px solid black;width:33%;text-align:left">
                     Name & Signature of the <br>
                        HA/Medical Director / MOD
                        </td>
                        <td height="50" style="border:1px solid black;width:33%;height:50px;text-align:center">

                                Name & Signature of the HOD
                                <br>Originating Department / HA
                        </td>
                        <td height="50" style="border:1px solid black;width:34%;height:50px;text-align:right">

                                Name & Signature of the HOD
                                <br> User Department / HA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </td>
                    </tr>
                     <tr>
                    <td style="border:1px solid black;width:100%;background-color:#f1f1f1;text-align:center">(For Biomedical Use)</td>
                    </tr>
                    <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1;"> Requisition received date and time</th>
                        <td style="border:1px solid black;width:75%;"></td>
                    </tr>
                    <tr>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1;"> Equipment ID</th>
                        <td style="border:1px solid black;width:75%;"></td>
                    </tr>
                    <tr>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1;"> Details of the Equipment
                        <br>(EqID,Model & S.no.etc)</th>
                        <td style="border:1px solid black;width:75%;"></td>
                    </tr>
                    <tr>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1;">List of Accessories</th>
                        <td style="border:1px solid black;width:75%;"></td>
                    </tr>
                    <tr>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1;">
                            For BME (Engineers responsible)Names
                        </th>
                        <td style="border:1px solid black;width:25%;"></td>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1;">Gate pass (out/in)</th>
                        <td style="border:1px solid black;width:25%;"></td>
                    </tr>
                    <tr>
                       <th style="border:1px solid black;width:25%;background-color:#f1f1f1;">Transfer Completed (Date & Time)</th>
                        <td style="border:1px solid black;width:25%;"></td>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1;">Gate pass (out/in)</th>
                        <td style="border:1px solid black;width:25%;"></td>
                    </tr>
                    <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1;"> Equipment returned on (Date and Time)</th>
                    <td style="border:1px solid black;width:75%;"></td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black;width:100%;text-align:center"> (Return Acknowledgement - In case it is on Returnable Basis)</td>
                    </tr>
                    <tr>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1;">Equipment Return Acknowledgement by (User Department) </th>
                        <td style="border:1px solid black;width:25%;"></td>
                        <th style="border:1px solid black;width:25%;background-color:#f1f1f1;">Remarks</th>
                        <td style="border:1px solid black;width:25%;"></td>
                    </tr>
                    <tr valign="bottom">
                <td height="70" style="border:1px solid black;width:50%;background-color:#f1f1f1;text-align:left"> Signature</td>
                <td  height="70" style="border:1px solid black;width:50%;background-color:#f1f1f1;text-align:right">  Date and Time
                        </td>

                    </tr>
                    <tr>
                        <td style="border:1px solid black;width:50%;">Format NO : </td>
                        <td style="border:1px solid black;width:50%;"> BMF13A</td>
                    </tr>


    </table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>