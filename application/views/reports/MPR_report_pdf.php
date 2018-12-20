<?php
//print_r($mpr->total_count_eqps);
//die();
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Monthly Performance Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                    MONTHLY PERFORMANCE REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 8);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage();
            $non_sheduled_call = '<table cellspacing="0" style="width:100%;" cellpadding="2" style="width:100%;padding:0px;margin:0px">
            <tr>
            <td style="width:40%;border:1px solid black;"></td>
            <th style="border:1px solid black;width:15%;background-color:#f1f1f1">B/F</th>
            <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Added</th>
            <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Total</th>
            <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Comp</th>
            </tr>
             <tr>
                <th style="width:40%;border:1px solid black;background-color:#f1f1f1">Biomedical Direct</th>
                <td style="border:1px solid black;width:15%;">0</td>
                <td style="border:1px solid black;width:15%;">'.$mpr->no_of_B_bkdwns.'</td>
                <td style="border:1px solid black;width:15%;">'.$mpr->tot_no_Bbd.'</td>
                <td style="border:1px solid black;width:15%;">'.$mpr->tot_no_Bbd.'</td>
            </tr>
            <tr>
                <th style="width:40%;border:1px solid black;background-color:#f1f1f1">Warranty B/D</th>
                <td style="border:1px solid black;width:15%;">0</td>
                <td style="border:1px solid black;width:15%;">'.$mpr->no_of_W_bkdwns.'</td>
                <td style="border:1px solid black;width:15%;">'.$mpr->tot_no_Wbd.'</td>
                <td style="width:15%;border:1px solid black">'.$mpr->tot_no_Wbd.'</td>

            </tr>
            <tr>
                <th style="border:1px solid black;background-color:#f1f1f1">Contract  B/D</th>
                <td style="width:15%;border:1px solid black;">0</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->no_of_C_bkdwns.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Cbd.'</td>
                <td style="width:15%;border:1px solid black">'.$mpr->tot_no_Cbd.'</td>
            </tr>
            <tr>
                <th  style="width:40%;border:1px solid black;background-color:#f1f1f1">Other Support(NS)*</th>
                <td style="width:15%;border:1px solid black;">0</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->no_of_N_bkdwns.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Nbd.'</td>
                <td style="width:15%;border:1px solid black">'.$mpr->tot_no_Nbd.'</td>
            </tr>
            <tr>
                <th style="width:40%;background-color:#f1f1f1;border:1px solid black;">TOTALS</th>
                <td style="width:15%;border:1px solid black;">0</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_subtotal_bkdwms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_subtotal_bkdwms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_subtotal_bkdwms.'</td>
            </tr>
            </table>';

            $rt ='<table cellspacing="0" style="width:100%;" cellpadding="1">
            <tr>
            <th style="border:1px solid black;width:33%;background-color:#f1f1f1"> < 10 min</th>
            <th style="border:1px solid black;width:33%;background-color:#f1f1f1"> < 60 min</th>
            <th style="border:1px solid black;width:34%;background-color:#f1f1f1"> > 60 min</th>
            </tr>
           <tr>
           <td style="border:1px solid black;width:33%;background-color:#f1f1f1">'.$mpr->total_lt_10.'</td>
           <td style="border:1px solid black;width:33%;background-color:#f1f1f1">'.$mpr->total_lt_60.'</td>
           <td style="border:1px solid black;width:34%;background-color:#f1f1f1">'.$mpr->total_gt_60.'</td>
            </tr>

            </table>';
            $ttr ='<table cellspacing="0" style="width:100%;" cellpadding="1">
            <tr>
            <th style="border:1px solid black;width:33%;background-color:#f1f1f1"> < 1D</th>
            <th style="border:1px solid black;width:33%;background-color:#f1f1f1"> < 3D</th>
            <th style="border:1px solid black;width:34%;background-color:#f1f1f1"> > 3D</th>
            </tr>
           <tr>
           <td style="border:1px solid black;width:33%;background-color:#f1f1f1">'.$mpr->total_lt_1d.'</td>
           <td style="border:1px solid black;width:33%;background-color:#f1f1f1">'.$mpr->total_lt_3d.'</td>
           <td style="border:1px solid black;width:34%;background-color:#f1f1f1">'.$mpr->total_gt_3d.'</td>
            </tr>

            </table>';
            $scheduled_calls= '<table cellspacing="0" style="width:100%;" cellpadding="2">
            <tr>
            <td style="width:40%;border:1px solid black;"></td>
            <th style="border:1px solid black;width:15%;background-color:#f1f1f1">B/F</th>
            <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Added</th>
            <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Total</th>
            <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Comp</th>
            </tr>
              <tr>
                <th  style="width:40%;border:1px solid black;background-color:#f1f1f1">New Installations</th>
                <td style="width:15%;border:1px solid black;">'.$mpr->no_of_N_pms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Npms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Npms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Npms.'</td>
            </tr>
             <tr>
                <th  style="width:40%;border:1px solid black;background-color:#f1f1f1">Comp.Warranty PMS</th>
                 <td style="width:15%;border:1px solid black;">'.$mpr->no_of_W_pms.'</td>
                 <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Wpms.'</td>
                 <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Wpms.'</td>
                 <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Wpms.'</td>
            </tr>
             <tr>
                <th  style="width:40%;border:1px solid black;background-color:#f1f1f1">Comp.Contract PMS</th>
                <td style="width:15%;border:1px solid black;">'.$mpr->no_of_C_pms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Cpms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Cpms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Cpms.'</td>
            </tr>
             <tr>
                <th  style="width:40%;border:1px solid black;background-color:#f1f1f1">Biomedical PMS</th>
                <td style="width:15%;border:1px solid black;">'.$mpr->no_of_B_pms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Bpms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Bpms.'</td>
                <td style="width:15%;border:1px solid black;">'.$mpr->tot_no_Bpms.'</td>
            </tr>
             <tr>
                <th  style="width:40%;border:1px solid black;background-color:#f1f1f1">Daily Rounds</th>
                <td style="width:15%;border:1px solid black;"></td>
                <td style="width:15%;border:1px solid black;"></td>
                <td style="width:15%;border:1px solid black;"></td>
                <td style="width:15%;border:1px solid black;"></td>
            </tr>
            </table>';
