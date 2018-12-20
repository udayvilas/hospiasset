<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="90" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Adverse Incedent Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex="100">
        <div class="md-dialog-content">
            <div layout="row" flex="100">
            <table class="md-api-table table table-bordered" style="width:100%;">
                <thead>
                <tr>
                    <th style="width:8%">Department</th>
                    <th style="width:14%">Equp ID</th>
                    <th style="width:8%">Incedent Type</th>
                    <th style="width:10%">Date Of Occarance</th>
                    <th style="width:8%">FeedBack</th>
                    <th style="width:10%">Incharge Comment</th>
                    <th style="width:8%">Observations</th>
                    <th style="width:6%">Occurance Reports</th>
                    <th style="width:6%">Spares</th>
                    <th style="width:6%">Accessories</th>
                    <th style="width:6%">Approximate Cost</th>
                    <th style="width:6%">Total Cost</th>
                    <th style="width:6%">Action Taken</th>
                </tr>
                </thead>
                <tbody ng-if="add_incedents!=null">
                <tr ng-repeat="add_incedent in add_incedents">
                    <td>{{add_incedent.DEPT_ID}}</td>
                    <td>{{add_incedent.EQUP_ID}}</td>
                    <td>{{add_incedent.INCIDENT_TYPE}}</td>
                    <td>{{add_incedent.DATE_OCCRANCE}}</td>
                    <td>{{add_incedent.FEEDBACK}}</td>
                    <td>{{add_incedent.INCHARGE_COMMENT}}</td>
                    <td>{{add_incedent.OBSERVATIONS}}</td>
                    <td>{{add_incedent.OCCRANCE_REPORT}}</td>
                    <td>{{add_incedent.SPARES}}</td>
                    <td>{{add_incedent.ACCESSORIES}}</td>
                    <td>{{add_incedent.APPROXIMATE_COST}}</td>
                    <td>{{add_incedent.TOTAL_COST}}</td>
                    <td>{{add_incedent.ACTION_TACKEN}}</td>

                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="13" style="text-align:center">No Adverse Incedents Found</td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>
    </md-dialog-content>
</md-dialog>