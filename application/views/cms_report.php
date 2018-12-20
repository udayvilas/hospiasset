<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">CMS Reports</h3>

        <div layout="row" layout-align="start start" flex="100">
            <mdp-date-picker ng-model="cms_report_search.fromdate" mdp-placeholder="From Date" mdp-format="DD-MM-YYYY" flex="15" mdp-max-date="minDate">
            </mdp-date-picker>

            <div flex="5" hide-xs hide-sm></div>

            <mdp-date-picker ng-model="cms_report_search.todate" mdp-placeholder="To Date" flex="15" mdp-max-date="maxDate" mdp-format="DD-MM-YYYY" mdp-min-date="cms_report_search.fromdate">
            </mdp-date-picker>
            <div flex="5" hide-xs hide-sm></div>
    <md-button class="md-icon-button md-raised md-accent" ng-click="loadCMSReports()"  md-theme="default" aria-label="submit">
        <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
    </md-button>
            <div flex="55" hide-xs hide-sm></div>
		
           <div ng-show="Cms_Pdf_Report==Generate PDF" layout-align="end end"> <a href="<?php echo base_url('reports/cms_report_pdf'); ?>" target="_blank" class="md-raised md-accent md-button md-ink-ripple">Export</a></div>
        </div>
        <!--<div layout="row" flex style="margin-bottom:5px;">
                    <div layout-align="center center" flex="100">
                        <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                                BIOMEDICAL ENGINEERING DEPARTMENT<br>
                                CALL MANAGEMENT REPORT</center></h5>
                    </div>
                    <div layout-align="end end" flex="0">
                        <img style="float:right" src="<?php /*echo base_url();*/?>assets/images/carepdflogo.jpg">
                    </div>
        </div>-->

            <div class="row" layout-align="center center" flex="100">
                <center>
                <div layout="row" layout-align="center center" flex="100" style="margin:10px;">
                        <table style="border-collapse:collapse;border:1px solid #000000;" border="1">
                            <tr>
                                <td colspan="5">CARE HOSPITALS</td>
                                <td colspan="15">CMS REPORT    <?php echo date('M-Y')?></td>
                                <td colspan="5">BME Department</td>
                            </tr>
                            <tr>

                                <td rowspan="2">NO</td>
                                <td rowspan="2">UNIT</td>
                                <td colspan="6">NON SCHEDULED CALLS</td>
                                <td colspan="7">SCHEDULED CALLS</td>
                                <td colspan="1">CALLS</td>
                                <td colspan="5">RESPONSE TIME</td>
                                <td colspan="4">TIME TO REPAIR</td>
                            </tr>
                            <tr>
                                <td>A-BD</td>
                                <td>B-BD</td>
                                <td>W-BD</td>
                                <td>C-BD</td>
                                <td>OS</td>
                                <td>SUB-TOT</td>
                                <td>INSTL</td>
                                <td>W-PMS</td>
                                <td>A-PMS</td>
                                <td>C-PMS</td>
                                <td>B-PMS</td>
                                <td>OS</td>
                                <td>SUB-TOT</td>
                                <td>TOTAL</td>
                                <td><10</td>
                                <td><60</td>
                                <td>>60</td>
                                <td>% < 10</td>
                                <td>% > 60</td>
                                <td>< 1D</td>
                                <td>< 3D</td>
                                <td>> 3D</td>
                                <td>%<1D</td>
                            </tr>
                            <tr  ng-repeat="cms_report in cms_reports">
                                <td>{{$index + 1}}</td>
                                <td>{{cms_report.BRANCH_NAME}}</td>
                                <td>{{cms_report.no_of_A_bkdwns}}</td>
                                <td>{{cms_report.no_of_B_bkdwns}}</td>
                                <td>{{cms_report.no_of_W_bkdwns}}</td>
                                <td>{{cms_report.no_of_C_bkdwns}}</td>
                                <td>{{cms_report.no_of_N_bkdwns}}</td>
                                <td>{{cms_report.no_tot_bkdwn_total}}</td>
                                <td>0</td>
                                <td>{{cms_report.no_of_W_pms}}</td>
                                <td>{{cms_report.no_of_A_pms}}</td>
                                <td>{{cms_report.no_of_C_pms}}</td>
                                <td>{{cms_report.no_of_B_pms}}</td>
                                <td>{{cms_report.no_of_N_pms}}</td>
                                <td>{{cms_report.no_tot_pms_total}}</td>
                                <td>{{cms_report.no_calls_total}}</td>
                                <td>{{cms_report.response_lt_10}}</td>
                                <td>{{cms_report.response_lt_60}}</td>
                                <td>{{cms_report.response_gt_60}}</td>
                                <td>{{cms_report.response_time_lt_10pcs}}</td>
                                <td>{{cms_report.response_time_lt_60pcs}}</td>
                                <td>{{cms_report.ttr_lt_1d}}</td>
                                <td>{{cms_report.ttr_lt_3d}}</td>
                                <td>{{cms_report.ttr_gt_3d}}</td>
                                <td>{{cms_report.ttr_lt_1d_inpcs}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Total</td>
                                <td>{{cms_reports.tot_no_Abd}}</td>
                                <td>{{cms_reports.tot_no_Bbd}}</td>
                                <td>{{cms_reports.tot_no_Wbd}}</td>
                                <td>{{cms_reports.tot_no_Cbd}}</td>
                                <td>{{cms_reports.tot_no_Nbd}}</td>
                                <td>{{cms_reports.tot_subtotal_bkdwms}}</td>
                                <td>0</td>
                                <td>{{cms_reports.tot_no_Wpms}}</td>
                                <td>{{cms_reports.tot_no_Apms}}</td>
                                <td>{{cms_reports.tot_no_Cpms}}</td>
                                <td>{{cms_reports.tot_no_Bpms}}</td>
                                <td>{{cms_reports.tot_no_Npms}}</td>
                                <td>{{cms_reports.tot_subtotal_pms}}</td>
                                <td>{{cms_reports.total_calls_total}}</td>
                                <td>{{cms_reports.total_lt_10}}</td>
                                <td>{{cms_reports.total_lt_60}}</td>
                                <td>{{cms_reports.total_gt_60}}</td>
                                <td>{{cms_reports.total_lt_10_pcs}}</td>
                                <td>{{cms_reports.total_lt_60_pcs}}</td>
                                <td>{{cms_reports.total_lt_1d}}</td>
                                <td>{{cms_reports.total_lt_3d}}</td>
                                <td>{{cms_reports.total_gt_3d}}</td>
                                <td>{{cms_reports.total_lt_1d_pcs}}</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;" colspan="25"> ABBEV:B / BIOMED=DEPT DIRECT CALLS WAR=WARRANTY,BD=BREAKDOWN,CO=CONTRACT,PMS=PREVENTIVE MAINTENANCE,D=DAY,INSTL=INSTALLATIONS,OS=Other Support Request</td>
                            </tr>
                        </table>
                </div>
                </center>
            </div>
<br>
            <div class="row" layout-align="center center" flex="100">
                <center>
                <div layout="row" layout-align="center center" flex="100" style="margin:10px;">
                    <table style="border-collapse:collapse;border:1px solid #000000;" border="1">
                        <tr>
                            <td colspan="5">CARE HOSPITALS</td>
                            <td colspan="15">Asset Mangement and other Activies</td>
                            <td colspan="12">Biomedical Engineering Department</td>
                        </tr>
                        <tr>
                            <td rowspan="2">NO</td>
                            <td rowspan="2">UNIT</td>
                            <td rowspan="2">SAV<br>(000)</td>
                            <td colspan="2">Traning</td>
                            <td colspan="2">NABH</td>
                            <td colspan="5">EXPENSES(000)</td>
                            <td colspan="2">GRN's(L)</td>
                            <td colspan="2">ADVERSE INC</td>
                            <td colspan="2">CONTRACTS</td>
                            <td colspan="2">ASSETS</td>
                            <td colspan="2">PERCENT</td>
                            <td colspan="2">COND, Eq</td>
                            <td colspan="2">REPL (L)</td>
                            <td colspan="1">DEPLOYMENT</td>
                            <td colspan="1">MANPOWER</td>
                        </tr>
                        <tr>
                            <td>EVENT</td>
                            <td>PPL</td>
                            <td>NOS> </td>
                            <td>VAL</td>
                            <td>SPR</td>
                            <td>SER</td>
                            <td>ACC</td>
                            <td>CONS</td>
                            <td>TOT</td>
                            <td>NO</td>
                            <td>VAL</td>
                            <td>NO</td>
                            <td>VAL</td>
                            <td>NOS</td>
                            <td>VAL(L)</td>
                            <td>NOS</td>
                            <td>VAL(L)</td>
                            <td>NOS</td>
                            <td>VAL(C)</td>
                            <td>NOS</td>
                            <td>VAL</td>
                            <td>BUD</td>
                            <td>BAL</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr ng-repeat="assets_management in assets_managements">
                            <td>{{$index + 1}}</td>
                            <td>{{assets_management.BRANCH_NAME}}</td>
                            <td>{{assets_management.saving_cost}}</td>
                            <td>{{assets_management.trngs_count}}</td>
                            <td>{{assets_management.trngs_cost}}</td>
                            <td>{{assets_management.qcdone_cnt}}</td>
                            <td>{{assets_management.qcdone_cost}}</td>
                            <td>{{assets_management.spares_cost}}</td>
                            <td>{{assets_management.services_cost}}</td>
                            <td>{{assets_management.accessories_cost}}</td>
                            <td>{{assets_management.consuble_cost}}</td>
                            <td>{{assets_management.tot_spr_acc_ser_cons}}</td>
                            <td>{{assets_management.grn_count}}</td>
                            <td>{{assets_management.grn_cost}}</td>
                            <td>{{assets_management.incidents_count}}</td>
                            <td>{{assets_management.incidents_cost}}</td>
                            <td>{{assets_management.tlc_count}}</td>
                            <td>{{assets_management.conttacts_lachs}}</td>
                            <td>{{assets_management.count}}</td>
                            <td>{{assets_management.asset_in_lacs}}</td>
                            <td>{{assets_management.percent_cnt}}</td>
                            <td>{{assets_management.percent_in_crores}}</td>
                            <td>{{assets_management.condem_count}}</td>
                            <td>{{assets_management.condem_cost_lacks}}</td>
                            <td></td>
                            <td></td>
                            <td>{{assets_management.deployment_count}}</td>
                            <td>{{assets_management.mp_count}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Total</td>
                            <td>{{assets_managements.tot_no_savings}}</td>
                            <td>{{assets_managements.tot_no_Events}}</td>
                            <td>{{assets_managements.tot_no_ppls}}</td>
                            <td>{{assets_managements.tot_no_nabh_cnt}}</td>
                            <td>{{assets_managements.tot_no_nabh_cost}}</td>
                            <td>{{assets_managements.tot_no_expenses_sprs}}</td>
                            <td>{{assets_managements.tot_no_expenses_servcs}}</td>
                            <td>{{assets_managements.tot_no_expenses_accers}}</td>
                            <td>{{assets_managements.tot_no_expenses_cnsbls}}</td>
                            <td>{{assets_managements.tot_no_expenses_tot}}</td>
                            <td>{{assets_managements.tot_no_grns_cnt}}</td>
                            <td>{{assets_managements.tot_no_grns_cost}}</td>
                            <td>{{assets_managements.tot_no_adverse_cnt}}</td>
                            <td>{{assets_managements.tot_no_adverse_cost}}</td>
                            <td>{{assets_managements.tot_no_contracts_cnt}}</td>
                            <td>{{assets_managements.tot_no_contracts_cost}}</td>
                            <td>{{assets_managements.tot_no_assets_cnt}}</td>
                            <td>{{assets_managements.tot_no_assets_cost}}</td>
                            <td>{{assets_managements.percnt_cost_tot}}</td>
                            <td>{{assets_managements.percent_crores}}</td>
                            <td>{{assets_managements.tot_no_cond_count}}</td>
                            <td>{{assets_managements.tot_no_cond_cost}}</td>
                            <td></td>
                            <td></td>
                            <td>{{assets_managements.tot_no_deplyment_count}}</td>
                            <td>{{assets_managements.tot_no_manpower_count}}</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;" colspan="30"> SPR-Spares,SER=-Service,ACC=Accessories,CONS-Consumables</td>
                        </tr>
                    </table>
                </div>
                </center>
            </div>
    </div>
</md-content>