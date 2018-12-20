<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="90" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4 class="textcenter">Adverse Report Details</h4>
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
                        <th>Equp ID</th>
                        <th>Department</th>
                        <th>Location</th>
                        <th>Equp Type</th>
                        <th>Equp Model</th>
                        <th>Equp Serial No</th>
                        <th>Date Of Occarance</th>
                        <th>Time Of Occarance</th>
                        <th>Incedent Type</th>
                        <th>Raised By</th>
                        <th>Completed By</th>
                        <th>Incident Problem</th>
                        <th>Incharge Comment</th>
                        <th>Observations</th>
                        <th>Occurance Reports</th>
                        <th>Parts Damaged</th>
                        <th>Approximate Cost</th>
                        <th>Total Cost</th>
                        <th>Action Taken</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="view_adverse_report in adverse_reports">
                        <td>{{view_adverse_report.EQUP_ID}}</td>
                        <td>{{view_adverse_report.department}}</td>
                        <td>{{view_adverse_report.location}}</td>
                        <td>{{view_adverse_report.type}}</td>
                        <td>{{view_adverse_report.model}}</td>
                        <td>{{view_adverse_report.serial_no}}</td>
                        <td>{{view_adverse_report.DATE_OCCRANCE}}</td>
                        <td>{{view_adverse_report.TIME_OCCARANCE}}</td>
                        <td>{{view_adverse_report.incidents_type}}</td>
                        <td>{{view_adverse_report.assigned_by}}</td>
                        <td>{{view_adverse_report.completed_by}}</td>
                        <td>{{view_adverse_report.FEEDBACK}}</td>
                        <td>{{view_adverse_report.INCHARGE_COMMENT}}</td>
                        <td>{{view_adverse_report.OBSERVATIONS}}</td>
                        <td>{{view_adverse_report.OCCRANCE_REPORT}}</td>
                        <td>{{view_adverse_report.SPARES}},{{view_adverse_report.ACCESSORIES}}</td>
                        <td>{{view_adverse_report.APPROXIMATE_COST}}</td>
                        <td>{{view_adverse_report.TOTAL_COST}}</td>
                        <td>{{view_adverse_report.ACTION_TACKEN}}</td>
                    </tr>
                    </tbody>
                    <!--<tbody >
                    <tr>
                        <td colspan="20" style="text-align:center">No Adverse Incedents Found</td>
                    </tr>
                    </tbody>-->
                </table>
            </div>
        </div>
    </md-dialog-content>
</md-dialog>