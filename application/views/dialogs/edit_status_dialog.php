<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Status Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content" >
            <form method="POST" name="EditestatusForm" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>{{stat_label.STATUS}}</label>
                        <input  type="text" ng-model="estatus_data.status" md-maxlength="50" name="status" required>
                        <div ng-messages="EditCtypeForm.status.$error">                        <div ng-message="md-maxlength">Max limit is reached.</div>
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>{{stat_label.SCODE}}</label>
                        <input  type="text" ng-model="estatus_data.status_code"  ng-change="estatus_data.status_code = (estatus_data.status_code | uppercase)" md-maxlength="3" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" name="status_code" required>
                        <div ng-messages="EditestatusForm.status_code.$error">
                            <div ng-message="required">Required.</div>                                <div ng-message="md-maxlength">Max limit is reached.</div>							  <div ng-show="EditestatusForm.status_code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>{{stat_label.STATUSS}}*</label>
                        <md-select name="statuss" required ng-model="estatus_data.statuss" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EditestatusForm.statuss.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateStatus(estatus_data)" ng-disabled="EditestatusForm.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>