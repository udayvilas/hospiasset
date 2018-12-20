<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <div ng-include="'includes/call_alerts'"></div>
        <h3 class="heading-stylerespond">{{title}}</h3>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
            <md-input-container ng-show="user_role_code==HMADMIN" class="no-margin-padding-md-input" flex="20" flex-xs="100">
                <md-select placeholder="Select Branch *" ng-model="user_branch" ng-change="getOtherunitUnitTransferCalls('','',user_branch)" aria-label="user_branch">
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
                <tbody ng-if="pending_trnsfers!=null">
                <tr ng-repeat="trnsfer in pending_trnsfers">
                    <td style="background-color:#2b247d;width:2%;"></td>
                    <td style="width: 16%;">{{trnsfer.EQUP_ID}}</td>
                    <td style="width: 8%;">{{trnsfer.req_eq_name}}</td>
                    <td style="width: 8%;">{{trnsfer.tbranch_name}}</td>
                    <td style="width: 8%;">{{trnsfer.username}}</td>
                    <td style="width: 8%;">{{trnsfer.REASON}}</td>
                    <td style="width: 3%;">{{trnsfer.DEPT_ID}}</td>
                    <td style="width: 4%;">
                        <div ng-if="trnsfer.TRANSFER_TYPE==transfer_types[0]">{{transfer_types_view[0]}}</div>
                        <div ng-else>{{transfer_types_view[1]}}</div>
                    </td>
                    <td style="width: 9%;">{{trnsfer.added_on+'000' | date : "dd-MM-yy hh:mm a"}}</td>
                    <td style="width: 4%;">Open</td>
                    <td style="width: 8%;">
                        <div  style="text-align: center;" ng-if="trnsfer.BRANCH_ID==null">
                            <button ng-disabled="user_role_code!=HMADMIN" ng-click="OtherUnitApprovedBySuperAdmin($event,trnsfer)" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
                                <md-tooltip md-direction="top">Assign</md-tooltip>
                                <md-icon class="material-icons-new" style="color:deepskyblue">call_received</md-icon>
                            </button>
                        </div>
                        <div ng-else>{{trnsfer.branch_name}}</div>
                    </td>
                    <td style="width: 8%;text-align:center;">
                        <div ng-if="trnsfer.BRANCH_ID==trnsfer.TRANSFER_BRANCH">
                            <button ng-disabled="true" class="btn btn-xs btn-default" ng-click="OtherUnitTransfer($event,trnsfer)" aria-label="Transfer Button{{$index}}">
                                <md-tooltip md-direction="top">Transfer</md-tooltip>
                                <md-icon class="material-icons-new" style="color:orangered">compare_arrows</md-icon>
                            </button>
                        </div>
                        <div ng-else>
                            <div ng-hide="user_role_code===HMADMIN">
                                <div ng-if="trnsfer.TRANSFER_BRANCH!=user_branch">
                                    <button ng-disabled="trnsfer.DEPLOYMENT_ID!=null" class="btn btn-xs btn-default" ng-click="OtherUnitTransfer($event,trnsfer)" aria-label="Transfer Button{{$index}}">
                                        <md-tooltip md-direction="top">Transfer</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:orangered">compare_arrows</md-icon>
                                    </button>
                                </div>
                                <div ng-elif="trnsfer.TRANSFER_BRANCH==user_branch">
                                    <button ng-disabled="true" class="btn btn-xs btn-default" ng-click="OtherUnitTransfer($event,trnsfer)" aria-label="Transfer Button{{$index}}">
                                        <md-tooltip md-direction="top">Transfer</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:orangered">compare_arrows</md-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="width: 8%;">
                        <div  style="text-align: center;" ng-if="trnsfer.BRANCH_ID==null">
                            Holden by Admin
                        </div>
                        <div ng-elif="trnsfer.BRANCH_ID!=null && trnsfer.EQUP_ID==null">Holden by {{trnsfer.branch_name}}</div>
                    </td>
                    <td style="width: 6%;text-align:center;">
                        <div ng-if="trnsfer.BRANCH_ID==trnsfer.TRANSFER_BRANCH">
                            <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
                                <md-tooltip md-direction="top">Deploy</md-tooltip>
                                <md-icon class="material-icons-new" style="color:green;">done_all
                                </md-icon>
                            </button>
                        </div>
                        <div ng-else>
                            <div ng-if="trnsfer.TRANSFER_BRANCH!=user_branch && trnsfer.EQUP_ID!=null">
                                <button ng-disabled="false" class="btn btn-xs btn-default" ng-click="transferDeployDevice($event,trnsfer)" aria-label="Conduct Button{{$index}}">
                                    <md-tooltip md-direction="top">Deploy</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:green;">done_all
                                    </md-icon>
                                </button>
                            </div>
                            <div ng-elif="trnsfer.TRANSFER_BRANCH==user_branch">
                                <div ng-if="trnsfer.EQUP_ID!=null">
                                    <button ng-disabled="trnsfer.DEPLOYMENT_ID!=null" class="btn btn-xs btn-default" ng-click="transferDeployDevice($event,trnsfer)"  aria-label="Conduct Button{{$index}}">
                                        <md-tooltip md-direction="top">Deploy</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:green;">done_all
                                        </md-icon>
                                    </button>
                                </div>
                                <div ng-elif="trnsfer.DEPLOYMENT_ID==null">
                                    <button ng-disabled="trnsfer.EQUP_ID==null" class="btn btn-xs btn-default" ng-click="transferDeployDevice($event,trnsfer)"  aria-label="Conduct Button{{$index}}">
                                        <md-tooltip md-direction="top">Deploy</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:green;">done_all
                                        </md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
                                        <md-tooltip md-direction="top">Deploy</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:green;">done_all
                                        </md-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="13" style="text-align:center;width:100%;">No Calls Found...!</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!--<div flex layout="row" class="marginb-10" ng-if="pending_trnsfers!=null">
            <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                    <md-tooltip md-direction="top">Total Records</md-tooltip>
                    {{no_of_recs}}
                </md-button>
            </div>
            <div flex="20" hide-xs hide-sm><!-- Space --/></div>
            <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getOtherunitUnitTransferCalls(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>-->
    </div>
</md-content>