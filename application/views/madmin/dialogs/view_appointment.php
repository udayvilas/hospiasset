<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="90" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>View Appointments Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <table class="md-api-table table table-bordered">
                <thead>
                <tr>
                    <th>ORG ID</th>
                    <th>ORG Name</th>
                    <th>APT Date</th>
                    <th>APT Time</th>
                    <th>Contact Person</th>
                    <th>APT Place</th>
                    <th>APT Feedbacks</th>
                    <th>APT Status</th>
                </tr>
                </thead>
                <tbody ng-if="!isempty(all_cp_apts)">
                <tr ng-repeat="all_cp_apt in all_cp_apts">
                    <td>{{all_cp_apt.ORG_ID}}</td>
                    <td>{{all_cp_apt.org_name}}</td>
                    <td><div ng-repeat="cps in all_cp_apt.PRVS_APT_DATES">{{cps.data}}{{cps.time}}</div></td>
                    <td><div ng-repeat="cps in all_cp_apt.PRVS_APT_DATES">{{cps.time}}</div></td>
                    <td><div ng-repeat="cps in all_cp_apt.PRVS_APT_DATES">{{cps.cp}}</div></td>
                    <td><div ng-repeat="cps in all_cp_apt.PRVS_APT_DATES">{{cps.place}}</div></td>
                    <td><div ng-repeat="cps in all_cp_apt.PRVS_APT_DATES">{{cps.feedback}}</div></td>
                    <td><div ng-repeat="cps in all_cp_apt.PRVS_APT_DATES">{{cps.status}}</div></td>
                </tr>
                </tbody>
                <tbody ng-if="isempty(all_cp_apts)">
                <tr>
                    <td style="text-align:center" colspan="9">No Rows Found</td>
                </tr>
                </tbody>
            </table>
        </div>
    </md-dialog-content>
</md-dialog>