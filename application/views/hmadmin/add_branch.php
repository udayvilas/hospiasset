<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Branch</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <span flex class="mandatory-fileds"></span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addBranchForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{branch_labels.BRANCH_NAME}}</label>
                        <input type="text" required ng-model="add_branch.branch_name"  name="branch_name" minlength="3" md-maxlength="50"  ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" aria-label="branch_name"/>                       
                        <div ng-messages="addBranchForm.branch_name.$error">
                            <div ng-message="required">Required.</div> 
							<div ng-message="md-maxlength">Max limit is reached.</div>
                            <div ng-show="addBranchForm.branch_name.$error.pattern">Please Provide Text Only.</div>                       
							<div ng-show="addBranchForm.branch_name.$error.minlength">minlength 3</div>				
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{branch_labels.BRANCH_CODE}}</label>
                        <input type="text" required ng-model="add_branch.branch_code" name="branch_code" ng-change="add_branch.branch_code = (add_branch.branch_code | uppercase)" minlength="2" md-maxlength="2" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" aria-label="branch_code"/>
                        <div ng-messages="addBranchForm.branch_code.$error">                          
						<div ng-message="required">Required.</div>  
                        <div ng-message="md-maxlength">Max limit is reached.</div>						
						<div ng-show="addBranchForm.branch_code.$error.pattern">Please Provide Text Only.</div>                       
						<div ng-show="addBranchForm.branch_code.$error.minlength">minlength 2</div>				
						
                            
                        </div>
                    </md-input-container>

                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <!----<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>ERP Code</label>
                        <input type="text" required ng-model="add_branch.branch_erp_code" name="branch_erp_code" aria-label="branch_erp_code"/>
                        <div ng-messages="addBranchForm.branch_erp_code.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>--->
                </div>
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{branch_labels.BRANCH_CITY}}*</label>
                        <md-select name="city_name" required ng-model="add_branch.city_name" aria-label="city_name">
                            <md-option  ng-value="city_name.CITY_CODE" ng-repeat="city_name in city_names">{{city_name.CITY_NAME}}</md-option>
                        </md-select>
                        <div ng-messages="addBranchForm.city_name.$error">
                            <div ng-message="required">Required.</div>
							<div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{branch_labels.BRANCH_ADDRESS}}</label>
						<input type="text"  ng-model="add_branch.branch_address" name="branch_address"  md-maxlength="250"  aria-label="branch_address"/>

                        <!---<textarea ng-model="add_branch.branch_address" md-maxlength="3" md-select-on-focus></textarea>   --->                          <!-- <div ng-messages="addBranchForm.branch_address.$error">							  <div ng-show="addBranchForm.branch_address.$error.maxlength">max length Exceeds</div>                              </div>-->
                         <div ng-messages="addBranchForm.branch_address.$error">
						 <div ng-message="md-maxlength">Max limit is reached.</div>
                         </div>						 
				   </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addBranch(add_branch)" ng-disabled="addBranchForm.$invalid" aria-label="submit">Submit</md-button>
                         <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hmadmin_branches">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>