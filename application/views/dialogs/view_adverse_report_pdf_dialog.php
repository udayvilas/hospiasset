<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
              <h4>Adverse Report Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()" style="color:#000 !important;">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <div layout="row" layout-align="end center" flex="100" style="margin-top:10px;">
        <button ng-click="printPdf()" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</button>
    </div>
    <md-dialog-content flex="100">
        <div class="md-dialog-content" id="exportthis" style="height:100%">
            <div layout="row"  flex style="margin-bottom:5px;">
                <div layout-align="center center" flex="100">
                <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                BIOMEDICAL ENGINEERING DEPARTMENT<br>
                INCIDENT REPORT</center></h5>
                </div>
                <div layout-align="end end" flex="0">
                <img style="float:right" src="<?php echo base_url();?>assets/images/carepdflogo.jpg">
                </div>
            </div>
            <div layout="row" layout-align="center center" flex="100" >
                <div flex="100"ng-repeat="view_adverse_report in view_adverse_reports">
                <table border="2" width="100%">
                    <tr>
                        <th width="450" colspan="2">DATE : {{view_adverse_report.COMPLETED_ON | date : "dd-MM-yy hh:mm a"}} </th>
                        <th width="450" colspan="2">TIME:{{view_adverse_report.TIME_OCCARANCE}} </th>
                    </tr>
                    <tr>
                        <th width="450" colspan="2">BRANCH : {{view_adverse_report.Branch_name}} </th>
                        <th width="450" colspan="3">DEPARTMENT : {{view_adverse_report.depart}} </th>
                    </tr>
                    <tr>
                        <th cospan="2"  height="40 !important"  width="300">DATE OF OCCURRENCE </th>
                        <td  cospan="2"> {{view_adverse_report.DATE_OCCRANCE}} </td>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr >
                        <th height="40 !important">NAME OF EQUIPMENT/SPARES </th>
                        <td>{{view_adverse_report.eq_name}}</td>
                        <th>TIME OF OCCURRENCE</th>
                        <td>{{view_adverse_report.OCCURRENCE}}</td>
                    </tr>
                    <tr height="40 !important">

                        <th>MODEL </th>
                        <td>{{view_adverse_report.model}}</td>
                        <th>RESPONDED BY</th>
                        <td>{{view_adverse_report.assigned_by}}</td>
                    </tr>
                    <tr>
                        <th height="40 !important">SERIAL NO </th>
                        <td>{{view_adverse_report.serial_no}}</td>
                        <th>COMPLETED BY</th>
                        <td>{{view_adverse_report.completed_by}}</td>
                    </tr>
                    <tr>
                        <th height="40 !important"> EQUP NO </th>
                        <td>{{view_adverse_report.EQUP_ID}}</td>
                        <th>INCIDENT TYPE </th>
                        <td>{{view_adverse_report.incidents_type}}</td>
                    </tr>
                    <tr valign="top">
                        <th height="70 !important">
                               CONTRACT TYPE <br>
                               WARANTY <br>
                        </th>
                        <td>{{view_adverse_report.type}}<br>
                            WARANTY <br>
                        </td>
                        <th>NAME OF STAFF INVOLVED</th>
                        <td height="70 !important">{{view_adverse_report.assigned_by}}, {{view_adverse_report.completed_by}}</td>
                    </tr>
                    <tr  valign="top">
                       <th height="40 !important" height="70 !important">INCIDENT HAPPENED/PROBLEM OCCURED </th>
                        <td>{{view_adverse_report.FEEDBACK}}</td>
                        <th>INCIDENT REPORTED BY</th>
                        <td height="40 !important"> {{view_adverse_report.completed_by}}</td>
                    </tr>
                    <tr  valign="top">
                        <th colspan="1" height="70 !important">USER DEPT HOD/INCHARGE COMMENT </th>
                        <td colspan="3" height="70 !important">{{view_adverse_report.INCHARGE_COMMENT}}</td>

                    </tr>
                    <tr  valign="top">
                        <th colspan="1" height="70 !important">OBSERVATION(BY BIOMEDICAL)  </th>
                        <td colspan="3" height="70 !important"> {{view_adverse_report.OBSERVATIONS}}</td>

                    </tr>
                    <tr  valign="top">
                        <th colspan="1" height="70 !important">OBSERVATION OCCURANCE REPORT </th>
                        <td colspan="3" height="70 !important">{{view_adverse_report.OCCRANCE_REPORT}}</td>

                    </tr>
                    <tr>
                        <th colspan="1">PARTS / ACCESSORIES DAMAGED </th>
                        <td colspan="3">{{view_adverse_report.SPARES}},{{view_adverse_report.ACCESSORIES}}</td>
                    </tr>
                    <tr>
                        <th>TOTAL COST </th>
                        <td>{{view_adverse_report.TOTAL_COST}}</td>
                        <th>APPROXIMATE COST </th>
                        <td>{{view_adverse_report.APPROXIMATE_COST}}</td>
                    </tr>
                    <tr rowspan="4"  valign="top" >
                        <th colspan="1" height="70 !important"  align="left">ACTION TAKEN </th>
                        <td colspan="3" height="70 !important"  align="left">{{view_adverse_report.ACTION_TACKEN}}</td>
                    </tr>
                </table>
                    <table border="0" WIDTH="100%" style="margin-top:60px;">
                        <tr valign="bottom"  height="70">
                            <td WIDTH="33%"  height="70">USER SIGNATURE</td>
                            <td WIDTH="33%"  height="70">ENGINEER SIGNATURE</td>
                            <td WIDTH="33%"  height="70">HOD SIGNATURE</td>
                        </tr>
                    </table>
            </div>
        </div>
    </div>
    </md-dialog-content>
</md-dialog>