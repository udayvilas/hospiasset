<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="70" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4> Update Gate Pass</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditGatePassForm"  flex-xs="100"  autocomplete="off">
                <div layout="column" layout-wrap flex>
                    <div layout="row">
                        <!--<md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Department</label>
                            <md-select ng-change="getDepartmentDevices(gatepass_update.dept_id)" ng-model="gatepass_req.dept_id" name="dept_id">
                                <md-option ng-value="null">
                                    Select
                                </md-option>
                                <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                                </md-option>
                            </md-select>
                        </md-input-container>--->													
                      <md-autocomplete flex="20" class="md-block" flex-gt-sm
					     required
						 md-input-name="department"
						 ng-init="searched.CODE = (gatepass_update.dept_id != null) ? {'CODE': gatepass_update.dept_id,'USER_DEPT_NAME':gatepass_update.DEPT} : null"
						 md-no-cache="false"
                         md-selected-item="searched.CODE"
                         md-search-text="gatepass_update.searchDepartment"
                         md-items="item in searchTextChange(gatepass_update.searchDepartment,'Department')"
                         md-item-text="gatepass_update.dept_id = item.USER_DEPT_NAME"
                         md-min-length="0"
                         md-floating-label="Search Department">
            <md-item-template>
                <span md-highlight-text="searchDepartment" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
            </md-item-template>
			<div ng-messages="EditGatePassForm.department.$error" ng-if="EditGatePassForm.department.$touched">
					<div ng-message="required">Required</div>
				</div>
            <!--<md-not-found>
                No Department Found
            </md-not-found>-->
        </md-autocomplete>
              <!--<span ng-value="gatepass_update.dept_id = searched.CODE.CODE" ng-model="gatepass_update.dept_id = searched.CODE.CODE" ></span>--->
					  
						
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <!---<md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment ID *</label>
                            <md-select  ng-disabled="gatepass_update.dept_id==null" ng-model="gatepass_update.device_id" name="device_id" ng-change="getDeviceDetailsByEID(gatepass_update.dept_id,gatepass_update.device_id)">
                                <md-option ng-value="nullValue">
                                    {{allValue}}
                                </md-option>
                                <md-option ng-repeat="device in devices"  ng-value="device.E_ID">
                                    {{device.E_ID}}
                                </md-option>
                            </md-select>
                        </md-input-container>--->
                       <md-autocomplete 
					   class="md-block" flex-gt-sm flex="45"  
					   md-no-cache="TRUE"   
                       required		
                       md-input-name="eqid"					   
					   md-selected-item="searched.EID"  
					   md-search-text="gatepass_update.searchEid"   					   
			           md-items="item in searchTextChange(gatepass_update.searchEid,gatepass_update.branch_id,gatepass_update.dept_id)" 
					   md-item-text="gatepass_update.device_id = item.E_ID" 
					   md-min-length="0"   
					   md-search-text-change="gatepass_update.device_id = ''"
					   md-selected-item-change="getDeviceDetailsByEID(gatepass_update.dept_id,gatepass_update.device_id)"
					   md-floating-label="Search Eq. id">
                <md-item-template>
                  <span md-highlight-text="searchText"  md-highlight-flags="^i">{{item.E_ID}}</span>
                </md-item-template>
				<div ng-messages="EditGatePassForm.eqid.$error">
				<div ng-message="required">Required.</div>
				</div>
                <md-not-found>    
				No Equipment Match Found                      
				</md-not-found>
              </md-autocomplete>






						
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Name</label>
                            <input type="text" ng-model="gatepass_update.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Model</label>
                            <input type="text" ng-model="gatepass_update.equp_model" name="equp_model" aria-label="gatepass_req" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Serial No</label>
                            <input type="text"  ng-model="gatepass_update.srial_no" name="srial_no" aria-label="srial_no" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45" n">
                        <label>Physical Location</label>
                        <input type="text" ng-model="gatepass_update.phy_location" name="phy_location" aria-label="phy_location" />
                        </md-input-container>
                    </div>

                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="30">
                            <label>GatePass Type</label>
                            <md-select ng-model="gatepass_update.gtype" name="ttype">
                                <md-option  required ng-repeat="transfer_type in transfer_types"  ng-value="transfer_type">
                                    {{transfer_type}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div ng-if="transfer_types[0]==gatepass_update.gtype" flex="5" hide-xs hide-sm><!-- Space --></div>
                        <div ng-if="transfer_types[0]==gatepass_update.gtype"  class="md-block" flex-gt-sm flex="30">
                            <md-input-container>
                                <label>Expecte Return</label>
                                <input required  type="text" ng-model="gatepass_update.expert_return" name="expert_return" aria-label="expert_return"/>
                            </md-input-container>
                        </div>
                        <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="30">
                            <label>Spares</label>
                            <md-select ng-model="gatepass_update.critical_spare" name="critical_spare" multiple>
                                <md-option ng-value="null">
                                    Select
                                </md-option>
                                <md-option ng-repeat="m_critical_spare in m_critical_spares"  ng-value="m_critical_spare.CODE">
                                    {{m_critical_spare.NAME}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Spares Count</label>
                            <input type="text" ng-model="gatepass_update.spars_cnt"  ng-maxlength="5" ng-pattern="/^(\d)+$/" ng-disabled="gatepass_update.critical_spare==null" required name="spars_cnt" aria-label="spars_cnt"/>
                           <div ng-messages="EditGatePassForm.spars_cnt.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="EditGatePassForm.spars_cnt.$error.pattern">Please Type Numbers only.</div>
							<div ng-show="EditGatePassForm.spars_cnt.$error.maxlength">Maxlength is Exceeds.</div>
							<!--<div ng-show="GatePassForm.spars_cnt.$error.minlength"></div>-->
                </div>
						</md-input-container>
                        <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm>
                            <label>Accessories</label>
                            <md-select ng-model="gatepass_update.accessories" name="accessorie" multiple>
                                <md-option ng-value="null">
                                    Select
                                </md-option>
                                <md-option ng-repeat="m_accessorie in m_accessories"  ng-value="m_accessorie.CODE">
                                    {{m_accessorie.NAME}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Accessories Count</label>
                            <input type="text" only-digits="only-digits"  ng-disabled="gatepass_update.accessories==null" ng-pattern="/^(\d)+$/" ng-maxlength="5" ng-model="gatepass_req.accessories_cnt"   name="accessories_cnt"  aria-label="accessories_cnt"/>
                        <div ng-messages="EditGatePassForm.accessories_cnt.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="EditGatePassForm.accessories_cnt.$error.pattern">Please Type Numbers only.</div>
							<div ng-show="EditGatePassForm.accessories_cnt.$error.maxlength">Maxlength is Exceeds.</div>
							<!--<div ng-show="GatePassForm.accessories_cnt.$error.minlength"></div>--->
                </div>
						</md-input-container>
                    </div>
                    <div flex layout="row">
                        <md-input-container class="md-block" flex-gt-sm >
                            <label>Reasons*</label>
                            <input type="text" ng-model="gatepass_update.reasons" required name="reasons" aria-label="reasons"/>
                            <div ng-messages="EditGatePassForm.reasons.$error">
			                <div ng-message="required">Required.</div>
			                    </div>
						</md-input-container>
                    </div>
                    <div flex layout="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Remarks</label>
                            <input type="text" ng-model="gatepass_update.remarks" name="remarks" aria-label="remarks"/>
                        </md-input-container>
                    </div>

                    <div flex layout="row" layout-align="center center">
                        
                            <md-button class="md-raised md-accent" ng-click="UpdateNewGatepass(gatepass_update,$index)" ng-disabled="EditGatePassForm.$invalid" aria-label="submit">Update</md-button>
                            <md-button class="md-raised md-default" ng-click="cancel()" aria-label="cancel">Cancel</md-button>
                        
                    </div>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>