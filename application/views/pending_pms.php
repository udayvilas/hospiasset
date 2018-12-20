<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
    <!--<div ng-include="'includes/call_alerts'"></div>-->
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
        <div flex flex-xs="100">
        <h3 class="heading-stylerespond">Pending PMS</h3>
        </div>
        <div ng-if="user_role_code==HMADMIN" flex="5" hide-xs hide-sm> </div>
        <md-input-container ng-if="user_role_code==HMADMIN" ng-show="user_role_code==HMADMIN" class="no-margin-padding-md-input" flex="20" flex-xs="100">
            <md-select placeholder="Select Branch *" ng-model="pendingpms_search.branch_id" ng-change="SearchPendingPms()" aria-label="user_branch">
                <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
            </md-select>
        </md-input-container>
    </div>
            <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center" style="margin-top:10px;">
                <md-datepicker  ng-model="pendingpms_search.fromdate" md-placeholder="From Date" md-min-date="minDate" flex-gt-sm>
                </md-datepicker>

                <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <md-datepicker  ng-model="pendingpms_search.todate" md-placeholder="To Date" md-max-date="maxDate" flex-gt-sm>
                </md-datepicker>
                <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>

                <md-input-container  class="md-block" flex-gt-sm>
                    <label>Department</label>
                    <md-select ng-model="pendingpms_search.department">
                        <md-option ng-value="nullValue" >
                            Select Department
                        </md-option>
                        <md-option ng-repeat="dept in depts"  ng-value="dept.CODE" >
                            {{dept.USER_DEPT_NAME}}
                        </md-option>
                    </md-select>
                    <div ng-messages="AddDevice.depts.$error">
                        <div ng-message="required">Required</div>
                    </div>
                </md-input-container>
                <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;</div>
                <md-autocomplete class="md-block" flex-gt-sm
                                 md-no-cache="false"
                                 md-selected-item="searched.EID"
                                 md-search-text="searchEid"
                                 md-items="item in searchTextChange(searchEid)"
                                 md-item-text="item.E_ID"
                                 md-min-length="0"
                                 md-floating-label="Search Eq. id?">
                    <md-item-template>
                        <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
                    </md-item-template>
                    <md-not-found>
                        No Equipment Match Found
                    </md-not-found>
                </md-autocomplete>
                <md-button class="md-icon-button md-raised md-accent" ng-click="SearchPendingPms()"  md-theme="default" aria-label="submit">
                        <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                    </md-button>


    </div>
<div class="clearfix"></div>
    <div layout="row">
        <table class=" md-api-table table table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Eq.ID</th>
                <th>Last Pms Done</th>
                <th>Due Date</th>
                <th>Assigned By</th>
                <th>Assigned To</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody ng-if="ppms_devices!=null">
            <tr ng-repeat="ppms_device in ppms_devices">
                <td>{{ppms_device.EID}}</td>
                <td>{{ppms_device.PMS_DONE}}</td>
                <td>{{ppms_device.PMS_DUE_DATE}}</td>
                <td>{{ppms_device.Assigned_by}}</td>
                <td>{{ppms_device.Assigned_to}}</td>
                <td style="text-align:center;">
                    <div ng-if="ppms_device.PMS_ASSIGNED_TO==user_id">
                        <button class="btn btn-xs btn-default" ng-click="PendingPmsDialog($event,ppms_device)" aria-label="PMS Button{{$index}}">
                            <md-tooltip md-direction="top">Pending PMS</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#ffa602">sms_failed</md-icon>
                        </button>
                    </div>
                    <div ng-elif="ppms_device.PMS_ASSIGNED_TO==null">
                        <button class="btn btn-xs btn-default" ng-click="PendingPmsDialog($event,ppms_device)" aria-label="PMS Button{{$index}}">
                            <md-tooltip md-direction="top">Pending PMS</md-tooltip>
                            <md-icon class="material-icons-new" style="fill:#ffa602">sms_failed</md-icon>
                        </button>
                    </div>

                    <div ng-else>
                        <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="PMS Button{{$index}}">
                            <md-icon class="material-icons-new" style="color:#614da4">sms_failed</md-icon>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
            <tbody ng-if="ppms_devices==null">
            <tr>
                <td colspan="8" style="text-align:center">No calls Found...!</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
    <!--<div ng-include="'includes/footer'"></div>-->
</md-content>