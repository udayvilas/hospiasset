<?php
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Equipments Summary');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                   '.$this->session->org_name, ' BIOMEDICAL ENGINEERING DEPARTMENT                                                                                                                           EQUIPMENTS SUMMARY REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(10);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 9);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage('L', 'A4');
$html='<table cellspacing="0" cellpadding="3" style="width:100%;" border="0">
    <tr>
        <th colspan="10" style="text-align:right;width:100%;">Summary in Lacs</th>
    </tr>
    <tr>
        <th colspan="6" style="border:1px solid black;text-align:center;width:60%;background-color:#f1f1f1">EQUIPMENTS SUMMARY AS OF '.date('m-Y').'</th>
        <th colspan="4" style="border:1px solid black;text-align:center;width:40%;background-color:#f1f1f1">CONTRACTS</th>
    </tr>
    <tr>
        <th style="border:1px solid black;text-align:center;width: 4%;background-color:#f1f1f1">S.No</th>
        <th style="border:1px solid black;text-align:center;width: 21%;background-color:#f1f1f1">Unit</th>
        <th style="border:1px solid black;text-align:center;width: 6%;background-color:#f1f1f1">Eq. Count</th>
        <th style="border:1px solid black;text-align:center;width: 11%;background-color:#f1f1f1">Total value of
Eq&#39;s</th>
        <th style="border:1px solid black;text-align:center;width: 9%;background-color:#f1f1f1">Contracts Count</th>
        <th style="border:1px solid black;text-align:center;width: 9%;background-color:#f1f1f1">Value of Contracts</th>
        <th style="border:1px solid black;text-align:center;width: 11%;background-color:#f1f1f1">Value of Eq&#39;s. Under Contracts</th>
        <th style="border:1px solid black;text-align:center;width: 7%;background-color:#f1f1f1">Number(%)</th>
        <th style="border:1px solid black;text-align:center;width: 7%;background-color:#f1f1f1">T-value(%)</th>
        <th style="border:1px solid black;text-align:center;width: 7%;background-color:#f1f1f1">C-value(%)</th>
        <th style="border:1px solid black;text-align:center;width: 8%;background-color:#f1f1f1">C/T-value(%)</th>
    </tr>';
    $cnt=1;
    foreach($esrp['equpment_summary'] as $esrp1)
    {
        $html .= '<tr>
        <td style="border:1px solid black;width: 4%;background-color:#f1f1f1">'.$cnt++.'</td>
        <td style="border:1px solid black;width: 21%;background-color:#f1f1f1">'.$esrp1['BRANCH_NAME'].'</td>
        <td style="border:1px solid black;width: 6%;">'.$esrp1['no_of_equipment'].'</td>
        <td style="border:1px solid black;width: 11%;">'.$esrp1['value_equipment'].'</td>
        <td style="border:1px solid black;width: 9%;">'.$esrp1['no_of_contracts'].'</td>
        <td style="border:1px solid black;width: 9%;">'.$esrp1['value_contracts'].'</td>
        <td style="border:1px solid black;width: 11%;">'.$esrp1['cec'].'</td>
        <td style="border:1px solid black;width: 7%;">'.$esrp1['NUMBER'].' %</td>
        <td style="border:1px solid black;width: 7%;">'.$esrp1['TVALUE'].' %</td>
        <td style="border:1px solid black;width: 7%;">'.$esrp1['CVALUE'].' %</td>
        <td style="border:1px solid black;width: 8%;">'.$esrp1['CTVALUE'].' %</td>
        </tr>';
    }

    $html.='<tr>
        <th style="border:1px solid black;width: 4%;background-color:#f1f1f1"></th>
        <th style="border:1px solid black;width: 21%;font-weight:bold;background-color:#f1f1f1">Total</th>
        <th style="border:1px solid black;width: 6%;font-weight:bold;background-color:#f1f1f1">'.$esrp['no_eqp_total'].'</th>
        <th style="border:1px solid black;width: 11%;font-weight:bold;background-color:#f1f1f1">'.$esrp['no_equp_value_total'].'</th>
        <th style="border:1px solid black;width: 9%;font-weight:bold;background-color:#f1f1f1">'.$esrp['no_contract_total'].'</th>
        <th style="border:1px solid black;width: 9%;font-weight:bold;background-color:#f1f1f1">'.$esrp['no_cont_value_total'].'</th>
        <th style="border:1px solid black;width: 11%;font-weight:bold;background-color:#f1f1f1">'.$esrp['no_valueeq_unser_contract_total'].'</th>
        <th style="border:1px solid black;width: 7%;font-weight:bold;background-color:#f1f1f1">'.$esrp['number_total'].' %</th>
        <th style="border:1px solid black;width: 7%;font-weight:bold;background-color:#f1f1f1">'.$esrp['tvalue_total'].' %</th>
        <th style="border:1px solid black;width: 7%;font-weight:bold;background-color:#f1f1f1">'.$esrp['cvalue_total'].' %</th>
        <th style="border:1px solid black;width: 8%;font-weight:bold;background-color:#f1f1f1">'.$esrp['ctvalue_total'].' %</th>
    </tr>
    <tr>
        <td colspan="10" style="width:100%;"><b>NOTE</b></td>
    </tr>
    <tr><td style="width:100%;" colspan="10">NUMBER% - Number of equipments under contract-out of total number of equipments.</td></tr>
    <tr><td style="width:100%;" colspan="10">T-VALUE% - Total contract value over the total value of equipment in the unit.</td></tr>
    <tr><td style="width:100%;" colspan="10">C-VALUE% - Total contract value over the total value of equipment that are under contract only.</td></tr>
    <tr><td style="width:100%;" colspan="10">C/T-VALUE% - Total value of contract equipments over the total assets value in the unit.</td></tr>
    <tr><td style="width:100%;" colspan="10">CONT:COUNT - Total contract equipment count under the contract only.</td></tr>';
    $html.='</table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();

?>