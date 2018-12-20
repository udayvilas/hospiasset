<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
	<div layout="column">
		<h3 class="heading-stylerespond">Equipments</h3>
		<div>
			<form name="Search" method="post">
				<div flex layout-gt-sm="row"  layout="row">
					<!--<md-input-container class="md-block" flex-gt-sm flex="20"><label>Equipment ID</label><input type="search" ng-model="dept_device_search.eqpid" name="seqpid" aria-label="seqpid"/></md-input-container><div flex="5" hide-xs hide-sm> (OR) </div><md-input-container class="md-block" flex-gt-sm flex="15"><label>Serial No</label><input type="search" ng-model="dept_device_search.saccessoriesno" name="saccessoriesno" aria-label="saccessoriesno"/></md-input-container><div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div><md-input-container class="md-block"  flex-gt-sm flex="15">			`			<label>Eq. Name</label><input type="text" ng-model="dept_device_search.spono" name="spono" aria-label="spono"/></md-input-container><div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div><md-input-container class="md-block" flex-gt-sm flex="15"><label>Select Department</label><md-select  ng-model="dept_device_search.dept_id" name="depts"><md-option ng-value="all">All</md-option><md-option ng-repeat="dept in depts"  ng-value="dept.CODE">								{{dept.USER_DEPT_NAME}} ({{dept.CODE}})							</md-option></md-select></md-input-container>--->
					<md-input-container class="md-block" flex-gt-sm flex="20">
						<label>Equipment ID</label>
						<input type="search" ng-model="dept_device_search.eqpid" name="seqpid" aria-label="seqpid"/>
					</md-input-container>
					<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
					<md-input-container class="md-block" flex-gt-sm flex="15">
						<label>Serial No</label>
						<input type="search" ng-model="dept_device_search.saccessoriesno" name="saccessoriesno" aria-label="saccessoriesno"/>
					</md-input-container>
					<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
					<md-input-container class="md-block"  flex-gt-sm flex="15">
						<label>Eq. Name</label>
						<input type="text" ng-model="dept_device_search.spono" name="spono" aria-label="spono"/>
					</md-input-container>
					<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
					<md-input-container class="md-block"  flex-gt-sm flex="15">
						<label>Select Department</label>
						<md-select  ng-model="dept_device_search.dept_id" name="depts">
							<md-option ng-value="all">All</md-option>
							<md-option ng-repeat="dept in depts"  ng-value="dept.CODE">                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                            </md-option>
						</md-select>
					</md-input-container>
					<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
					<md-input-container ng-show="user_role_code==HMADMIN" flex="20">
						<label>Select Branch</label>
						<md-select ng-model="user_branch" aria-label="user_branch" ng-change="branch_all_loading(user_branch)">
							<md-option ng-value="branch.BRANCH_ID" ng-selected="branch.BRANCH_ID == user_branch" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
						</md-select>
					</md-input-container>
					<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm></div>
					<md-button type="submit" value="Submit" class="md-icon-button md-raised md-primary" ng-click="getDepartDevices()" aria-label="submit">
						<ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
					</md-button>
					<div flex="10" hide-xs hide-sm></div>
					<md-button class="md-button md-raised md-accent" aria-label="download" ng-click="excelReport(depart_devices)"  >						Excel Export					</md-button>
					<div flex="10" ng-show="user_role_code!=HMADMIN" hide-xs hide-sm></div>
					<!--<md-button ng-show="user_role_code!=HMADMIN" class="md-button md-raised md-accent" aria-label="download" href="
						<?php echo base_url('reports/download_devices'); ?>" target="_blank">						Download Eq's Pdf					
					</md-button>-->
				</div>
			</form>
		</div>
		<div layout-gt-sm="row" layout="row">
			<table class="md-api-table table table-bordered" style="width:100%;">
				<thead>
					<tr>
						<th style="width:16%">ID</th>
						<th style="width:17%">Name</th>
						<th style="width:15%">Location</th>
						<th style="width:4%">TYPE</th>
						<th style="width:10%">MODEL</th>
						<th style="width:10%">Serial No.</th>
						<th style="width:8%">End of Life</th>
						<th style="width:8%">End of Support</th>
						<th style="width:10%">Action</th>
					</tr>
				</thead>
				<tbody ng-if="!isEmpty(depart_devices)">
					<tr ng-repeat="depart_device in depart_devices">
						<td style="width:16%">{{depart_device.E_ID}}</td>
						<td style="width:17%">{{depart_device.E_NAME}}</td>
						<td style="width:15%">{{depart_device.PHY_LOCATION}}</td>
						<td style="width:4%">{{depart_device.E_TYPE}}</td>
						<td style="width:10%">{{depart_device.E_MODEL}}</td>
						<td style="width:10%">{{depart_device.ES_NUMBER}}</td>
						<td style="width:8%">{{depart_device.END_OF_LIFE}}</td>
						<td style="width:8%">{{depart_device.END_OF_SUPPORT}}</td>
						<td style="width:10%;text-align: center;">
							<!-- ng-if="can_update_equp==yesstate" -->
							<button   ng-click="editEquipment($event,depart_device)" ng-disabled="Edit_Equipment!='Edit' || depart_device.VENDOR==user_org" class="btn btn-xs btn-default" aria-label="Edit">
								<md-tooltip md-direction="top">Edit</md-tooltip>
								<md-icon class="material-icons-new" style="color: #614da4;">mode_edit</md-icon>
							</button>
							<button   ng-click="editEquipment1(depart_device)" ng-disabled="Edit_Equipment!='Edit' || depart_device.VENDOR==user_org" class="btn btn-xs btn-default" aria-label="Edit">
								<md-tooltip md-direction="top">Edit</md-tooltip>
								<md-icon class="material-icons-new" style="color: #614da4;">mode_edit</md-icon>
							</button>
							<button ng-click="viewEquipmentDetails($event,depart_device)" class="btn btn-xs btn-default" ng-disabled="View_Equipment!=View" aria-label="View">
								<md-tooltip md-direction="top">View</md-tooltip>
								<md-icon class="material-icons-new" style="color: rgb(68,138,255);">launch</md-icon>
							</button>
							<button ng-click="EquipmentReplacement($event,depart_device)" class="btn btn-xs btn-default" ng-disabled="Replace_Equipment!=Replace || depart_device.VENDOR==user_org" aria-label="Replace">
								<md-tooltip md-direction="top">Replace</md-tooltip>
								<md-icon class="material-icons-new" style="color: rgb(25, 71, 131);">swap_horiz</md-icon>
							</button>
							<button ng-show="user_org_type==Vendor" ng-disabled="depart_device.ASSIGN_ID!=NULL || depart_device.VENDOR==user_org" class="btn btn-xs btn-default" ng-click="editvequipment($event,depart_device)" aria-label="Replace">
								<md-tooltip md-direction="top">Assign</md-tooltip>
								<md-icon class="material-icons-new" style="color: rgb(68,138,255);">call_received</md-icon>
							</button>
						</td>
					</tr>
				</tbody>
				<tbody ng-if="depart_devices==null">
					<tr>
						<td colspan="9" class="text-center" ng-show="user_branch != 'All'">No Devices Found...</td>
						<td colspan="9" class="text-center" ng-show="user_branch == 'All'">Select Any Branch..!!</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div flex layout="row" class="marginb-10">
			<div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
				<md-button class="md-icon-button md-primary md-raised" aria-label="Total">
					<md-tooltip md-direction="top">Total Records</md-tooltip>					{{no_of_recs}}				
				</md-button>
			</div>
			<div flex="20" hide-xs hide-sm>
				<!-- Space -->
			</div>
			<div flex-xs="100" flex="60" layout="column" layout-align="end end">
				<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getDepartDevices(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
			</div>
		</div>
	</div>
</md-content>