$training_session='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
                    <tr>
                    <td style="width:60%;border:1px solid black;"></td>
                    <th style="width:20%;border:1px solid black;background-color:#f1f1f1">Sessions</th>
                    <th style="width:20%;border-bottom:1px solid black;border-top:1px solid black;border-left:1px solid black;background-color:#f1f1f1">Trainees</th>
                    </tr>
                    <tr>
                   <th style="width:60%;border:1px solid black;background-color:#f1f1f1">BME Sessions with Trainees</th>
                   <td style="width:20%;border:1px solid black;"></td>
                   <td style="width:20%;border-bottom:1px solid black;border-top:1px solid black;border-left:1px solid black;"></td>
                    </tr>
                      <tr>
                   <th style="width:60%;border:1px solid black;background-color:#f1f1f1">OJT to Engineers by BME</th>
                   <td style="width:20%;border:1px solid black;"></td>
                   <td style="width:20%;border-bottom:1px solid black;border-top:1px solid black;border-left:1px solid black;"></td>
                    </tr>
                     <tr>
                   <th style="width:60%;border:1px solid black;background-color:#f1f1f1">Vendor Trainings to BME/Technicians</th>
                   <td style="width:20%;border:1px solid black;"></td>
                   <td style="width:20%;border-top:1px solid black;border-left:1px solid black;"></td>
                    </tr>
                    <tr>
                   <th style="width:60%;border:1px solid black;background-color:#f1f1f1">BME Training to Technicians</th>
                   <td style="width:20%;border:1px solid black;"></td>
                   <td style="width:20%;border-top:1px solid black;border-left:1px solid black;"></td>
                    </tr>
                    <tr>
                   <th style="width:60%;border:1px solid black;background-color:#f1f1f1">Trainings done on Rounds</th>
                   <td style="width:20%;border:1px solid black;"></td>
                   <td style="width:20%;border-top:1px solid black;"></td>
                    </tr>
                    </table>';
$cause_codes='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
                <tr>
                <th style="width:100%;background-color:#f1f1f1">(Mention CC against each RT >60mins && TTR>3days)</th>
                </tr>';
                foreach($mpr->cause_codes as $cause_code)
                {
                 $cause_codes.='<tr>
                 <td style="width:15%;border:1px solid black;">'.$cause_code->ID.'</td>
                 <td style="width:85%;border:1px solid black;">'.$cause_code->CAUSE.'</td>
                 </tr>';
                }
                $cause_codes.='</table>';
