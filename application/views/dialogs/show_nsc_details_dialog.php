<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-dialog aria-label="dialog-box" flex="60">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Non Sceduled Calls</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <table  border="2" width="100%" class="dtable">
                <tr>
                    <th>Date</th>
                    <td>{{nsc_report_view.date}}</td>
                    <th>Time</th>
                    <td>{{nsc_report_view.time}}</td>
                </tr>
                <tr>
                    <th>Dept</th>
                    <td>{{nsc_report_view.department}}</td>
                    <th>Branch</th>
                    <td>{{nsc_report_view.branch_name}}</td>
                </tr>
                <tr>
                    <th width="25%">Equipment ID</th>
                    <td  width="25%">{{nsc_report_view.EID}}</td>
                    <th  width="25%">Equipment Name</th>
                    <td  width="25%">{{nsc_report_view.equp_name}}</td>
                </tr>
                <tr>
                    <th width="25%">Serial no</th>
                    <td  width="25%">{{nsc_report_view.serial_number}}</td>
                    <th  width="25%">Down Time</th>
                    <td  width="25%">{{nsc_report_view.DOWN_TIME}}</td>
                </tr>
                <tr>
                    <th width="25%">Genarated By</th>
                    <td  width="25%">{{nsc_report_view.CALLER_NAME}}</td>
                    <th width="25%">Genarated Date & Time</th>
                    <td  width="25%">{{nsc_report_view.CDATE}}{{nsc_report_view.CTIME}}</td>
                </tr>
                <tr>
                    <th width="25%">Genarated Reason</th>
                    <td  width="75%" colspan="3">{{nsc_report_view.NATURE_OF_COMP}}</td>
                </tr>
                <tr>
                    <th  width="25%">Assigned By</th>
                    <td  width="25%">{{nsc_report_view.Attended_by}}</td>
                    <th  width="25%">Date Time</th>
                    <td  width="25%">{{nsc_report_view.ATTENDED_DATE}}{{nsc_report_view.ATTENDED_TIME}}</td>
                </tr>
                <tr>
                    <th width="25%">Pending By</th>
                    <td  width="25%">{{nsc_report_view.Attended_by}}</td>
                    <th width="25%"> Pending Reasons</th>
                    <td  width="25%">{{nsc_report_view.PENDING_REASON}}</td>
                </tr>
                <tr>
                    <th width="25%">Responded By</th>
                    <td  width="25%">{{nsc_report_view.Responded_by}}</td>
                    <th width="25%">Responded Date & Time</th>
                    <td  width="25%">{{nsc_report_view.RESPONDED_DATE}}{{nsc_report_view.RESPONDED_TIME}}</td>
                </tr>
                <tr>
                    <th width="25%">Completed  By</th>
                    <td  width="25%">{{nsc_report_view.Attended_by}}</td>
                    <th  width="25%">Date Time</th>
                    <td  width="25%">{{nsc_report_view.JOBCOMPLETED_DATE}}{{nsc_report_view.JOBCOMPLETED_TIME}}</td>
                </tr>

            </table>
        </div>
    </md-dialog-content>
</md-dialog>