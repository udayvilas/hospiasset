<?php
$rep_data = $tdata['cms_report'];
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('CMS Report PDf');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'CALL MANAGEMENT REPORT', array(0,64,55), array(0,64,128));
$pdf->setFooterData(array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 8);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('L','A4');
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <tr>
        <th style="border:1px solid black;" colspan="5">'.strtoupper($this->session->org_name).'</th>
        <th style="border:1px solid black;" colspan="15">CMS REPORT '.date('m-Y').'</th>
        <th style="border:1px solid black;" colspan="6">BME Department</th>
    </tr>
    <tr>
        <td style="border:1px solid black;width:2%;" rowspan="2">No</td>
        <td style="border:1px solid black;width:15%;" rowspan="2">UNIT</td>
        <td style="border:1px solid black;width:19%;" colspan="6">NON SCHEDULED CALLS</td>
        <td style="border:1px solid black;width:21%;" colspan="7">SCHEDULED CALLS(PMS)</td>
        <td style="border:1px solid black;width:4%;" colspan="1">CALLS</td>
        <td style="border:1px solid black;width:18%;" colspan="5">RESPONSE TIME</td>
        <td style="border:1px solid black;width:16%;" colspan="4">TIME TO REPAIR</td>
        <td style="border:1px solid black;width:5%;">UPTIME</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:3%">AMC</td>
        <td style="border:1px solid black;width:3%">BME</td>
        <td style="border:1px solid black;width:3.5%">WAR</td>
        <td style="border:1px solid black;width:3%">CMC</td>
        <td style="border:1px solid black;width:3%">OS</td>
        <td style="border:1px solid black;width:3.5%">STOT</td>
        <td style="border:1px solid black;width:3%">INST</td>
        <td style="border:1px solid black;width:2.9%">WAR</td>
        <td style="border:1px solid black;width:2.9%">AMC</td>
        <td style="border:1px solid black;width:2.8%">CMC</td>
        <td style="border:1px solid black;width:2.8%">BME</td>
        <td style="border:1px solid black;width:3.8%">STOT</td>
        <td style="border:1px solid black;width:2.8%">OS</td>
        <td style="border:1px solid black;">TOTAL</td>
        <td style="border:1px solid black;">&lt;10</td>
        <td style="border:1px solid black;">&lt;60</td>
        <td style="border:1px solid black;">&gt;60</td>
        <td style="border:1px solid black;">% &lt; 10</td>
        <td style="border:1px solid black;">% &gt; 60</td>
        <td style="border:1px solid black;">&lt; 1D</td>
        <td style="border:1px solid black;">&lt; 3D</td>
        <td style="border:1px solid black;">&gt; 3D</td>
        <td style="border:1px solid black;">%&lt;1D</td>
        <td style="border:1px solid black;"></td>
    </tr>';
    $i=1;
    foreach($rep_data as $data)
    {
        $html.='<tr>
        <td style="border:1px solid black;">'.$i.'</td>
        <td style="border:1px solid black;">'.$data["BRANCH_NAME"].'</td>
        <td style="border:1px solid black;">'.$data["no_of_A_bkdwns"].'</td>
        <td style="border:1px solid black;">'.$data["no_of_B_bkdwns"].'</td>
        <td style="border:1px solid black;">'.$data["no_of_W_bkdwns"].'</td>
        <td style="border:1px solid black;">'.$data["no_of_C_bkdwns"].'</td>
        <td style="border:1px solid black;">'.$data["no_of_N_bkdwns"].'</td>
        <td style="border:1px solid black;">'.$data["no_tot_bkdwn_total"].'</td>
        <td style="border:1px solid black;">
        </td>
        <td style="border:1px solid black;">'.$data["no_of_W_pms"].'</td>
        <td style="border:1px solid black;">'.$data["no_of_A_pms"].'</td>
        <td style="border:1px solid black;">'.$data["no_of_C_pms"].'</td>
        <td style="border:1px solid black;">'.$data["no_of_B_pms"].'</td>
        <td style="border:1px solid black;">'.$data["no_of_N_pms"].'</td>
        <td style="border:1px solid black;">'.$data["no_tot_pms_total"].'</td>
        <td style="border:1px solid black;">'.$data["no_calls_total"].'</td>
        <td style="border:1px solid black;">'.$data["response_lt_10"].'</td>
        <td style="border:1px solid black;">'.$data["response_lt_60"].'</td>
        <td style="border:1px solid black;">'.$data["response_gt_60"].'</td>
        <td style="border:1px solid black;">'.$data["response_time_lt_10pcs"].'</td>
        <td style="border:1px solid black;">'.$data["response_time_lt_60pcs"].'</td>
        <td style="border:1px solid black;">'.$data["ttr_lt_1d"].'</td>
        <td style="border:1px solid black;">'.$data["ttr_lt_3d"].'</td>
        <td style="border:1px solid black;">'.$data["ttr_gt_3d"].'</td>
        <td style="border:1px solid black;">'.$data["ttr_lt_1d_inpcs"].'</td>
        <td style="border:1px solid black;"></td>
    </tr>';
        $i++;
    }
    $html.= '<tr>
        <td style="border:1px solid black;"colspan="2">Total</td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Abd"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Bbd"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Wbd"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Cbd"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Nbd"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_subtotal_bkdwms"].'</td>
        <td style="border:1px solid black;"></td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Wpms"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Apms"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Cpms"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Bpms"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_no_Npms"].'</td>
        <td style="border:1px solid black;">'.$tdata["tot_subtotal_pms"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_calls_total"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_lt_10"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_lt_60"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_gt_60"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_lt_10_pcs"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_lt_60_pcs"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_lt_1d"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_lt_3d"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_gt_3d"].'</td>
        <td style="border:1px solid black;">'.$tdata["total_lt_1d_pcs"].'</td>
        <td style="border:1px solid black;"></td>
    </tr>';
    $html.='<tr>
                <td style="border:1px solid black;" colspan="26"> ABBEV:B / BIOMED=DEPT DIRECT CALLS WAR=WARRANTY,BD=BREAKDOWN,CO=CONTRACT,PMS=PREVENTIVE MAINTENANCE,D=DAY,INSTL=INSTALLATIONS,OS=Other Support Request</td>
            </tr>';
    $html.='</table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    //Asset Management and Other Activities Reports
    $pdf->AddPage('L', 'A4');
    $html='<table cellspacing="0" cellpadding="3" style="width:100%;" border="0">';
    $html.='<tr>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;" rowspan="2">NO</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 15%;" rowspan="2">UNIT</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;" rowspan="2">SAV(000)</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 7%;" colspan="2">Training</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 6%;" colspan="2">NABH</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 15%;" colspan="5">Expenses(000)</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 6%;" colspan="2">GRN&#39;s(L)</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 6%;" colspan="2">Adverse</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 7%;" colspan="2">Contracts</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 7%;" colspan="2">Assets</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 7%;" colspan="2">Percent</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 6%;" colspan="2">Cond. Eq.</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 6%;" colspan="2">Repl (L)</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;" rowspan="2">Deployed</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;" rowspan="2">Manpower</td>
            </tr>
            <tr>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3.5%;">Event</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3.5%;">Ppl</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 2.5%;">Nos</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3.5%;">Val</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Spr</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Ser</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Acc</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Cons</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Tot</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">No</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Val</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">No</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">val</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Nos</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 4%;">Val(L)</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Nos</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 4%;">Val(L)</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Nos</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 4%;">Val(C)</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Nos</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Val</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Bud</td>
                <td style="border:1px solid black;background-color:#f1f1f1;width: 3%;">Bal</td>
            </tr>';
    $ji=1;
    foreach($amoa['asset_management'] as $amo)
    {
        $html .='<tr>
                <td style="border:1px solid black;width: 3%;">'.$ji++.'</td>
                <td style="border:1px solid black;width: 15%;">'.$amo['BRANCH_NAME'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['saving_cost'].'</td>
                <td style="border:1px solid black;width: 3.5%;">'.$amo['trngs_count'].'</td>
                <td style="border:1px solid black;width: 3.5%;">'.$amo['trngs_cost'].'</td>
                <td style="border:1px solid black;width: 2.5%;">'.$amo['qcdone_cnt'].'</td>
                <td style="border:1px solid black;width: 3.5%;">'.$amo['qcdone_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['spares_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['services_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['accessories_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['consuble_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['tot_spr_acc_ser_cons'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['grn_count'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['grn_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['incidents_count'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['incidents_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['tlc_count'].'</td>
                <td style="border:1px solid black;width: 4%;">'.$amo['conttacts_lachs'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['count'].'</td>
                <td style="border:1px solid black;width: 4%;">'.$amo['asset_in_lacs'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['percent_cnt'].'</td>
                <td style="border:1px solid black;width: 4%;">'.$amo['percent_in_crores'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['condem_count'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['condem_cost_lacks'].'</td>
                <td style="border:1px solid black;width: 3%;"></td>
                <td style="border:1px solid black;width: 3%;"></td>
                <td style="border:1px solid black;width: 3%;">'.$amo['deployment_count'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amo['mp_count'].'</td>
            </tr>';
    }
    $html.= '<tr>
                <td style="border:1px solid black;width: 18%;" colspan="9">Total</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_savings'].'</td>
                <td style="border:1px solid black;width: 3.5%;">'.$amoa['tot_no_Events'].'</td>
                <td style="border:1px solid black;width: 3.5%;">'.$amoa['tot_no_ppls'].'</td>
                <td style="border:1px solid black;width: 2.5%;">'.$amoa['tot_no_nabh_cnt'].'</td>
                <td style="border:1px solid black;width: 3.5%;">'.$amoa['tot_no_nabh_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_expenses_sprs'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_expenses_servcs'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_expenses_accers'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_expenses_cnsbls'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_expenses_tot'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_grns_cnt'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_grns_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_adverse_cnt'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_adverse_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_contracts_cnt'].'</td>
                <td style="border:1px solid black;width: 4%;">'.$amoa['tot_no_contracts_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_assets_cnt'].'</td>
                <td style="border:1px solid black;width: 4%;">'.$amoa['tot_no_assets_cost'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['percnt_cost_tot'].'</td>
                <td style="border:1px solid black;width: 4%;">'.$amoa['percent_crores'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_cond_count'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_cond_cost'].'</td>
                <td style="border:1px solid black;width: 3%;"></td>
                <td style="border:1px solid black;width: 3%;"></td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_deplyment_count'].'</td>
                <td style="border:1px solid black;width: 3%;">'.$amoa['tot_no_manpower_count'].'</td>
                </tr>
                <tr>
                    <td style="text-align:center;border:1px solid black;" colspan="30">SPR-Spares,SER=-Service,ACC=Accessories,CONS-Consumables
                    </td>
                </tr>';
    $html.='</table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>