<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">CMS Reports</h3>
        <div layout-gt-sm="row" layout="row" >
            <div layout="row" flex style="margin-bottom:5px;">
                <div layout-align="center center" flex="100">
                    <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                            BIOMEDICAL ENGINEERING DEPARTMENT<br>
                            CALL MANAGEMENT REPORT</center></h5>
                </div>
                <div layout-align="end end" flex="0">
                    <img style="float:right" src="<?php echo base_url();?>assets/images/carepdflogo.jpg">
                </div>
            </div>
        </div>
        <div class="row" layout-align="center center">
            <div layout="row" layout-align="center center" flex="98" style="margin:10px;">
                <div flex="100">
                    <table border="2" width="100%" class="dtable">
                        <tr>
                            <th width="100">Date</th>
                            <td colspan="2">{{myDate | date : "dd-MM-yy"}}</td>
                            <th width="100">Time</th>
                            <td colspan="2">{{myDate | date : "hh:mm a"}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Location</th>
                            <td colspan="2">{{user_branch_name}}</td>
                            <th colspan="1">Department</th>
                            <td colspan="2">{{}}</td>
                        </tr>
                        <tr>
                            <th width="150">CARE HOSPITALS</th>
                            <th width="400" colspan="3" style="text-align:center">CALL MANAGEMENT REPORT</th>
                            <th width="400" colspan="2" style="text-align:right;padding-right:15px;">BIOMEDICAL ENGINEERS</th>
                        </tr>
                        <tr>
                            <th colspan="1">
                                <table  border="0">
                                    <tr>
                                        <th width="100">UNIT</th>
                                    </tr>
                                    <tr  ng-repeat="cms_report in cms_reports">
                                        <td width="200">{{cms_report.BRANCH_NAME}}</td>
                                    </tr>
                                </table>
                            </th>
                            <th style="text-align:center">NON-SCHEDULED CALLS
                                <table   border="1" style="margin:0px -47px -8px -11px">
                                    <thead>
                                    <tr>
                                        <th>B-BD</th>
                                        <th>W-BD</th>
                                        <th>A-BD</th>
                                        <th>C-BD</th>
                                        <th>OS</th>
                                        <th>SUM TOT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr  ng-repeat="cms_report in cms_reports">
                                        <td>{{cms_report.no_of_B_bkdwns}}</td>
                                        <td>{{cms_report.no_of_W_bkdwns}}</td>
                                        <td>{{cms_report.no_of_A_bkdwns}}</td>
                                        <td>{{cms_report.no_of_C_bkdwns}}</td>
                                        <td>{{cms_report.no_of_N_bkdwns}}</td>
                                        <td>{{cms_report.no_tot_bkdwn_total}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </th>
                            <th style="text-align:center">SCHEDULED CALLS
                                <table  border="1" style="margin:0px -55px -8px -11px">
                                    <thead>
                                    <tr>
                                        <th>INSTAL</th>
                                        <th>W-PMS</th>
                                        <th>C-PMS</th>
                                        <th>A-PMS</th>
                                        <th>OS</th>
                                        <th>SUM TOT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr  ng-repeat="cms_report in cms_reports">
                                        <td></td>
                                        <td>{{cms_report.no_of_W_pms}}</td>
                                        <td>{{cms_report.no_of_C_pms}}</td>
                                        <td>{{cms_report.no_of_A_pms}}</td>
                                        <td>{{cms_report.no_of_N_pms}}</td>
                                        <td>{{cms_report.no_tot_pms_total}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </th>
                            <th style="text-align:center">CALLS
                                <table  border="1"  style="margin:0px -50px -8px -11px;">                                                 <thead>
                                    <tr>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="cms_report in cms_reports">
                                        <td>{{cms_report.no_calls_total}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </th>
                            <th  width="250"style="text-align:center">RESPONSE TIME (RT-MINUTES)
                                <table  border="1" style="margin:0px -150px -3px -11px">
                                    <thead>
                                    <tr>
                                        <th width="50"> < 10</th>
                                        <th width="50"> < 60</th>
                                        <th width="50"> >60</th>
                                        <th width="50"> % < 10</th>
                                        <th width="50"> % > 60</th>
                                    </tr>
                                    <tbody>
                                    </thead>
                                    <tr ng-repeat="cms_report in cms_reports">
                                        <td>{{cms_report.response_lt_10}}</td>
                                        <td>{{cms_report.response_lt_60}}</td>
                                        <td>{{cms_report.response_gt_60}}</td>
                                        <td>{{cms_report.response_time_lt_10pcs}}</td>
                                        <td>{{cms_report.response_time_lt_60pcs}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </th>
                            <th style="text-align:center">TIME TO REPARIES
                                <table width="244" border="1" style="margin:0px -40px -3px -11px">
                                    <thead>
                                    <tr>
                                        <th width="55">  < 1D</th>
                                        <th width="55">  < 3D</th>
                                        <th width="55">  > 3D</th>
                                        <th width="55"> % < 1D</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="cms_report in cms_reports">
                                        <td>{{cms_report.ttr_lt_1d}}</td>
                                        <td>{{cms_report.ttr_lt_3d}}</td>
                                        <td>{{cms_report.ttr_gt_3d}}</td>
                                        <td>{{cms_report.ttr_lt_1d_inpcs}}</td>
                                    </tr>
                                    </tbody>

                                </table>
                            </th>
                        </tr>
                        <tr>
                            <th>TOATL</th>
                            <td>
                                <table border="1">
                                    <tr>
                                        <td width="40">{{cms_reports.tot_no_Bbd}}</td>
                                        <td width="40">{{cms_reports.tot_no_Wbd}}</td>
                                        <td width="40">{{cms_reports.tot_no_Abd}}</td>
                                        <td width="40">{{cms_reports.tot_no_Cbd}}</td>
                                        <td width="40">{{cms_reports.tot_no_Nbd}}</td>
                                        <td width="40">{{cms_reports.tot_subtotal_Bbd}}</td>
                                        <!--     <td width="40">{{cms_reports.total_lt_10}}</td>
                                             <td width="40">{{cms_reports.total_lt_60}}</td>
                                             <td width="40">{{cms_reports.total_gt_60}}</td>
                                             <td width="40">{{cms_reports.total_lt_10_pcs}}</td>
                                             <td width="40">{{cms_reports.total_lt_60_pcs}}</td>-->
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;" colspan="6"> ABBEV:B / BIOMED=DEPT DIRECT CALLS WAR=WARRANTY,BD=BREAKDOWN,CO=CONTRACT,PMS=PREVENTIVE MAINTENANCE,D=DAY,INSTL=INSTALLATIONS,OS=Other Support Request</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</md-content>