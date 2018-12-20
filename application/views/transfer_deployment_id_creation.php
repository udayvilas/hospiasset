<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div flex layout="column">
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
            <h3 flex class="heading-stylerespond">Transfer Equipment Deployment</h3>
        </div>
        <form name="TransferDeployDevice" action="javascript:void(0);">

            <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                <md-input-container  flex="25">
                    <label>Equipment ID</label>
                    <input required type="text" ng-model="transfer_deploy_device.E_ID" name="rceqpid" aria-label="rc username"/>
                    <div ng-messages="TransferDeployDevice.rceqpid.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container flex="20">
                    <label>City</label>
                    <input required ng-readonly="true" type="text" ng-model="transfer_deploy_device.city_name" name="city_code" aria-label="city_code"/>
                    <div ng-messages="TransferDeployDevice.rcename.$error">
                        <div ng-message="required">Required</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container flex="20">
                    <label>Branch</label>
                    <input required ng-readonly="true" type="text" ng-model="transfer_deploy_device.branch_name" name="equp_branch" aria-label="equp_branch"/>
                    <div ng-messages="TransferDeployDevice.equp_branch.$error">
                        <div ng-message="required">Required</div>
                    </div>
                </md-input-container>

                <div flex="5" hide-xs hide-sm><!-- Space --></div>

                <md-input-container class="no-margin-padding-md-input" flex="20" flex-xs="100">
                    <label>Transfer Branch</label>
                    <md-select required placeholder="Select Branch *" ng-model="transfer_deploy_device.transfer_branch"  aria-label="transfer_branch_name">
                        <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
                    </md-select>
                </md-input-container>
            </div>
            <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <md-input-container flex="20">
                        <label>Department</label>
                        <md-select  required ng-model="transfer_deploy_device.transfer_dept" name="depts">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}}
                            </md-option>
                        </md-select>
                        <div ng-messages="TransferDeployDevice.depts.$error">
                            <div ng-message="required">Required</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container flex="20">
                    <label>Physical Location</label>
                    <input type="text" ng-model="transfer_deploy_device.location" name="location" aria-label="location"/>
                    <div ng-messages="TransferDeployDevice.location.$error">
                        <div ng-message="required">Required</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised md-accent" ng-disabled="TransferDeployDevice.$invalid && transfer_deploy_device.E_ID==null" ng-click="transferDeployDevice($event,transfer_deploy_device)" aria-label="button"> Deploy </md-button>

            </div>
        </form>
    </div>
</md-content>
