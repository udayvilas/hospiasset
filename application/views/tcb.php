<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column">
            <!--<scrollable-table watch="tc_devices" resizable>-->
            <table class="md-api-table table table-bordered" ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th style="width: 2%;"></th>
                    <th style="width:17%">Equipment ID</th>
                    <th style="width:11%">Eq. Name</th>
                    <th style="width:5%">Location</th>
                    <th style="width:7%">Raised By</th>
                    <th style="width:10%">Complaint</th>
                    <th style="width:5%">Dept</th>
                    <!--<th style="width:5%">Type </th>-->
                    <th style="width:8%">Call Date</th>
                    <th style="width:5%">Status</th>
                    <th style="width:10%">Assign To</th>
                    <th style="width:10%">Attend By</th>
                    <th style="width:10%">On Hold By</th>
                    <th style="width:10%">Completed By</th>
                </tr>
                </thead>
                <tbody>
                <tr style="background-color:{{tc_device.color}} !important;" ng-repeat="tc_device in tc_devices">
                    <td style="background-color: {{tc_device.complaint_color}}"></td>
                    <td>{{tc_device.EID}}</td>
                    <td>{{tc_device.eq_name}}</td>
                    <td>{{tc_device.location}}</td>
                    <td>{{tc_device.CALLER_NAME}}</td>
                    <td>{{tc_device.NATURE_OF_COMP}}</td>
                    <td>{{tc_device.CALLER_DEPT}}</td>
                    <!--<td>Other</td>-->
                    <td>{{tc_device.CDATETIME+'000' | date:'dd-MM-yyyy hh:mm a'}}</td>
                    <td>
                        <div ng-if="tc_device.STATUS==ticket_sts[0]">{{ticket_sts1[0]}}</div>
                        <div ng-elif="tc_device.STATUS==ticket_sts[1]">{{ticket_sts1[1]}}</div>
                        <div ng-else="tc_device.STATUS==ticket_sts[2]">{{ticket_sts1[2]}}</div>
                    </td>
                    <td style="text-align:center"> <!-- Responded / Assigned To  -->
                        <div ng-show="user_role_code!=HMADMIN" ng-if="tc_device.RESPONDED_DATE==null">
                            <div ng-if="tc_device.ASSIGNED_TO==null && tc_device.ATTENDED_BY==null">
                                <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,before_respond)">
                                    <md-tooltip md-direction="top">Respond Call</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#0d7cff">call</md-icon>
                                </button>
                            </div>
                            <div ng-elif="tc_device.ASSIGNED_TO==user_id">
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

                    <td style="text-align:center"> <!--Attend-->
                        <div ng-if="tc_device.ASSIGNED_TO==Vendor">
                            <div ng-show="user_role_code!=HMADMIN" ng-if="tc_device.ATTENDED_BY==null">
                                <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,Vendor)" aria-label="Vendor Button{{$index}}">
                                    <md-tooltip md-direction="top">Vendor Call</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#ffa602"></md-icon>
                                </button>
                            </div>
                            <div ng-else>
                                <span title="Vendor Call Attended by {{tc_device.ATTENDEE_NAME}}" style="color:#3957D8;text-transform:capitalize;">{{tc_device.ATTENDEE_NAME}}</span>
                            </div>
                        </div>
                        <div ng-show="user_role_code!=HMADMIN" ng-elif="tc_device.RESPONDED_BY==user_id && tc_device.ASSIGNED_BY!=user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,after_respond)" aria-label="Attend Button{{$index}}">
                                <md-tooltip md-direction="top">Attend Call</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">call_received</md-icon>
                            </button>
                        </div>
                        <div ng-show="user_role_code!=HMADMIN" ng-elif="tc_device.ASSIGNED_TO==user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
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

                        <div ng-elif="(tc_device.ATTENDED_BY==user_id || tc_device.ASSIGNED_TO==user_id) && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true" aria-label="Attend Button{{$index}}">
                                <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>
                        </div>

                        <div ng-elif="tc_device.ASSIGNED_TO!=user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>
                        </div>

                        <div ng-elif="(tc_device.ATTENDED_BY!=user_id || tc_device.ASSIGNED_TO==null) && tc_device.RESPONDED_DATE==null && tc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>
                        </div>

                        <div ng-elif="tc_device.ATTENDED_BY!=user_id && tc_device.RESPONDED_DATE!=null && tc_device.ATTENDED_DATE==null">
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
                    <td style="text-align:center"> <!-- Process Pending Status -->
                        <div ng-if="tc_device.ATTENDED_BY==null">
                            <button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new"  style="color:#614DA4" >sms_failed</md-icon>      </button>
                        </div>

                        <div ng-elif="tc_device.ATTENDED_BY==user_id">
                            <div ng-if="tc_device.ATTENDED_DATE!=null">
                                <div ng-if="tc_device.JOBCOMPLETED_DATE==null && tc_device.PENDING_REASON!=null">
                                    {{tc_device.ATTENDEE_NAME}}
                                </div>
                                <div ng-elif="tc_device.JOBCOMPLETED_DATE==null && tc_device.PENDING_REASON==null">
                                    <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,make_pending_call)" aria-label="Pending Button{{$index}}">
                                        <md-tooltip md-direction="top">Inprogress Call</md-tooltip>
                                        <md-icon class="material-icons-new"  style="color:#800">sms_failed</md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    {{tc_device.ATTENDEE_NAME}}
                                </div>
                            </div>
                            <div ng-else>
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
                                <div ng-elif="tc_device.JOBCOMPLETED_DATE==null && tc_device.PENDING_REASON==null">
                                    <button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
                                        <md-icon class="material-icons-new" style="color:#614DA4">sms_failed</md-icon>
                                    </button>
                                </div>
                            </div>
                            <div ng-else>
                                <button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
                                    <md-icon class="material-icons-new" style="color:#614DA4">sms_failed</md-icon>
                                </button>
                            </div>
                        </div>
                    </td> <!-- End Process Pending Status -->
                    <td style="text-align:center"><!--Complete - Status...-->
                        <div ng-if="tc_device.ATTENDED_BY==user_id">
                            <div ng-if="tc_device.ATTENDED_DATE!=null">
                                <div ng-if="tc_device.JOBCOMPLETED_DATE==null">
                                    <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,tc_device,complete_call)" aria-label="Completed Button{{$index}}">
                                        <md-tooltip md-direction="top">Complete Call</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:green">done_all</md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    {{tc_device.ATTENDEE_NAME}}
                                </div>
                            </div>
                            <div ng-else>
                                <button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
                                    <md-icon class="material-icons-new" style="color:#614DA4" >done_all</md-icon>
                                </button>
                            </div>
                        </div>

                        <div ng-elif="tc_device.ATTENDED_BY!=user_id">
                            <div ng-if="tc_device.ATTENDED_DATE!=null">
                                <div ng-if="tc_device.JOBCOMPLETED_DATE==null">
                                    <button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
                                        <md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    {{tc_device.ATTENDEE_NAME}}
                                </div>
                            </div>
                            <div ng-else>
                                <button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
                                    <md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
                                </button>
                            </div>
                        </div>
                    </td><!-- End Complete Status...-->
                </tr>
                <tr ng-show="user_role_code=HMADMIN" ng-repeat="ppms_device in ppms_devices">
                    <td style="background-color: #cbb778"></td>
                    <td>{{ppms_device.EID}}</td>
                    <td>{{ppms_device.eq_name}}</td>
                    <td>{{ppms_device.location}}</td>
                    <td>-</td>
                    <td></td>
                    <td></td>
                    <!--<td>PMS</td>-->
                    <td>{{ppms_device.PMS_DUE_DATE}}</td>
                    <td>Pending</td>
                    <td>
                        <div style="text-align: center;" ng-if="ppms_device.PMS_ASSIGNED_TO==null">
                            <button class="btn btn-xs btn-default" ng-click="PendingPmsDialog($event,ppms_device)" aria-label="PMS Button{{$index}}">
                                <md-tooltip md-direction="top">Pending PMS</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">call</md-icon>
                            </button>
                        </div>
                        <div ng-else>{{ppms_device.Assigned_by}}</div>
                    </td>
                    <td>{{ppms_device.Assigned_to}}</td>
                    <td></td>
                    <td style="text-align: center;">
                        <div ng-if="ppms_device.PMS_ASSIGNED_TO==user_id">
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
                    <td style="background-color: #0065a3"></td>
                    <td>{{pqc_device.EID}}</td>
                    <td>{{pqc_device.eq_name}}</td>
                    <td>{{pqc_device.location}}</td>
                    <td>-</td>
                    <td></td>
                    <td></td>
                    <!--<td>QC</td>-->
                    <td>{{pqc_device.QC_DUE | date:'dd-MM-yyyy'}}</td>
                    <td>Pending</td>
                    <td>
                        <div style="text-align: center;" ng-if="pqc_device.ASSIGNED_TO==null">
                            <button class="btn btn-xs btn-default" ng-click="PendingQcDialog($event,pqc_device)" aria-label="QC Button{{$index}}">
                                <md-tooltip md-direction="top">Pending QC</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">call</md-icon>
                            </button>
                        </div>
                        <div ng-else>{{pqc_device.Assigned_by}}</div>
                    </td>
                    <td>{{pqc_device.Assigned_to}}</td>
                    <td></td>
                    <td style="text-align:center">
                        <div ng-if="pqc_device.ASSIGNED_TO==user_id">
                            <button class="btn btn-xs btn-default" ng-click="PendingQcDialog($event,pqc_device)" aria-label="QC Button{{$index}}">
                                <md-tooltip md-direction="top">Pending QC</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#ffa602">done_all</md-icon>
                            </button>
                        </div>

                        <div ng-else>
                            <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="QC Button{{$index}}">
                                <md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr ng-show="user_role_code=HMADMIN" style="/*background-color:{{ad_incednt.color}} !important*/;" ng-repeat="ad_incednt in ad_incednts">
                    <td style="background-color: #c3a303"></td>
                    <td>{{ad_incednt.EQUP_ID}}</td>
                    <td>{{ad_incednt.eq_name}}</td>
                    <td>{{ad_incednt.location}}</td>
                    <td>{{ad_incednt.ADDED_BY_NAME}}</td>
                    <td>{{ad_incednt.incidents_type}}</td>
                    <td>{{ad_incednt.DEPT_ID}}</td>
                    <!--<td>Adverse</td>-->
                    <td>{{ad_incednt.DATE_OCCRANCE | date:'dd-MM-yyyy'}}</td>
                    <td>{{ticket_sts1[1]}}</td>
                    <td>-</td>
                    <td></td>
                    <td></td>
                    <td style="text-align: center;">
                        <button ng-click="editObservations($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Edit</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#d58512">mode_edit</md-icon>
                        </button>
                        <!--<md-button ng-click="viewAdverseIncedentsDetalis($event,ad_incednt)" class="md-icon-button md-accent" aria-label="Edit">
                            <md-tooltip md-direction="top">View</md-tooltip>
                            <md-icon>launch</md-icon>
                        </md-button>-->
                    </td>
                </tr>
                <tr ng-if="round_assigned.exp==nostate" ng-repeat="round_assigned in round_assigneds">
                    <td style="background-color: #f25b22"></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>{{round_assigned.assigned_by}}</td>
                    <td>Obervation</td>
                    <td>{{round_assigned.DEPT_ID}}</td>
                    <!--<td>Round</td>-->
                    <td>{{round_assigned.ROUND_DATE | date:'dd-MM-yyyy'}}</td>
                    <td>Open</td>
                    <td>{{round_assigned.assigned_to}}</td>
                    <td style="text-align:center;">
                        <button ng-click="StartRound($event,round_assigned)" class="btn btn-xs btn-default" ng-disabled="round_assigned.sround!=''" aria-label="link">
                            <md-tooltip md-direction="top">Start</md-tooltip>
                            <md-icon class="material-icons-new" style="color:rgb(68,138,255)">call_received</md-icon>
                        </button>
                    </td>
                    <td>-</td>
                    <td style="text-align:center;">
                        <button ng-click="RoundSubmit(round_assigned)" ng-disabled="round_assigned.sround==''" class="btn btn-xs btn-default" aria-label="link">
                            <md-tooltip md-direction="top">Submit</md-tooltip>
                            <md-icon class="material-icons-new" style="color:green">done_all</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <!--</scrollable-table>-->
        </div>
    </div>
</md-content>