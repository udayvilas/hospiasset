<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Edit Transfer Request</h4>
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
                    <md-select ng-disabled="true" ng-model="edit_within_unit.TRANSFER" name="transfer">
                        <md-option ng-repeat="transfer in transfers"  ng-value="transfer">
                            {{transfer}}
                        </md-option>
                    </md-select>
                </md-input-container>
            </div>
            <div ng-if="edit_within_unit.TRANSFER==transfers[0]" flex layout="row" layout-align="center center">
                <form method="POST" name="EdiTtrnsferform" flex="100"  autocomplete="off">
                    <div layout="row" >
                        <md-input-container  class="md-block" flex-gt-sm flex="40">
                            <label>Department</label>
                            <md-select required ng-model="edit_within_unit.departments" name="depts">
                                <md-option ng-repeat="dept in all_depts"  ng-value="dept.CODE">
                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                                </md-option>
                            </md-select>
							<div ng-messages="EdiTtrnsferform.departments.$error">
							<div ng-message="required">Required.</div>
							</div>
                        </md-input-container>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Equipment ID</label>
                            <input type="equp_id" ng-disabled="edit_within_unit.departments==null" required ng-model="edit_within_unit.equp_id" ng-change="getDeviceDetailsByEID(edit_within_unit.departments,edit_within_unit.equp_id)" name="equp_id" aria-label="equp_id"/>
                            <div ng-messages="EdiTtrnsferform.equp_id.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Equipment Name</label>
                            <input type="text" ng-model="edit_within_unit.equp_name" name="equp_name" aria-label="req_eq_name" ng-disabled="true"/>
                            <div ng-messages="EdiTtrnsferform.equp_name.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Equipment Model</label>
                            <input type="text"  ng-model="edit_within_unit.equp_model" name="equp_model" aria-label="response" ng-disabled="true"/>
                            <!--<div ng-messages="EdiTtrnsferform.equp_model.$error">
                                <div ng-message="required">Required.</div>
                            </div>-->
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Equipment Serial No</label>
                            <input type="text"  ng-model="edit_within_unit.srial_no" name="eserial_no" aria-label="eserial_no" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Equipment PO No</label>
                            <input type="text"  ng-model="edit_within_unit.pono" name="pono" aria-label="pono" ng-disabled="true"/>
                        </md-input-container>
                    </div>
                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Equipment Contract Type</label>
                            <input type="text"  ng-model="edit_within_unit.ctype" name="ctype" aria-label="ctype" ng-disabled="true"/>
                            <div ng-messages="EdiTtrnsferform.ctype.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Select New Department *</label>
                            <md-select ng-model="edit_within_unit.newdepts" name="depts" md-on-open="loadDepartments()" >
                                <md-option ng-repeat="dept in all_depts" ng-if="dept.CODE!=edit_within_unit.departments" ng-value="dept.CODE">
                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                                </md-option>
                            </md-select>
                            <div ng-messages="EdiTtrnsferform.newdepts.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Physical Location</label>
                            <input type="text"  ng-model="edit_within_unit.plocation" name="plocation" aria-label="plocation" required />
                            <div ng-messages="EdiTtrnsferform.plocation.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Reasons</label>
                            <textarea ng-model="edit_within_unit.reasons" name="reasons" ng-maxlength="250" rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="EdiTtrnsferform.reasons.$error">
                                <div ng-message="required">Required.</div>
								<div ng-show="EdiTtrnsferform.reasons.$error.maxlength">Max length Exceeds.</div>
                            </div>
                        </md-input-container>
                    </div>

                    <div flex layout="row" layout-align="center center">
                            <md-button class="md-raised md-accent" ng-click="UudateTransferRequest(edit_within_unit,edit_within_unit.TRANSFER)" ng-disabled="EdiTtrnsferform.$invalid" aria-label="submit">Submit</md-button>
                            <div flex="2" hide-xs hide-sm><!-- Space --></div>
                <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>
                    </div>
                </form>
            </div>

            <div ng-if="edit_within_unit.TRANSFER==transfers[1]" flex layout="row" layout-align="center center">
                <form method="POST" name="EditotherUnitRequestForm" flex="100" autocomplete="off">
                    <div layout="row">
					<md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Equipment ID</label>
                            <input type="equp_id" ng-disabled="edit_other_request.departments==null" required ng-model="edit_other_request.equp_id" ng-change="getDeviceDetailsByEID(edit_other_request.departments,edit_other_request.equp_id)" name="equp_id" aria-label="equp_id"/>
                            <div ng-messages="EditotherUnitRequestForm.equp_id.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
						<div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Name</label>
                            <input type="text" ng-disabled="true" ng-model="edit_other_request.equp_name" name="equp_name" aria-label="equp_name"/>
                            <div ng-messages="EditotherUnitRequestForm.equp_name.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
						<div flex="10" hide-xs hide-sm><!-- Space --></div>
						
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Equipment Model</label>
                            <input type="text"  ng-model="edit_other_request.equp_model" name="equp_model" aria-label="response" ng-disabled="true"/>
                            <div ng-messages="EditotherUnitRequestForm.equp_model.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                       
                        <!---<md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Department</label>
                            <md-select ng-model="edit_other_request.departments" name="depts">
                                <md-option ng-repeat="dept in all_depts"  ng-value="dept.CODE">
                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                                </md-option>
                            </md-select>
                        </md-input-container>---></div>
						<div flex="10" hide-xs hide-sm><!-- Space --></div>
						<div layout="row">																		<md-autocomplete flex="20" class="md-block" flex-gt-sm						 ng-init="searched.CODE = (edit_other_request.departments != null) ? {'CODE': edit_other_request.departments,'USER_DEPT_NAME':edit_other_request.department} : null"						 md-no-cache="false"                         md-selected-item="searched.CODE"                         md-search-text="edit_other_request.searchDepartment"                         md-items="item in searchTextChange(edit_other_request.searchDepartment,'Department')"                         md-item-text="item.USER_DEPT_NAME"                         md-search-text-change="edit_other_request.departments = ''"                         md-selected-item-change="edit_other_request.departments = item.CODE"                         md-min-length="0"                         md-floating-label="Department">            <md-item-template>                <span md-highlight-text="searchDepartment" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>            </md-item-template>            <md-not-found>                No Department Found            </md-not-found>        </md-autocomplete>              <span ng-value="edit_other_request.departments = searched.CODE.CODE" ng-model="edit_other_request.departments = searched.CODE.CODE" ></span>
                    

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Physical Location</label>
                            <input type="text" ng-model="edit_other_request.plocation" name="plocation" aria-label="plocation" />
                            <div ng-messages="EditotherUnitRequestForm.plocation.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Transfer Type</label>
                            <md-select ng-disabled="true" ng-model="edit_other_request.ttype" name="ttype">
                                <md-option ng-repeat="transfer_type in transfer_types"  ng-value="transfer_type">
                                    {{transfer_type}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>
<div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <div layout="row">
                        <mdp-date-picker ng-if="edit_other_request.ttype==transfer_types[0]" mdp-placeholder="Expected return date" name="expect_return" mdp-disabled="true" class="md-block" flex-gt-sm flex="45" mdp-format="DD-MM-YYYY" ng-model="edit_other_request.expected_return" mdp-min-date="minDate">
                        </mdp-date-picker>
                        <div ng-if="edit_other_request.ttype==transfer_types[0]" flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Reasons</label>
                            <textarea ng-model="edit_other_request.reasons" name="reasons" md-maxlength="350" rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="EditotherUnitRequestForm.reasons.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>

                    <div flex layout="row" layout-align="center center">

                            <md-button class="md-raised md-accent" ng-click="UpdateOtherUnitRequest(edit_other_request,edit_within_unit.TRANSFER)" ng-disabled="EditotherUnitRequestForm.$invalid" aria-label="submit">Submit</md-button>
                            <div flex="2" hide-xs hide-sm><!-- Space --></div>
                            <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                    </div>
                </form>
        </div>
        </div>
    </md-dialog-content>
</md-dialog>