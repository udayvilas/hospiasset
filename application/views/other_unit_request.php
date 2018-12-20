<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Other Unit Request</h3>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <div flex="50" flex-sm="50" flex-md="50"  ng-if="user_role_code==HMADMIN"  layout-align="start start">
                <md-button  ui-sref="home.other_unit_approval" class="md-raised md-primary">Approval</md-button>
            </div>
            <div flex="50" flex-sm="50" flex-md="50" layout-align="end end">
                <md-button  ui-sref="home.other_unit_transfer" class="md-raised md-primary">Transfer</md-button>
            </div>
        </div>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="otherUnitRequestForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
              <md-autocomplete class="md-block" flex-gt-sm
                                     md-no-cache="false"
                                     md-selected-item="searched.ENAME"
                                     md-search-text="searchEname"
                                     md-items="item in searchTextChangeEQUPNAME(searchEname,'ename')"
                                     md-item-text="item.E_NAME"
                                     md-min-length="0"
                                     md-floating-label="Search Equipment name">
                        <md-item-template>
            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_NAME}}</span>
                        </md-item-template>
                        <md-not-found>
                            No Equipment Name Found
                        </md-not-found>
                    </md-autocomplete>
             <!--    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Name</label>
                        <input type="text"  ng-model="other_request.equp_name" name="equp_name" aria-label="equp_name"/>
                        <div ng-messages="otherUnitRequestForm.equp_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>-->
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container  class="md-block" flex-gt-sm flex="40">
                        <label>Department</label>
                        <md-select ng-model="other_request.departments" name="depts">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Physical Location</label>
                        <input type="text"  ng-model="other_request.plocation" name="plocation" aria-label="plocation" />
                        <div ng-messages="otherUnitRequestForm.ctype.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container  class="md-block" flex-gt-sm flex="40">
                        <label>Transfer Type</label>
                        <md-select ng-model="other_request.ttype" name="ttype">
                        <md-option ng-repeat="transfer_type in transfer_types"  ng-value="transfer_type">
                                {{transfer_type}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Reasons</label>
                        <textarea ng-model="other_request.reasons" name="reasons" md-maxlength="350" rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="otherUnitRequestForm.reasons.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="OtherUnitRequest(other_request)" ng-disabled="otherUnitRequestForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>