<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Monthly Performance Report Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()" style="color:#000 !important;">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <div layout="row" layout-align="end center" flex="100" style="margin-top:10px;">
        <button ng-click="printPdf()" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</button>
    </div>

    <md-content>
        <div id="exportthis" style="height:100%">
            <div layout="row"  flex style="margin-bottom:5px;">
                <div layout-align="center center" flex="100">
                    <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                            BIOMEDICAL ENGINEERING DEPARTMENT<br>
                            MONTHLY PERFORMANCE REPORT</center></h5>
                </div>
                <div layout-align="end end" flex="0">
                    <img style="float:right" src="<?php echo base_url();?>assets/images/carepdflogo.jpg">
                </div>
            </div>
            <div layout="row" layout-align="center center" flex="100" >
                <div flex="100">
                    <table  border="2" width="100%" class="dtable">
                        <tr>
                            <th width="250">Date</th>
                            <td>{{deployemnt_report_pdf.DATEOF_INSTALL}}</td>
                            <th width="250">Time</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th width="250">Department</th>
                            <td>{{deployemnt_report_pdf.department}}</td>
                            <th width="250">Branch</th>

                            <td>{{deployemnt_report_pdf.branchname}}</td>
                        </tr>
                        <tr>
                            <td>
                                A] NON SCHEDULED CALLS
                                <table>
                                    <tr>
                                        <th></th>
                                    <th> B/F </th>
                                    <th>  Added </th>
                                    <th>  Total </th>
                                    <th> Comp </th>
                                    </tr>
                                    <tr>
                                        <th>Biomediacal Direct</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Warenty B/D</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Contract  B/D</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Other Support(NS)*</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>TOTALS</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <span>other Support jobs must be documented and available for audit</span>
                            </td>
                            <td>
                                A1-Response Time (RT)
                                <table>
                                    <tr>
                                        <th>>10min</th>
                                        <th><60 mins</th>
                                        <th><60 mins/th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                A2- Time To Repair-(TTR)
                                <table>
                                    <tr>
                                        <th><1D</th>
                                        <th><3D</th>
                                        <th>>3D/th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </md-content>