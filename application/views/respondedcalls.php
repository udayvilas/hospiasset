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
                    <th>Assigned</th>
                    <th>Attended By</th>
                    <th>On Hold By</th>
                    <th>Completed By</th>
                </tr>
                </thead>
                <tbody ng-if="!isEmpty(rc_devices)">
                <tr style="background-color:{{rc_device.color}} !important;" ng-repeat="rc_device in rc_devices">
                    <td style="background-color:#353bf0;width:2%"></td>
                    <td>{{(user_org == rc_device.ORG_ID) ? rc_device.EID : rc_device.ASSIGN_ID}}</td>
                    <td>{{rc_device.eq_name}}</td>
                    <td>{{rc_device.location}}</td>
                    <td>{{rc_device.CALLER_UNAME}}</td>
                    <td>{{rc_device.NATURE_OF_COMP}}</td>
                    <td>{{rc_device.CALLER_DEPT}}</td>
                    <td>{{rc_device.TYPE}}</td>
                    <td>{{rc_device.CDATETIME+'000' | date:'dd-MM-yyyy hh:mm a'}}</td>
                    <td>
                        <div ng-if="rc_device.STATUS==ticket_sts[0]">{{ticket_sts1[0]}}</div>
                        <div ng-elif="rc_device.STATUS==ticket_sts[1]">{{ticket_sts1[1]}}</div>
                        <div ng-else="rc_device.STATUS==ticket_sts[2]">{{ticket_sts1[2]}}</div>
                    </td>
                    <td style="text-align:center;"> <!-- Responded / Assigned To  -->
                        <div ng-if="rc_device.RESPONDED_DATE==null" ng-show="user_role_code!=HMADMIN">
                            <div ng-if="rc_device.ASSIGNED_TO==null && rc_device.ATTENDED_BY==null">
                                <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,rc_device,before_respond)" aria-label="Respond Button{{$index}}">
                                    <md-tooltip md-direction="top">Respond Call</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#0d7cff">call</md-icon>
                                </button>
                            </div>
                            <div ng-elif="rc_device.ASSIGNED_TO==user_id">
                                <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,rc_device,before_respond)" aria-label="Respond Button{{$index}}">
                                    <md-tooltip md-direction="top">Call Assigned To You</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#009688">call</md-icon>
                                </button>
                            </div>
                            <div ng-else>{{rc_device.ASSIGNED_ON}} / {{rc_device.ASSIGNED_TO_NAME}}</div>
                        </div>
                        <div ng-else>
                            <div>{{rc_device.RESPONDED_DATE | date:'dd-MM-yy'}} {{rc_device.RESPONDED_TIME}} / {{rc_device.RESPONDED_BY_NAME}}</div>
                        </div>
                    </td> <!-- End Responded / Assigned To -->
                    <td style="text-align:center;"> <!--Attend-->
                        <div ng-if="rc_device.org_type=='Vendor'">
                            <div ng-show="user_role_code!=HMADMIN" ng-if="rc_device.ASSIGNED_BY==null>
                                <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,rc_device,Vendor)" aria-label="Vendor Button{{$index}}">
                                    <md-tooltip md-direction="top">Vendor Call</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#ffa602">call_split</md-icon>
                                </button>
                            </div>
                            <div ng-show="user_role_code!=HMADMIN" ng-if="rc_device.ASSIGNED_BY!=null">
                                <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,rc_device,Vendor)" ng-disabled="true" aria-label="Vendor Button{{$index}}">
                                    <md-tooltip md-direction="top">Vendor Call</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#ffa602">call_split</md-icon>
                                </button>
                            </div>
                            <div ng-else>
                                <span title="Vendor Call Attended by {{rc_device.ATTENDEE_NAME}}" style="color:#3957D8;text-transform:capitalize;">{{rc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{rc_device.ATTENDED_TIME}} / {{rc_device.ATTENDEE_NAME}}</span>
                            </div>
                        </div>
                        <div ng-show="user_role_code!=HMADMIN" ng-elif="rc_device.RESPONDED_BY==user_id && rc_device.ASSIGNED_BY!=user_id && rc_device.RESPONDED_DATE!=null && rc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,rc_device,after_respond)" aria-label="Attend Button{{$index}}">
                                <md-tooltip md-direction="top">Attend Call</md-tooltip>
                                <md-icon style="color:#ffa602">call_received</md-icon>
                            </button>
                        </div>
                        <div ng-show="user_role_code!=HMADMIN" ng-elif=" rc_device.RESPONDED_DATE!=null && rc_device.ATTENDED_DATE==null && rc_device.ASSIGNED_DATE!=null">
                            <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,rc_device,after_respond)" aria-label="Attend Button{{$index}}">
                                <md-tooltip md-direction="top">Assigned by {{rc_device.ASSIGNED_BY_NAME}}</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#009688">call_received</md-icon>
                            </button>
                        </div>
                        <div ng-elif="rc_device.ASSIGNED_TO==user_id && rc_device.RESPONDED_DATE!=null && rc_device.ATTENDED_DATE!=null">
                            {{rc_device.ASSIGNED_ON}} / {{rc_device.ASSIGNED_TO_NAME}}
                        </div>
						
                        <div ng-elif="rc_device.ATTENDED_BY==user_id && rc_device.RESPONDED_DATE!=null && rc_device.ATTENDED_DATE!=null">
                            {{rc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{rc_device.ATTENDED_TIME}} / {{rc_device.ATTENDEE_NAME}}
                        </div>
                        <div ng-elif="(rc_device.ATTENDED_BY==user_id || rc_device.ASSIGNED_TO==user_id) && rc_device.RESPONDED_DATE!=null && rc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true" aria-label="Attend Button{{$index}}">
                                <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>
                        </div>
                        <div ng-elif="rc_device.ASSIGNED_TO!=user_id && rc_device.RESPONDED_DATE!=null && rc_device.ATTENDED_DATE==null">
                           <!--<button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>-->
							{{rc_device.ASSIGNED_ON}} / {{rc_device.ASSIGNED_TO_NAME}}
                        </div>
                        <div ng-elif="(rc_device.ATTENDED_BY!=user_id || rc_device.ASSIGNED_TO==null) && rc_device.RESPONDED_DATE==null && rc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>
                        </div>
                        <div ng-elif="rc_device.ATTENDED_BY!=user_id && rc_device.RESPONDED_DATE!=null && rc_device.ATTENDED_DATE==null">
                            <button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
                            </button>
                        </div>
                        <div ng-elif="rc_device.ATTENDED_BY!=user_id && rc_device.RESPONDED_DATE!=null && rc_device.ATTENDED_DATE!=null">
                            {{rc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{rc_device.ATTENDED_TIME}} / {{rc_device.ATTENDEE_NAME}}
                        </div>
                        <div ng-elif="rc_device.ASSIGNED_TO!=user_id && rc_device.RESPONDED_DATE!=null && rc_device.ATTENDED_DATE!=null">
                            {{rc_device.ASSIGNED_ON}} / {{rc_device.ASSIGNED_TO_NAME}}
                        </div>
                    </td> <!--End Attend-->
                    <td style="text-align:center;"> <!-- Process Pending Status -->
                        <div ng-if="rc_device.ATTENDED_BY==null">
                            <button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
                                <md-icon class="material-icons-new" style="color:#614DA4">sms_failed</md-icon>
                            </button>
                        </div>
                        <div ng-elif="rc_device.ATTENDED_BY==user_id">
                            <div ng-if="rc_device.ATTENDED_DATE!=null">
                                <div ng-if="rc_device.JOBCOMPLETED_DATE==null && rc_device.PENDING_REASON!=null">
                                    {{rc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{rc_device.ATTENDED_TIME}} / {{rc_device.ATTENDEE_NAME}}
                                </div>
                                <div ng-elif="rc_device.JOBCOMPLETED_DATE==null && rc_device.PENDING_REASON==null">
                                    <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,rc_device,make_pending_call)" aria-label="Pending Button{{$index}}">
                                        <md-tooltip md-direction="top">Inprogress Call</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:#800">sms_failed</md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    {{rc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{rc_device.ATTENDED_TIME}} / {{rc_device.ATTENDEE_NAME}}
                                </div>
                            </div>
                            <div ng-else>
                                <button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
                                    <md-icon class="material-icons-new" style="color:#614DA4">sms_failed</md-icon>
                                </button>
                            </div>
                        </div>
                        <div ng-elif="rc_device.ATTENDED_BY!=user_id">
                            <div ng-if="rc_device.ATTENDED_DATE!=null">
                                <div ng-if="rc_device.JOBCOMPLETED_DATE==null && rc_device.PENDING_REASON!=null">
                                    {{rc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{rc_device.ATTENDED_TIME}} / {{rc_device.ATTENDEE_NAME}}
                                </div>
                                <div ng-elif="rc_device.JOBCOMPLETED_DATE==null && rc_device.PENDING_REASON==null">
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
                    <td style="text-align:center;"><!--Complete - Status...-->
                        <div ng-if="rc_device.ATTENDED_BY==user_id">
                            <div ng-if="rc_device.ATTENDED_DATE!=null">
                                <div ng-if="rc_device.JOBCOMPLETED_DATE==null">
                                    <button class="btn btn-xs btn-default" ng-click="RespondToCall($event,rc_device,complete_call)" aria-label="Completed Button{{$index}}">
                                        <md-tooltip md-direction="top">Complete Call</md-tooltip>
                                        <md-icon class="material-icons-new" style="color:green">done_all</md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    {{rc_device.jobcomplete_date}} / {{rc_device.COMPLETED_BY}}
                                </div>
                            </div>
                            <div ng-else>
                                <button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
                                    <md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
                                </button>
                            </div>
                        </div>
                        <div ng-elif="rc_device.ATTENDED_BY!=user_id">
                            <div ng-if="rc_device.ATTENDED_DATE!=null">
                                <div ng-if="rc_device.JOBCOMPLETED_DATE==null">
                                    <button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
                                        <md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
                                    </button>
                                </div>
                                <div ng-else>
                                    {{rc_device.jobcomplete_date}} / {{rc_device.COMPLETED_BY}}
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
                </tbody>
                <tbody ng-else>
                <tr>
                    <td style="text-align: center;" colspan="15">No Calls Found</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div flex layout="row" class="marginb-10"  ng-if="rc_devices!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="SearchRespondedCalls(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>