<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="20">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Requests</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
    <div class="md-dialog-content">
        <form method="POST" layout="column" name="RequestForm" flex="100"  autocomplete="off">
        <md-input-container flex="100">
            <label>Training Status</label>
            <md-select name="status" ng-model="requst_training_data.tstatus"  style="width:200px"  aria-label="Status">
                <md-option ng-value="trngstatus_update.key" ng-repeat="trngstatus_update in trngstatus_updates">                             {{trngstatus_update.name}}
                </md-option>
            </md-select>
        </md-input-container>
        <div layout="row" layout="center center" style="margin-top:30px;">
            <md-button class="md-raised md-accent" ng-click="RequestforApprove(requst_training_data)" ng-disabled="RequestForm.$invalid" aria-label="submit" style="float:left" >Submit</md-button>
            <div flex="2" hide-xs hide-sm><!-- Space --></div>
            <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
        </div>
        </form>
    </div>
    </md-dialog-content>
</md-dialog>