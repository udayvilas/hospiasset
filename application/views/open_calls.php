<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
	<div layout="column">
		<div ng-include="'includes/call_alerts'"></div>
		<h3 class="heading-stylerespond">{{title}}</h3>
		<div flex layout="column" layout-md="column" flex-gt-sm="column" layout-xs="column" style="margin-top: 10px;">
			<table class="md-api-table table table-bordered" ng-cloak>
				<thead>
					<tr>
						<th style="width: 2%;"></th>
						<th style="width: 16%;">Equipment ID</th>
						<th style="width: 8%;">Eq. Name</th>
						<th style="width: 8%;">Location</th>
						<th style="width: 8%;">Raised By</th>
						<th style="width: 8%;">Complaint</th>
						<th style="width: 3%;">Dept</th>
						<th style="width: 4%;">Type</th>
						<th style="width: 9%;">Call Date</th>
						<th style="width: 4%;">Status</th>
						<th style="width: 8%;">Assigned</th>
						<th style="width: 8%;">Attended By</th>
						<th style="width: 8%;">On Hold By</th>
						<th style="width: 6%;">CompletedBy</th>
					</tr>
				</thead>
				<tbody>
					<tr style="background-color:{{open_ns_call.color}} !important;" ng-repeat="open_ns_call in open_ns_calls">
						<td style="background-color: {{open_ns_call.complaint_color}};width: 2%;"></td>
						<td style="width: 16%;">{{ (user_org == open_ns_call.ORG_ID) ? open_ns_call.EID : open_ns_call.ASSIGN_ID}}</td>
						<td style="width: 8%;">{{open_ns_call.eq_name}}</td>
						<td style="width: 8%;">{{open_ns_call.location}}</td>
						<td style="width: 8%;">{{open_ns_call.CALLER_NAME}}</td>
						<td style="width: 8%;">{{open_ns_call.NATURE_OF_COMP}}</td>
						<td style="width: 3%;">{{open_ns_call.CALLER_DEPT}}</td>
						<td style="width: 4%;">Other</td>
						<td style="width: 9%;">{{open_ns_call.CDATETIME+'000' | date:'dd-MM-yy h:mma'}}</td>
						<td style="width: 4%;">
							<div ng-if="open_ns_call.STATUS==ticket_sts[0]">{{ticket_sts1[0]}}</div>
							<div ng-elif="open_ns_call.STATUS==ticket_sts[1]">{{ticket_sts1[1]}}</div>
							<div ng-else="open_ns_call.STATUS==ticket_sts[2]">{{ticket_sts1[2]}}</div>
						</td>
						<td style="width: 8%;">
							<!-- Responded / Assigned To  -->
							<div ng-show="user_role_code!=HMADMIN" ng-if="open_ns_call.RESPONDED_DATE==null">
								<div class="text-center" ng-if="open_ns_call.ASSIGNED_TO==null && open_ns_call.ATTENDED_BY==null">
									<button class="btn btn-xs btn-default" ng-click="RespondToCall($event,open_ns_call,before_respond)">
										<md-tooltip md-direction="top">Respond Call</md-tooltip>
										<md-icon class="material-icons-new" style="color:#0d7cff">call</md-icon>
									</button>
								</div>
								<div class="text-center" ng-elif="open_ns_call.ASSIGNED_TO==user_id">
									<button class="btn btn-xs btn-default" ng-click="RespondToCall($event,open_ns_call,before_respond)" aria-label="Respond Button{{$index}}">
										<md-tooltip md-direction="top">Call Assigned To You</md-tooltip>
										<md-icon class="material-icons-new" style="color:#009688">call</md-icon>
									</button>
								</div>
								<div ng-else>{{open_ns_call.ASSIGNED_ON}} / {{open_ns_call.ASSIGNED_TO_NAME}}</div>
							</div>
							<div ng-else>
								<div>{{open_ns_call.RESPONDED_DATE | date:'dd-MM-yy'}} {{open_ns_call.RESPONDED_TIME}}  / {{open_ns_call.RESPONDED_BY_NAME}}</div>
							</div>
						</td>
						<!-- End Responded / Assigned To -->
						<td style="width: 8%;">
							<!--Attend-->
							<div ng-if="open_ns_call.ASSIGNED_TO==Vendor">
								<div class="text-center" ng-show="user_role_code!=HMADMIN" ng-if="open_ns_call.ATTENDED_BY==null">
									<button class="btn btn-xs btn-default" ng-click="RespondToCall($event,open_ns_call,Vendor)" aria-label="Vendor Button{{$index}}">
										<md-tooltip md-direction="top">Vendor Call</md-tooltip>
										<md-icon class="material-icons-new" style="color:#ffa602">call_merge</md-icon>
									</button>
								</div>
								<div ng-else>
									<span title="Vendor Call Attended by {{open_ns_call.ATTENDEE_NAME}}" style="color:#3957D8;text-transform:capitalize;">{{open_ns_call.ATTENDED_DATE | date:'dd-MM-yy'}} {{open_ns_call.ATTENDED_TIME}} / {{open_ns_call.ATTENDEE_NAME}}</span>
								</div>
							</div>
							<div class="text-center" ng-show="user_role_code!=HMADMIN" ng-elif="open_ns_call.RESPONDED_BY==user_id && open_ns_call.ASSIGNED_BY!=user_id && open_ns_call.RESPONDED_DATE!=null && open_ns_call.ATTENDED_DATE==null">
								<button class="btn btn-xs btn-default" ng-click="RespondToCall($event,open_ns_call,after_respond)" aria-label="Attend Button{{$index}}">
									<md-tooltip md-direction="top">Attend Call</md-tooltip>
									<md-icon class="material-icons-new" style="color:#ffa602">call_received</md-icon>
								</button>
							</div>
							<div class="text-center" ng-show="user_role_code!=HMADMIN" ng-elif="open_ns_call.ASSIGNED_TO==user_id && open_ns_call.RESPONDED_DATE!=null && open_ns_call.ATTENDED_DATE==null">
								<button class="btn btn-xs btn-default" ng-click="RespondToCall($event,open_ns_call,after_respond)" aria-label="Attend Button{{$index}}">
									<md-tooltip md-direction="top">Assigned by {{open_ns_call.ASSIGNED_BY_NAME}}</md-tooltip>
									<md-icon class="material-icons-new" style="color:#009688">call_received</md-icon>
								</button>
							</div>
							<div ng-elif="open_ns_call.ASSIGNED_TO==user_id && open_ns_call.RESPONDED_DATE!=null && open_ns_call.ATTENDED_DATE!=null">                            {{open_ns_call.ASSIGNED_ON}} / {{open_ns_call.ASSIGNED_TO_NAME}}                        </div>
							<div ng-elif="open_ns_call.ATTENDED_BY==user_id && open_ns_call.RESPONDED_DATE!=null && open_ns_call.ATTENDED_DATE!=null">                            {{open_ns_call.ATTENDED_DATE | date:'dd-MM-yy'}} {{open_ns_call.ATTENDED_TIME}} / {{open_ns_call.ATTENDEE_NAME}}                        </div>
							<div class="text-center" ng-elif="(open_ns_call.ATTENDED_BY==user_id || open_ns_call.ASSIGNED_TO==user_id) && open_ns_call.RESPONDED_DATE!=null && open_ns_call.ATTENDED_DATE==null">
								<button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true" aria-label="Attend Button{{$index}}">
									<md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
								</button>
							</div>
							<div class="text-center" ng-elif="open_ns_call.ASSIGNED_TO!=user_id && open_ns_call.RESPONDED_DATE!=null && open_ns_call.ATTENDED_DATE==null">
								<button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
									<md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
								</button>
							</div>
							<div class="text-center" ng-elif="(open_ns_call.ATTENDED_BY!=user_id || open_ns_call.ASSIGNED_TO==null) && open_ns_call.RESPONDED_DATE==null && open_ns_call.ATTENDED_DATE==null">
								<button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
									<md-icon class="material-icons-new" style="color:#614DA4">call_received</md-icon>
								</button>
							</div>
							<div class="text-center" ng-elif="open_ns_call.ATTENDED_BY!=user_id && open_ns_call.RESPONDED_DATE!=null && open_ns_call.ATTENDED_DATE==null">
								<button class="btn btn-xs btn-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
									<md-icon class="material-icons-new" style="color:#614DA4" >call_received</md-icon>
								</button>
							</div>
							<div ng-elif="open_ns_call.ATTENDED_BY!=user_id && open_ns_call.RESPONDED_DATE!=null && open_ns_call.ATTENDED_DATE!=null">                            {{open_ns_call.ATTENDED_DATE | date:'dd-MM-yy'}} {{open_ns_call.ATTENDED_TIME}} / {{open_ns_call.ATTENDEE_NAME}}                        </div>
							<div ng-elif="open_ns_call.ASSIGNED_TO!=user_id && open_ns_call.RESPONDED_DATE!=null && open_ns_call.ATTENDED_DATE!=null">                            {{open_ns_call.ASSIGNED_ON}} / {{open_ns_call.ASSIGNED_TO_NAME}}                        </div>
						</td>
						<!--End Attend-->
						<td style="width: 8%;">
							<!-- Process Pending Status -->
							<div class="text-center" ng-if="open_ns_call.ATTENDED_BY==null">
								<button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
									<md-icon class="material-icons-new"  style="color:#614DA4" >sms_failed</md-icon>
								</button>
							</div>
							<div ng-elif="open_ns_call.ATTENDED_BY==user_id">
								<div ng-if="open_ns_call.ATTENDED_DATE!=null">
									<div ng-if="open_ns_call.JOBCOMPLETED_DATE==null && open_ns_call.PENDING_REASON!=null">                                    {{open_ns_call.ATTENDED_DATE | date:'dd-MM-yy'}} {{open_ns_call.ATTENDED_TIME}} / {{open_ns_call.ATTENDEE_NAME}}                                </div>
									<div class="text-center" ng-elif="open_ns_call.JOBCOMPLETED_DATE==null && open_ns_call.PENDING_REASON==null">
										<button class="btn btn-xs btn-default" ng-click="RespondToCall($event,open_ns_call,make_pending_call)" aria-label="Pending Button{{$index}}">
											<md-tooltip md-direction="top">Inprogress Call</md-tooltip>
											<md-icon class="material-icons-new"  style="color:#800">sms_failed</md-icon>
										</button>
									</div>
									<div ng-else>                                    {{open_ns_call.ATTENDED_DATE | date:'dd-MM-yy'}} {{open_ns_call.ATTENDED_TIME}} / {{open_ns_call.ATTENDEE_NAME}}                                </div>
								</div>
								<div class="text-center" ng-else>
									<button class="btn btn-xs btn-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
										<md-icon class="material-icons-new" style="color:#614DA4" size="24">sms_failed</md-icon>
									</button>
								</div>
							</div>
							<div ng-elif="open_ns_call.ATTENDED_BY!=user_id">
								<div ng-if="open_ns_call.ATTENDED_DATE!=null">
									<div ng-if="open_ns_call.JOBCOMPLETED_DATE==null && open_ns_call.PENDING_REASON!=null">                                    {{open_ns_call.ATTENDED_DATE | date:'dd-MM-yy'}} {{open_ns_call.ATTENDED_TIME}} / {{open_ns_call.ATTENDEE_NAME}}                                </div>
									<div class="text-center" ng-elif="open_ns_call.JOBCOMPLETED_DATE==null && open_ns_call.PENDING_REASON==null">
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
						</td>
						<!-- End Process Pending Status -->
						<td style="width: 6%;">
							<!--Complete - Status...-->
							<div ng-if="open_ns_call.ATTENDED_BY==user_id">
								<div ng-if="open_ns_call.ATTENDED_DATE!=null">
									<div class="text-center" ng-if="open_ns_call.JOBCOMPLETED_DATE==null">
										<button class="btn btn-xs btn-default" ng-click="RespondToCall($event,open_ns_call,complete_call)" aria-label="Completed Button{{$index}}">
											<md-tooltip md-direction="top">Complete Call</md-tooltip>
											<md-icon class="material-icons-new" style="color:green">done_all</md-icon>
										</button>
									</div>
									<div ng-else>{{open_ns_call.jobcomplete_date}} / {{open_ns_call.COMPLETED_BY}}                                </div>
								</div>
								<div class="text-center" ng-else>
									<button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
										<md-icon class="material-icons-new" style="color:#614DA4" >done_all</md-icon>
									</button>
								</div>
							</div>
							<div ng-elif="open_ns_call.ATTENDED_BY!=user_id">
								<div ng-if="open_ns_call.ATTENDED_DATE!=null">
									<div class="text-center" ng-if="open_ns_call.JOBCOMPLETED_DATE==null">
										<button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
											<md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
										</button>
									</div>
									<div ng-else>{{open_ns_call.jobcomplete_date}} / {{open_ns_call.COMPLETED_BY}}                               </div>
								</div>
								<div class="text-center" ng-else>
									<button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
										<md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
									</button>
								</div>
							</div>
						</td>
						<!-- End Complete Status...-->
					</tr>
				</tbody>
			</table>
		</div>
		<div flex layout="row" class="marginb-10" ng-if="!isEmpty(open_ns_calls)">
			<div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
				<md-button class="md-icon-button md-primary md-raised" aria-label="Total">
					<md-tooltip md-direction="top">Total Records</md-tooltip>                    {{no_of_recs}}                
				</md-button>
			</div>
			<div flex="20" hide-xs hide-sm>
				<!-- Space -->
			</div>
			<div flex-xs="100" flex="60" layout="column" layout-align="end end">
				<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="openNsCalls(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
			</div>
		</div>
	</div>
</md-content>