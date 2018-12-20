<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
    <h3 class="heading-stylerespond">Add User</h3>
    <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
    <div flex layout="row" layout-align="center center">
        <form method="POST" name="addUserForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
			<div flex layout="row">
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Employee ID</label>
                    <input only-digits="only-digits" type="emp_no" ng-change="getCCCEmpDetls(add_user.emp_no)" required ng-model="add_user.emp_no" name="emp_no" aria-label="emp_no"/>
                    <div ng-messages="addUserForm.emp_no.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
				<md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Name</label>
                    <input type="text" readonly required ng-model="add_user.user_name" name="user_name" aria-label="user_name"/>
                    <div ng-messages="addUserForm.user_name.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
            </div>
            <div flex layout="row" layout-align="center center">
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Contact Number</label>
                    <input only-digits="only-digits" type="text" required ng-model="add_user.mbl_no" name="mbl_no" aria-label="mbl_no"/>
                    <div ng-messages="addUserForm.mbl_no.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
				<div flex="20" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Email Id</label>
                    <input type="email" required ng-model="add_user.user_email" name="user_email" aria-label="user_email"/>
                    <div ng-messages="addUserForm.user_email.$error">
                        <div ng-message="required">Required.</div>
                        <div ng-message="email">Enter Valid Email ID.</div>
                    </div>
                </md-input-container>
            </div>

            <!--<div layout="row">
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>User Type *</label>
                    <md-select name="roleid" required ng-model="add_user.roleid" aria-label="roleid">
                        <md-option ng-value="nullValue">Select Type</md-option>
                        <md-option ng-if="user_role_priority<role.ROLE_PRIORITY && role.ROLE_CODE!=HBUSER" ng-value="role.ROLE_CODE" ng-repeat="role in roles">{{role.ROLE_NAME}}</md-option>
                    </md-select>
                    <div ng-messages="addUserForm.roleid.$error">
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