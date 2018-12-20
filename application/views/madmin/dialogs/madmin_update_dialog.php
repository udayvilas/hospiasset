<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Update Hospitals</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="updateHospitalForm" flex="60"  autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label> Orgnisation name</label>
                        <input type="text" required ng-model="add_hospitals.org_name" name="org_name" aria-label="org_name"/>
                        <div ng-messages="addHospitalForm.org_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Orgnisation Type *</label>
                        <md-select ng-model="add_hospitals.org_type" name="org_type" required  multiple aria-label="org_type">
                            <md-option ng-repeat="org_typ in org_types" ng-value="org_typ">
                                {{org_typ}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container  class="md-block" flex-gt-sm flex="30">
                        <label style="color:#000000 !important;">No of Branches</label>
                        <input type="text"  only-digits="only-digits" ng-model="add_hospitals.no_of_branches" name="no_of_branches" aria-label="no_of_branches"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>No of Users</label>
                        <input type="text" only-digits="only-digits" ng-model="add_hospitals.no_of_users" name="no_of_users" aria-label="no_of_users"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>No of Equipments</label>
                        <input type="text" only-digits="only-digits" ng-model="add_hospitals.no_of_equipments" name="no_of_equipments" aria-label="no_of_equipments"/>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="100">
                        <label> Orgnisation Address</label>
                        <input type="text"  ng-model="add_hospitals.org_address" name="org_address" aria-label="org_address"/>
                        <div ng-messages="addHospitalForm.org_address.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container  class="md-block" flex-gt-sm flex="30">
                        <label style="color:#000000 !important;">Contract Person *</label>
                        <input type="text" required ng-model="add_hospitals.contact_person" name="contact_person" aria-label="contact_person"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Contact Number</label>
                        <input type="text"  required only-digits="only-digits" ng-model="add_hospitals.contact_no"  name="contact_no" aria-label="contact_no"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Email ID</label>
                        <input type="email" required ng-model="add_hospitals.email_id" name="email_id" aria-label="email_id"/>
                    </md-input-container>

                </div>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="start center">
                    <md-button ng-disabled="addHospitalForm.$invalid" ng-click="addnewOrgContatcPerson($event)" class="md-raised md-primary">Add Contact Person</md-button>
                </div>
                <div flex layout="row" ng-if="!isEmpty(all_ocps)">
                    <table class="md-api-table table table-bordered" ng-cloak style="width:100%;margin-bottom: 5px;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile No.</th>
                            <th>Email ID</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody ng-if="!isEmpty(all_ocps)">
                        <tr ng-repeat="all_ocp in all_ocps track by $index">
                            <td>{{all_ocp.contact_person}}</td>
                            <td>{{all_ocp.contact_person_no}}</td>
                            <td>{{all_ocp.cpemail}}</td>
                            <td style="text-align: center;">
                                <button ng-click="removeOCP(all_ocp)"  class="btn btn-xs btn-default" aria-label="Edit">
                                    <md-tooltip md-direction="top">Delete</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#614DA4">highlight_off</md-icon>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div flex layout="row" layout-align="center center">
                   
                        <md-button class="md-raised md-accent" ng-click="UpdateHospitals(add_hospitals)" ng-disabled="addHospitalForm.$invalid" aria-label="submit">Submit</md-button>                       <md-button class="md-raised" style="float:left;color:#604ca3" ui-sref="home.mahospitals">Cancel</md-button>
                    
                </div>
            </form>
            </form>
        </div>
    </div>
</md-content>