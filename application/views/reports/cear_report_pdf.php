<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Cear Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "                  ".$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                              CEAR REPORT', array(0,64,55), array(0,64,128));
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
                 <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Branch</th>
                <td  style="border:1px solid black;width:25%;" >'.$cear->branch_name.'</td>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Department</th>
                <td  style="border:1px solid black;width:25%;">'.$cear->dept_id.'</td>
                </tr>
                <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Cear Number</th>
                    <td  style="border:1px solid black;width:25%;">'.$cear->CEAR_ID.'</td>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Project Number</th>
                    <td  style="border:1px solid black;width:25%;">'.$cear->PROJECT_ID.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Project Title</th>
                    <td  style="border:1px solid black;width:25%;">'.$cear->TITLE.'</td>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Category</th>
                    <td  style="border:1px solid black;width:25%;"></td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Requesting Unit</th>
                    <td  style="border:1px solid black;width:25%;">'.$cear->REQ_UNIT.'</td>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Requesting DEPT</th>
                    <td  style="border:1px solid black;width:25%;">'.$cear->REQ_DEPT.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Scope of the Project</th>
                    <td  style="border:1px solid black;width:75%;">'.$cear->SOP.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Purpose & Justification</th>
                    <td  style="border:1px solid black;width:75%;">'.$cear->PAJ.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Alternatives Considered</th>
                    <td  style="border:1px solid black;width:75%;">'.$cear->AC.'</td>
                </tr>
                <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Consequence of Not Approving Expenditure</th>
                    <td style="border:1px solid black;width:75%;">'.$cear->CONAE.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Effect on Operating Budget / Experts</th>
                    <td  style="border:1px solid black;width:75%;">'.$cear->EOOBE.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Equipment Purchage</th>
                    <td style="border:1px solid black;width:75%;">'.$cear->EP.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Start Date</th>
                    <td style="border:1px solid black;width:25%;">'.$cear->DATE.'</td>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Start Time</th>
                    <td  style="border:1px solid black;width:25%;">'.$cear->CDATE.'</td>
                </tr>
                <tr valign="top">
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Finacial Justification</th>
                    <td  style="border:1px solid black;width:75%;">
                        <span>Project Profit & Loss Statement</span><br>
                        <span>Project Cash Flow Statement</span><br>
                        <span>Finding Options and Impact on Balance Sheet</span><br>
                        <span>Payback Period</span><br>
                        <span>Return on Investment / IRR</span><br>
                    </td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Details Finacial Attached </th>
                    <td  style="border:1px solid black;width:75%;">'.$cear->DFATTACHED.'</td>

                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Conclusion</th>
                    <td  style="border:1px solid black;width:75%;">'.$cear->CONSLUSION.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Cost Centered to be Charged</th>
                    <td  style="border:1px solid black;width:75%;">'.$cear->COST.'</td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Cost Estimate</th>
                    <td  style="border:1px solid black;width:75%;"></td>
                </tr>
                <tr>
                    <th  style="border:1px solid black;width:100%;text-align:center;background-color:#f1f1f1"> Authorization</th>
                </tr>
                <tr>

                    <th style="border:1px solid black;width:33%;background-color:#f1f1f1">Bio Medical Manager</th>
                    <th style="border:1px solid black;width:33%;background-color:#f1f1f1">Signature</th>
                    <th style="border:1px solid black;width:34%;background-color:#f1f1f1">Date</th>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">CHARGES</th>
                    <td  style="border:1px solid black;width:75%;"></td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Medical Director</th>
                    <td  style="border:1px solid black;width:75%;"></td>
                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">FUNCTIONAL Head / COO</th>
                    <td  style="border:1px solid black;width:75%;"></td>

                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">CEO</th>
                    <td  style="border:1px solid black;width:75%;"></td>

                </tr>
                <tr>
                    <th style="border:1px solid black;width:25%;background-color:#f1f1f1">CMD</th>
                    <td  style="border:1px solid black;width:75%;"></td>

                </tr>
    </table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>