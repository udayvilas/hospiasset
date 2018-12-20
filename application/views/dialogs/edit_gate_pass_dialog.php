<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Gate Pass</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditGatePassForm" flex="100" flex-xs="100"  autocomplete="off">
                <div layout="column" flex>
                    <div layout="row" layout-wrap>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>To Whom</label>
                            <input type="text" ng-model="edit_gate_pass.to_whom" name="to_whom" aria-label="to_whom">
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Department</label>
                            <md-select ng-change="getDepartmentDevices(edit_gate_pass.dept_id)" ng-model="edit_gate_pass.dept_id" name="dept_id">
                                <md-option ng-value="null">
                                    Select
                                </md-option>
                                <md-option ng-repeat="dept in depts"  ng-value="dept.USER_DEPT_NAME">
                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment ID *</label>
                            <md-select  ng-disabled="edit_gate_pass.dept_id==null" ng-model="edit_gate_pass.device_id" name="device_id" ng-change="getDeviceDetailsByEID(edit_gate_pass.dept_id,edit_gate_pass.device_id)">
                                <md-option ng-repeat="device in devices"  ng-value="device.E_ID">
                                    {{device.E_ID}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Name</label>
                            <input type="text" ng-model="edit_gate_pass.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--</div>
                    <div layout="row">-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Model</label>
                            <input type="text" ng-model="edit_gate_pass.equp_model" name="equp_model" aria-label="gatepass_req" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Serial No</label>
                            <input type="text"  ng-model="edit_gate_pass.srial_no" name="srial_no" aria-label="srial_no" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Physical Location</label>
                        <input type="text" ng-model="edit_gate_pass.phy_location" name="phy_location" aria-label="phy_location" />
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--</div>
                    <div layout="row">-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>GatePass Type</label>
                            <md-select ng-model="edit_gate_pass.gtype" name="ttype">
                                <md-option  required ng-repeat="transfer_type in transfer_types"  ng-value="transfer_type">
                                    {{transfer_type}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div ng-if="transfer_types[0]==edit_gate_pass.gtype" flex="5" hide-xs hide-sm><!-- Space --></div>
                        <div ng-if="transfer_types[0]==edit_gate_pass.gtype"  class="md-block" flex-gt-sm flex="45">
                            <div flex="5" hide-xs hide-sm><!-- Space --></div>
                                <mdp-date-picker mdp-placeholder="Expected Return"  name="expert_return" ng-model="edit_gate_pass.expert_return" ng-required="transfer_types[0]==edit_gate_pass.gtype" class="md-block" flex-gt-sm mdp-format="DD-MM-YYYY">
                                </mdp-date-picker>
                        </div>
                        <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Spares</label>
                            <md-select  ng-model="edit_gate_pass.critical_spare" name="critical_spare" multiple>
                                <md-option ng-repeat="m_critical_spare in m_critical_spares"  ng-value="m_critical_spare.CODE">
                                    {{m_critical_spare.NAME}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--</div>
                    <div layout="row">-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Spares Count</label>
                            <input type="text" ng-model="edit_gate_pass.spars_cnt" only-digits="only-digits" ng-disabled="edit_gate_pass.critical_spare==null" name="spars_cnt" aria-label="spars_cnt"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Accessories</label>
                            <md-select ng-model="edit_gate_pass.accessories" name="accessorie" multiple>
                                <md-option ng-value="null">
                                    Select
                                </md-option>
                                <md-option ng-repeat="m_accessorie in m_accessories"  ng-value="m_accessorie.CODE">
                                    {{m_accessorie.NAME}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Accessories Count</label>
                            <input type="text" only-digits="only-digits" ng-model="edit_gate_pass.accessories_cnt"  ng-disabled="edit_gate_pass.accessories==null" name="accessories_cnt" aria-label="accessories_cnt"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--</div>
                    <div flex layout="row">-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Reasons*</label>
                            <input type="text" ng-model="edit_gate_pass.reasons" name="reasons" aria-label="reasons"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--</div>
                    <div flex layout="row">-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Remarks</label>
                            <input type="text" ng-model="edit_gate_pass.remarks" name="remarks" aria-label="remarks"/>
                        </md-input-container>
                    </div>

                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="UpdateGatePass(edit_gate_pass)" ng-disabled="EditGatePassForm.$invalid" aria-label="submit">Submit</md-button>
                            <md-button class="md-raised md-default" ng-click="hide()" aria-label="cancel">Cancel</md-button>                        </center>
                    </div>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>