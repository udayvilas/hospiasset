<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr">
	<h3 class="heading-stylerespond">Categories</h3>
	<div layout="row" ng-if="user_role_code==HMADMIN || user_role_code==HBHOD || user_role_code==HBBME" ng-show="user_role_code==HMADMIN || user_role_code==HBHOD || user_role_code==HBBME" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
		<div flex="33" flex-sm="50" flex-md="50">
		    <div ng-if="Add_Category==Add">
			<md-button  ui-sref="home.hbbme_add_equipment_name" class="md-raised md-primary">Add  New</md-button>
		   </div>
		</div>
	</div>
	<div layout="column" flex>
		<table class="md-api-table table table-bordered">
			<thead>
				<tr>
					<th>{{dtypes_label.NAME}}</th>
					<th>{{dtypes_label.CODE}}</th>
					<th>{{dtypes_label.priority}}</th>
					<th>{{dtypes_label.STATUS}}</th>
					<th>{{dtypes_label.ACTION}}</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-if="equp_names!=null && equp_names!='undefined'" ng-repeat="equp_name in equp_names">
					<td>{{equp_name.NAME}}</td>
					<td>{{equp_name.CODE}}</td>
					<td>{{equp_name.priority}}</td>
					<td>{{equp_name.STATUS=='A' ? 'Active':'Inactive'}}</td>
					<td style="text-align: center;">
						<button ng-disabled="Edit_Category!=Edit" ng-click="editEquipmentName($event,equp_name)" class="btn btn-xs btn-default" aria-label="Edit">
							<md-tooltip md-direction="top">Edit</md-tooltip>
							<md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
						</button>
					</td>
				</tr>
				<tr ng-if=equp_names==null || equp_names=='undefined'>
					<td colspan="3" class="text-center">No Equipment Names Found</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div flex layout="row" class="marginb-10">
		<div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
			<md-button class="md-icon-button md-primary md-raised" aria-label="Total">
				<md-tooltip md-direction="top">Total Records</md-tooltip>                {{no_of_recs}}            
			</md-button>
		</div>
		<div flex="20" hide-xs hide-sm>
			<!-- Space -->
		</div>
		<div flex-xs="100" flex="60" layout="column" layout-align="end end">
			<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadEquipmentNames(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
		</div>
	</div>
</md-content>