<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content  class="mylayout-padding" ng-cloak>
    <div layout="column">
        <div  flex="100" style="margin-bottom:5px;">
            <h3 class="heading-stylerespond">Monthly Performance Report</h3>
        </div>
        <div layout="row" flex>

                <mdp-date-picker ng-model="mprsdate" mdp-placeholder="Date" mdp-format="DD-MM-YYYY" flex="15" mdp-max-date="minDate">
                </mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
            <md-button class="md-icon-button md-raised md-accent" ng-click="loadMPReports()"  md-theme="default" aria-label="submit">
                <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
            <div flex="65" hide-xs hide-sm>&nbsp;&nbsp;</div>
            <md-button ui-sref="home.monthly_performance_graph" class="md-raised md-primary">view MPR Graph</md-button>
                <button ng-show="Monthly_Pdf_Report==Generate PDF" ng-if="mpr_report_pdf_data!=[]" ng-click="loadMPReportsTCPDF()" class="md-raised md-accent md-button md-ink-ripple" style="float:right">Export</button>
        </div>
    <div id="exportthis" style="height:2500px">
   <!--     <div layout="row" layout-align="center center" flex="85" style="margin-bottom:5px;">
            <div layout-align="center center" flex="100">
                <h5 style="font-weight:700;margin-left:200px;"><center>CARE HOSPITALS<br>
                        BIOMEDICAL ENGINEERING DEPARTMENT<br>
                        MONTHLY PERFORMANCE REPORT</center></h5>
            </div>
            <div  flex="0">
                <img style="float:right" src="<?php /*echo base_url();*/?>assets/images/carepdflogo.jpg">
            </div>
        </div>-->
        <div layout="row">

        </div>
        <div ng-show="mpr_report_pdf_data!=null || mpr_report_pdf_data!=undefined" layout="row" flex layout-align="center center" style="margin-bottom:100px;">
            <table  border="1"  class="dtable" WIDTH="930">
                <tr>
                    <th width="100">For the Month of</th>
                    <td width="250">{{mpr_reports_pdfs.date}}</td>
                    <th width="100">Time</th>
                    <td width="250">{{mpr_reports_pdfs.time}}</td>
                </tr>
                <tr>
                    <th width="100">Branch</th>
                    <td width="250">{{user_branch_name}}</td>
                    <th width="100">Department</th>
                    <td width="250">BioMedical</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div style="float:left;margin-right:30px;">
                            <b style="border-bottom:1px solid #000;">A] NON SCHEDULED CALLS </b>
                            <table border="1" valign="top" width="450">
                                <tr>
                                    <th></th>
                                    <th>  B/F </th>
                                    <th>  Added </th>
                                    <th>  Total </th>
                                    <th> Comp. </th>
                                </tr>
                                <tr>
                                    <th>Biomedical Direct</th>
                                    <td></td>
                                    <td>{{mpr_reports_pdf.no_of_B_bkdwns}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Bbd}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Bbd}}</td>
                                </tr>
                                <tr>
                                    <th>Warranty B/D</th>
                                    <td></td>
                                    <td>{{mpr_reports_pdf.no_of_W_bkdwns}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Wbd}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Wbd}}</td>

                                </tr>
                                <tr>
                                    <th>Contract  B/D</th>
                                    <td></td>
                                    <td>{{mpr_reports_pdf.no_of_C_bkdwns}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Cbd}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Cbd}}</td>
                                </tr>
                                <tr>
                                    <th>Other Support(NS)*</th>
                                    <td></td>
                                    <td>{{mpr_reports_pdf.no_of_N_bkdwns}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Nbd}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Nbd}}</td>
                                </tr>
                                <tr>
                                    <th>TOTALS</th>
                                    <td>0</td>
                                    <td>{{mpr_reports_pdf.tot_subtotal_bkdwms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_subtotal_bkdwms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_subtotal_bkdwms}}</td>
                                </tr>
                            </table>
                            <span>other Support jobs must be documented and available for audit</span>
                        </div>
                        <div style="float:left;margin-right:10px;">
                            <b style="border-bottom:1px solid #000;">A1-Response Time (RT)</b>
                            <table border="1" valign="top" width="200">
                                <tr valign="top">
                                    <th><10min</th>
                                    <th><60 mins</th>
                                    <th>>60 mins</th>
                                </tr>
                                <tr>
                                    <td>{{mpr_reports_pdfs.total_lt_10}}</td>
                                    <td>{{mpr_reports_pdfs.total_lt_60}}</td>
                                    <td>{{mpr_reports_pdfs.total_gt_60}}</td>
                                </tr>
                            </table>
                        </div>
                        <div style="float:left;">
                            <b style="border-bottom:1px solid #000;">A2- Time To Repair-(TTR)</b>
                            <table border="1" width="200">
                                <tr valign="top">
                                    <th><1D</th>
                                    <th><3D</th>
                                    <th>>3D</th>
                                </tr>
                                <tr>
                                    <td>{{mpr_reports_pdfs.total_lt_1d}}</td>
                                    <td>{{mpr_reports_pdfs.total_lt_3d}}</td>
                                    <td>{{mpr_reports_pdfs.total_gt_3d}}</td>

                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div style="float:left;margin-right:30px;">
                            <b style="border-bottom:1px solid #000;"> B] SCHEDULED CALLS</b>
                            <table border="1" width="450">
                                <tr>
                                    <th></th>
                                    <th>B/F</th>
                                    <th>Added</th>
                                    <th>Total</th>
                                    <th>Comp.</th>
                                </tr>
                                <tr>
                                    <th>New Installations</th>
                                    <td>{{mpr_reports_pdf.no_of_N_pms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Npms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Npms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Npms}}</td>
                                </tr>
                                <tr>
                                    <th>Comp.Warranty PMS</th>
                                     <td>{{mpr_reports_pdf.no_of_W_pms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Wpms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Wpms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Wpms}}</td>

                                </tr>
                                <tr>
                                    <th>Comp.Contract PMS</th>
                                    <td>{{mpr_reports_pdf.no_of_C_pms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Cpms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Cpms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Cpms}}</td>
                                </tr>
                                <tr>
                                    <th>Biomedical PMS</th>
                                    <td>{{mpr_reports_pdf.no_of_B_pms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Bpms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Bpms}}</td>
                                    <td>{{mpr_reports_pdfs.tot_no_Bpms}}</td>
                                </tr>
                                <tr>
                                    <th>Daily Rounds </th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div style="flaot:left;">
                            <b style="border-bottom:1px solid #000;">C] TOTAL TRAININGS SESSIONS</b>
                            <table border="1" width="450">
                                <tr>
                                    <th></th>
                                    <th>Sessions</th>
                                    <th>Trainees</th>
                                </tr>
                                <tr>
                                    <th>BME Sessions with Trainees</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>OJT to Engineers by BME</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Vendor Trainings to BME/Technicians</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>BME Training to Technicians</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Trainings done on Rounds</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td border="1" colspan="4">
                        <div style="float:left;margin-right:30px;">
                            <b style="border-bottom:1px solid #000;">D] RT / TTR -Cause Codes(CC)</b>
                            <BR><span>(Mention CC against each RT >60mins && TTR>3days)</span>
                            <table border="1" width="450">
                           <tr ng-repeat="cause_code in cause_codes">
                                   <td>{{$index+1}} - {{cause_code.CAUSE}}</td>
                               </div>
                           </tr>
                            </table>
                        </div>
                        <div style="float:left;">
                            <b style="border-bottom:1px solid #000;">D1]  Reasons for delay(RT>60M & TTR>3D)</b>
                            <br><br>
                            <table border="1" width="200">
                                <tr>
                                    <th colspan="2" style="text-align:center"> RT>60mins</th>
                                </tr>
                                <tr>
                                    <th>NOS</th>
                                    <th>CC(no,cc,no,cc)</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>{{mpr_reports_pdfs.response_gt_60}}</td>
                                </tr>
                            </table>
                        </div>
                        <div style="float:left;">
                            <br><br>
                            <table border="1" width="200">
                                <tr>
                                    <th colspan="2" style="text-align:center">TTR>3Days</th>
                                </tr>
                                <tr>
                                    <th>NOS</th>
                                    <th>CC(no,cc,no,cc)</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>{{mpr_reports_pdfs.ttr_gt_3d}}</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div style="float:left;margin-right:30px;">
                            <b style="border-bottom:1px solid #000;">E] ASSETS</b>
                            <table border="1" width="450">
                                <tr>
                                    <th></th>
                                    <th>Nos</th>
                                    <th>Value of Eq.</th>

                                </tr>
                                <tr>
                                    <th>a) New Installation</th>
                                    <td>{{mpr_reports_pdfs.no_of_Instals_count}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>b) Eq under Warranty</th>
                                    <td>{{assets_cnt.Warranty}}</td>
                                    <td>{{Assets.Warranty}}</td>
                                </tr>
                                <tr>
                                    <th>c) Eq under Contract</th>
                                    <td>{{assets_cnt.CMC}}</td>
                                    <td>{{Assets.CMC}}</td>
                                </tr>
                                <tr>
                                    <th>
                                        d) Eq under Biomedical
                                    </th>
                                    <td>{{assets_cnt.Biomedical}}</td>
                                    <td>{{Assets.Biomedical}}</td>
                                </tr>
                                <tr>
                                    <th>
                                        E) Eq under AMC
                                    </th>
                                    <td>{{assets_cnt.AMC}}</td>
                                    <td>{{Assets.AMC}}</td>
                                </tr>
                                <tr>
                                    <th>
                                        e) Total Assets and Value
                                    </th>
                                    <td>{{assets_cnt.total}}</td>
                                    <td>{{Assets.total}}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Equipments on Rentals/Demo(Nos)</th>
                                    <td>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div style="float:left">
                            <b style="border-bottom:1px solid #000;">F] MANPOWER</b>
                            <table border="1" width="450">
                                <tr>
                                    <th></th>
                                    <th>BME</th>
                                    <th>TR</th>
                                </tr>
                                <tr>
                                    <th>Number of Engineers sanctioned for Unit</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Number of Engineers available this month</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Holidays in the Month</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Man days Available</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>MD on Training/Meets/OS/Rounds</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Manpower /IB--MP/Asset Value</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b style="border-bottom:1px solid #000;">G] REPLACEMENTS</b>
                            <table border="1" width="930">
                                <tr>
                                    <th></th>
                                    <th>Nos</th>
                                    <th>BUDGET(LAKHS)</th>
                                    <th>NUMBERS RELEASED</th>
                                    <th>PO VALUE</th>
                                    <th>BALANCE<br>(NO/VALUE)</th>
                                </tr>
                                <td>
                                    EQUIPMENTS
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div style="float:left;margin-right:30px;">
                            <b style="border-bottom:1px solid #000;">H] EXPENSES</b>
                                <table border="1" width="450">
                                    <tr>
                                        <th></th>
                                        <th>NOS</th>
                                        <th>VAL (K)</th>
                                    </tr>
                                    <tr>
                                        <th>1) NABH DONE</th>
                                        <td>{{qcdone_cnt}}</td>
                                        <td>{{qcdone_cost}}</td>
                                    </tr>
                                    <tr>
                                        <th>2) SPARES</th>
                                        <td>{{spares_cnt}}</td>
                                        <td>{{spares_cost}}</td>
                                    </tr>
                                    <tr>
                                        <th>3) SERVICE</th>
                                        <td>{{services_cost}}</td>
                                        <td>{{services_cost}}</td>
                                    </tr>
                                    <tr>
                                        <th>4)ACCESSORIES</th>
                                        <td>{{accessories_cnt}}</td>
                                        <td>{{accessories_cost}}</td>
                                    </tr>
                                    <tr>
                                        <th>5) CONSUMABLES</th>
                                        <td>{{consubble_cnt}}</td>
                                        <td>{{consubble_cost}}</td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL</th>
                                        <td>{{astotalcount}}</td>
                                        <td>{{astotalcost}}</td>
                                    </tr>
                                </table>
                        </div>
                        <div style="float:left;">
                            <b style="border-bottom:1px solid #000;">I] ACTIVITIES</b>
                            <table border="1" width="450">
                                <tr>
                                    <th></th>
                                    <th>NOS</th>
                                    <th>VALUE</th>
                                </tr>
                                <tr>
                                    <th>GRN's DONE</th>
                                    <td>{{grn_count}}</td>
                                    <td>{{grn_cost}}</td>

                                </tr>
                                <tr>
                                    <th>ADVERSE INCIDENTS REPORTED</th>
                                    <td>{{incidents_count}}</td>
                                    <td>{{incidents_cost}}</td>
                                </tr>
                                <tr>
                                    <th>EQ.DEPLOYMENTS</th>
                                    <td>{{eq_count}}</td>
                                    <td>{{eq_cost}}</td>
                                </tr>
                                <tr>
                                    <th>EQUIPMENTS CONDEMNED</th>
                                    <td>{{condem_count}}</td>
                                    <td>{{condem_cost}}</td>
                                </tr>
                                <tr>
                                    <th>MEETING ATTENDED - HOD,MD,CHA(Nos.)</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>CRITICAL EQUIPMENT UPTIME(%)</th>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div style="float:left">
                            <b style="border-bottom:1px solid #000;FONT-SIZE:20PX;"> MONTHLY PERFORMANCE REPORT</b><BR>
                            <b style="border-bottom:1px solid #000;">J] CONTRACTS</b>


                            <table border="1" WIDTH="930">
                                <tr>
                                    <th>NO</th>
                                    <th></th>
                                    <th>NOS</th>
                                    <th>  CONT.VALUE  </th>
                                    <th>COMMENTS/NOTES/REASONS</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <th>TOTAL LIVE CONTRACTS BF</th>
                                    <td>{{tlc_count}}</td>
                                    <td>{{tlc_cost}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>2</td>
                                    <th>EXPIRED CONTRACTS (till last month)</th>
                                    <td>{{exc_count}}</td>
                                    <td>{{exc_sum}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>3</td>
                                    <th>EXPIRED WARRANTY (till last month)</th>
                                    <td>{{exw_count}}</td>
                                    <td>{{exw_sum}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>4</td>
                                    <th>CONTRACTS expired and sent for renewal</th>
                                    <td>{{cesr_count}}</td>
                                    <td>{{cesr_sum}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>5</td>
                                    <th>WARRANTY expired and sent for CONT.</th>
                                    <td>{{wesr_count}}</td>
                                    <td>{{wesr_sum}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>6</td>
                                    <th>WARR. TO CONTRACTS NOT DESIRED</th>
                                    <td>{{wcnd_count}}</td>
                                    <td>{{wcnd_sum}}</td>

                                    <td></td>

                                </tr>
                                <tr>
                                    <td>7</td>
                                    <th>CONTRACT renewals NOT DESIRED</th>
                                    <td>{{crnd_count}}</td>
                                    <td>{{crnd_sum}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>8</td>
                                    <th>CONT RENEWALS DONE since last month </th>
                                    <td>{{crlm_count}}</td>
                                    <td>{{crlm_sum}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>9</td>
                                    <th>CONTRACT RENEWALS PENDING</th>
                                    <td>{{crp_count}}</td>
                                    <td>{{crp_sum}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>10</td>
                                    <th>CONTRACTS EXPIRING in coming month</th>
                                    <td>{{eccm_count}}</td>
                                    <td>{{eccm_sum}}</td>
                                    <td></td>


                                </tr>
                                <tr>
                                    <td>11</td>
                                    <th>WARRANTY EXPIRING in coming month</th>
                                    <td>{{ewcm_count}}</td>
                                    <td>{{ewcm_sum}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>12</td>
                                    <th>CONT's (TO BE) INDENTED FOR RENEWAL</th>
                                    <td>{{cir_count}}</td>
                                    <td>{{cir_sum}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>13</td>
                                    <th>TOTAL CONTRACT RENEWALS PENDING</th>
                                    <td>{{tcrp_count}}</td>
                                    <td>{{tcrp_sum}}</td>
                                    <td></td>
                                </tr>
                            </table>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div style="float:left;">
                            <b style="border-bottom:1px solid #000;">K] Engineers Productivity</b>
                            <table border="1" width="930">
                                <tr>
                                    <th>NO</th>
                                    <th>ENGR</th>
                                    <th>CALLS</th>
                                    <th>ROUNDS</th>
                                    <th>TRAININGS</th>
                                    <th>PMS</th>
                                    <th>TOT NO OF<BR>TRIPS </th>
                                    <th>TOT .TIME<BR>(Hrs) </th>
                                    <th>LEADER'S COMMENTS </th>
                                </tr>
                                <tr ng-repeat="user_call in user_calls">
                                    <td>{{$index+1}}</td>
                                    <td>{{user_call.name}}</td>
                                    <td>{{user_call.cms_cnt}}</td>
                                    <td>{{user_call.rounds_cnt}}</td>
                                    <td>{{user_call.trngs_cnt}}</td>
                                    <td>{{user_call.pms_cnt}}</td>
                                    <td>{{user_call.total_trips}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div style="float:left;">
                            <b style="border-bottom:1px solid #000;">L] NABH READINESS</b>
                            <table border="1" width="930">
                                <tr>
                                    <th></th>
                                    <th>MON/VENT/ANES</th>
                                    <th>ECG/DIATH/DEFIB</th>
                                    <th>DIALYSIS/ETC</th>
                                    <th>SY-INF PUMPS</th>
                                    <th>LAB EQPMTS </th>
                                    <th>RAD/CAT/H </th>
                                    <th>STER/OTHERS </th>
                                    <th>TOTAL </th>
                                </tr>
                                <tr>
                                    <th>NABH Calibration Numbers</th>
                                    <td>{{count[0]}}</td>
                                    <td>{{count[1]}}</td>
                                    <td>{{count[2]}}</td>
                                    <td>{{count[3]}}</td>
                                    <td>{{count[4]}}</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>{{total_count_eqps}}</td>
                                </tr>
                                <tr>
                                    <th>NABH Calibration Cost </th>
                                    <td>{{cost[0]}}</td>
                                    <td>{{cost[1]}}</td>
                                    <td>{{cost[2]}}</td>
                                    <td>{{cost[3]}}</td>
                                    <td>{{cost[4]}}</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>{{total_cost_eqps}}</td>
                                </tr>
                                <tr>
                                    <th>NABH Calibration done dt </th>
                                    <td>{{count[0]}}</td>
                                    <td>{{count[1]}}</td>
                                    <td>{{count[2]}}</td>
                                    <td>{{count[3]}}</td>
                                    <td>{{count[4]}}</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>{{total_count_eqps}}</td>
                                </tr>
                                <tr>
                                    <th>NABH Calibration next due dt </th>
                                    <td>{{count[0]}}</td>
                                    <td>{{count[1]}}</td>
                                    <td>{{count[2]}}</td>
                                    <td>{{count[3]}}</td>
                                    <td>{{count[4]}}</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>{{total_count_eqps}}</td>
                                </tr>
                            </table>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div style="float:left;">
                            <b style="border-bottom:1px solid #000;">M] SAVINGS<BR>(In thousands)</b>
                            <table border="1" width="930">
                                <tr>
                                    <th></th>
                                    <th>Nos.</th>
                                    <th>Outside Expenses</th>
                                    <th>Cost of Part Repaired</th>
                                    <th>Month Disallowed</th>
                                    <th>YTD Disallowed </th>
                                    <th>Remarks </th>
                                    <th>Month Savings </th>
                                    <th>YTD Savings </th>
                                </tr>
                                <tr>
                                    <th>IN-HOUSE REPAIRS</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>INDIRECT SAVINGS </th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </table>
                        </div>
                </tr>
               <tr>
                   <td colspan="4">
                       <br>
                        <table width="930" border="1">
                            <tr align="center">
                                <th style="text-align: center !important;">N] Significant Achievements/Support Required/Quality Issues/Any Other inputs</th>
                            </tr>
                            <tr rowsapn="5">
                                <td colspan="4"></td>
                            </tr>
                        </table>  <br>
                   </td>
               </tr>
            </table>
        </div>
    </div>

    </div>
</md-content>
