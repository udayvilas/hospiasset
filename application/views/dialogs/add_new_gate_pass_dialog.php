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
            <md-input-container class="md-block" flex-gt-sm flex="45">
              <label>Select Branch *</label>
			  <md-select ng-model="gatepass_req.branch_id"   name="branch_id"  aria-label="user_branch" ng-change="branch_all_loading(gatepass_req.branch_id)" required >
                <md-option ng-value="branch.BRANCH_ID"  ng-if="branch.BRANCH_ID !='All'" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
              </md-select>
			  <div ng-messages="GatePassForm.branch_id.$error">
                    <div ng-message="required">Required.</div>
              </div>
            </md-input-container>
            <div flex="5" hide-xs hide-sm>
              <!-- Space -->
            </div>
            <md-input-container class="md-block" flex-gt-sm flex="45">
              <label>To Whom</label>
              <input type="text" ng-model="gatepass_req.to_whom" required name="to_whom" aria-label="to_whom">
              <div ng-messages="GatePassForm.to_whom.$error">
			  <div ng-message="required">Required.</div>
			  </div>
			  </md-input-container>
              
			 
              <!---<md-input-container class="md-block" flex-gt-sm flex="45"><label>Department</label><md-select ng-change="getDepartmentDevices(gatepass_req.dept_id)" ng-model="gatepass_req.dept_id" name="dept_id" required><md-option ng-value="null">                                    Select                                </md-option><md-option ng-repeat="dept in all_depts"  ng-value="dept.CODE">                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                                </md-option></md-select></md-input-container>--->
              <md-autocomplete flex="45" class="md-block" flex-gt-sm 
					  required
					  md-input-name="department"	
					  md-no-cache="false"     
					  md-selected-item="searched.CODE"  
					  md-search-text="gatepass_req.searchDepartment"                      
					  md-items="item in searchTextChange(gatepass_req.searchDepartment,'Department')"  
					  md-item-text="gatepass_req.dept_id=item.USER_DEPT_NAME" 
                      md-search-text-change="gatepass_req.dept_id=''"					  
					  md-min-length="0"	 					  
					  md-floating-label="Search Department">
                <md-item-template>
                  <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
                </md-item-template>
				<div ng-messages="GatePassForm.department.$error" ng-if="GatePassForm.department.$touched">
					<div ng-message="required">Required</div>
				</div>
                <!--<md-not-found>           
				No Department Found        
				</md-not-found>--->
              </md-autocomplete>
              <span ng-value="gatepass_req.dept_id = searched.CODE.CODE"></span>
              <div flex="5" hide-xs hide-sm>
                <!-- Space -->
              </div>
              <!----<md-input-container class="md-block" flex-gt-sm flex="45"><label>Equipment ID *</label><md-select  ng-disabled="gatepass_req.dept_id==null" ng-model="gatepass_req.device_id" name="device_id" ng-change="getDeviceDetailsByEID(gatepass_req.dept_id,gatepass_req.device_id)" required><md-option ng-value="nullValue">Select</md-option><md-option ng-repeat="device in devices"  ng-value="device.E_ID">                                    {{device.E_ID}}                                </md-option></md-select></md-input-container>---->
              <md-autocomplete  ng-if="gatepass_req.branch_id != NULL" class="md-block" 
				  required
				  md-input-name="equipmentid"
				  flex-gt-sm flex="45"                                     			
				  md-no-cache="false"    
				  md-selected-item="searched.EID" 
				  md-search-text="gatepass_req.searchEid"
				  md-items="item in searchTextChange(gatepass_req.searchEid,gatepass_req.branch_id,gatepass_req.dept_id)"
				  md-item-text="gatepass_req.device_id = item.E_ID" 
				  md-min-length="0" 				  
				  md-search-text-change="gatepass_req.device_id = ''"                                     
				  md-selected-item-change="getDeviceDetailsByEID(gatepass_req.dept_id,gatepass_req.device_id)"
				  md-floating-label="Search Eq. id">
                <md-item-template>
                  <span md-highlight-text="searchText"  md-highlight-flags="^i">{{item.E_ID}}</span>
                </md-item-template>
				<div ng-messages="GatePassForm.equipmentid.$error" ng-if="GatePassForm.equipmentid.$touched">
					<div ng-message="required">Required</div>
				</div>
                <md-not-found>    
				No Equipment  found.             
				</md-not-found>
              </md-autocomplete>
              
              <md-input-container class="md-block" flex-gt-sm flex="45">
                <label>Equipment Name</label>
                <input type="text" ng-model="gatepass_req.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
              </md-input-container>
              <div flex="5" hide-xs hide-sm>
                <!-- Space -->
              </div>
              <!--</div><div layout="row">-->
              <md-input-container class="md-block" flex-gt-sm flex="45">
                <label>Equipment Model</label>
                <input type="text" ng-model="gatepass_req.equp_model" name="equp_model" aria-label="gatepass_req" ng-disabled="true"/>
              </md-input-container>
              <div flex="5" hide-xs hide-sm>
                <!-- Space -->
              </div>
              <md-input-container class="md-block" flex-gt-sm flex="45">
                <label>Equipment Serial No</label>
                <input type="text" ng-model="gatepass_req.srial_no" name="srial_no" aria-label="srial_no" ng-disabled="true"/>
              </md-input-container>
              <div flex="5" hide-xs hide-sm>
                <!-- Space -->
              </div>
              <md-input-container class="md-block" flex-gt-sm flex="45">
                <label>Physical Location</label>
                <input type="text" ng-model="gatepass_req.phy_location" name="phy_location" aria-label="phy_location" />
              </md-input-container>
              <div flex="5" hide-xs hide-sm>
                <!-- Space -->
              </div>
              <!--</div><div layout="row">-->
              <md-input-container class="md-block" flex-gt-sm flex="45">
                <label>GatePass Type</label>
                <md-select ng-model="gatepass_req.gtype" name="ttype" required>
                  <md-option  ng-repeat="transfer_type in transfer_types"  ng-value="transfer_type"> 
				  {{transfer_type}}   
				  </md-option>
                </md-select>
				<div ng-messages="GatePassForm.gtype.$error">
                    <div ng-message="required">Required.</div>
				</div>
              </md-input-container>
              <div ng-if="transfer_types[0]==gatepass_req.gtype" flex="5" hide-xs hide-sm>
                <!-- Space -->
              </div>
              <div ng-if="transfer_types[0]==gatepass_req.gtype"  class="md-block" flex-gt-sm flex="45">
                <mdp-date-picker mdp-placeholder="Expecte Return "  name="expert_return" ng-required="transfer_types[0]==gatepass_req.gtype" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" mdp-min-date="minDate" ng-model="gatepass_req.expert_return"></mdp-date-picker>
              </div>
              <div flex="5" hide-xs hide-sm >
                <!-- Space -->
              </div>
              <md-input-container  class="md-block" flex-gt-sm flex="45">
                <label>Spares</label>
                <md-select ng-model="gatepass_req.critical_spare" name="critical_spare" multiple>
                  <md-option ng-repeat="m_critical_spare in m_critical_spares"  ng-value="m_critical_spare.CODE">                                    {{m_critical_spare.NAME}}                                </md-option>
                </md-select>
              </md-input-container>
              <div flex="5" hide-xs hide-sm>
                <!-- Space -->
              </div>
              <md-input-container class="md-block" flex-gt-sm flex="45">
                <label>Spares Count</label>
                <input type="text" ng-model="gatepass_req.spars_cnt" ng-pattern="/^[1-9][0-9]" required  ng-maxlength="5" ng-minlength="1" ng-disabled="gatepass_req.critical_spare==null" name="spars_cnt" aria-label="spars_cnt"/>
				<div ng-messages="GatePassForm.spars_cnt.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="GatePassForm.spars_cnt.$error.pattern">Please Type Numbers only.</div>
							<div ng-show="GatePassForm.spars_cnt.$error.maxlength">Maxlength is Exceeds.</div>
							<div ng-show="GatePassForm.accessories_cnt.$error.minlength">Please Enter minlength</div>
							<!--<div ng-show="GatePassForm.spars_cnt.$error.minlength"></div>-->
                </div>
              </md-input-container>
              <div flex="5" hide-xs hide-sm >
                <!-- Space -->
              </div>
              <md-input-container  class="md-block" flex-gt-sm flex="45">
                <label>Accessories</label>
                <md-select ng-model="gatepass_req.accessories" name="accessorie" multiple>
                  <md-option ng-repeat="m_accessorie in m_accessories"  ng-value="m_accessorie.CODE">                                    {{m_accessorie.NAME}}                                </md-option>
                </md-select>
              </md-input-container>
              <div flex="5" hide-xs hide-sm >
                <!-- Space -->
              </div>
              <md-input-container class="md-block" flex-gt-sm flex="45">
                <label>Accessories Count</label>
                <input type="text" only-digits="only-digits"  ng-disabled="gatepass_req.accessories==null" ng-minlength="1" ng-pattern="/^(\d)+$/" ng-maxlength="5"  ng-model="gatepass_req.accessories_cnt"  name="accessories_cnt"  aria-label="accessories_cnt"/>
				<div ng-messages="GatePassForm.accessories_cnt.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="GatePassForm.accessories_cnt.$error.pattern">Please Type Numbers only.</div>
							<div ng-show="GatePassForm.accessories_cnt.$error.maxlength">Maxlength is Exceeds.</div>
							<div ng-show="GatePassForm.accessories_cnt.$error.minlength">Please Enter minlength</div>
							<!--<div ng-show="GatePassForm.accessories_cnt.$error.minlength"></div>--->
                </div>
              </md-input-container>
              <div flex="5" hide-xs hide-sm>
                <!-- Space -->
              </div>
              <!--</div><div flex layout="row">-->
              <md-input-container class="md-block" flex-gt-sm flex="45">
                <label>Reasons</label>
                <input type="text" ng-model="gatepass_req.reasons" required name="reasons" aria-label="reasons"/>
              <div ng-messages="GatePassForm.reasons.$error">
			  <div ng-message="required">Required.</div>
			  </div>
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
                <md-button class="md-raised md-accent" ng-click="appendGatepass()" ng-disabled="GatePassForm.$invalid" aria-label="submit">Add</md-button>
                <md-button class="md-raised md-default" ng-click="clear();hide();" aria-label="cancel">Cancel</md-button>
              </center>
            </div>
          </div>
        </form>
      </div>
    </md-dialog-content>
  </md-dialog>