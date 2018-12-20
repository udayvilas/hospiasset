<?php
//print_r($tgatepass);
//die();
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('GatePass PDf');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'GATEPASS REPORT', array(0,64,55), array(0,64,128));
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
        <th style="border:1px solid black;width:8%;">Hospital</th>
        <th style="border:1px solid black;width:9%;">Branch</th>
        <th style="border:1px solid black;width:5%;">Dept</th>
        <th style="border:1px solid black;width:10%;">GP No.</th>
        <th style="border:1px solid black;width:10%;">Return Type</th>
        <th style="border:1px solid black;width:10%;">Return Due Dt</th>
        <th style="border:1px solid black;width:10%;">Name of the Party</th>
        <th style="border:1px solid black;width:36%;">Additional Details</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
        foreach($gate_pass_news as $tgatepas)
        {
           if($tgatepas["EXPECTED_RETURN"]!=NULL || $tgatepas["EXPECTED_RETURN"]!="")
		    $expected_return = date('Y-m-d',strtotime($tgatepas["EXPECTED_RETURN"]));
	   else
		    $expected_return = "-";


		   $small_table = '<table>
    <tr>
       <th style="border-bottom:1px solid black;border-right:1px solid black;width:70%">Material Description </th><th style="border-bottom:1px solid black;width:30%"> Quantity</th>
    </tr>
    <tr>
        <td style="width:30%;border-bottom:1px solid black;border-right:1px solid black;">Accessories:</td>
        <td style="width:40%;border-bottom:1px solid black;">';
            foreach($gate_pass_news['accesses'] as $accesses)
            {
                $small_table.='&nbsp;'.$accesses.'<br>';
            }
         $small_table.='</td>

        <td style="width:30%;border-left:1px solid black;border-bottom: 1px solid black;"> ' . $tgatepas["ACCESSORIES_CNT"] . '</td>
    </tr>
     <tr>
        <td style="width:30%;border-right:1px solid black;">Critical Spares:</td>
       <td style="width:40%;">';
            foreach($gate_pass_news['cspares'] as $csparess)
            {
                $small_table.='&nbsp;'.$csparess.'<br>';
            }
         $small_table.='</td>

        <td style="width:40%;border-left:1px solid black;"> ' . $tgatepas['SPARES_CNT'] . '</td>
    </tr>
  </table>';
        $html.='
<tr>
        <td style="border:1px solid black;width:2%;">'.$i.'</td>
        <td style="border:1px solid black;width:8%;">'.$this->session->org_name.'</td>
        <td style="border:1px solid black;width:9%;">'.$tgatepas["branch_name"].'</td>
        <td style="border:1px solid black;width:5%;">'.$tgatepas["DEPT_ID"].'</td>
        <td style="border:1px solid black;width:10%;">'.$tgatepas["GP_ID"].'</td>
        <td style="border:1px solid black;width:10%;">'.$tgatepas["RETURN_TYPE"].'</td>
	   <td style="border:1px solid black;width:10%;">'.$expected_return.'</td>
        <td style="border:1px solid black;width:10%;">'.$tgatepas["TO_WHOME"].'</td>
        <td style="border:1px solid black;width:36%;">'.$small_table.'</td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>