$rt60min='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
                <tr>
                <th style="width:100%;background-color:#f1f1f1;border:1px solid black;text-align:center">RT>60mins</th>
                </tr>
                <tr>
                <th style="width:25%;border:1px solid black;">NOS</th>
                <th style="width:75%;border:1px solid black;">CC(no,cc,no,cc)</th>
                </tr>
                 <tr>
                <td style="width:25%;border:1px solid black;">'.$mpr->index.'</td>
                <td style="width:75%;border:1px solid black;">'.$mpr->response_gt_60.'</td>
                </tr>
                </table>';
$ttr3d='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
                <tr>
                <th style="width:100%;background-color:#f1f1f1;border:1px solid black;text-align:center">TTR>3Days</th>
                </tr>
                <tr>
                <th style="width:25%;border:1px solid black;">NOS</th>
                <th style="width:75%;border:1px solid black;">CC(no,cc,no,cc)</th>
                </tr>
                 <tr>
                <td style="width:25%;border:1px solid black;">'.$mpr->index.'</td>
                <td style="width:75%;border:1px solid black;">'.$mpr->ttr_gt_3d.'</td>
                </tr>
                </table>';
$asset='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
        <tr>
        <td  style="width:50%;border:1px solid black;"></td>
        <th style="width:20%;background-color:#f1f1f1;border:1px solid black;text-align:center">NOS</th>
        <th style="width:30%;background-color:#f1f1f1;border:1px solid black;text-align:center">Value of Eq</th>
        </tr>
        <tr>
        <td  style="width:50%;border:1px solid black;">a) New Installation</td>
        <td style="width:20%;border:1px solid black;text-align:center">'.$mpr->no_of_Instals_count.'</td>
        <td style="width:30%;border:1px solid black;text-align:center">'.$mpr->no_of_Instals_count.'</td>
        </tr>
        <tr>
        <td  style="width:50%;border:1px solid black;">b) Eq under Warranty</td>
        <td style="width:20%;border:1px solid black;text-align:center">'.$mpr->assets_cnt->Warranty.'</td>
        <td style="width:30%;border:1px solid black;text-align:center">'.$mpr->Assets->Warranty.'</td>
        </tr>
         <tr>
        <td  style="width:50%;border:1px solid black;">c) Eq under Contract</td>
        <td style="width:20%;border:1px solid black;text-align:center">'.$mpr->assets_cnt->CMC.'</td>
        <td style="width:30%;border:1px solid black;text-align:center">'.$mpr->Assets->CMC.'</td>
        </tr>
         <tr>
        <td  style="width:50%;border:1px solid black;">d) Eq under Biomedical</td>
        <td style="width:20%;border:1px solid black;text-align:center">'.$mpr->assets_cnt->Biomedical.'</td>
        <td style="width:30%;border:1px solid black;text-align:center">'.$mpr->Assets->Biomedical.'</td>
        </tr>
         <tr>
        <td  style="width:50%;border:1px solid black;">E) Eq under AMC</td>
        <td style="width:20%;border:1px solid black;text-align:center">'.$mpr->assets_cnt->AMC.'</td>
        <td style="width:30%;border:1px solid black;text-align:center">'.$mpr->Assets->AMC.'</td>
        </tr>
         <tr>
        <td  style="width:50%;border:1px solid black;">e) Total Assets and Value</td>
        <td style="width:20%;border:1px solid black;text-align:center">'.$mpr->assets_cnt->total.'</td>
        <td style="width:30%;border:1px solid black;text-align:center">'.$mpr->Assets->total.'</td>
        </tr>
        <tr>
        <td  style="width:70%;border:1px solid black;">Equipments on Rentals/Demo(Nos)</td>
        <td style="width:30%;border:1px solid black;text-align:center"></td>
        </tr>
        </table>';
