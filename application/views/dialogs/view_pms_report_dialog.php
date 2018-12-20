<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock flex>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Pms Report Details </h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()" style="color:#000 !important;">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-dialog-content flex="100">
        <div layout="row" layout-align="end end" flex="100">
            <button ng-click="printPdf()" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</button>
        </div>
        <div class="md-dialog-content" layout="column" id="exportthis" flex>
            <div layout="row" flex style="margin-bottom:5px;">
                <div layout-align="center center" flex="100">
                    <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                            BIOMEDICAL ENGINEERING DEPARTMENT<br>
                            PREVENTIVE MAINTENANCE REPORT</center></h5>
                </div>
                <div layout-align="end end" flex="0">
                    <img style="float:right" src="<?php echo base_url();?>assets/images/carepdflogo.jpg">
                </div>
            </div>
            <div layout="row" layout-align="center center" flex="100">
                <div flex="100">
                    <table  border="2" width="100%" class="dtable">
                        <tr>
                            <th width="250">Date</th>
                            <td>{{pms_reports_pdf.PMS_DONE}}</td>
                            <th width="250">Time</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th width="250">Department</th>
                            <td>{{pms_reports_pdf.department}}</td>
                            <th width="250">Branch</th>
                            <td>{{pms_reports_pdf.branch_name}}</td>
                        </tr>
                        <tr>

                            <th width="250" colspan="1">Equipment ID</th>
                            <td colspan="3">{{pms_reports_pdf.EID}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1">Equipment Name</th>
                            <td colspan="3">{{pms_reports_pdf.equp_name}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1">Model</th>
                            <td colspan="3">{{pms_reports_pdf.model}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1">SL.NO</th>
                            <td colspan="3">{{pms_reports_pdf.es_number}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1">Preventive Maintenance</th>
                            <td colspan="3">{{pms_reports_pdf.PRE_PMS_DETAILS}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1">PMS Done on</th>
                            <td colspan="1">{{pms_reports_pdf.PMS_DONE}}</td>
                            <th width="250" colspan="1">PMS Due Date</th>
                            <td colspan="1">{{pms_reports_pdf.PMS_DUE_DATE}} </td>
                        </tr>
                        <tr height="70" valign="top">
                            <th width="250" colspan="1">Engineers Observation</th>
                            <td colspan="3">{{pms_reports_pdf.ASSIGN_REMARKS}}</td>
                        </tr>
                        <tr height="70" valign="top">
                            <th width="250" colspan="1">Remarks/status</th>
                            <td colspan="3">{{pms_reports_pdf.COMPLETED_REMARKS}}</td>
                        </tr>

                        <tr height="70 !important" valign="bottom">
                            <td  colspan="2">USER DEPT HOD SIGNATURE</td>
                            <td  colspan="2" style="text-align:right;padding-right:15px">UNIT HEAD SIGNATURE</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </md-dialog-content>
</md-dialog>