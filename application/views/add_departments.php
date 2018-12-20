<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Depatments</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addDeptForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <!--<md-input-container class="md-block" flex-gt-sm flex="40">
					<label>Module Id</label>
					<input type="text" ng-model="user_org_module" readonly name="module_id" required aria-label="module_id">
                         
					</md-input-container>-->
					<md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{depart_labels.USER_DEPT_NAME}}</label>
                        <input type="text" required ng-model="add_dept.department" name="department" md-maxlength="50"   aria-label="department"/>
                        <div ng-messages="addDeptForm.department.$error">                         <div ng-message="required">Required.</div>                          <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{depart_labels.CODE}}</label>
                        <input type="text" required ng-model="add_dept.dept_code" name="dept_code"  ng-change="add_dept.dept_code = (add_dept.dept_code | uppercase)" ng-pattern ="/^[a-zA-Z. ]*[a-zA-Z]$/"  	md-maxlength="3" aria-label="dept_code"/>
                        <div ng-messages="addDeptForm.dept_code.$error">                        <div ng-message="required">Required.</div>						 <div ng-message="md-maxlength">Max limit is reached.</div>						 <div ng-show="addDeptForm.dept_code.$error.pattern">Please Provide Text Only.</div>                          </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addDepartment(add_dept)" ng-disabled="addDeptForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.departments">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>