<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Indent Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                              INDENT REPORT', array(0,64,55), array(0,64,128));
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
                <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Date</th>
                <td style="border:1px solid black;width:35%;">'.date('d-m-Y').'</td>
                <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Time</th>
                <td style="border:1px solid black;width:35%;">'.date('h:i A').'</td>
            </tr>
           <tr>
            <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Branch</th>
                <td style="border:1px solid black;width:35%;">'.$indent->branch_name.'</td>
                <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Department</th>
                <td style="border:1px solid black;width:35%;">'.$indent->DEPT.'</td>

            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Equipment Name</th>
                <td style="border:1px solid black;width:75%;">'.$indent->EQ_NAME.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Quantity</th>
                <td style="border:1px solid black;width:75%;">'.$indent->QTY.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Equipment Category</th>
                <td style="border:1px solid black;width:75%;">'.$indent->EQ_CAT.'</td>
            </tr>
            <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1"> Brief Description</th>
                <td style="border:1px solid black;width:75%;">'.$indent->DESCRP.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Basic / Essential Features</th>
                <td style="border:1px solid black;width:75%;">'.$indent->ESNTL_FEATURES.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Optimal /Desirous Features</th>
                <td style="border:1px solid black;width:75%;">'.$indent->OPTIMAL_FEATURES.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Optimal /Luxurious Features</th>
                <td style="border:1px solid black;width:75%;">'.$indent->OPTIONAL_FEATURES.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Standard Accessories</th>
                <td style="border:1px solid black;width:75%;">'.$indent->STNRD_ACCESSORIES.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Optional Accessories</th>
                <td style="border:1px solid black;width:75%;">'.$indent->OPTIONAL_ACCESSORIES.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Contract Vendor </th>
                <td style="border:1px solid black;width:75%;">'.$indent->EQ_CAT.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Reasons </th>
                <td style="border:1px solid black;width:75%;">'.$indent->EQ_CAT.'</td>
            </tr>
            <tr>
                <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Estimated Cost </th>
                <td style="border:1px solid black;width:75%;">'.$indent->ESTIMATED_COST.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Approx revenue generation</th>
                <td style="border:1px solid black;width:75%;">'.$indent->REVENEW_GENERATION.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Benefits with Desirous Features</th>
                <td style="border:1px solid black;width:75%;">'.$indent->DESIROUS_REVENEW.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Benefits with Luxurious Features</th>
                <td style="border:1px solid black;width:75%;">'.$indent->LUXURY_REVENEW.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Budget approved By</th>
                <td style="border:1px solid black;width:75%;">'.$indent->BUDGET_APPROVED_BY.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Budget reference</th>
                <td style="border:1px solid black;width:75%;">'.$indent->BUDGET_REFF.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Bio-Medical Receipt Date</th>
                <td style="border:1px solid black;width:75%;">'.$indent->BUDGET_APPROVED_DATETIME.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Quotes called for : (2 weeks)</th>
                <td style="border:1px solid black;width:75%;">'.$indent->QUOTES.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">Evaluation period :(4 weeks)</th>
                <td style="border:1px solid black;width:75%;">'.$indent->EVALUATION_PEROID.'</td>
            </tr>
            <tr>
                <th  style="border:1px solid black;width:25%;background-color:#f1f1f1">PO Release Date</th>
                <td style="border:1px solid black;width:75%;">'.$indent->PO_DATE.'</td>
            </tr>
            <tr valign="top">
                <th height="70" style="border:1px solid black;width:25%;background-color:#f1f1f1">Remarks</th>
                <td height="70" style="border:1px solid black;width:75%;">'.$indent->REMARKS.'</td>
            </tr>
            <tr>
                <td style="border:1px solid black;width:100%;">
                *(<b>Add additional sheets whenever required</b>)
                    <br>
                    Note:Please take time odd to fill in this requisition carefully.Every effort will be made to procure the best equipment which meets your requirments add also fulfils the organisation\'s needs of quality,reliability and life-cycle cost.
                </td>
            </tr>
            <tr>
                <td style="border:1px solid black;width:25%">Format No: </td>
                <td style="border:1px solid black;width:75%;"></td>
            </tr>
            <tr>
            <td height="30">
            </td>
            </tr>
            <tr>
                <td style="text-align:left;width:33%">Signature</td>
                <td style="text-align:center;width:33%">Name</td>
                <td style="text-align:right;width:34%">Designation</td>
            </tr>
            <tr>
            <td height="30">
            </td>
            </tr>
            <tr>
                <td style="text-align:left;width:33%">Indented by<br>'.$indent->Indented_By.'</td>
                <td style="text-align:center;width:33%">Approved by<br>'.$indent->Approved_by.'</td>
                <td style="text-align:right;width:34%">Sanctioned by<br>'.$indent->Sanctioned_by.'</td>
            </tr>
    </table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>