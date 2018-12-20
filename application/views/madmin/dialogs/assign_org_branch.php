<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Update organization</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="UpdateHospitalForm" flex="80" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <h5 class="sub_heading-style-respond">Organization Details</h5>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Hospitals *</label>
                        <md-select ng-model="update_hospitals.org_id" name="org_id" ng-change="getBranchDetailsByHospitalID(update_hospitals.org_id)" required multiple aria-label="org_id">
                            <md-option ng-repeat="hospital in hospitals" ng-value="hospital.ORG_ID" ng-if="hospital.ORG_ID != update_hospitals.current_org">
                                {{hospital.ORG_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container>
                        <label>Branchs</label>
                        <md-select ng-model="update_hospitals.branch_id" multiple="" ng-disabled="update_hospitals.org_id==null"
                                   ng-change="update_hospitals.org_branch = getSelectives(update_hospitals.branch_id)" required >
                            <md-optgroup label="{{hospital.ORG_NAME}}" ng-repeat="hospital in hospital_branchs" ng-if="hospital.ORG_ID != update_hospitals.current_org" >
                                <md-option ng-value="item.BRANCH_ID +'|'+ hospital.ORG_ID" ng-repeat="item in hospital.branches" >{{item.BRANCH_NAME}}</md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>

                </div>


                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="HospitalAssign(update_hospitals)" ng-disabled="UpdateHospitalForm.$invalid" aria-label="submit">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3" ui-sref="home.mahospitals">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>