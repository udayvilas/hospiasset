<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content  class="mylayout-padding"  md-theme="hospiclr" ng-cloak>
	<div layout="column">
		<h3 class="heading-stylerespond">Transfers</h3>
		<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="left">
			<!--<md-button ui-sref="home.transfer_within_unit" class="md-raised md-primary">Transfer</md-button><div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
			<mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="transfer_search.fromdate" mdp-max-date="maxDate" ></mdp-date-picker>
			<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
			<mdp-date-picker mdp-placeholder=" To Date" class="md-block" flex-gt-sm flex="40" mdp-min-date="transfer_search.fromdate" mdp-max-date="maxDate" mdp-format="DD/MM/YYYY" ng-model="transfer_search.todate" ></mdp-date-picker>
			<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
			<md-input-container  class="md-block" flex-gt-sm flex="20">
				<label>Transfers Status</label>
				<md-select ng-model="transfer_search.status" name="transfer">
					<md-option ng-repeat="tstatus in transfers_status"  ng-value="tstatus">                        {{tstatus}}                    </md-option>
				</md-select>
			</md-input-container>
			<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
			<md-input-container  class="md-block" flex-gt-sm flex="20">
				<label>Transfers Type</label>
				<md-select ng-model="transfer_search.unit_type" name="transfer">
					<md-option ng-repeat="transfer in transfers"  ng-value="transfer">                        {{transfer}}                    </md-option>
				</md-select>
			</md-input-container>
			<md-button class="md-icon-button md-raised md-accent" ng-click="loadTransferUnits()"  md-theme="default" aria-label="submit">
				<ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
			</md-button>
		</div>
		<div layout="row">
			<table class="md-api-table table table-bordered">
				<thead>
					<tr>
						<th>Eq. Id</th>
						<th>Eq. Name</th>
						<th>Serial No</th>
						<th>Transfer Branch</th>
						<th>Physical Location</th>
						<th>Person Name</th>
						<th>Reason</th>
						<th>Dept</th>
						<th>Transfer Type</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody ng-if="trnsfers!=null">
					<tr ng-repeat="trnsfer in trnsfers">
						<td>{{trnsfer.EQUP_ID}}</td>
						<td>{{trnsfer.E_NAME}}</td>
						<td>{{trnsfer.serial_no}}</td>
						<td>{{trnsfer.tbranch_name}}</td>
						<td>{{trnsfer.PHYSICAL_LOCATION}}</td>
						<td>{{trnsfer.username}}</td>
						<td>{{trnsfer.REASON}}</td>
						<td>{{trnsfer.DEPT_ID}}</td>
						<td>
							<div ng-if="trnsfer.TRANSFER_TYPE==transfer_types[0]">{{transfer_types_view[0]}}</div>
							<div ng-else>{{transfer_types_view[1]}}</div>
						</td>
						<td>{{trnsfer.added_on+'000' | date : "dd-MM-yy hh:mm a"}}</td>
						<td>Open</td>
						<td style="text-align:center;">
							<div ng-if="user_branch==trnsfer.TRANSFER_BRANCH">
								<button ng-click="editTransfersRequest($event,trnsfer)" ng-disabled="Edit_Transfer!=Edit" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
									<md-tooltip md-direction="top">Edit</md-tooltip>
									<md-icon class="material-icons-new" style="color:deepskyblue;">mode_edit</md-icon>
								</button>
							</div>
							<div ng-if="user_branch==trnsfer.TRANSFER_BRANCH && trnsfer.DEPT_ID!=null && trnsfer.DEPLOYMENT_ID==null">
								<button ng-click="transferdeploy($event,trnsfer)" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
									<md-tooltip md-direction="top">Deploy</md-tooltip>
									<md-icon class="material-icons-new" style="color:green;">done_all</md-icon>
								</button>
							</div>
						</td>
					</tr>
				</tbody>
				<tbody ng-else>
					<tr>
						<td colspan="12" style="text-align:center">No Transfer Records Found </td>
					</tr
				</tbody>
			</table>
		</div>
		<div flex layout="row" class="marginb-10">
			<div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
				<md-button class="md-icon-button md-primary md-raised" aria-label="Total">
					<md-tooltip md-direction="top">Total Records</md-tooltip>                    {{no_of_recs}}                
				</md-button>
			</div>
			<div flex="20" hide-xs hide-sm>
				<!-- Space -->
			</div>
			<div flex-xs="100" flex="60" layout="column" layout-align="end end">
				<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadTransferUnits(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
			</div>
		</div>
	</div>
</md-content>