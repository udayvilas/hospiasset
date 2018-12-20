<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Vendor</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addVendorForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Hospitals *</label>
                        <md-select ng-model="add_vendor.org_id" name="org_id" ng-change="getBranchDetailsByHospitalID(add_vendor.org_id)" required multiple aria-label="org_id">
                            <md-option ng-repeat="hospital in hospitals" ng-value="hospital.ORG_ID">
                                {{hospital.ORG_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                            <!--<md-input-container class="md-block" flex-gt-sm flex="30">
                            <label>Branchs</label>
                            <md-select ng-model="add_vendor" multiple="" ng-disabled="add_vendor.org_id==null">
                                <md-optgroup label="CARE">
                                    <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in hospital_branchs ">{{branch.BRANCH_NAME}}</md-option>
                                </md-optgroup>
                                <md-optgroup label="apollo">
                                    <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in hospital_branchs ">{{branch.BRANCH_NAME}}</md-option>
                                </md-optgroup>
                            </md-select>
                        </md-input-container>--->
                    <md-input-container>
                        <label>Branchs</label>
                        <md-select ng-model="add_vendor.branch_id" multiple="" ng-disabled="add_vendor.org_id==null" >
                            <md-optgroup label="{{hospital.ORG_NAME}}" ng-repeat="hospital in hospital_branchs" >
                                <md-option ng-value="item.BRANCH_ID +'|'+ hospital.ORG_ID" ng-repeat="item in hospital.branches" >{{item.BRANCH_NAME}}</md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>


                   <!--<md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Branchs *</label>
                        <md-select ng-model="add_vendor.branch_id" ng-disabled="add_vendor.org_id==null"   name="branch_id" required   multiple aria-label="branch_id">
                            <md-option ng-repeat="branch in hospital_branchs" ng-value="branch.BRANCH_ID">{{branch.BRANCH_NAME}}</md-option>
                        </md-select>
                    </md-input-container>-->
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Name</label>
                        <input type="text" required ng-model="add_vendor.vendor_name" name="vendor_name" aria-label="vendor_name"/>
                        <div ng-messages="add_vendor.vendor_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div  layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Contact Number</label>
                        <input only-digits="only-digits"  maxlength="10" minlength="10" required type="text" ng-change="checktheVendorexists(add_vendor.mbl_no)" ng-model="add_vendor.mbl_no" name="mbl_no" aria-label="mbl_no"/>
                        <span ng-show="vendorexists" class="mandatory-fileds" >Vendor Already Exists</span>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Email Id</label>
                        <input type="email" required ng-model="add_vendor.email" name="email" aria-label="email"/>
                        <div ng-messages="addVendorForm.email.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="email">Enter Valid Email ID.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Vendor Type *</label>
                        <md-select required ng-model="add_vendor.type" name="type" aria-label="type" multiple>
                            <md-option ng-value="vdr_type.NAME" ng-repeat="vdr_type in vdr_types">{{vdr_type.NAME}}</md-option>
                        </md-select>
                    </md-input-container>


        </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Countries </label>
                        <md-select ng-model="add_vendor.country" name="country" ng-change="getStateDetailsByCountryID(add_vendor.country)" required aria-label="country">
                            <md-option ng-repeat="country in countries" ng-value="country.COUNTRY_CODE">
                                {{country.COUNTRY_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>States *</label>
                        <md-select ng-model="add_vendor.states" ng-disabled="add_vendor.country==null"  ng-change="getCityDetailsByStateID(add_vendor.states)"name="states" required   aria-label="states">
                            <md-option ng-repeat="state in country_states" ng-value="state.STATE_CODE">{{state.STATE_NAME}}</md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Cities </label>
                        <md-select ng-model="add_vendor.cities" name="cities" required   aria-label="cities"  ng-disabled="add_vendor.states==null">
                            <md-option ng-repeat="city in state_cities" ng-value="city.CITY_CODE">
                                {{city.CITY_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div flex layout="row">


                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <!---<md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>User Type *</label>
                        <md-select name="roleid" required ng-model="add_user.roleid" aria-label="roleid">
                            <md-option ng-value="nullValue">Select Type</md-option>
                            <md-option ng-repeat="role in org_roles" ng-if="user_role_code!=role.ROLE_CODE" ng-value="role.EROLE_CODE">{{role.ROLE_NAME}}</md-option>
                        </md-select>
                        <div ng-messages="addHaVendorForm.roleid.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>-->

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
                        <md-button class="md-raised md-accent" ng-click="addhaVendor(add_vendor)"  aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>

