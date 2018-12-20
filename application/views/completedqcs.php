<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <div ng-include="'includes/call_alerts'"></div>
        <h3 class="heading-stylerespond">{{title}}</h3>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
            <md-input-container ng-show="user_role_code==HMADMIN" class="no-margin-padding-md-input" flex="20" flex-xs="100">
                <md-select placeholder="Select Branch *" ng-model="completedqcs_search.branch_id" ng-change="SearchCompletedQcs()" aria-label="user_branch">
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
                    <th>Dept</th>
                    <th>Due Date</th>
                    <th>Completed By</th>
                    <th>Completed On</th>
                </tr>
                </thead>
                <tbody ng-if="cqc_devices!=null">
                <tr ng-repeat="cqc_device in cqc_devices">
                    <td>{{cqc_device.EID}}</td>
                    <td>{{cqc_device.eq_name}}</td>
                    <td>{{cqc_device.location}}</td>
                    <td>{{cqc_device.department}}</td>
                    <td>{{cqc_device.QC_DUE | date : 'dd-MM-yyyy'}}</td>
                    <td>{{cqc_device.COMPLETED_BY_NAME}}</td>
                    <td>{{cqc_device.QC_ACTL_DONE | date : 'dd-MM-yyyy'}}</td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="13" style="text-align:center"> No Scheduled Found</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
 <!--   <div flex layout="row" class="marginb-10"  ng-if="cqc_devices!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --</div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="SearchCompletedQcs(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>-->
    </div>
    </div>
</md-content>