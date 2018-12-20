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
                    <th>Serial No.</th>
                    <th>Location</th>
                    <th>make</th>
                    <th>Dept</th>
                    <th>Type </th>
                    <th>Last Done</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Attend</th>
                    <th>In Progress</th>
                    <th>Complete</th>
                    <!--<th>Actions</th> -->
                </tr>
                </thead>
                <tbody ng-if="scheduled_details_call!=null">
                <tr ng-repeat="scheduled_detail in scheduled_details_call">
                    <td style="background-color:#cbb778;width:2%">
                        <!--<md-checkbox  ng-if="ppms_device.PMS_ASSIGNED_TO==user_id && ppms_device.COMPLETED_BY == null" ng-click="pmsSelectEq(ppms_device.ID, pms_eq_selected)" aria-label="{{ppms_device.ID}}" class="md-primary" style="margin-bottom: 0px;"></md-checkbox>-->
                        <md-checkbox  ng-if="scheduled_detail.COMPLETED_BY == null"   aria-label="{{scheduled_detail.ID}}" class="md-primary" style="margin-bottom: 0px;"></md-checkbox>
                    </td>
                    <td>{{(user_org==scheduled_detail.ORG_ID) ? scheduled_detail.EID: scheduled_detail.ASSIGN_ID}}</td>
                    <td>{{scheduled_detail.eq_name}}</td>
                    <td>{{scheduled_detail.serial_number}}</td>
                    <td>{{scheduled_detail.location}}</td>
                    <td>{{scheduled_detail.company_name}}</td>
                    <td>{{scheduled_detail.department}}</td>
                    <td>{{scheduled_detail.type}}</td>
                    <td>{{scheduled_detail.PMS_DONE | date: "dd-MM-y"}}</td>
                    <td>{{scheduled_detail.PMS_DUE_DATE | date: "dd-MM-y"}}</td>
                    <td>Pending</td>
                    <td>{{scheduled_detail.Assigned_by}}</td>
                    <td>{{scheduled_detail.Assigned_to}}</td>
                    <td ng-if="$index==0" rowspan="{{scheduled_details_call.length}}" style="text-align:center;">
                        <div>
                            <button ng-disabled="isEmpty(pms_eq_selected)" class="btn btn-xs btn-default" ng-click="PendingPmsDialog($event,pms_eq_selected)" aria-label="PMS Button{{$index}}">
                                <md-tooltip md-direction="top">Pending PMS</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">sms_failed</md-icon>
                            </button>
                        </div>
                        <div ng-else>
                            <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="PMS Button{{$index}}">
                                <md-icon class="material-icons-new" style="color:#614da4">sms_failed</md-icon>
                            </button>
                        </div>
                    </td>
                    <!--<td>
                       <button  ng-disabled="ppms_device.PMS_ASSIGNED_TO != NULL || ppms_device.COMPLETED_BY != null" ng-click="pmsassign($event,ppms_device)" class="btn btn-xs btn-default" aria-label="Edit">
                                <md-tooltip md-direction="top">Assign</md-tooltip>
                                <md-icon class="material-icons-new material-icons" style="color: rgb(68,138,255);">call_received</md-icon>
                       </button>
                    </td>-->
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="15" style="text-align:center"> No Pending Scheduled Found</td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="SearchScheduledcall(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
    </div>
</md-content>