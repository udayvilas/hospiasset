<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <div ng-include="'includes/call_alerts'"></div>
        <h3 class="heading-stylerespond">{{title}}</h3>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
            <md-input-container ng-show="user_role_code==HMADMIN" class="no-margin-padding-md-input" flex="20" flex-xs="100">
                <md-select placeholder="Select Branch *" ng-model="completedpms_search.branch_id" ng-change="SearchCompletedPms()" aria-label="user_branch">
                    <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
                </md-select>
            </md-input-container>
        </div>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th>Equipment ID</th>
                    <th>Eq. Name</th>
                    <th>Location</th>
                    <th>Raised By</th>
                    <th>Complaint</th>
                    <th>Dept</th>
                    <th>Type </th>
                    <th>Call Date</th>
                    <th>Status</th>
                    <th>Respond</th>
                    <th>Attend</th>
                    <th>In Progress</th>
                    <th>Complete</th>
                </tr>
                </thead>
                <tbody ng-if="cpms_devices!=null">
                <tr ng-repeat="cpms_device in cpms_devices">
                    <td>{{cpms_device.EID}}</td>
                    <td>{{cpms_device.eq_name}}</td>
                    <td>{{cpms_device.location}}</td>
                    <td></td>
                    <td>PMS Call</td>
                    <td>{{cpms_device.department}}</td>
                    <td>{{cpms_device.type}}</td>
                    <td>{{cpms_device.PMS_DONE_DATE}}</td>
                    <td>Completed</td>
                    <td>{{cpms_device.Assigned_by}}</td>
                    <td>{{cpms_device.Assigned_to}}</td>
                    <td></td>
                    <td>{{cpms_device.COMPLETED_BY_NAME}}</td>
                </tr>

                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="13" style="text-align:center"> No Completed Pms Found</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div flex layout="row" class="marginb-10"  ng-if="cpms_devices!=null">
            <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                    <md-tooltip md-direction="top">Total Records</md-tooltip>
                    {{no_of_recs}}
                </md-button>
            </div>
            <div flex="20" hide-xs hide-sm><!-- Space --></div>
            <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="SearchCompletedPms(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>

    </div>
    </div>
</md-content>