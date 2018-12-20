<?PHP defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
  <div layout="column">
    <h3 class="heading-stylerespond">Viability Request</h3>
    <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
    <div flex layout="row" layout-align="center center">
      <form method="POST" name="ViabilityRequestForm" flex="95" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
        <div layout="row">
          <!--<md-autocomplete class="md-block"  flex-gt-sm flex="30"                                     md-no-cache="false"                                     md-selected-item="searched.EID"                                     md-search-text="searchEid"                                     md-items="item in searchTextChange(searchEid)"                                     md-item-text="item.E_ID"                                     md-min-length="0"                                     md-floating-label="Search Eq. id?"><md-item-template><span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span></md-item-template><md-not-found>                            No Equipment Match Found                        </md-not-found></md-autocomplete>-->
          <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Select Branch *</label>
            <md-select ng-model="add_viability.branch_id" required name="branch_id" aria-label="user_branch" >
              <md-option ng-repeat="branch in branchs" ng-value="branch.BRANCH_ID" ng-if="branch.BRANCH_ID !='All'">{{branch.BRANCH_NAME}}</md-option>
            </md-select>
			<div ng-messages="ViabilityRequestForm.branch_id.$error">
			<div ng-message="required">Required.</div>
			</div>
          </md-input-container>
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <!---<md-input-container class="md-block" flex-gt-sm flex="25">
            <label>Department</label>
            <md-select ng-change="getDepartmentDevices(add_viability.dept_id,add_viability.branch_id)" ng-model="add_viability.dept_id" name="dept_id">
              <md-option ng-repeat="dept in all_depts"  ng-value="dept.CODE">                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                            </md-option>
            </md-select>
          </md-input-container>--->
		  
		  
		  <md-autocomplete flex="25" class="md-block" flex-gt-sm
                         ng-value="add_viability.dept_id=searched.CODE"
						 md-no-cache="true"
						 md-input-name="department"
						 required
                         md-selected-item="searched.CODE"
                         md-search-text="searchDepartment"
                         md-items="item in searchTextChange(searchDepartment,'Department')"
                         md-item-text="item.USER_DEPT_NAME"
                         md-min-length="0"
                         md-floating-label="Search Department">
            <md-item-template>
                <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
            </md-item-template>
			<div ng-messages="ViabilityRequestForm.department.$error">
			<div ng-message="required">Required.</div>
			</div>
            <md-not-found>
                No Department Found
            </md-not-found>
        </md-autocomplete>
		<span ng-value="add_viability.dept_id = searched.CODE.CODE" ></span>
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <!--<md-input-container class="md-block" flex-gt-sm flex="25">
            <label>Equipment ID *</label>
            <md-select required ng-disabled="add_viability.dept_id==null" ng-model="add_viability.equp_id" name="equp_id" ng-change="getDeviceDetailsByEID(add_viability.dept_id,add_viability.equp_id);getEIDByPriority(add_viability.equp_id)">
              <md-option ng-repeat="device in devices"  ng-value="device.E_ID" ng-if="devices.length >0 ">                                {{device.E_ID}}                            </md-option>
              <md-option ng-if="devices.length == 0">                                No Equipments Found                            </md-option>
            </md-select>
          </md-input-container>--->
		  
		  <md-autocomplete   class="md-block" flex-gt-sm flex="25"

                                     md-no-cache="true"
									 md-input-name="Eq.ID"
									 required
									 ng-value="add_viability.equp_id=searched.E_ID"
                                     md-selected-item="searched.E_ID"
                                     md-search-text="add_viability.searchEid"
                                     md-items="item in searchTextChange(add_viability.searchEid,add_viability.branch_id,add_viability.dept_id)"
                                     md-item-text="add_viability.equp_id = item.E_ID"
                                     md-min-length="0"
                                     md-search-text-change="add_viability.equp_id = ''"
                                     md-selected-item-change="getDeviceDetailByEID(item)"
                                     md-floating-label="Search Eq. id">
                        <md-item-template>
                            <span md-highlight-text="searchText"  md-highlight-flags="^i">{{item.E_ID}}</span>
                        </md-item-template>
						<div ng-messages="ViabilityRequestForm.Eq.ID.$error">
			<div ng-message="required">Required.</div>
			</div>
                        <md-not-found>
                            No Equipment Match Found
                        </md-not-found>
                    </md-autocomplete>
                       <span ng-value="add_viability.equp_id = searched.E_ID.E_ID" ></span>
          <!--<md-input-container  class="md-block" flex-gt-sm flex="20"><label>Department</label><md-select ng-model="add_viability.department" name="depts"><md-option ng-repeat="dept in depts"  ng-value="dept.CODE">                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                            </md-option></md-select></md-input-container>-->
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Cost of Consumables</label>
            <input type="text"  ng-maxlength="5" ng-pattern="/^(\d)+$/"  ng-model="add_viability.cost_consumables" name="cost_consumables" aria-label="cost_consumables"/>
          <div ng-messages="ViabilityRequestForm.cost_consumables.$error">
			<div ng-message="required">Required.</div>
			<div ng-show="ViabilityRequestForm.cost_consumables.$error.maxlength">Max length is Exceeds.</div>
			<div ng-show="ViabilityRequestForm.cost_consumables.$error.pattern">Please type numbers only</div>
			</div>
		  
		  </md-input-container>
		  
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <md-input-container class="md-block" flex-gt-sm flex="15">
            <label>Disposable Cost</label>
            <input type="text" ng-pattern="/^(\d)+$/"   required ng-maxlength="10" ng-model="add_viability.disposal_cost" name="disposal_cost" aria-label="disposal_cost"/>
           <div ng-messages="ViabilityRequestForm.disposal_cost.$error">
			<div ng-message="required">Required.</div>
			<div ng-show="ViabilityRequestForm.disposal_cost.$error.maxlength">Max length is Exceeds.</div>
			<div ng-show="ViabilityRequestForm.disposal_cost.$error.pattern">Please type numbers only</div>
			</div>
		  </md-input-container>
        </div>
        <div layout="row">
          <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Number of Cases Done Daily</label>
            <input  type="text" ng-pattern="/^(\d)+$/" ng-maxlength="5" ng-model="add_viability.no_of_cases_daily" name="no_of_cases_daily" aria-label="no_of_cases_daily"/>
               <div ng-messages="ViabilityRequestForm.no_of_cases_daily.$error">
			   <div ng-show="ViabilityRequestForm.no_of_cases_daily.$error.maxlength">Max length is Exceeds.</div>
			<div ng-show="ViabilityRequestForm.no_of_cases_daily.$error.pattern">Please type numbers only</div>
			</div>       
		 </md-input-container>
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Charges Per Operation/Procedure</label>
            <input type="text" ng-model="add_viability.charge_operation" ng-pattern="/^(\d)+$/"  ng-maxlength="10" name="charge_operation" aria-label="charge_operation"/>
           <div ng-messages="ViabilityRequestForm.charge_operation.$error">
			<div ng-show="ViabilityRequestForm.charge_operation.$error.maxlength">Max length is Exceeds.</div>
			<div ng-show="ViabilityRequestForm.charge_operation.$error.pattern">Please type numbers only</div>
			</div>  
		 </md-input-container>
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Number of Operations Per Year</label>
            <input  type="text" ng-maxlength="5" ng-pattern="/^(\d)+$/" ng-model="add_viability.no_of_oper_per_year" name="no_of_oper_per_year" aria-label="no_of_oper_per_year"/>
            <div ng-messages="ViabilityRequestForm.no_of_oper_per_year.$error">
			<div ng-show="ViabilityRequestForm.charge_operation.$error.maxlength">Max length is Exceeds.</div>
			<div ng-show="ViabilityRequestForm.charge_operation.$error.pattern">Please type numbers only</div>
			</div>  
		  </md-input-container>
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <md-input-container class="md-block" flex-gt-sm flex="25">
            <label>Revenue Per Year</label>
            <input ng-pattern="/^(\d)+$/" type="text" ng-maxlength="10" ng-model="add_viability.revenu_year" name="revenu_year" aria-label="revenu_year"/>
          <div ng-messages="ViabilityRequestForm.revenu_year.$error">
             <div ng-show="ViabilityRequestForm.revenu_year.$error.maxlength">Max length is Exceeds.</div>
			<div ng-show="ViabilityRequestForm.revenu_year.$error.pattern">Please type numbers only</div>		
			</div>  
		  </md-input-container>
        </div>
        <div layout="row" flex>
          <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Profit over One Year </label>
            <input  type="text" ng-maxlength="10" ng-pattern="/^(\d)+$/" ng-model="add_viability.Profit_over_one_year" name="Profit_over_one_year" aria-label="Profit_over_one_year"/>
           <div ng-messages="ViabilityRequestForm.Profit_over_one_year.$error">
			<div ng-show="ViabilityRequestForm.Profit_over_one_year.$error.maxlength">Max length is Exceeds.</div>
			<div ng-show="ViabilityRequestForm.Profit_over_one_year.$error.pattern">Please type numbers only</div>
			</div>  
		 </md-input-container>
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Profit Over Three Year</label>
            <input  type="text" ng-maxlength="10" ng-pattern="/^(\d)+$/" ng-model="add_viability.Profit_over_three_year" name="Profit_over_three_year" aria-label="Profit_over_three_year"/>
           <div ng-messages="ViabilityRequestForm.Profit_over_three_year.$error">
			<div ng-show="ViabilityRequestForm.Profit_over_three_year.$error.maxlength">Max length is Exceeds.</div>
			<div ng-show="ViabilityRequestForm.Profit_over_three_year.$error.pattern">Please type numbers only</div>
			</div>           
		 </md-input-container>
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Code of Operation</label>
            <input  type="text"  ng-maxlength="10" ng-pattern="/^(\d)+$/" ng-model="add_viability.Code_of_operation" name="Code_of_operation" aria-label="Code_of_operation"/>
          <div ng-messages="ViabilityRequestForm.Code_of_operation.$error">
			<div ng-show="ViabilityRequestForm.Code_of_operation.$error.maxlength">Max length is Exceeds.</div>
			<div ng-show="ViabilityRequestForm.Code_of_operation.$error.pattern">Please type numbers only</div>
			</div>  
		  </md-input-container>
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
        </div>
        <div layout="row">
          <div>
            <label> Justification</label>
            <md-input-container class="md-block">
              <textarea ck-editor ng-model="add_viability.justification" md-select-on-focus=""></textarea>
            </md-input-container>
          </div>
          <div flex="5" hide-xs hide-sm>
            <!-- Space -->
          </div>
          <div>
            <label>Advantages</label>
            <md-input-container class="md-block">
              <textarea ck-editor ng-model="add_viability.advantages" md-select-on-focus=""></textarea>
            </md-input-container>
          </div>
        </div>
        <div layout="row">
          <div flex="100">
            <label> Technical Specifications of the Eq. being Purchased</label>
            <md-input-container class="md-block">
              <textarea ck-editor ng-model="add_viability.tsebp" md-select-on-focus=""></textarea>
            </md-input-container>
          </div>
        </div>
        <div flex layout="row" layout-align="center center">
          
            <md-button class="md-raised md-accent" ng-click="addViability(add_viability)" ng-disabled="ViabilityRequestForm.$invalid" aria-label="submit">Submit</md-button>
          
            <md-button class="md-raised" aria-label="submit" ui-sref="home.viability">Cancel</md-button>
          </center>
        </div>
      </form>
    </div>
  </div>
</md-content>