<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style xmlns:width="http://www.w3.org/1999/xhtml">
    tbody {
        display:block;
        height:350px;
        overflow:auto;
    }
    thead, tbody tr {
        display:table;
        width:100%;
        table-layout:fixed;
    }
    thead {
        width: calc( 100% - 1em )
    }
    table
    {
        width:100%;
    }
    .table-bordered > thead > tr > th
    {
        border: none;
    }
    .table-bordered
    {
        border: none;
    }
    .table-bordered > tbody > tr > td
    {
        border: 1px solid #fff;
        border-top: 0px solid #fff;
        padding: 1px 2px 3px 4px;
        line-height: 27px;
    }
</style>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <div ng-include="'includes/call_alerts'"></div>
        <h3 class="heading-stylerespond">{{title}}</h3>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
            <md-input-container ng-show="user_role_code==HMADMIN" class="no-margin-padding-md-input" flex="20" flex-xs="100">
                <md-select placeholder="Select Branch *" ng-model="user_branch_id" ng-change="toDayCalls(user_branch_id)" aria-label="user_branch">
                    <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
                </md-select>
            </md-input-container>
        </div>
        <div flex layout="column" layout-md="column" flex-gt-sm="column" layout-xs="column">
            <table class="md-api-table table table-bordered" ng-cloak style="margin-bottom: 0px;">
                <thead>
                <tr>
                    <th style="width: 2%;"></th>
                    <th style="width: 15%;">Equipment ID</th>
                    <th style="width: 8%;">Eq. Name</th>
                    <th style="width: 8%;">Location</th>
                    <th style="width: 8%;">Raised By</th>
                    <th style="width: 8%;">Complaint</th>
                    <th style="width: 3%;">Dept</th>
                    <th style="width: 4%;">Type</th>
                    <th style="width: 8%;">Call Date</th>
                    <th style="width: 4%;">Status</th>
                    <th style="width: 8%;">Assign To</th>
                    <th style="width: 8%;">Attended By</th>
                    <th style="width: 8%;">On Hold By</th>
                    <th style="width: 8%;">Completed By</th>
                </tr>
                </thead>
                </table>
                <table class="md-api-table table table-bordered" ng-cloak>
                <tbody>
                <tr style="background-color:{{tc_device.color}} !important;" ng-repeat="tc_device in tc_devices">
                    <td style="background-color: {{tc_device.complaint_color}};width: 2%;"></td>
                    <td style="width: 15%;">{{tc_device.EID}}</td>
                    <td style="width: 8%;">{{tc_device.eq_name}}</td>
                    <td style="width: 8%;">{{tc_device.location}}</td>
                    <td style="width: 8%;">{{tc_device.CALLER_NAME}}</td>
                    <td style="width: 8%;">{{tc_device.NATURE_OF_COMP}}</td>
                    <td style="width: 3%;">{{tc_device.CALLER_DEPT}}</td>
                    <td style="width: 4%;">Other</td>
                    <td style="width: 8%;">{{tc_device.CDATETIME+'000' | date:'dd-MM-yy h:mma'}}</td>
                    <td style="width: 4%;">
                        <div ng-if="tc_device.STATUS==ticket_sts[0]">{{ticket_sts1[0]}}</div>
                        <div ng-elif="tc_device.STATUS==ticket_sts[1]">{{ticket_sts1[1]}}</div>
                        <div ng-else="tc_device.STATUS==ticket_sts[2]">{{ticket_sts1[2]}}</div>
                    </td>
                    <td style="width: 8%;"> <!-- Responded / Assigned To  -->
                        <div ng-show="user_role_code!=HMADMIN" ng-if="tc_device.RESPONDED_DATE==null">
                            <div class="text-center" ng-if="tc_device.ASSIGNED_TO==null && tc_device.ATTENDED_BY==null">
                            <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,before_respond)">
                                <md-tooltip md-direction="top">Respond Call</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#0d7cff">call</md-icon>
                            </button>
                            </div>
                            <div class="text-center" ng-elif="tc_device.ASSIGNED_TO==user_id">
                                <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,before_respond)" aria-label="Respond Button{{$index}}">
                                    <md-tooltip md-direction="top">Call Assigned To You</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#009688">call</md-icon>
                                </button>
                            </div>
                            <div ng-else>{{tc_device.ASSIGNED_TO_NAME}}</div>
                        </div>

                        <div ng-else>
                            <div>{{tc_device.RESPONDED_BY_NAME}}</div>
                        </div>
                    </td> <!-- End Responded / Assigned To -->

                    <td style="width: 8%;"> <!--Attend-->
                        <div ng-if="tc_device.ASSIGNED_TO==Vendor">
                            <div class="text-center" ng-show="user_role_code!=HMADMIN" ng-if="tc_device.ATTENDED_BY==null">
                                <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,Vendor)" aria-label="Vendor Button{{$index}}">
                                    <md-tooltip md-direction="top">Vendor Call</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#ffa602"></md-icon>
                                </button>
                            </div>
                            <div ng-else>
                                <span title="Vendor Call Attended by {{tc_device.ATTENDEE_NAME}}" style="color:#3957D8;text-transform:capitalize;">{{tc_device.ATTENDEE_NAME}}</span>
                            </div>
                        </div>
                        <div class="text-center" ng-show="user_role_code!=HMADMIN" ng-elif="tc_device.RESPONDED_BY==user_id && tc_device.ASSIGNED_BY!=user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,after_respond)" aria-label="Attend Button{{$index}}">
                                <md-tooltip md-direction="top">Attend Call</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">call_received</md-icon>
                            </button>
                        </div>
                        <div class="text-center" ng-show="user_role_code!=HMADMIN" ng-elif="tc_device.ASSIGNED_TO==user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,after_respond)" aria-label="Attend Button{{$index}}">
                                <md-tooltip md-direction="top">Assigned by {{tc_device.ASSIGNED_BY_NAME}}</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#009688">call_received</md-icon>
                            </button>
                        </div>

                        <div ng-elif="tc_device.ASSIGNED_TO==user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE!=null">
                            {{tc_device.ASSIGNED_TO_NAME}}
                        </div>

                        <div ng-elif="tc_device.ATTENDED_BY==user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE!=null">
                            {{tc_device.ATTENDEE_NAME}}
                        </div>

                        <div class="text-center" ng-elif="(tc_device.ATTENDED_BY==user_id || tc_device.ASSIGNED_TO==user_id) && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true" aria-label="Attend Button{{$index}}">
                            <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>
                        </div>

                        <div class="text-center" ng-elif="tc_device.ASSIGNED_TO!=user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>
                        </div>

                        <div class="text-center" ng-elif="(tc_device.ATTENDED_BY!=user_id || tc_device.ASSIGNED_TO==null) && tc_device.RESPONDED_DATE==null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>
                        </div>

                        <div class="text-center" ng-elif="tc_device.ATTENDED_BY!=user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new" style="color:#614DA4" >call_received</md-icon>
                            </button>
                        </div>

                        <div ng-elif="tc_device.ATTENDED_BY!=user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE!=null">
                            {{tc_device.ATTENDEE_NAME}}
                        </div>

                        <div ng-elif="tc_device.ASSIGNED_TO!=user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE!=null">
                            {{tc_device.ASSIGNED_TO_NAME}}
                        </div>
                    </td> <!--End Attend-->
                    <td style="width: 8%;"> <!-- Process Pending Status -->
                        <div class="text-center" ng-if="tc_device.ATTENDED_BY==null">
                            <button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new"  style="color:#614DA4" >sms_failed</md-icon>      </button>
                        </div>

                        <div ng-elif="tc_device.ATTENDED_BY==user_id">
                            <div ng-if="tc_device.ATTENDED_DATE!=null">
                                <div ng-if="tc_device.JOBCOMPLETED_DATE==null && tc_device.PENDING_REASON!=null">
                                    {{tc_device.ATTENDEE_NAME}}
                                </div>
                                <div class="text-center" ng-elif="tc_device.JOBCOMPLETED_DATE==null && tc_device.PENDING_REASON==null">
                                    <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,make_pending_call)" aria-label="Pending Button{{$index}}">
                                        <md-tooltip md-direction="top">Inprogress Call</md-tooltip>
                                        <md-icon class="material-icons-new"  style="color:#800">sms_failed</md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    {{tc_device.ATTENDEE_NAME}}
                                </div>
                            </div>
                            <div class="text-center" ng-else>
                                <button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
                                    <md-icon class="material-icons-new" style="color:#614DA4" size="24">sms_failed</md-icon>
                                </button>
                            </div>
                        </div>

                        <div ng-elif="tc_device.ATTENDED_BY!=user_id">
                            <div ng-if="tc_device.ATTENDED_DATE!=null">
                                <div ng-if="tc_device.JOBCOMPLETED_DATE==null && tc_device.PENDING_REASON!=null">
                                    {{tc_device.ATTENDEE_NAME}}
                                </div>
                                <div class="text-center" ng-elif="tc_device.JOBCOMPLETED_DATE==null && tc_device.PENDING_REASON==null">
                                    <button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
                                        <md-icon class="material-icons-new" style="color:#614DA4">sms_failed</md-icon>
                                    </button>
                                </div>
                            </div>
                            <div class="text-center" ng-else>
                                <button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
                                    <md-icon class="material-icons-new" style="color:#614DA4">sms_failed</md-icon>
                                </button>
                            </div>
                        </div>
                    </td> <!-- End Process Pending Status -->
                    <td style="width: 8%;"><!--Complete - Status...-->
                        <div ng-if="tc_device.ATTENDED_BY==user_id">
                            <div ng-if="tc_device.ATTENDED_DATE!=null">
                                <div class="text-center" ng-if="tc_device.JOBCOMPLETED_DATE==null">
                                    <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,complete_call)" aria-label="Completed Button{{$index}}">
                                        <md-tooltip md-direction="top">Complete Call</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:green">done_all</md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    {{tc_device.ATTENDEE_NAME}}
                                </div>
                            </div>
                            <div class="text-center" ng-else>
                                <button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
                                    <md-icon class="material-icons-new" style="color:#614DA4" >done_all</md-icon>
                                </button>
                            </div>
                        </div>

                        <div ng-elif="tc_device.ATTENDED_BY!=user_id">
                            <div ng-if="tc_device.ATTENDED_DATE!=null">
                                <div class="text-center" ng-if="tc_device.JOBCOMPLETED_DATE==null">
                                    <button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
                                        <md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    {{tc_device.ATTENDEE_NAME}}
                                </div>
                            </div>
                            <div class="text-center" ng-else>
                                <button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
                                    <md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
                                </button>
                            </div>
                        </div>
                    </td><!-- End Complete Status...-->
                </tr>
                <tr ng-show="user_role_code=HMADMIN" ng-repeat="ppms_device in ppms_devices">
                    <td style="background-color: #cbb778;width: 2%;"></td>
                    <td style="width: 15%;">{{ppms_device.EID}}</td>
                    <td style="width: 8%;">{{ppms_device.eq_name}}</td>
                    <td style="width: 8%;">{{ppms_device.location}}</td>
                    <td style="width: 8%;">-</td>
                    <td style="width: 8%;"></td>
                    <td style="width: 3%;"></td>
                    <td style="width: 4%;">PMS</td>
                    <td style="width: 8%;">{{ppms_device.PMS_DUE_DATE}}</td>
                    <td style="width: 4%;">Pending</td>
                    <td style="width: 8%;">
                        <div class="text-center" style="text-align: center;" ng-if="ppms_device.PMS_ASSIGNED_TO==null">
                            <button class="btn btn-xs btn-default" ng-click="PendingPmsDialog($event,ppms_device)" aria-label="PMS Button{{$index}}">
                                <md-tooltip md-direction="top">Pending PMS</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">call</md-icon>
                            </button>
                        </div>
                        <div ng-else>{{ppms_device.Assigned_by}}</div>
                    </td>
                    <td style="width: 8%;">{{ppms_device.Assigned_to}}</td>
                    <td style="width: 8%;"></td>
                    <td style="width: 8%;">
                        <div class="text-center" ng-if="ppms_device.PMS_ASSIGNED_TO==user_id">
                            <button class="btn btn-xs btn-default" ng-click="PendingPmsDialog($event,ppms_device)" aria-label="PMS Button{{$index}}">
                                <md-tooltip md-direction="top">Pending PMS</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">done_all</md-icon>
                            </button>
                        </div>

                        <div ng-else>
                            <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="PMS Button{{$index}}">
                                <md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr ng-show="user_role_code=HMADMIN" ng-repeat="pqc_device in pqc_devices">
                    <td style="background-color: #0065a3;width: 2%;"></td>
                    <td style="width: 15%;">{{pqc_device.EID}}</td>
                    <td style="width: 8%;">{{pqc_device.eq_name}}</td>
                    <td style="width: 8%;">{{pqc_device.location}}</td>
                    <td style="width: 8%;">-</td>
                    <td style="width: 8%;"></td>
                    <td style="width: 3%;"></td>
                    <td style="width: 4%;">QC</td>
                    <td style="width: 8%;">{{pqc_device.QC_DUE | date:'dd-MM-yyyy'}}</td>
                    <td style="width: 4%;">Pending</td>
                    <td style="width: 8%;">
                        <div class="text-center" ng-if="pqc_device.ASSIGNED_TO==null">
                            <button class="btn btn-xs btn-default" ng-click="PendingQcDialog($event,pqc_device)" aria-label="QC Button{{$index}}">
                                <md-tooltip md-direction="top">Pending QC</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">call</md-icon>
                            </button>
                        </div>
                        <div ng-else>{{pqc_device.Assigned_by}}</div>
                    </td>
                    <td style="width: 8%;">{{pqc_device.Assigned_to}}</td>
                    <td style="width: 8%;"></td>
                    <td style="width: 8%;">
                        <div class="text-center" ng-if="pqc_device.ASSIGNED_TO==user_id">
                            <button class="btn btn-xs btn-default" ng-click="PendingQcDialog($event,pqc_device)" aria-label="QC Button{{$index}}">
                                <md-tooltip md-direction="top">Pending QC</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">done_all</md-icon>
                            </button>
                        </div>

                        <div class="text-center" ng-else>
                            <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="QC Button{{$index}}">
                                <md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr ng-show="user_role_code=HMADMIN" style="/*background-color:{{ad_incednt.color}} !important*/;" ng-repeat="ad_incednt in ad_incednts">
                    <td style="background-color: #c3a303;width: 2%;"></td>
                    <td style="width: 15%;">{{ad_incednt.EQUP_ID}}</td>
                    <td style="width: 8%;">{{ad_incednt.eq_name}}</td>
                    <td style="width: 8%;">{{ad_incednt.location}}</td>
                    <td style="width: 8%;">{{ad_incednt.ADDED_BY_NAME}}</td>
                    <td style="width: 8%;">{{ad_incednt.incidents_type}}</td>
                    <td style="width: 3%;">{{ad_incednt.DEPT_ID}}</td>
                    <td style="width: 4%;">Adverse</td>
                    <td style="width: 8%;">{{ad_incednt.DATE_OCCRANCE | date:'dd-MM-yyyy'}}</td>
                    <td style="width: 4%;">{{ticket_sts1[1]}}</td>
                    <td style="width: 8%;">
                        <div ng-if="ad_incednt.ASSIGNED_TO!=null">{{ad_incednt.assigned_to}}</div>
                        <div class="text-center" ng-else>
                            <button ng-click="editObservations($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Edit">
                                <md-tooltip md-direction="top">Edit</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#d58512">mode_edit</md-icon>
                            </button>
                        </div>
                    </td>
                    <td style="width: 8%;"></td>
                    <td style="width: 8%;"></td>
                    <td style="width: 8%;">
                        <div class="text-center" ng-if="ad_incednt.ASSIGNED_TO==user_id">
                            <button ng-click="editObservations($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Edit">
                                <md-tooltip md-direction="top">Edit</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#d58512">mode_edit</md-icon>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr ng-if="round_assigned.exp==nostate" ng-repeat="round_assigned in round_assigneds">
                    <td style="background-color: #f25b22;width: 2%;"></td>
                    <td style="width: 15%;">-</td>
                    <td style="width: 8%;">-</td>
                    <td style="width: 8%;">-</td>
                    <td style="width: 8%;">{{round_assigned.assigned_by}}</td>
                    <td style="width: 8%;">Obervation</td>
                    <td style="width: 3%;">{{round_assigned.DEPT_ID}}</td>
                    <td style="width: 4%;">Round</td>
                    <td style="width: 8%;">{{round_assigned.ROUND_DATE | date:'dd-MM-yyyy'}}</td>
                    <td style="width: 4%;">Open</td>
                    <td style="width: 8%;">{{round_assigned.assigned_to}}</td>
                    <td style="width: 8%;" class="text-center">
                        <button ng-click="StartRound($event,round_assigned)" class="btn btn-xs btn-default" ng-disabled="round_assigned.sround!=''" aria-label="link">
                            <md-tooltip md-direction="top">Start</md-tooltip>
                            <md-icon class="material-icons-new" style="color:rgb(68,138,255)">call_received</md-icon>
                        </button>
                    </td>
                    <td style="width: 8%;">-</td>
                    <td style="width: 8%;" class="text-center">
                        <button ng-click="RoundSubmit(round_assigned)" ng-disabled="round_assigned.sround==''" class="btn btn-xs btn-default" aria-label="link">
                            <md-tooltip md-direction="top">Submit</md-tooltip>
                            <md-icon class="material-icons-new" style="color:green">done_all</md-icon>
                        </button>
                    </td>
                </tr>
                <tr ng-if="trnsfer.TRANSFER==transfers[1]" ng-repeat="trnsfer in trnsfers">
                    <td style="background-color: #000;width: 2%;"></td>
                    <td style="width: 15%;">{{trnsfer.EQUP_ID}}</td>
                    <td style="width: 8%;">{{trnsfer.E_NAME}}</td>
                    <td style="width: 8%;">{{trnsfer.tbranch_name}}</td>
                    <td style="width: 8%;">{{trnsfer.username}}</td>
                    <td style="width: 8%;">{{trnsfer.REASON}}</td>
                    <td style="width: 3%;">{{trnsfer.DEPT_ID}}</td>
                    <td style="width: 4%;">
                        <div ng-if="trnsfer.TRANSFER_TYPE==transfer_types[0]">{{transfer_types_view[0]}}</div>
                        <div ng-else>{{transfer_types_view[1]}}</div>
                    </td>
                    <td style="width: 8%;">{{trnsfer.added_on | date : "dd-MM-yy hh:mm a"}}</td>
                    <td style="width: 4%;">Open</td>
                    <td style="width: 8%;">
                        <div  style="text-align: center;" ng-if="trnsfer.BRANCH_ID==null">
                            <button ng-disabled="user_role_code!=HMADMIN" ng-click="OtherUnitApprovedBySuperAdmin($event,trnsfer)" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
                                <md-tooltip md-direction="top">Edit</md-tooltip>
                                <md-icon class="material-icons-new" style="color:deepskyblue">
                                    mode_edit</md-icon>
                            </button>
                        </div>
                        <div ng-else>{{trnsfer.branch_name}}</div>
                    </td>
                    <td style="width: 8%;text-align:center;">
                        <div ng-if="trnsfer.BRANCH_ID==trnsfer.TRANSFER_BRANCH">
                            <button ng-disabled="true" class="btn btn-xs btn-default" ng-click="OtherUnitTransfer($event,trnsfer)" aria-label="Transfer Button{{$index}}">
                                <md-tooltip md-direction="top">Transfer</md-tooltip>
                                <md-icon class="material-icons-new" style="color:orangered">local_shipping</md-icon>
                            </button>
                        </div>
                        <div ng-else>
                            <div ng-if="trnsfer.TRANSFER_BRANCH!=user_branch">
                                <button ng-disabled="trnsfer.DEPLOYMENT_ID!=null" class="btn btn-xs btn-default" ng-click="OtherUnitTransfer($event,trnsfer)" aria-label="Transfer Button{{$index}}">
                                    <md-tooltip md-direction="top">Transfer</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:orangered">local_shipping</md-icon>
                                </button>
                            </div>
                            <div ng-elif="trnsfer.TRANSFER_BRANCH==user_branch">
                                <button ng-disabled="true" class="btn btn-xs btn-default" ng-click="OtherUnitTransfer($event,trnsfer)" aria-label="Transfer Button{{$index}}">
                                    <md-tooltip md-direction="top">Transfer</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:orangered">local_shipping</md-icon>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td style="width: 8%;">
                        <div  style="text-align: center;" ng-if="trnsfer.BRANCH_ID==null">
                            Holden by Admin
                        </div>
                        <div ng-elif="trnsfer.BRANCH_ID!=null && trnsfer.EQUP_ID==null">Holden by {{trnsfer.branch_name}}</div>
                    </td>
                    <td style="width: 8%;text-align:center;">
                        <div ng-if="trnsfer.BRANCH_ID==trnsfer.TRANSFER_BRANCH">
                            <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
                                <md-tooltip md-direction="top">Deploy</md-tooltip>
                                <md-icon class="material-icons-new" style="color:green;">near_me
                                </md-icon>
                            </button>
                        </div>
                        <div ng-else>
                            <div ng-if="trnsfer.TRANSFER_BRANCH!=user_branch">
                                <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
                                    <md-tooltip md-direction="top">Deploy</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:green;">near_me
                                    </md-icon>
                                </button>
                            </div>
                            <div ng-elif="trnsfer.TRANSFER_BRANCH==user_branch">
                                <div ng-if="trnsfer.EQUP_ID!=null">
                                    <button ng-disabled="trnsfer.DEPLOYMENT_ID!=null" class="btn btn-xs btn-default" ng-click="transferDeployDevice($event,trnsfer)"  aria-label="Conduct Button{{$index}}">
                                        <md-tooltip md-direction="top">Deploy</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:green;">near_me
                                        </md-icon>
                                    </button>
                                </div>
                                <div ng-elif="trnsfer.DEPLOYMENT_ID==null">
                                    <button ng-disabled="trnsfer.EQUP_ID==null" class="btn btn-xs btn-default" ng-click="transferDeployDevice($event,trnsfer)"  aria-label="Conduct Button{{$index}}">
                                        <md-tooltip md-direction="top">Deploy</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:green;">near_me
                                        </md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
                                        <md-tooltip md-direction="top">Deploy</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:green;">near_me
                                        </md-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr ng-repeat="condemination in condeminations">
                    <td style="width:2%;background-color: #DDD"></td>
                    <td style="width: 15%;">{{condemination.EQUP_ID}}</td>
                    <td style="width: 8%;">{{condemination.equp_name}}</td>
                    <td style="width: 8%;">{{condemination.phy_location}}</td>
                    <td style="width: 8%;">{{condemination.added_by}}</td>
                    <td style="width: 8%;">{{condemination.REASONS}}</td>
                    <td style="width: 3%;">{{condemination.DEPT_ID}}</td>
                    <td style="width: 4%;">Codem</td>
                    <td style="width: 8%;">{{condemination.added_on+'000' | date : "dd-MM-yy hh:mm a"}}</td>
                    <td style="width: 4%;">Open</td>
                    <td style="width: 8%;">
                        <div style="text-align:center;" ng-if="condemination.CONDEMNATION_STATUS==null">
                            <button ng-disabled="user_role_code!=HMADMIN" class="btn btn-xs btn-default" ng-click="EditAdminCondemination($event,condemination)" aria-label="Conduct Button{{$index}}">
                                <md-tooltip md-direction="top">Admin Approve</md-tooltip>
                                <md-icon class="material-icons-new" style="color:deepskyblue">
                                    done</md-icon>
                            </button>
                        </div>
                        <div ng-else>
                            {{condemination.ADMIN_FEEDBACK}}
                        </div>
                    </td>
                    <td style="width: 8%;">-</td>
                    <td style="width: 8%;">-</td>
                    <td style="width: 8%;">
                        <div style="text-align: center">
                            <button ng-if="condemination.CONDEMNATION_STATUS=='Approved' "   ng-disabled="condemination.RESOLD_VALUE !=null"  class="btn btn-xs btn-default" ng-click="EditApprovedCondemnation($event,condemination)" aria-label="Conduct Button{{$index}}">
                                <md-tooltip md-direction="top">Approved</md-tooltip>
                                <md-icon class="material-icons-new" style="color:deepskyblue">
                                    done_all</md-icon>
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</md-content>