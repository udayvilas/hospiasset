<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Asset Mangement and Other Activities Reports</h3>
        <div layout="row" layout-align="end center" flex="100">
            <a href="<?php echo base_url('reports/asset_management_other_activites'); ?>" target="_blank" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</a>
        </div>
        <div id="exportthis">
            <!--        <div layout="row" flex style="margin-bottom:5px;">
                    <div layout-align="center center" flex="100">
                        <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                                BIOMEDICAL ENGINEERING DEPARTMENT<br>
                                CALL MANAGEMENT REPORT</center></h5>
                    </div>
                    <div layout-align="end end" flex="0">
                        <img style="float:right" src="<?php /*echo base_url();*/?>assets/images/carepdflogo.jpg">
                    </div>
                </div>-->

            <div class="row" layout-align="center center">
                <div layout="row" layout-align="center center" flex="98" style="margin:10px;">
                    <div flex="100">
                        <center>
                            <table style="border-collapse:collapse;border:1px solid #000000;" border="1">
                                <tr>
                                    <td colspan="5">CARE HOSPITALS</td>
                                    <td colspan="15">Asset Management and other Activities</td>
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
                                        <td style="text-align:center;" colspan="30">SPR-Spares,SER=-Service,ACC=Accessories,CONS-Consumables
                                        </td>
                                    </tr>
                            </table>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</md-content>