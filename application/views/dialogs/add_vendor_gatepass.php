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
            <form method="POST" name="GatePassForm"  flex-xs="100" autocomplete="off">
                <div layout="column" flex>
                    <div layout="row" layout-wrap>
                        <!--<md-input-container class="md-block" flex-gt-sm flex="45"><label>Select Branch *</label><md-select ng-model="gatepass_req.branch_id" ng-required="branch.BRANCH_ID !=''" name="branch_id" style="color: #ffffff" aria-label="user_branch" ng-change="branch_all_loading(user_branch)"><md-option ng-value="branch.BRANCH_ID"  ng-if="branch.BRANCH_ID !='All'" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option></md-select></md-input-container>-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>From Branch</label>
                            <md-select  ng-model="gatepass_req.trans_branch_id" name="trans_branch_id" ng-disabled="true">
                                <md-option ng-value="null"> Select</md-option>
                                <md-option ng-repeat="branch in branchs"  ng-value="branch.BRANCH_ID">
                                    {{branch.BRANCH_NAME}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                            <!-- Space -->
                        </div>
                       <!-- <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>To Whom</label>
                            <input type="text" ng-model="gatepass_req.to_whom" required name="to_whom" aria-label="to_whom">
                        </md-input-container>-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>To Branch</label>
                            <md-select  ng-model="gatepass_req.branch_id" name="branch_id" ng-disabled="true">
                                <md-option ng-value="null"> Select</md-option>
                                <md-option ng-repeat="branch in branches"  ng-value="branch.BRANCH_ID">
                                    {{branch.BRANCH_NAME}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                            <!-- Space -->
                        </div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Department</label>
                            <md-select  ng-model="gatepass_req.Dept_id" name="dept_id" ng-disabled="true">
                                <md-option ng-value="null"> Select</md-option>
                                <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                            <!-- Space -->
                        </div>
                        <!-- <md-input-container class="md-block" flex-gt-sm flex="45" ng-disabled="true"><label>Equipment ID *</label><md-select  ng-model="gatepass_req.EQ_ID" name="EQ_ID" required><md-option ng-value="nullValue">Select</md-option><md-option ng-repeat="device in devices"  ng-value="device.E_ID">

                                {{device.E_ID}}

                            </md-option></md-select></md-input-container>-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment ID</label>
                            <input type="text" ng-model="gatepass_req.E_ID" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                            <!-- Space -->
                        </div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Name</label>
                            <input type="text" ng-model="gatepass_req.E_NAME" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                            <!-- Space -->
                        </div>
                        <!--<md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Model</label>
                            <input type="text" ng-model="gatepass_req.E_MODEL" name="equp_model" aria-label="gatepass_req"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                        </div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Serial No</label>
                            <input type="text" ng-model="gatepass_req.srial_no" name="srial_no" aria-label="srial_no" />
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                        </div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Physical Location</label>
                            <input type="text" ng-model="gatepass_req.PHY_LOCATION" name="phy_location" aria-label="phy_location" />
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                        </div>
                        -->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>GatePass Type</label>
                            <md-select ng-model="gatepass_req.gtype" name="ttype" required>
                                <md-option  required ng-repeat="transfer_type in transfer_types"  ng-value="transfer_type">

                                    {{transfer_type}}

                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div ng-if="transfer_types[0]==gatepass_req.gtype" flex="5" hide-xs hide-sm>
                            <!-- Space -->
                        </div>
                        <div ng-if="transfer_types[0]==gatepass_req.gtype"  class="md-block" flex-gt-sm flex="45">
                            <mdp-date-picker mdp-placeholder="Expecte Return "  name="expert_return" ng-required="transfer_types[0]==gatepass_req.gtype" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="gatepass_req.expert_return"></mdp-date-picker>
                        </div>
                        <div flex="5" hide-xs hide-sm >
                            <!-- Space -->
                        </div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Spares</label>
                            <md-select ng-model="gatepass_req.critical_spare" name="critical_spare" multiple>
                                <md-option ng-repeat="m_critical_spare in m_critical_spares"  ng-value="m_critical_spare.CODE">

                                    {{m_critical_spare.NAME}}

                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                            <!-- Space -->
                        </div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Spares Count</label>
                            <input type="text" ng-model="gatepass_req.spars_cnt" only-digits="only-digits"  ng-disabled="gatepass_req.critical_spare==null" name="spars_cnt" aria-label="spars_cnt"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm >
                            <!-- Space -->
                        </div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Accessories</label>
                            <md-select ng-model="gatepass_req.accessories" name="accessorie" multiple>
                                <md-option ng-repeat="m_accessorie in m_accessories"  ng-value="m_accessorie.CODE">

                                    {{m_accessorie.NAME}}

                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm >
                            <!-- Space -->
                        </div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Accessories Count</label>
                            <input type="text" only-digits="only-digits"  ng-disabled="gatepass_req.accessories==null" ng-model="gatepass_req.accessories_cnt"  name="accessories_cnt"  aria-label="accessories_cnt"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                            <!-- Space -->
                        </div>
                        <!--</div><div flex layout="row">-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Reasons</label>
                            <input type="text" ng-model="gatepass_req.reasons" required name="reasons" aria-label="reasons"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm>
                            <!-- Space -->
                        </div>
                        <!--</div><div flex layout="row">-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Remarks</label>
                            <input type="text" ng-model="gatepass_req.remarks" name="remarks" aria-label="remarks"/>
                        </md-input-container>
                    </div>
                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="add_gate_pass_list(gatepass_req);transferEquipment(gatepass_req);" ng-disabled="GatePassForm.$invalid" aria-label="submit">Add</md-button>
                            <md-button class="md-raised md-default" ng-click="hide()" aria-label="cancel">Cancel</md-button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>