<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
	<div layout="column">
		<h3 class="heading-stylerespond">Gate Pass</h3>
		<div>
			<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="start start">
				<md-button ng-show="Add_Gatepass==Add" ui-sref="home.gate_pass_request" class="md-raised md-primary">Request</md-button>
				<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
				<!--<md-datepicker  ng-model="gatepass_search_new.fromdate" md-placeholder="From Date" md-max-date="maxDate"  flex-gt-sm></md-datepicker><div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div><md-datepicker  ng-model="gatepass_search_new.todate" md-placeholder="To Date" md-max-date="maxDate" flex-gt-sm></md-datepicker><div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div><md-input-container class="md-block" flex-gt-sm  flex="25"><label>Departments</label><md-select ng-model="gatepass_search_new.dept_id" name="reasons"><md-option ng-repeat="dept in depts "  ng-value="dept.CODE">                            {{dept.USER_DEPT_NAME}}({{dept.CODE}})                        </md-option></md-select></md-input-container><md-button class="md-icon-button md-raised md-accent" ng-click="loadTransferUnitsnew()"  md-theme="default" aria-label="submit"><ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon></md-button>-->
			</div>
		</div>
		<div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
			<table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
				<thead>
					<tr>
						<th>Eq.ID</th>
						<th>GatePass ID</th>
						<th>Department</th>
						<th>Branch</th>
						<th>Eq. Name</th>
						<th>Serial No</th>
						<!--<th>Contract Type</th>-->
						<th>Location</th>
						<th>Spares</th>
						<th>Accessories</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody ng-if="gate_pass_news!=null">
					<tr ng-repeat="gate_pass_new in gate_pass_news">
						<td>{{gate_pass_new.E_ID}}</td>
						<td>{{gate_pass_new.GP_ID}}</td>
						<td>{{gate_pass_new.department}}</td>
						<td>{{gate_pass_new.branch_name}}</td>
						<td>{{gate_pass_new.equp_name}}</td>
						<td>{{gate_pass_new.serial_no}}</td>
						<!--<td>{{gate_pass_new.contract_type}}</td>-->
						<td>{{gate_pass_new.LOCATION}}</td>
						<td>{{gate_pass_new.SPARES}}</td>
						<td>{{gate_pass_new.ACCESSORIES}}</td>
						<td style="text-align: center;">
							<button ng-if="can_update_gatepass==yesstate" ng-show="Edit_Gatepass==Edit" ng-click="editGatePass($event,gate_pass_new)"  class="btn btn-xs btn-default" aria-label="Edit">
								<md-tooltip md-direction="top">Edit</md-tooltip>
								<md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
							</button>
							<button ng-click="GatepasspdfNEW(gate_pass_new)"  class="btn btn-xs btn-default" aria-label="Edit">
								<md-tooltip md-direction="top">Pdf</md-tooltip>
								<md-icon class="material-icons-new" href="" style="color:#614DA4">picture_as_pdf</md-icon>
							</button>
						</td>
					</tr>
				</tbody>
				<tbody ng-else>
					<tr>
						<td colspan="10" style="text-align:center"> No Gate Pass Found</td>
					</tr>
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
				<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadGatepass(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
			</div>
		</div>
	</md-content>