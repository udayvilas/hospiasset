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
						<th>Assign To</th>
						<th>Attend By</th>
						<th>On Hold By</th>
						<th>Completed By</th>
					</tr>
				</thead>
				<tbody ng-if="condeminations!=null">
					<tr ng-repeat="condemination in condeminations">
						<td style="width:2%;background-color: #ff1979"></td>
						<td style="width: 16%;">{{(user_org == condemination.ORG_ID) ?  condemination.EQUP_ID : condemination.ASSIGN_ID}}</td>
						<td style="width: 8%;">{{condemination.equp_name}}</td>
						<td style="width: 8%;">{{condemination.branch_name}}</td>
						<td style="width: 8%;">{{condemination.added_by}}</td>
						<td style="width: 8%;">{{condemination.reasons | objtostring}}</td>
						<td style="width: 3%;">{{condemination.DEPT_ID}}</td>
						<td style="width: 4%;">Codem</td>
						<td style="width: 9%;">{{condemination.added_on+'000' | date : "dd-MM-yy hh:mm a"}}</td>
						<td style="width: 4%;">Open</td>
						<td style="width: 8%;">
							<div style="text-align:center;" ng-if="condemination.CONDEMNATION_STATUS==null">
								<button ng-disabled="user_role_code!=HMADMIN" class="btn btn-xs btn-default" ng-click="EditAdminCondemination($event,condemination)" aria-label="Conduct Button{{$index}}">
									<md-tooltip md-direction="top">Admin Approve</md-tooltip>
									<md-icon class="material-icons-new" style="color:deepskyblue">                                    call_received</md-icon>
								</button>
							</div>
							<div ng-else>                            {{condemination.ADMIN_FEEDBACK}}                        </div>
						</td>
						<td style="width: 8%;">-</td>
						<td style="width: 8%;">-</td>
						<td style="width: 6%;">
							<div style="text-align: center">
								<button ng-if="condemination.CONDEMNATION_STATUS=='Approved'" ng-disabled="condemination.RESOLD_VALUE!=null" class="btn btn-xs btn-default" ng-click="EditApprovedCondemnation($event,condemination)" aria-label="Conduct Button{{$index}}">
									<md-tooltip md-direction="top">Approved</md-tooltip>
									<md-icon class="material-icons-new" style="color:deepskyblue">                                    done_all</md-icon>
								</button>
							</div>
						</td>
					</tr>
				</tbody>
				<tbody ng-else>
					<tr>
						<td colspan="14" style="text-align:center;width:100%;">No Calls Found...!</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div flex layout="row" class="marginb-10" ng-if="condeminations!=null">
			<div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
				<md-button class="md-icon-button md-primary md-raised" aria-label="Total">
					<md-tooltip md-direction="top">Total Records</md-tooltip>                    {{no_of_recs}}                
				</md-button>
			</div>
			<div flex="20" hide-xs hide-sm>
				<!-- Space -->
			</div>
			<div flex-xs="100" flex="60" layout="column" layout-align="end end">
				<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadCondemenationRequest(paging.current,undefined,admin_branch)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
			</div>
		</div>
	</div>
</md-content>