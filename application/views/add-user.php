<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
    <h3 class="heading-stylerespond">Add User</h3>
    <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
    <div flex layout="row" layout-align="center center">
        <form method="POST" name="addUserForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
            <div layout="row">
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Mobile Number</label>
                    <input only-digits="only-digits" type="emp_no" maxlength="10" minlength="10" ng-change="check_emp_no(add_user.emp_no)" required ng-model="add_user.emp_no" name="emp_no" aria-label="emp_no"/>					<span ng-bind="Message" ng-style="{color:Color}"></span>
                    <div ng-messages="addUserForm.emp_no.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Name</label>
                    <input type="text" required ng-model="add_user.user_name" name="user_name" aria-label="user_name"/>
                    <div ng-messages="addUserForm.user_name.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
            </div>

            <div flex layout="row">
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Contact Number</label>
                    <input only-digits="only-digits"  maxlength="10" minlength="10" type="text" required ng-model="add_user.mbl_no" name="mbl_no" aria-label="mbl_no"/>
                    <div ng-messages="addUserForm.mbl_no.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Email Id</label>
                    <input type="email" required ng-change="checkemail(add_user.user_email)" ng-model="add_user.user_email" name="user_email" aria-label="user_email"/>
                    <span ng-bind="EMessage" ng-style="{color:EColor}"></span>
					<div ng-messages="addUserForm.user_email.$error">
                        <div ng-message="required">Required.</div>
                        <div ng-message="email">Enter Valid Email ID.</div>
                    </div>
                </md-input-container>
            </div>
            <div flex layout="row">
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Select Branch *</label>
                    <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" name="branch_id" required multiple ng-model="add_user.branch_id" aria-label="branch_id">
                        <md-select-header class="demo-select-header">
                            <input ng-model="searchTerm" type="text" placeholder="Search Branch" class="demo-header-searchbox md-text">
                        </md-select-header>
                        <md-optgroup label="branches">
                            <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs |
              filter:searchTerm">{{branch.BRANCH_NAME}}</md-option>
                        </md-optgroup>
                    </md-select>
                    <div ng-messages="addUserForm.branchid.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
				<md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>User Type *</label>
                    <md-select name="roleid" required ng-model="add_user.roleid" aria-label="roleid">
                        <md-option ng-value="nullValue">Select Type</md-option>
                        <md-option ng-repeat="role in org_roles" ng-if="user_role_code!=role.ROLE_CODE" ng-value="role.ROLE_CODE">{{role.ROLE_NAME}}</md-option>
                    </md-select>
                    <div ng-messages="addUserForm.roleid.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>

            </div>
            <!--<div flex layout="row">
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Levels *</label>
                    <md-select name="level" ng-required="add_user.roleid!=HBUSER" ng-model="add_user.level" aria-label="level">
                        <md-option ng-value="nullValue">Select Type</md-option>
                        <md-option  ng-value="level.LEVEL_NAME" ng-repeat="level in levels">{{level.LEVEL_NAME}}</md-option>
                    </md-select>
                    <div ng-messages="addUserForm.level.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
            </div>-->
            <div flex layout="row" layout-align="center center">
                <center>
                    <md-button class="md-raised md-accent" ng-click="addUser(add_user)" ng-disabled="addUserForm.$invalid" aria-label="submit">Submit</md-button>
                </center>
            </div>
        </form>
    </div>
    </div>
</md-content>