$manpower='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
        <tr>
        <td  style="width:70%;border:1px solid black;"></td>
        <th style="width:15%;background-color:#f1f1f1;border:1px solid black;text-align:center">BME</th>
        <th style="width:15%;background-color:#f1f1f1;border:1px solid black;text-align:center">TR</th>
        </tr>
        <tr>
        <td  style="width:70%;border:1px solid black;">Number of Engineers available this month</td>
        <td style="width:15%;border:1px solid black;text-align:center">'.$mpr->no_of_Instals_count.'</td>
        <td style="width:15%;border:1px solid black;text-align:center"></td>
        </tr>
        <tr>
        <td  style="width:70%;border:1px solid black;">Holidays in the Month</td>
        <td style="width:15%;border:1px solid black;text-align:center">'.$mpr->Warranty.'</td>
        <td style="width:15%;border:1px solid black;text-align:center">'.$mpr->Warranty.'</td>
        </tr>
         <tr>
        <td  style="width:70%;border:1px solid black;">Man days Available</td>
        <td style="width:15%;border:1px solid black;text-align:center">'.$mpr->CMC.'</td>
        <td style="width:15%;border:1px solid black;text-align:center">'.$mpr->CMC.'</td>
        </tr>
         <tr>
        <td  style="width:70%;border:1px solid black;">MD on Training/Meets/OS/Rounds</td>
        <td style="width:15%;border:1px solid black;text-align:center"></td>
        <td style="width:15%;border:1px solid black;text-align:center"></td>
        </tr>
         <tr>
        <td  style="width:70%;border:1px solid black;">Manpower /IB--MP/Asset Value</td>
        <td style="width:15%;border:1px solid black;text-align:center"></td>
        <td style="width:15%;border:1px solid black;text-align:center"></td>
        </tr>
         <tr>
        <td  style="width:70%;border:1px solid black;">Manpower /IB--MP/Asset Value</td>
        <td style="width:15%;border:1px solid black;text-align:center"></td>
        <td style="width:15%;border:1px solid black;text-align:center"></td>
        </tr>
        </table>';
$replacement='<table table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
            <tr>
            <th style="width:25%;background-color:#f1f1f1;border:1px solid black;text-align:center"></th>
            <th style="width:10%;background-color:#f1f1f1;border:1px solid black;text-align:center">No</th>
            <th style="width:15%;background-color:#f1f1f1;border:1px solid black;text-align:center">BUDGET(LAKHS)</th>
            <th style="width:20%;background-color:#f1f1f1;border:1px solid black;text-align:center">NUMBERS RELEASED</th>
            <th style="width:10%;background-color:#f1f1f1;border:1px solid black;text-align:center">PO VALUE</th>
            <th style="width:20%;background-color:#f1f1f1;border:1px solid black;text-align:center">BALANCE
(NO/VALUE)</th>
            </tr>
            <tr>
             <td style="width:25%;border:1px solid black;text-align:center"></td>
             <td style="width:10%;border:1px solid black;text-align:center"></td>
             <td style="width:15%;border:1px solid black;text-align:center"></td>
             <td style="width:20%;border:1px solid black;text-align:center"></td>
             <td style="width:10%;border:1px solid black;text-align:center"></td>
             <td style="width:20%;border:1px solid black;text-align:center"></td>
            </tr>
            </table>';
$expenses='<table table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
            <tr>
            <th  style="width:70%;background-color:#f1f1f1;border:1px solid black;text-align:center"></th>
            <th  style="width:10%;background-color:#f1f1f1;border:1px solid black;text-align:center">No</th>
            <th  style="width:20%;background-color:#f1f1f1;border:1px solid black;text-align:center">VAL (K)</th>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">1) NABH DONE</td>
            <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->qcdone_cnt.'</td>
             <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->qcdone_cost.'</td>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">2) SPARES</td>
            <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->spares_cnt.'</td>
             <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->spares_cost.'</td>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">3) SERVICE</td>
            <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->service_cnt.'</td>
             <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->service_cnt.'</td>
            </tr>
             <tr>
            <td style="width:70%;border:1px solid black;text-align:left">4)ACCESSORIES</td>
            <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->accessories_cnt.'</td>
             <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->accessories_cost.'</td>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">5) CONSUMABLES</td>
            <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->consubble_cnt.'</td>
            <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->consubble_cost.'</td>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">TOTAL</td>
            <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->astotalcount.'</td>
             <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->astotalcost.'</td>
            </tr>
            </table>';
