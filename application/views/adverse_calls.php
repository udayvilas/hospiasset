<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <div ng-include="'includes/call_alerts'"></div>
        <h3 class="heading-stylerespond">{{title}}</h3>

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
                    <th>Assigned To</th>
                    <th>Attended By</th>
                    <th>On Hold By</th>
                    <th>Completed By</th>
                </tr>
                </thead>
                <tbody ng-if="ad_incednts!=null">
                <tr ng-repeat="ad_incednt in ad_incednts">
                    <td style="background-color:#5dd27c;width: 2%;"></td>
                    <td style="width: 16%;">{{(user_org== ad_incednt.ORG_ID) ?  ad_incednt.EQUP_ID : ad_incednt.ASSIGN_ID}}</td>
                    <td style="width: 8%;">{{ad_incednt.eq_name}}</td>
                    <td style="width: 8%;">{{ad_incednt.location}}</td>
                    <td style="width: 8%;">{{ad_incednt.ADDED_BY_NAME}}</td>
                    <td style="width: 8%;">{{ad_incednt.incidents_type}}</td>
                    <td style="width: 3%;">{{ad_incednt.DEPT_ID}}</td>
                    <td style="width: 4%;">Adverse</td>
                    <td style="width: 9%;">{{ad_incednt.DATE_OCCRANCE | date:'dd-MM-yyyy'}}</td>
                    <td style="width: 4%;">{{ticket_sts1[1]}}</td>
                    <td style="width: 8%;">
                        <div ng-if="ad_incednt.ASSIGNED_TO!=null">{{ad_incednt.RESPONDED_DATE | date:'dd-MM-yy'}} {{ad_incednt.RESPONDED_TIME}} / {{ad_incednt.RESPONDED_BY_NAME}}</div>
                        <div class="text-center" ng-else>
                            <button ng-if="adverse_approvals_count==fromJsonLength(ad_incednt.APPROVED_BY)" ng-click="editObservations($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Edit">
                                <md-tooltip md-direction="top">Complete/Assign</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#d58512">mode_edit</md-icon>
                            </button>
                        </div>
                    </td>
                    <td style="width: 8%;">
                        <div ng-if="ad_incednt.UPDATED_BY!=null">{{ad_incednt.updated_by}}</div>
                        <div  class="text-center" ng-else>
                            <button ng-if="isUserNotApproved(ad_incednt.APPROVED_BY)"  ng-click="ApproveObservations($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Approve">
                                <md-tooltip md-direction="top">Approve</md-tooltip>
                                <md-icon class="material-icons-new" style="color:green">done_all</md-icon>
                            </button>
                        </div>
                    </td>
                    <td style="width: 8%;"></td>
                    <td style="width: 8%;">
                        <div  ng-if="ad_incednt.COMPLETED_BY!=null">{{ad_incednt.completed_by}}</div>
                        <div class="text-center" ng-else>
                            <button ng-if="ad_incednt.UPDATED_BY!=null" ng-disabled="ad_incednt.ASSIGNED_TO!=null" ng-click="editObservations($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Edit">
                                <md-tooltip md-direction="top">Complete/Assign</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#d58512">done_all</md-icon>
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="13" style="width: 100%;text-align: center;">No Adverse Calls Found</td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadAdverseIncedents(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>