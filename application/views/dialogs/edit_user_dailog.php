<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>User Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditUserForm" flex="100"  autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{users_label.EMP_NO}}</label>
                        <input numbers-only="numbers-only" required  ng-change="check_emp_no(euser_data.EMP_NO)" ng-model="euser_data.EMP_NO" md-maxlength="14" ng-minlength="8">
                        <span ng-bind="Message" ng-style="{color:Color}"></span>
                        <div ng-messages="EditUserForm.EMP_NO.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                            <div ng-message="minlength">Min length is 8</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{users_label.USER_NAME}}</label>
                        <input required ng-model="euser_data.USER_NAME" md-maxlength="200">
                        <div ng-messages="EditUserForm.USER_NAME.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row">

                    <!--<md-input-container class="md-block" flex-gt-sm>
                        <label>Alternate Number</label>
                        <input required numbers-only="numbers-only" md-maxlength="10" ng-minlength="10" ng-model="euser_data.MOBILE_NO">
                        <div ng-messages="EditUserForm.MOBILE_NO.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                            <div ng-message="minlength">Min length is 8</div>
                        </div>
                    </md-input-container>-->
                    <!--<div flex="10" hide-xs hide-sm><!-- Space --><!--</div>-->
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{users_label.STATUS}}</label>
                        <md-select required ng-model="euser_data.STATUS">
                            <md-option ng-value="user_status.ID" ng-repeat="user_status in user_statues">{{user_status.VALUE}}</md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm></div>
                <md-input-container class="md-block" flex-gt-sm>
                        <label>{{users_label.ROLE_NAME}}</label>
                        <md-select required ng-model="euser_data.ROLE_CODE">
                            <md-option ng-if="user_role_code!=role.ROLE_CODE" ng-value="role.ROLE_CODE" ng-repeat="role in org_roles | orderBy:'ROLE_NAME'">{{role.ROLE_NAME}}</md-option>
                        </md-select>
                        <div ng-messages="EditUserForm.ROLE_CODE.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                  </div>
                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm>
                    <div flex-xs="" flex="50">
                        <md-checkbox aria-label="Select All"  md-indeterminate="isIndeterminate()" ng-click="toggleAll()">
                            <span ng-if="isChecked()">Un-</span>Select All
                        </md-checkbox>
                    </div>
                    <div class="demo-select-all-checkboxes" flex="100" ng-repeat="branch in branchs" ng-if="branch.BRANCH_ID !='All'" >
                        <md-checkbox ng-checked="exists(branch, euser_data.org_branch_id)" ng-click="toggle(branch, euser_data.org_branch_id)" >
                            {{ branch.BRANCH_NAME }}
                        </md-checkbox>
                    </div>
                    </md-input-container>
                    

                </div>

                <!--<div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Levels *</label>
                        <md-select name="level" required ng-model="euser_data.LEVEL" aria-label="level">
                            <md-option  ng-value="level.LEVEL_NAME" ng-repeat="level in levels">{{level.LEVEL_NAME}}</md-option>
                        </md-select>
                        <div ng-messages="addUserForm.level.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>-->

                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateUser(euser_data)" ng-disabled="EditUserForm.$invalid" aria-label="submit"  style="float:left" >Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>

</md-dialog>