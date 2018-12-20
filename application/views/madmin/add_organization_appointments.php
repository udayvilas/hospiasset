<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add organization</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addHospitalForm" flex="80" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <h5 class="sub_heading-style-respond">Organization Details</h5>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Organisation Name</label>
                        <input type="text" required ng-model="add_hospitals.org_name" name="org_name" aria-label="org_name"/>
                        <div ng-messages="addHospitalForm.org_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Organisation Type *</label>
                        <md-select ng-model="add_hospitals.org_type" name="org_type" required  multiple aria-label="org_type">
                            <md-option ng-repeat="org_typ in horg_types" ng-value="org_typ.TYPE">
                                {{org_typ.TYPE}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Organisation Number</label>
                        <input type="text"  required ng-model="add_hospitals.org_contact_no"  name="org_contact_no" aria-label="org_contact_no"/>
                    </md-input-container>

                    <div flex="10" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="45">
                        <label>Organisation Email ID</label>
                        <input type="email" required ng-model="add_hospitals.org_email_id" name="org_email_id" aria-label="org_email_id"/>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Countries </label>
                        <md-select ng-model="add_hospitals.country" name="country" ng-change="getStateDetailsByCountryID(add_hospitals.country)" required aria-label="country">
                            <md-option ng-repeat="country in countries" ng-value="country.COUNTRY_CODE">
                                {{country.COUNTRY_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>States *</label>
                        <md-select ng-model="add_hospitals.states" ng-disabled="add_hospitals.country==null"  ng-change="getCityDetailsByStateID(add_hospitals.states)"name="states" required   aria-label="states">
                        <md-option ng-repeat="state in country_states" ng-value="state.STATE_CODE">{{state.STATE_NAME}}</md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Cities </label>
                        <md-select ng-model="add_hospitals.cities" name="cities" required   aria-label="cities" ng-disabled="add_hospitals.states==null">
                            <md-option ng-repeat="city in state_cities" ng-value="city.CITY_CODE">
                                {{city.CITY_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="100">
                        <label>Organisation Address</label>
                        <input type="text"  ng-model="add_hospitals.org_address" name="org_address" aria-label="org_address"/>
                        <div ng-messages="addHospitalForm.org_address.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <h5 class="sub_heading-style-respond">Other Contact Persons</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
                    <md-button ng-click="addAPTOrgContatcPerson($event)" class="md-raised md-primary">Add Contact Person</md-button>
                </div>
                <div flex layout="row">
                    <table class="md-api-table table table-bordered" ng-cloak style="width:100%;margin-bottom: 5px;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile No.</th>
                            <th>Email ID</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody ng-if="!isEmpty(all_ocps)">
                        <tr ng-repeat="all_ocp in all_ocps track by $index">
                            <td>{{all_ocp.contact_person}}</td>
                            <td>{{all_ocp.contact_person_no}}</td>
                            <td>{{all_ocp.cpemail}}</td>
                            <td>{{all_ocp.cp_designation}}</td>
                            <td style="text-align: center;">
                                <button ng-click="removeOCP(all_ocp)"  class="btn btn-xs btn-default" aria-label="Edit">
                                    <md-tooltip md-direction="top">Delete</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#614DA4">highlight_off</md-icon>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                        <tbody ng-else>
                        <tr>
                        <td colspan="5" style="text-align: center;">Click on Add Contact Person BUTTON to Add</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div flex layout="row" layout-align="center center">
                 
                        <md-button class="md-raised md-accent" ng-click="addAPTHospitals(add_hospitals)" ng-disabled="addHospitalForm.$invalid" aria-label="submit">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3" ui-sref="home.appointment_organizations">Cancel</md-button>

                </div>
            </form>
        </div>
    </div>
</md-content>