<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Equipment Name Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content" >
            <form method="POST" name="EditEqupNameForm" flex="100" autocomplete="off">
                <div flex layout="column">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{dtypes_label.NAME}}</label>
                        <input  type="text" ng-model="eeqname_data.equp_name" name="equp_name"  md-maxlength="50" required>                           <div ng-messages="EditEqupNameForm.equp_name.$error">                            <div ng-message="required">Required.</div>                              <div ng-message="md-maxlength">Max limit is reached.</div>                                                      </div>
                    </md-input-container>

                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{dtypes_label.CODE}}</label>
                        <input  type="text" ng-model="eeqname_data.code" name="code" md-maxlength="3"  ng-pattern= "/^[a-zA-Z. ]*[a-zA-Z]$/"  ng-change="eeqname_data.code = (eeqname_data.code | uppercase)" required>                              <div ng-messages="EditEqupNameForm.ecode.$error">                            <div ng-message="required">Required.</div>                              <div ng-message="md-maxlength">Max limit is reached.</div>							  <div ng-show="EditEqupNameForm.ecode.$error.pattern">Please Provide Text Only.</div>							                                                         </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{dtypes_label.priority}}</label>
                        <md-select name="equp_type" ng-model="eeqname_data.priority" aria-label="equp_type">
                            <md-option ng-value="device_priority.PID" ng-repeat="device_priority in device_priorities">{{device_priority.PNAME}}</md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{dtypes_label.STATUS}}</label>
                        <md-select name="status" required ng-model="eeqname_data.status" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateEqupname(eeqname_data)" ng-disabled="EditEqupNameForm.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>