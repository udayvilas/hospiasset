<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-dialog aria-label="dialog-box" flex="40">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Round Attend / Assign</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
        <form method="POST" name="RoundAttendForm" class="mylayout-padding" autocomplete="off">
            <div flex layout="column">
                <md-input-container>
                    <label>Name</label>
                    <input type="text" ng-model="round_complete.assigned_to" name="assigned_to" aria-label="assigned_to" ng-disabled="true">
                </md-input-container>
                <md-input-container>
                    <label>Assigned By</label>
                    <input type="text" ng-model="round_complete.assigned_by" name="assigned_by" aria-label="assigned_by" ng-disabled="true">
                </md-input-container>
                <md-input-container>
                    <label>Department</label>
                    <input type="text" ng-model="round_complete.DEPT_ID" name="departs" aria-label="departs" ng-disabled="true">
                </md-input-container>                 				 
				
				<div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">               
				<input type="file" filename-model="rounds_docs"   />
				<ul style="margin-top: 15px;">                
				<li ng-repeat="rounds_doc in rounds_docs">{{rounds_doc.name}}</li>         
				</ul>             
				</div>
                <md-input-container>
                    <label>Remarks</label>
                    <input type="text" ng-model="round_complete.remarks" name="remarks" aria-label="remarks">
                </md-input-container>
            </div>

            <div flex layout="row" layout-align="center center">
                <center>
                    <md-button class="md-raised md-accent" ng-click="RoundSubmit(round_complete)" ng-disabled="RoundAttendForm.$invalid" aria-label="submit">Complete</md-button>
                </center>
                <center>
                    <md-button class="md-raised md-default" ng-click="cancel()"  aria-label="cancel">Cancel</md-button>
                </center>
            </div>
        </form>
        </div>
    </md-dialog-content>
</md-dialog>