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
				<tbody ng-if="ppc_devices!=null">
					<tr style="background-color:{{ppc_device.color}} !important;" ng-repeat="ppc_device in ppc_devices">
						<td style="background-color:#ffc425;width:2%"></td>
						<td>{{(user_org == ppc_device.ORG_ID) ? ppc_device.EID : ppc_device.ASSIGN_ID}}</td>
						<td>{{ppc_device.eq_name}}</td>
						<td>{{ppc_device.location}}</td>
						<td>{{ppc_device.CALLER_UNAME}}</td>
						<td>{{ppc_device.NATURE_OF_COMP}}</td>
						<td>{{ppc_device.CALLER_DEPT}}</td>
						<td>{{ppc_device.TYPE}}</td>
						<td>{{ppc_device.CDATETIME+'000' | date:'dd-MM-yyyy hh:mm a'}}</td>
						<td>
							<div ng-if="ppc_device.STATUS==ticket_sts[0]">{{ticket_sts1[0]}}</div>
							<div ng-elif="ppc_device.STATUS==ticket_sts[1]">{{ticket_sts1[1]}}</div>
							<div ng-else="ppc_device.STATUS==ticket_sts[2]">{{ticket_sts1[2]}}</div>
						</td>
						<td align="center">
							<!-- Responded / Assigned To  -->
							<div ng-show="user_role_code!=HMADMIN" ng-if="ppc_device.RESPONDED_DATE==null">
								<div ng-if="ppc_device.ASSIGNED_TO==null && ppc_device.ATTENDED_BY==null">
									<md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="RespondToCall($event,ppc_device,before_respond)" aria-label="Respond Button{{$index}}">
										<md-tooltip md-direction="top">Respond Call</md-tooltip>
										<ng-md-icon icon="call" style="fill:#0d7cff" size="24"></ng-md-icon>
									</md-button>
								</div>
								<div ng-elif="ppc_device.ASSIGNED_TO==user_id">
									<md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="RespondToCall($event,ppc_device,before_respond)" aria-label="Respond Button{{$index}}">
										<md-tooltip md-direction="top">Call Assigned To You</md-tooltip>
										<ng-md-icon icon="call" style="fill:#009688" size="24"></ng-md-icon>
									</md-button>
								</div>
								<div ng-else>{{ppc_device.ASSIGNED_ON}} / {{ppc_device.ASSIGNED_TO_NAME}}</div>
							</div>
							<div ng-else>
								<!--<div ng-if="tc_device.ASSIGNED_TO==user_id">{{tc_device.ASSIGNED_TO_NAME}}</div><div ng-elif="tc_device.RESPONDED_BY==user_id">{{tc_device.RESPONDED_BY_NAME}}</div><div ng-elif="tc_device.ATTENDED_BY==user_id">{{tc_device.ATTENDEE_NAME}}</div><div ng-elif="tc_device.ATTENDED_BY!=user_id">{{tc_device.RESPONDED_BY_NAME}}</div>-->
								<div>{{ppc_device.RESPONDED_DATE | date:'dd-MM-yy'}} {{ppc_device.RESPONDED_TIME}} / {{ppc_device.RESPONDED_BY_NAME}}</div>
							</div>
						</td>
						<!-- End Responded / Assigned To -->
						<td style="text-align:center;">
							<!--Attend-->
							<div ng-if="ppc_device.ASSIGNED_TO==Vendor">
								<div ng-show="user_role_code!=HMADMIN" ng-if="ppc_device.ATTENDED_BY==null">
									<md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="RespondToCall($event,ppc_device,Vendor)" aria-label="Vendor Button{{$index}}">
										<md-tooltip md-direction="top">Vendor Call</md-tooltip>
										<ng-md-icon icon="call_split" style="fill:#ffa602" size="24"></ng-md-icon>
									</md-button>
								</div>
								<div ng-else>
									<span title="Vendor Call Attended by {{ppc_device.ATTENDEE_NAME}}" style="color:#3957D8;text-transform:capitalize;">{{ppc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{ppc_device.ATTENDED_TIME}}  / {{ppc_device.ATTENDEE_NAME}}</span>
								</div>
							</div>
							<div ng-show="user_role_code!=HMADMIN" ng-elif="ppc_device.RESPONDED_BY==user_id && ppc_device.ASSIGNED_BY!=user_id && ppc_device.RESPONDED_DATE!=null && ppc_device.ATTENDED_DATE==null">
								<md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="RespondToCall($event,ppc_device,after_respond)" aria-label="Attend Button{{$index}}">
									<md-tooltip md-direction="top">Attend Call</md-tooltip>
									<ng-md-icon icon="call_received" style="fill:#ffa602" size="24"></ng-md-icon>
								</md-button>
							</div>
							<div ng-show="user_role_code!=HMADMIN" ng-elif="ppc_device.ASSIGNED_TO==user_id && ppc_device.RESPONDED_DATE!=null && ppc_device.ATTENDED_DATE==null">
								<md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="RespondToCall($event,ppc_device,after_respond)" aria-label="Attend Button{{$index}}">
									<md-tooltip md-direction="top">Assigned by {{ppc_device.ASSIGNED_BY_NAME}}</md-tooltip>
									<ng-md-icon icon="call_received" style="fill:#009688" size="24"></ng-md-icon>
								</md-button>
							</div>
							<div ng-elif="ppc_device.ASSIGNED_TO==user_id && ppc_device.RESPONDED_DATE!=null && ppc_device.ATTENDED_DATE!=null">                            {{ppc_device.ASSIGNED_ON}} / {{ppc_device.ASSIGNED_TO_NAME}}                        </div>
							<div ng-elif="ppc_device.ATTENDED_BY==user_id && ppc_device.RESPONDED_DATE!=null && ppc_device.ATTENDED_DATE!=null">                            {{ppc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{ppc_device.ATTENDED_TIME}}  / {{ppc_device.ATTENDEE_NAME}}                        </div>
							<div ng-elif="(ppc_device.ATTENDED_BY==user_id || ppc_device.ASSIGNED_TO==user_id) && ppc_device.RESPONDED_DATE!=null && ppc_device.ATTENDED_DATE==null">
								<md-button class="md-icon-button my-md-icon-button md-raised md-default" aria-label="Attend Button{{$index}}" ng-disabled="true" aria-label="Attend Button{{$index}}>
									<ng-md-icon icon="call_received" style="fill:#FFFFFF" size="24"></ng-md-icon>
								</md-button>
							</div>
							<div ng-elif="ppc_device.ASSIGNED_TO!=user_id && ppc_device.RESPONDED_DATE!=null && ppc_device.ATTENDED_DATE==null">
								<md-button class="md-icon-button my-md-icon-button md-raised md-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
									<ng-md-icon icon="call_received" style="fill:#FFFFFF" size="24"></ng-md-icon>
								</md-button>
							</div>
							<div ng-elif="(ppc_device.ATTENDED_BY!=user_id || ppc_device.ASSIGNED_TO==null) && ppc_device.RESPONDED_DATE==null && ppc_device.ATTENDED_DATE==null">
								<md-button class="md-icon-button my-md-icon-button md-raised md-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
									<ng-md-icon icon="call_received" style="fill:#FFFFFF" size="24"></ng-md-icon>
								</md-button>
							</div>
							<div ng-elif="ppc_device.ATTENDED_BY!=user_id && ppc_device.RESPONDED_DATE!=null && ppc_device.ATTENDED_DATE==null">
								<md-button class="md-icon-button my-md-icon-button md-raised md-default" aria-label="Attend Button{{$index}}" ng-disabled="true">
									<ng-md-icon icon="call_received" style="fill:#FFFFFF" size="24"></ng-md-icon>
								</md-button>
							</div>
							<div ng-elif="ppc_device.ATTENDED_BY!=user_id && ppc_device.RESPONDED_DATE!=null && ppc_device.ATTENDED_DATE!=null">                            {{ppc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{ppc_device.ATTENDED_TIME}}  / {{ppc_device.ATTENDEE_NAME}}                        </div>
							<div ng-elif="ppc_device.ASSIGNED_TO!=user_id && ppc_device.RESPONDED_DATE!=null && ppc_device.ATTENDED_DATE!=null">                            {{ppc_device.ASSIGNED_ON}} / {{ppc_device.ASSIGNED_TO_NAME}}                        </div>
						</td>
						<!--End Attend-->
						<td style="text-align:center;">
							<!-- Process Pending Status -->
							<div ng-if="ppc_device.ATTENDED_BY==null">
								<md-button class="md-icon-button my-md-icon-button md-raised md-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
									<ng-md-icon icon="sms_failed" style="fill:#FFFFFF" size="24"></ng-md-icon>
								</md-button>
							</div>
							<div ng-elif="ppc_device.ATTENDED_BY==user_id">
								<div ng-if="ppc_device.ATTENDED_DATE!=null">
									<div ng-if="ppc_device.JOBCOMPLETED_DATE==null && ppc_device.PENDING_REASON!=null">                                    {{ppc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{ppc_device.ATTENDED_TIME}}  / {{ppc_device.ATTENDEE_NAME}}                                </div>
									<div ng-elif="ppc_device.JOBCOMPLETED_DATE==null && ppc_device.PENDING_REASON==null">
										<md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="RespondToCall($event,ppc_device,make_pending_call)" aria-label="Pending Button{{$index}}">
											<md-tooltip md-direction="top">Inprogress Call</md-tooltip>
											<ng-md-icon icon="sms_failed" style="fill:#800" size="24"></ng-md-icon>
										</md-button>
									</div>
									<div ng-else>                                    {{ppc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{ppc_device.ATTENDED_TIME}}  / {{ppc_device.ATTENDEE_NAME}}                                </div>
								</div>
								<div ng-else>
									<md-button class="md-icon-button my-md-icon-button md-raised md-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
										<ng-md-icon icon="sms_failed" style="fill:#FFFFFF" size="24"></ng-md-icon>
									</md-button>
								</div>
							</div>
							<div ng-elif="ppc_device.ATTENDED_BY!=user_id">
								<div ng-if="ppc_device.ATTENDED_DATE!=null">
									<div ng-if="ppc_device.JOBCOMPLETED_DATE==null && ppc_device.PENDING_REASON!=null">                                    {{ppc_device.ATTENDED_DATE | date:'dd-MM-yy'}} {{ppc_device.ATTENDED_TIME}}  / {{ppc_device.ATTENDEE_NAME}}                                </div>
									<div ng-elif="ppc_device.JOBCOMPLETED_DATE==null && ppc_device.PENDING_REASON==null">
										<md-button class="md-icon-button my-md-icon-button md-raised md-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
											<ng-md-icon icon="sms_failed" style="fill:#FFFFFF" size="24"></ng-md-icon>
										</md-button>
									</div>
								</div>
								<div ng-else>
									<md-button class="md-icon-button my-md-icon-button md-raised md-default" aria-label="Pending Button{{$index}}" ng-disabled="true">
										<ng-md-icon icon="sms_failed" style="fill:#FFFFFF" size="24"></ng-md-icon>
									</md-button>
								</div>
							</div>
						</td>
						<!-- End Process Pending Status -->
						<td style="text-align:center;">
							<!--Complete - Status...-->
							<div>
								<div ng-if="ppc_device.ATTENDED_DATE!=null">
									<div ng-if="ppc_device.JOBCOMPLETED_DATE==null">
										<button class="btn btn-xs btn-default" ng-click="RespondToCall($event,ppc_device,complete_call)" aria-label="Completed Button{{$index}}">
											<md-tooltip md-direction="top">Complete Call</md-tooltip>
											<md-icon class="material-icons-new" style="color:green">done_all</md-icon>
										</button>
									</div>
									<div ng-else> {{ppc_device.jobcomplete_date}} / {{ppc_device.COMPLETED_BY}} </div>
								</div>
								<div ng-else>
									<button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
										<md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
									</button>
								</div>
							</div>
							<div ng-elif="ppc_device.ATTENDED_BY!=user_id">
								<div ng-if="ppc_device.ATTENDED_DATE!=null">
									<div ng-if="ppc_device.JOBCOMPLETED_DATE==null">
										<button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
											<md-icon class="material-icons-new" style="color:#614DA4" size="24">done_all</md-icon>
										</button>
									</div>
									<div ng-else>{{ppc_device.jobcomplete_date}} / {{ppc_device.COMPLETED_BY}}</div>
								</div>
								<div ng-else>
									<button class="btn btn-xs btn-default" aria-label="Completed Button{{$index}}" ng-disabled="true">
										<md-icon class="material-icons-new" style="color:#614DA4">done_all</md-icon>
									</button>
								</div>
							</div>
						</td>
						<!-- End Complete Status...-->
					</tr>
					<!--<tr ng-repeat="ppms_device in ppms_devices"><td>{{ppms_device.EID}}</td><td>{{ppms_device.eq_name}}</td><td>{{ppms_device.location}}</td><td>PMS Call</td><td></td><td></td><td></td><td>{{ppms_device.PMS_DUE_DATE}}</td><td>Pending</td><td>{{ppms_device.Assigned_by}}</td><td>{{ppms_device.Assigned_to}}</td><td></td><td><div ng-if="ppms_device.PMS_ASSIGNED_TO==user_id"><md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="PendingPmsDialog($event,ppms_device)" aria-label="PMS Button{{$index}}"><md-tooltip md-direction="top">Pending PMS</md-tooltip><ng-md-icon icon="sms_failed" style="fill:#ffa602" size="24"></ng-md-icon></md-button></div><div ng-elif="ppms_device.PMS_ASSIGNED_TO==null"><md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="PendingPmsDialog($event,ppms_device)" aria-label="PMS Button{{$index}}"><md-tooltip md-direction="top">Pending PMS</md-tooltip><ng-md-icon icon="sms_failed" style="fill:#ffa602" size="24"></ng-md-icon></md-button></div><div ng-else><md-button ng-disabled="true" class="md-icon-button my-md-icon-button md-raised md-default" aria-label="PMS Button{{$index}}"><ng-md-icon icon="sms_failed" style="fill:#CCC" size="24"></ng-md-icon></md-button></div></td></tr><tr ng-repeat="pqc_device in pqc_devices"><td>{{pqc_device.EID}}</td><td>{{pqc_device.eq_name}}</td><td>{{pqc_device.location}}</td><td>QC Call</td><td></td><td></td><td></td><td>{{pqc_device.QC_DUE}}</td><td>Pending</td><td>{{pqc_device.Assigned_by}}</td><td>{{pqc_device.Assigned_to}}</td><td></td><td><div ng-if="pqc_device.ASSIGNED_TO==user_id"><md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="PendingQcDialog($event,pqc_device)" aria-label="QC Button{{$index}}"><md-tooltip md-direction="top">Pending QC</md-tooltip><ng-md-icon icon="sms_failed" style="fill:#ffa602" size="24"></ng-md-icon></md-button></div><div ng-elif="pqc_device.ASSIGNED_TO==null"><md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="PendingQcDialog($event,pqc_device)" aria-label="QC Button{{$index}}"><md-tooltip md-direction="top">Pending QC</md-tooltip><ng-md-icon icon="sms_failed" style="fill:#ffa602" size="24"></ng-md-icon></md-button></div><div ng-else><md-button ng-disabled="true" class="md-icon-button my-md-icon-button md-raised md-default" aria-label="QC Button{{$index}}"><ng-md-icon icon="sms_failed" style="fill:#CCC" size="24"></ng-md-icon></md-button></div></td></tr>-->
				</tbody>
				<tbody ng-else>
					<tr>
						<td colspan="13" style="text-align:center">No Calls Found</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div flex layout="row" class="marginb-10" ng-if="ppc_devices!=null">
			<div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
				<md-button class="md-icon-button md-primary md-raised" aria-label="Total">
					<md-tooltip md-direction="top">Total Records</md-tooltip>                    {{no_of_recs}}                
				</md-button>
			</div>
			<div flex="20" hide-xs hide-sm>
				<!-- Space -->
			</div>
			<div flex-xs="100" flex="60" layout="column" layout-align="end end">
				<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="SearchProcessPendimgCalls(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
			</div>
		</div>
	</div>
</md-content>