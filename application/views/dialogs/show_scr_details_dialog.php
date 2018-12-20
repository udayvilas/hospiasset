<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-dialog aria-label="dialog-box" flex="60">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Sceduled Calls</h4>
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
                    <td>{{sc_report_view.date}}</td>
                    <th>Time</th>
                    <td>{{sc_report_view.time}}</td>
                </tr>
                <tr>
                    <th>Dept</th>
                    <td>{{sc_report_view.department}}</td>
                    <th>Branch</th>
                    <td>{{sc_report_view.branch_name}}</td>
                </tr>
                <tr>
                    <th width="25%">Equipment ID</th>
                    <td  width="25%">{{sc_report_view.EID}}</td>
                    <th  width="25%">Equipment Name</th>
                    <td  width="25%">{{sc_report_view.equp_name}}</td>
                </tr>

                <tr>
                    <th  width="25%">Assigned By</th>
                    <td   colspan="3" width="75%">{{sc_report_view.assigned_by}}</td>
                </tr>

                <tr>
                    <th width="25%">Completed  By</th>
                    <td  colspan="3"  width="75%">{{sc_report_view.completed_by}}</td>

                </tr>

            </table>
        </div>
    </md-dialog-content>
</md-dialog>