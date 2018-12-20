<?php
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Equipments List');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, $this->session->branch_name.' Unit Equipments List', array(0,64,55), array(0,64,128));
$pdf->setFooterData(array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('L','A4');
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
	<thead>
    <tr>
        <td style="border:1px solid black;width:5%;">SN</td>
        <td style="border:1px solid black;width:20%;">Eq. Id</td>
        <td style="border:1px solid black;width:23%;">Gen. Id</td>
        <td style="border:1px solid black;width:21%;">Eq. Name</td>
        <td style="border:1px solid black;width:4%;">Dept.</td>
        <td style="border:1px solid black;width:18%;">Serial No.</td>
        <td style="border:1px solid black;width:10%;">Status</td>
    </tr></thead><tbody>';
	$j=1;
    for($i=0;$i<count($devices);$i++)
    {
        $html.='<tr>
        <td style="border:1px solid black;width:5%;">'.$j.'</td>
        <td style="border:1px solid black;width:20%;">'.$devices[$i][$this->devices->IMPORT_EID].'</td>
        <td style="border:1px solid black;width:23%;">'.$devices[$i][$this->devices->E_ID].'</td>
        <td style="border:1px solid black;width:21%;">'.$devices[$i][$this->devices->E_NAME].'</td>
        <td style="border:1px solid black;width:4%;">'.$devices[$i][$this->devices->DEPT_ID].'</td>
        <td style="border:1px solid black;width:18%;">'.$devices[$i][$this->devices->ES_NUMBER].'</td>
        <td style="border:1px solid black;width:10%;">'.$devices[$i][$this->devices->EQ_CONDATION].'</td>
    </tr>';
	$j++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>