<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>

<md-dialog aria-label="dialog-box" flex="60" ng-clock>

    <md-toolbar>

        <div class="md-toolbar-tools">

            <h4>Tranfer Deploy request</h4>

            <span flex></span>

            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>

        </div>

    </md-toolbar>



    <md-dialog-content flex layout-align="center center">

        <div class="md-dialog-content">

            <div flex layout="row" layout-align="center center">

                <md-input-container  class="md-block" flex-gt-sm flex="20">

                    <label>Transfers</label>

                    <md-select ng-disabled="true" ng-model="transfer_deploy.TRANSFER" name="transfer">

                        <md-option ng-repeat="transfer in transfers"  ng-value="transfer">

                            {{transfer}}

                        </md-option>

                    </md-select>

                </md-input-container>

            </div>




            <div  flex layout="row" layout-align="center center">

                <form method="POST" name="TransferDeployForm" flex="100" autocomplete="off">

                    <div layout="row">


                        <!---<md-input-container class="md-block" flex-gt-sm flex="40">

                            <label>Equipment ID</label>

                            <input type="equp_id" ng-disabled="transfer_deploy.departments==null" required ng-model="transfer_deploy.equp_id" ng-change="getDeviceDetailsByEID(edit_within_unit.departments,edit_within_unit.equp_id)" name="equp_id" aria-label="equp_id"/>

                            <div ng-messages="TransferDeployForm.equp_id.$error">

                                <div ng-message="required">Required.</div>

                            </div>

                        </md-input-container>-->

                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">

                            <label>Equipment Name</label>

                            <input type="text" ng-disabled="true" ng-model="transfer_deploy.equp_name" name="equp_name" aria-label="equp_name"/>

                            <div ng-messages="TransferDeployForm.equp_name.$error">

                                <div ng-message="required">Required.</div>

                            </div>

                        </md-input-container>

                        <div flex="10" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container  class="md-block" flex-gt-sm flex="45">

                            <label>Department</label>

                            <md-select ng-model="transfer_deploy.departments" name="depts">

                                <md-option ng-repeat="dept in all_depts"  ng-value="dept.CODE">

                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})

                                </md-option>

                            </md-select>

                        </md-input-container>

                    </div>



                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm flex="45">

                            <label>Physical Location</label>

                            <input type="text" ng-model="transfer_deploy.plocation" name="plocation" aria-label="plocation" />

                            <div ng-messages="TransferDeployForm.ctype.$error">

                                <div ng-message="required">Required.</div>

                            </div>

                        </md-input-container>

                        <div flex="10" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container  class="md-block" flex-gt-sm flex="45">

                            <label>Transfer Type</label>

                            <md-select ng-disabled="true" ng-model="transfer_deploy.ttype" name="ttype">

                                <md-option ng-repeat="transfer_type in transfer_types"  ng-value="transfer_type">

                                    {{transfer_type}}

                                </md-option>

                            </md-select>

                        </md-input-container>

                    </div>



                    <div layout="row">

                        <mdp-date-picker ng-if="transfer_deploy.ttype==transfer_types[0]" mdp-placeholder="Expected return date" name="expect_return" mdp-disabled="true" class="md-block" flex-gt-sm flex="45" mdp-format="DD-MM-YYYY" ng-model="transfer_deploy.expected_return" mdp-min-date="minDate">

                        </mdp-date-picker>

                        <div ng-if="transfer_deploy.ttype==transfer_types[0]" flex="10" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm flex>

                            <label>Reasons</label>

                            <textarea ng-model="transfer_deploy.reasons" name="reasons" md-maxlength="350" rows="5" md-select-on-focus> </textarea>

                            <div ng-messages="TransferDeployForm.reasons.$error">

                                <div ng-message="required">Required.</div>

                            </div>

                        </md-input-container>

                    </div>



                    <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="transferDeployDevice(transfer_deploy)" ng-disabled="TransferDeployForm.$invalid" aria-label="submit">Submit</md-button>

                        <div flex="2" hide-xs hide-sm><!-- Space --></div>

                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                    </div>

                </form>

            </div>

        </div>

    </md-dialog-content>

</md-dialog>