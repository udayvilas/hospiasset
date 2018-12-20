<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>FeedBacks</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <div layout="row">
                <table class="md-api-table table table-bordered">
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Feed back</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="ct_feedback in ct_feedbacks">
                        <td>{{ct_feedback.EMP_NAME}}</td>
                        <td>{{ct_feedback.FEEDBACK}}</td>
                        <td>{{ct_feedback.status}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </md-dialog-content>

    <md-dialog-actions layout="row">
        <md-button class="md-primary" ng-click="cancel()">Close</md-button>
    </md-dialog-actions>
</md-dialog>