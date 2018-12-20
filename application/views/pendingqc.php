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
                    <th>Make</th>
                    <th>Dept</th>
                    <th>Type </th>
                    <th>Last Done</th>
                    <th>Due Date</th>
                    <th>Respond</th>
                    <th>Attend</th>
                    <th>In Progress</th>
                    <th>Complete</th>
                    <!--<th>Actions</th>-->
                </tr>
                </thead>
                <tbody ng-if="pqc_devices!=null">
                <tr ng-repeat="pqc_device in pqc_devices">
                    <td style="background-color:#2989c3;width:2%">
                        <md-checkbox ng-if="pqc_device.COMPLETED_BY == null" ng-click="qcSelectEq(pqc_device.ID, qc_eq_selected)" aria-label="{{pqc_device.ID}}" class="md-primary" style="margin-bottom: 0px;"></md-checkbox>
                    </td>
                    <td>{{(user_org==pqc_device.ORG_ID) ? pqc_device.EID: pqc_device.ASSIGN_ID}}</td>
                    <td>{{pqc_device.eq_name}}</td>
                    <td>{{pqc_device.serial_no}}</td>
					<td>{{pqc_device.location}}</td>
                    <td>{{pqc_device.company_name}}</td>
                    <td>{{pqc_device.department}}</td>
                    <td>{{pqc_device.type}}</td>
                    <td>{{pqc_device.QC_DONE | date  : "dd-MM-y"}}</td>
                    <td>{{pqc_device.QC_DUE | date  : "dd-MM-y"}}</td>
                    <td>Pending</td>
                    <td>{{pqc_device.Assigned_by}}</td>
                    <td>{{pqc_device.Assigned_to}}</td>
                    <td ng-if="$index==0" rowspan="{{pqc_devices.length}}" style="text-align: center;">
                        <div>
                            <button ng-disabled="isEmpty(qc_eq_selected)" class="btn btn-xs btn-default" ng-click="PendingQcDialog($event,qc_eq_selected)" aria-label="QC Button{{$index}}">
                                <md-tooltip md-direction="top">Pending QC</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">sms_failed</md-icon>
                            </button>
                        </div>
                        <div ng-else>
                            <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="QC Button{{$index}}">
                                <md-icon class="material-icons-new" style="color:#614da4">sms_failed</md-icon>
                            </button>
                        </div>
                    </td>
                   <!-- <td>
                        <button  ng-disabled="pqc_device.ASSIGNED_TO != NULL || pqc_device.COMPLETED_BY != null" ng-click="qcassign($event,pqc_device)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Assign</md-tooltip>
                            <md-icon class="material-icons-new material-icons" style="color: rgb(68,138,255);">call_received</md-icon>
                        </button>
                    </td>-->
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="14" style="text-align:center"> No Pending QC Found</td>
                </tr>
                </tbody>
            </table>
        </div>
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
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="SearchPendingQc(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
    </div>
</md-content>