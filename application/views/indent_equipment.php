<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
	<div layout="column">
		<h3 class="heading-stylerespond">Indents</h3>
		<div layout-gt-sm="row" layout-xs="column" ng-show="Add_Indent==Add" layout-gt-xs="column" layout="row" layout-align="start center">
			<md-button ui-sref="home.indent_equipment_request" class="md-raised md-primary">Request</md-button>
		</div>
		<div ng-if="user_role_code==PURCHASE || user_role_code==HMADMIN" layout="row" flex layout-padding>
			<div ui-sref="" flex="5" flex-xs="100" flex-gt-sm="66" layout-xs="row"  class="widget margin-4"  style="background-color:#00b9ee;" layout="column">
				<div flex class="card-margin-4" layout="row" >
					<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">assignment_late</md-icon>
					<div flex="10" style="color:#fff;" layout-align="end">{{stock_indent_counts.pending_indent_cnt}}</div>
				</div>
				<div flex layout="row" layout-align="center center">
					<span style="color:#FFF;">Pending Indents</span>
				</div>
			</div>
			<div ui-sref="" flex="5" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#353bf0;" layout="column">
				<div flex class="card-margin-4" layout="row" layout-align="center center">
					<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">done_all</md-icon>
					<div style="color:#fff;" layout-align="end">{{stock_indent_counts.sanctioned_indent_cnt}}</div>
				</div>
				<div flex layout="row" layout-align="center center">
					<span  style="color:#FFF;">Sanctioned Indent</span>
				</div>
			</div>
			<div ui-sref="" flex="5" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#5dd27c;" layout="column">
				<div flex class="card-margin-4" layout="row">
					<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">                        call_received   </md-icon>
					<div style="color:#fff;" layout-align="end">{{stock_indent_counts.in_stock_cnt}}</div>
				</div>
				<div flex layout="row" layout-align="center center">
					<span style="color:#FFF;">In Stock</span>
				</div>
			</div>
			<div ui-sref="" flex="5" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#f58f20;" layout="column">
				<div flex class="card-margin-4" layout="row">
					<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">call_made </md-icon>
					<div style="color:#fff;" layout-align="end">{{stock_indent_counts.out_stock_cnt}}</div>
				</div>
				<div flex layout="row" layout-align="center center">
					<span style="color:#FFF;">Out Stock</span>
				</div>
			</div>
			<div flex="40"> &nbsp;&nbsp;&nbsp;</div>
		</div>
		<div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
			<table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
				<thead>
					<tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Dept Id</th>
                    <th ng-hide="user_role_code==HBBME || user_role_code==HBHOD">Branch</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Transferred To Branch</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
				</thead>
				<tbody ng-if="indent_equps!=null">
					<tr ng-repeat="indent_equp in indent_equps">
						<td>{{indent_equp.INDENT_ID}}</td>
						<td>{{indent_equp.INDENT_TYPE}}</td>
						<td>{{indent_equp.DEPT}}</td>
						<td ng-hide="user_role_code==HBBME || user_role_code==HBHOD">{{indent_equp.branch_name}}</td>
						<td>{{indent_equp.EQ_NAME}}</td>
						<td>{{indent_equp.QTY}}</td>
						<td>{{indent_equp.trans_branch_name}}</td>
						<td></td>
						<td style="text-align: center;">
							<button ng-click="editIndentEqupment($event,indent_equp)" ng-show="indent_equp.INDENT_STATUS!==indent_statuss[0]" 
							ng-disabled="Edit_Indent!=Edit" class="btn btn-xs btn-default" aria-label="Edit" ng-if="user_role_code!=PURCHASE" >
								<md-tooltip md-direction="top">Edit</md-tooltip>
								<md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
							</button>
							<button ng-show="org_type!=Vendor &&  indent_equp.no_of_res!=indent_equp.QTY && indent_equp.SANCTION_STATUS==indent_sactioned_statuss[0] && Stock_Indent==Stock" ng-click="addtoStock(indent_equp)" class="btn btn-xs btn-default" aria-label="Edit">
								<md-tooltip md-direction="top">Add Stock</md-tooltip>
								<md-icon class="material-icons-new" style="color:#614DA4">send</md-icon>
							</button>
							<button ng-if="org_type!=Vendor && indent_equp.INDENT_TYPE==indent_requests[0] && indent_equp.CEAR_RAISED!=yesstate" ng-show="Rise_Cear==Rise CEAR" ng-click="addIndendtCearRequest($event,indent_equp)" class="btn btn-xs btn-default" aria-label="Edit">
								<md-tooltip md-direction="top">Rise CEAR</md-tooltip>
								<md-icon class="material-icons-new" style="color:#614DA4">add_circle</md-icon>
							</button>
							<!--<button ng-hide="org_type==Vendor" ng-if="can_approve_indent==yesstate && indent_equp.SANCTION_STATUS!=indent_sactioned_statuss[0] && isUserNotApproved(indent_equp.APPROVED_BY)" class="btn btn-xs btn-default" ng-click="adminApprovedStatus($event,indent_equp)" aria-label="Conduct Button{{$index}}"><md-tooltip md-direction="top">Approve</md-tooltip><md-icon class="material-icons-new" style="color:deepskyblue">done_all</md-icon></button>-->
							<button ng-if="org_type!=Vendor && indent_equp.SANCTION_STATUS!=indent_sactioned_statuss[0] && fromJsonLength(indent_equp.APPROVED_BY)==indent_approvals_count" ng-show="Sanction_Indent==Sanction" class="btn btn-xs btn-default" ng-click="adminSactionedStatus($event,indent_equp)" aria-label="Conduct Button{{$index}}">
								<md-tooltip md-direction="top">Sanction</md-tooltip>
								<md-icon class="material-icons-new" style="color:#4FB626">offline_pin</md-icon>
							</button>
							<button ng-if="org_type!=Vendor && user_role_code==PURCHASE && indent_equp.SANCTION_STATUS==indent_sactioned_statuss[0]" class="btn btn-xs btn-default" ng-disabled="true" ng-click="adminSactionedStatus($event,indent_equp)" aria-label="Conduct Button{{$index}}">
								<md-tooltip md-direction="top">Sanctioned</md-tooltip>
								<md-icon class="material-icons-new" style="color:#4FB626">offline_pin</md-icon>
							</button>
							<!--Vendor Changes-->
							<button ng-show="org_type==Vendor || user_role_code==HMADMIN && Approve_Indent==Approve"   class="btn btn-xs btn-default" ng-click="adminApprovedStatus($event,indent_equp)" aria-label="Conduct Button{{$index}}">
								<md-tooltip md-direction="top">Approve</md-tooltip>
								<md-icon class="material-icons-new" style="color:deepskyblue">done_all</md-icon>
							</button>
							<button ng-show="org_type==Vendor && user_role_code==HBHOD && indent_equp.INDENT_STATUS == 'Approved' && indent_equp.GATEPASS_ID == 0" ng-click="EquipmentTransfer($event,indent_equp)" class="btn btn-xs btn-default" aria-label="Replace">
								<md-tooltip md-direction="top">Transfer</md-tooltip>
								<md-icon class="material-icons-new" style="color: rgb(25, 71, 131);">swap_horiz</md-icon>
							</button>
							<button ng-show="org_type==Vendor && user_role_code!=HMADMIN && indent_equp.GATEPASS_ID != '0'" ng-click="indent_gatepass(indent_equp.GATEPASS_ID)" class="btn btn-xs btn-default" aria-label="Edit">
								<md-tooltip md-direction="top">Pdf</md-tooltip>
								<md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
							</button>
							<!--Vendor Changes-->
						</td>
					</tr>
				</tbody>
				<tbody ng-else>
					<tr>
						<td colspan="12" style="text-align:center"> No Indent Requests Found</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		
        <div flex layout="row" class="marginb-10">


            <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">


                <md-button class="md-icon-button md-primary md-raised" aria-label="Total">


                    <md-tooltip md-direction="top">Total Records</md-tooltip>


                    {{no_of_recs}}


                </md-button>


            </div>


            <div flex="20" hide-xs hide-sm><!-- Space --></div>


            <div flex-xs="100" flex="60" layout="column" layout-align="end end">


                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadIncidentsElements(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>


            </div>


        </div>


	</md-content>