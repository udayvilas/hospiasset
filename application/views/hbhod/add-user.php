<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
    <h3 class="heading-stylerespond">Add User</h3>
    <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
    <div flex layout="row" layout-align="center center" >
        <form method="POST" name="addUserForm" flex="60"  class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
			<div flex layout="row" >
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>{{users_label.BRANCH}}*</label>
                    <md-select ng-model="add_user.branch_id" aria-label="user_branch" multiple>
                        <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs" ng-if="branch.BRANCH_ID !='All'">
                            {{branch.BRANCH_NAME}}
                        </md-option>
                    </md-select>
					<div ng-messages="addUserForm.branch_id.$error">
                        <div ng-message="required">Required.</div>
						</div>
                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>{{users_label.EMP_NO}}</label>
                    <input only-digits="only-digits" ng-change="check_emp_no(add_user.emp_no)" type="emp_no" required minlength="8" md-maxlength="14" ng-model="add_user.emp_no" name="emp_no" aria-label="emp_no"/>					<span ng-bind="NMessage" ng-style="{color:NColor}"></span>
                    <span ng-bind="Message" ng-style="{color:Color}"></span>
                    <div ng-messages="addUserForm.emp_no.$error">
                        <div ng-message="required">Required.</div>
						<div ng-message="md-maxlength">Max limit is reached.</div>
						<div ng-message="minlength">Min length is 8</div>
                    </div>
                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
				<md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>{{users_label.USER_NAME}}</label>
                    <input type="text" required ng-model="add_user.user_name" name="user_name" aria-label="user_name"/>
                    <div ng-messages="addUserForm.user_name.$error">
                        <div ng-message="required">Required.</div>
						
                    </div>
                </md-input-container>
            </div>
			
            <div layout="row">
				<!---<md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Alternate Number</label>
                    <input only-digits="only-digits" ng-minlength="8" md-maxlength="14"  type="text" required ng-model="add_user.mbl_no" name="mbl_no" aria-label="mbl_no"/>
                    <div ng-messages="addUserForm.mbl_no.$error">
                        <div ng-message="required">Required.</div>
						<div ng-message="md-maxlength">Max limit is reached.</div>
						<div ng-message="minlength">Min length is 8</div>
                    </div>
                </md-input-container>--->
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>{{users_label.EMAIL_ID}}</label>
                    <input type="email" required ng-change="checkemail(add_user.user_email)" ng-model="add_user.user_email" name="user_email" aria-label="user_email"/>			
                    <span ng-bind="EMessage" ng-style="{color:EColor}"></span>
                    <div ng-messages="addUserForm.user_email.$error">
                        <div ng-message="required">Required.</div>
                        <div ng-message="email">Enter Valid Email ID.</div>
                    </div>
                </md-input-container>
           
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
          
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>{{users_label.ROLE_NAME}}*</label>
                    <md-select name="roleid" required ng-model="add_user.roleid" aria-label="roleid">
                        <md-option ng-value="nullValue">Select Type</md-option>
                        <md-option ng-repeat="role in org_roles | orderBy:'ROLE_NAME'" ng-if="role.ROLE_CODE!=user_role_code" ng-value="role.ROLE_CODE">{{role.ROLE_NAME}}</md-option>
                    </md-select>
                    <div ng-messages="addUserForm.roleid.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="20" hide-xs hide-sm></div>
                <!--<md-input-container ng-show="user_role_code==HMADMIN" class="no-margin-padding-md-input" flex="20" flex-xs="100">
                    <md-select placeholder="Select Branch *" ng-model="completecall_search.branch_id" ng-change="SearchCompletedCalls()" aria-label="user_branch">
                        <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs" >{{branch.BRANCH_NAME}}</md-option>
                    </md-select>
                </md-input-container>
                <!--<div flex="20" hide-xs hide-sm><!-- Space --/></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Levels *</label>
                    <md-select name="level" ng-required="add_user.roleid!=HBUSER" ng-model="add_user.level" aria-label="level">
                        <md-option ng-value="nullValue">Select Type</md-option>
                        <md-option ng-value="level.LEVEL_NAME" ng-repeat="level in levels">{{level.LEVEL_NAME}}</md-option>
                    </md-select>
                    <div ng-messages="addUserForm.level.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>-->
            </div>
             <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="addUser(add_user)" ng-disabled="addUserForm.$invalid" aria-label="submit">Submit</md-button>

                    <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbhod_users">Cancel</md-button>

            </div>
        </form>
    </div>
    </div>
</md-content>