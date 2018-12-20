<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <div ng-include="'includes/my_call_alerts'"></div>
        <h3 class="heading-stylerespond">Adverse Call</h3>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
            <!-- <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
             <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
            <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="adverse_search_new.fromdate" mdp-max-date="maxDate" ></mdp-date-picker>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
            <mdp-date-picker mdp-placeholder=" To Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="adverse_search_new.todate" ></mdp-date-picker>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

            <md-input-container class="md-block" flex-gt-sm  flex="25">
                <label>Departments</label>
                <md-select ng-model="adverse_search_new.dept_id" name="reasons">
                    <md-option ng-repeat="dept in depts "  ng-value="dept.CODE">
                        {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                    </md-option>
                </md-select>

            </md-input-container>
            <md-button class="md-icon-button md-raised md-accent" ng-click="loadAdverseIncedentsNew()"  md-theme="default" aria-label="submit">
                <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
        </div>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
            <md-input-container ng-show="user_role_code==HMADMIN" class="no-margin-padding-md-input" flex="20" flex-xs="100">
                <md-select placeholder="Select Branch *" ng-model="incdent.branch_id" ng-change="loadAdverseIncedentsNew()" aria-label="user_branch">
                    <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
                </md-select>
            </md-input-container>
        </div>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th></th>
                    <th>Equipment ID</th>
                    <th>Eq. Name</th>
                    <th>Location</th>
                    <th>Raised By</th>
                    <th>Complaint</th>
                    <th>Dept</th>
                    <th>Type </th>
                    <th>Call Date</th>
                    <th>Status</th>
                    <th>Assign To</th>
                    <th>Attend By</th>
                    <th>On Hold By</th>
                    <th>Completed By</th>
                </tr>
                </thead>
                <tbody ng-if="indent_equps_new!=null">
                <tr ng-repeat="ad_incednt in indent_equps_new">
                    <td style="background-color:#5dd27c;width: 2%;"></td>
                    <td style="width: 16%;">{{ad_incednt.EQUP_ID}}</td>
                    <td style="width: 8%;">{{ad_incednt.eq_name}}</td>
                    <td style="width: 8%;">{{ad_incednt.location}}</td>
                    <td style="width: 8%;">{{ad_incednt.ADDED_BY_NAME}}</td>
                    <td style="width: 8%;">{{ad_incednt.incidents_type}}</td>
                    <td style="width: 3%;">{{ad_incednt.DEPT_ID}}</td>
                    <td style="width: 4%;">Adverse</td>
                    <td style="width: 9%;">{{ad_incednt.DATE_OCCRANCE | date:'dd-MM-yyyy'}}</td>
                    <td style="width: 4%;">{{ticket_sts1[1]}}</td>
                    <td style="width: 8%;">
                        <div ng-if="ad_incednt.ASSIGNED_TO!=null">{{ad_incednt.assigned_to}}</div>
                        <div class="text-center" ng-else>
                            <button ng-click="editObservations($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Edit">
                                <md-tooltip md-direction="top">Complete/Assign</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#d58512">mode_edit</md-icon>
                            </button>
                        </div>
                    </td>
                    <td style="width: 8%;"></td>
                    <td style="width: 8%;"></td>
                    <td style="width: 8%;">
                        <div class="text-center" ng-if="ad_incednt.ASSIGNED_TO==user_id">
                            <button ng-click="editObservations($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Edit">
                                <md-tooltip md-direction="top">Complete/Assign</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#d58512">done_all</md-icon>
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="14" style="width: 100%;text-align: center;">No Adverse Calls Found</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div flex layout="row" class="marginb-10">
            <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                    <md-tooltip md-direction="top">Total Records</md-tooltip>
                    {{no_of_recs}}
                </md-button>
            </div>
            <div flex="20" hide-xs hide-sm><!-- Space --></div>
            <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadAdverseIncedentsNew(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>