$assets='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
            <tr>
            <th  style="width:70%;background-color:#f1f1f1;border:1px solid black;text-align:center"></th>
            <th  style="width:10%;background-color:#f1f1f1;border:1px solid black;text-align:center">No</th>
            <th  style="width:20%;background-color:#f1f1f1;border:1px solid black;text-align:center">VAL (K)</th>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">GRN s DONE</td>
            <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->grn_count.'</td>
            <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->grn_cost.'</td>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">ADVERSE INCIDENTS REPORTED</td>
            <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->incidents_count.'</td>
             <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->incidents_cost.'</td>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">EQ.DEPLOYMENTS</td>
            <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->eq_count.'</td>
            <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->eq_cost.'</td>
            </tr>
             <tr>
            <td style="width:70%;border:1px solid black;text-align:left">EQUIPMENTS CONDEMNED</td>
              <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->condem_count.'</td>
             <td style="width:20%;border:1px solid black;text-align:left">'.$mpr->condem_cost.'</td>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">MEETING ATTENDED - HOD,MD,CHA(Nos.)</td>
            <td style="width:10%;border:1px solid black;text-align:left"></td>
             <td style="width:20%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
            <td style="width:70%;border:1px solid black;text-align:left">CRITICAL EQUIPMENT UPTIME(%)</td>
            <td style="width:10%;border:1px solid black;text-align:left"></td>
             <td style="width:20%;border:1px solid black;text-align:left"></td>
            </tr>
            </table>';
$contracts='<table table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
            <tr>
             <th style="width:40%;border:1px solid black;text-align:left;background-color:#f1f1f1;"></th>
            <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">NOS</th>
             <th style="width:15%;border:1px solid black;text-align:left;background-color:#f1f1f1;">CONT.VALUE</th>
             <th style="width:35%;border:1px solid black;text-align:left;background-color:#f1f1f1;">COMMENTS/NOTES/REASONS</th>
            </tr>
            <tr>
            <td style="width:40%;border:1px solid black;text-align:left">TOTAL LIVE CONTRACTS BF</td>
             <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->tlc_count.'</td>
             <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->tlc_cost.'</td>
             <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
            <td style="width:40%;border:1px solid black;text-align:left">EXPIRED CONTRACTS (till last month)</td>
             <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->exc_count.'</td>
            <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->exc_sum.' </td>
            <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">CONTRACTS expired and sent for renewal</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->cesr_count.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->cesr_cost.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">WARRANTY expired and sent for CONT.</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->wesr_count.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->wesr_sum.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">WARR. TO CONTRACTS NOT DESIRED</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->wcnd_sum.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->wcnd_count.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">CONTRACT renewals NOT DESIRED</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->crnd_sum.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->crnd_count.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">CONT RENEWALS DONE since last month</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->crlm_count.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->crlm_sum.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">CONTRACT RENEWALS PENDING</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->crp_count.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->crp_sum.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">CONTRACTS EXPIRING in coming month</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->eccm_count.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->eccm_sum.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">WARRANTY EXPIRING in coming month</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->ewcm_count.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->ewcm_cost.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">CONT s (TO BE) INDENTED FOR RENEWAL</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mpr->cir_count.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mpr->cir_sum.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            <tr>
                <td style="width:40%;border:1px solid black;text-align:left">TOTAL CONTRACT RENEWALS PENDING</td>
                <td style="width:10%;border:1px solid black;text-align:left">'.$mrp->tcrp_count.'</td>
                <td style="width:15%;border:1px solid black;text-align:left">'.$mrp->tcrp_sum.'</td>
                <td style="width:35%;border:1px solid black;text-align:left"></td>
            </tr>
            </table>';
$engProductivity='<table table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
    <tr>
        <th style="width:5%;border:1px solid black;text-align:left;background-color:#f1f1f1;">NO</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">ENGR</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">CALLS</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">ROUNDS</th>
        <th style="width:15%;border:1px solid black;text-align:left;background-color:#f1f1f1;">TRAININGS</th>
        <th style="width:5%;border:1px solid black;text-align:left;background-color:#f1f1f1;">PMS</th>
        <th style="width:20%;border:1px solid black;text-align:left;background-color:#f1f1f1;">TOT NO OF TRIPS</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">TOT .TIME(Hrs)</th>
        <th style="width:15%;border:1px solid black;text-align:left;background-color:#f1f1f1;">	LEADER S COMMENTS</th>

    </tr>';
    $users_calls_count=1;
    foreach($mpr->calls as $user_call)
    {
    $engProductivity.='<tr>
        <td style="width:5%;border:1px solid black;text-align:left;">'.$users_calls_count++.'</td>
        <td style="width:10%;border:1px solid black;text-align:left;">'.$user_call->name.'</td>
        <td style="width:10%;border:1px solid black;text-align:left;">'.$user_call->cms_cnt.'</td>
        <td style="width:10%;border:1px solid black;text-align:left;">'.$user_call->rounds_cnt.'</td>
        <td style="width:15%;border:1px solid black;text-align:left;">'.$user_call->trngs_cnt.'</td>
        <td style="width:5%;border:1px solid black;text-align:left;">'.$user_call->pms_cnt.'</td>
        <td style="width:20%;border:1px solid black;text-align:left;">'.$user_call->total_trips.'</td>
        <td style="width:10%;border:1px solid black;text-align:left;"></td>
        <td style="width:15%;border:1px solid black;text-align:left;"></td>
    </tr>';
    }
    $engProductivity.='</table>';
$nabh_readiness='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
    <tr>
        <th style="width:20%;border:1px solid black;text-align:left;background-color:#f1f1f1;"></th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">MON/VENT/ANES</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">ECG/DIATH/DEFIB</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">DIALYSIS/ETC</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">SY-INF PUMPS</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">LAB EQPMTS</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">RAD/CAT/H</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">STER/OTHERS</th>
        <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">TOTAL</th>
    </tr>
    <tr>
        <td style="width:20%;border:1px solid black;text-align:left;">NABH Calibration Numbers</td>';
        foreach($mpr->count as $nabh_count) {
        $nabh_readiness .= '
        <td style="width:10%;border:1px solid black;text-align:left;">' . $nabh_count . '</td>';
        }
        $nabh_readiness .= '</tr>
    <tr>
        <td style="width:20%;border:1px solid black;text-align:left;">NABH Calibration Cost</td>';
        foreach($mpr->cost as $nabh_cost) {
        $nabh_readiness .= '
        <td style="width:10%;border:1px solid black;text-align:left;">' . $nabh_cost . '</td>';
        }
        $nabh_readiness .=' </tr>
    <tr>
        <td style="width:20%;border:1px solid black;text-align:left;">NABH Calibration done dt</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;"> 0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
    </tr>
    <tr>
        <td style="width:20%;border:1px solid black;text-align:left;">NABH Calibration next due dt</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0 </td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
        <td style="width:10%;border:1px solid black;text-align:left;">0</td>
    </tr>';
    $nabh_readiness.= '</table>';
        $savings='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
            <tr>
                <th style="width:20%;border:1px solid black;text-align:left;background-color:#f1f1f1;"></th>
                <th style="width:5%;border:1px solid black;text-align:left;background-color:#f1f1f1;">Nos</th>
                <th style="width:12%;border:1px solid black;text-align:left;background-color:#f1f1f1;">Outside Expenses</th>
                <th style="width:12%;border:1px solid black;text-align:left;background-color:#f1f1f1;">Cost of Part Repaired</th>
                <th style="width:12%;border:1px solid black;text-align:left;background-color:#f1f1f1;">Month Disallowed</th>
                <th style="width:11%;border:1px solid black;text-align:left;background-color:#f1f1f1;">YTD Disallowed</th>
                <th style="width:8%;border:1px solid black;text-align:left;background-color:#f1f1f1;">Remarks</th>
                <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">Month Savings</th>
                <th style="width:10%;border:1px solid black;text-align:left;background-color:#f1f1f1;">YTD Savings</th>
            </tr>
            <tr>
                <th style="width:20%;border:1px solid black;text-align:left;">IN-HOUSE REPAIRS</th>
                <th style="width:5%;border:1px solid black;text-align:left"></th>
                <th style="width:12%;border:1px solid black;text-align:left;"></th>
                <th style="width:12%;border:1px solid black;text-align:left;"></th>
                <th style="width:12%;border:1px solid black;text-align:left;"></th>
                <th style="width:11%;border:1px solid black;text-align:left;"></th>
                <th style="width:8%;border:1px solid black;text-align:left;"></th>
                <th style="width:10%;border:1px solid black;text-align:left;"></th>
                <th style="width:10%;border:1px solid black;text-align:left;"></th>
            </tr>
            <tr>
                <th style="width:20%;border:1px solid black;text-align:left;">INDIRECT SAVINGS</th>
                <th style="width:5%;border:1px solid black;text-align:left"></th>
                <th style="width:12%;border:1px solid black;text-align:left;"></th>
                <th style="width:12%;border:1px solid black;text-align:left;"></th>
                <th style="width:12%;border:1px solid black;text-align:left;"></th>
                <th style="width:11%;border:1px solid black;text-align:left;"></th>
                <th style="width:8%;border:1px solid black;text-align:left;"></th>
                <th style="width:10%;border:1px solid black;text-align:left;"></th>
                <th style="width:10%;border:1px solid black;text-align:left;"></th>
            </tr>
        </table>';
        $achivements='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
            <tr>
                <td style="width:100%;border:1px solid black;"></td>
            </tr>
            <tr>
                <td style="width:100%;border:1px solid black;"></td>
            </tr>
        </table>';
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
    <tr>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Date</th>
        <td style="border:1px solid black;width:25%;">'.date('m-Y').'</td>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Time</th>
        <td style="border:1px solid black;width:25%;">'.date('h:i A').'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Branch</th>
        <td style="border:1px solid black;width:25%;">'.$mpr->branchname.'</td>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Department</th>
        <td style="border:1px solid black;width:25%;">BioMedical</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:50%;">A] NON SCHEDULED CALLS </td>
        <td style="border:1px solid black;width:25%;">A1-Response Time (RT)</td>
        <td style="border:1px solid black;width:25%;">A2- Time To Repair-(TTR)</td>
    </tr>
    <tr>
        <td style="border-left:1px solid black;border-bottom:1px solid black;width:50%;">
            '.$non_sheduled_call.'</td>
        <td  style="border:1px solid black;width:25%;">
            '.$rt.'
        </td>
        <td  style="border:1px solid black;width:25%;">
            '.$ttr.'
        </td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;">other Support jobs must be documented and available for audit</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:50%;">B] SCHEDULED CALLS</td>
        <td style="border:1px solid black;width:50%;">C] TOTAL TRAININGS SESSIONS</td>
    </tr>
    <tr>
        <td style="border-left:1px solid black;border-bottom:1px solid black;width:50%;">'.$scheduled_calls.'</td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;width:50%;">'.$training_session.'</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:50%;">D] RT / TTR -Cause Codes(CC </td>
        <td style="border:1px solid black;width:50%;">D1] Reasons for delay(RT>60M & TTR>3D)</td>
    </tr>
    <tr>
        <td style="border-left:1px solid black;border-bottom:1px solid black;width:50%;">'.$cause_codes.'</td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;width:25%;">'.$rt60min.'</td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;width:25%;">'.$ttr3d.'</td>
    </tr>

    <tr>
        <td style="border-left:1px solid black;border-bottom:1px solid black;width:50%;">'.$asset.'</td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;width:50%;">'.$manpower.'</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;text-align:center"> G] REPLACEMENTS</td>
    </tr>
    <tr>
        <td style="border-right:1px solid black;border-left:1px solid black;border-bottom:1px solid black;width:100%;">'.$replacement.'</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:50%;">H] EXPENSES </td>
        <td style="border:1px solid black;width:50%;">I] ACTIVITIES</td>
    </tr>
    <tr>
        <td style="border-left:1px solid black;border-bottom:1px solid black;width:50%;">'.$expenses.'</td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;width:50%;">'.$assets.'</td>
    </tr>
    <tr>
        <td style="width:100%;"></td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;text-align:center"> J] CONTRACTS</td>
    </tr>
    <tr>
        <td style="border-right:1px solid black;border-left:1px solid black;border-bottom:1px solid black;width:100%;">'.$contracts.'</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;text-align:center"> K] Engineers Productivity</td>
    </tr>
    <tr>
        <td style="border-right:1px solid black;border-left:1px solid black;border-bottom:1px solid black;width:100%;">'.$engProductivity.'</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;text-align:center">L] NABH READINESS</td>
    </tr>
    <tr>
        <td style="border-right:1px solid black;border-left:1px solid black;border-bottom:1px solid black;width:100%;">'.$nabh_readiness.'</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;text-align:center">M] SAVINGS</td>
    </tr>
    <tr>
        <td style="border-right:1px solid black;border-left:1px solid black;border-bottom:1px solid black;width:100%;">'.$savings.'</td>
    </tr>
    <tr>
        <td style="border:1px solid black;width:100%;text-align:center">M] SAVINGS</td>
    </tr>
    <tr>
        <td style="border-right:1px solid black;border-left:1px solid black;border-bottom:1px solid black;width:100%;">'.$achivements.'</td>
    </tr>
</table>';
//echo $html;
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output();
?>