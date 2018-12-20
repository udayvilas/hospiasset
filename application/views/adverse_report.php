<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
	<div layout="column">
		<h3 class="heading-stylerespond">Adverse Report</h3>
		<div layout ="row">
			<div flex="100">
				<canvas id="bar" class="chart chart-bar" height="50"    chart-data="adversegraphdata" chart-labels="adversegraphlabels" chart-colors="adversegraphcolors" chart-series="adversegraphseries"></canvas>
			</div>
		</div>
		<form name="Search" method="post">
			<div flex layout-gt-sm="row"  layout="row">
				<!--  <md-input-container class="md-block" flex-gt-sm flex="20"><label>Equipment ID</label><input type="search" ng-model="adverse_report_search.eqpid" name="seqpid" aria-label="seqpid"/></md-input-container>-->
				<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
				<md-autocomplete class="md-block"  flex-gt-sm flex="30"                                     md-no-cache="false"                                     md-selected-item="searched.EID"                                     md-search-text="searchEid"                                     md-items="item in searchTextChange(searchEid)"                                     md-item-text="item.E_ID"                                     md-min-length="0"                                     md-floating-label="Search Eq. id?">
					<md-item-template>
						<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
					</md-item-template>
					<md-not-found>                            No Equipment Match Found                        </md-not-found>
				</md-autocomplete>
				<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	(OR)</div>
				<!--<md-input-container class="md-block" flex-gt-sm flex="10">
					<label>Serial No</label>
					<input type="search" ng-model="adverse_report_search.saccessoriesno" name="saccessoriesno" aria-label="saccessoriesno"/>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
				<md-input-container class="md-block"  flex-gt-sm flex="15">
					<label>Eq. Name</label>
					<input type="text" ng-model="adverse_report_search.spono" name="spono" aria-label="spono"/>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>-->
				<!--<md-input-container flex="20"><label>Select Department</label><md-select  ng-model="adverse_report_search.dept_id" name="depts"><md-option ng-value="all">All</md-option><md-option ng-repeat="dept in depts"  ng-value="dept.CODE">                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                            </md-option></md-select></md-input-container>--->
				<md-autocomplete flex="20" class="md-block" flex-gt-sm                             ng-value="adverse_report_search.dept_id=searched.CODE"                             md-no-cache="false"                             md-selected-item="searched.CODE"                             md-search-text="searchDepartment"                             md-items="item in searchTextChange(searchDepartment,'Department')"                             md-item-text="item.USER_DEPT_NAME"                             md-min-length="0"                             md-floating-label="Department">
					<md-item-template>
						<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
					</md-item-template>
					<md-not-found>                    No Department Found                </md-not-found>
				</md-autocomplete>
				<span ng-value="adverse_report_search.dept_id = searched.CODE.CODE"></span>
				<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
				<md-input-container ng-show="user_role_code==HMADMIN" flex="20">
					<label>Select Branch</label>
					<md-select ng-model="user_branch" ng-change="branch_all_loading(user_branch)" aria-label="plbranch">
						<md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
					</md-select>
				</md-input-container>
				<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm></div>
				<md-button type="submit" value="Submit" class="md-icon-button md-raised md-primary" ng-click="getAdverseReport()" aria-label="submit">
					<ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
				</md-button>
				<md-button ng-show="adverse_reports!=null && Adverse_pdf_report==Generate PDF" class="md-button md-raised md-primary" ng-click="getAdverseReportTCPDF(adverse_reports)" aria-label="submit">                        Export                    </md-button>
			</div>
		</form>
	</div>
	<div layout-gt-sm="row" layout="row" >
		<table class="md-api-table table table-bordered" style="width:100%;">
			<thead>
				<tr>
					<th style="width:15%">Eq. ID</th>
					<th style="width:15%">Eq. Name</th>
					<th style="width:8%">DEPT ID</th>
					<th style="width:8%">Location</th>
					<th style="width:4%">Type</th>
					<th style="width:8%">Model</th>
					<th style="width:8%">Serial No.</th>
					<th style="width:10%">Date & Time</th>
					<th style="width:10%">Incident Type</th>
					<th style="width:8%">Action</th>
				</tr>
			</thead>
			<tbody ng-if="!isEmpty(adverse_reports)">
				<tr ng-repeat="adverse_report in adverse_reports">
					<td>{{adverse_report.EQUP_ID}}</td>
					<td>{{adverse_report.eq_name}}</td>
					<td>{{adverse_report.DEPT_ID}}</td>
					<td>{{adverse_report.location}}</td>
					<td>{{adverse_report.type}}</td>
					<td>{{adverse_report.model}}</td>
					<td>{{adverse_report.serial_no}}</td>
					<td>{{adverse_report.ADDED_ON}}</td>
					<td>{{adverse_report.incidents_type}}</td>
					<td>
						<button ng-show="Adverse_pdf_report==Generate PDF" ng-if="user_role_code!=HMADMIN" ng-click="pdfAdverseReport($event,adverse_report)" class="btn btn-xs btn-default" aria-label="Edit">
							<md-tooltip md-direction="top">Pdf</md-tooltip>
							<md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
						</button>
						<button ng-click="viewAdverrseReportDetails($event,adverse_report)"  class="btn btn-xs btn-default" aria-label="Edit">
							<md-tooltip md-direction="top">View</md-tooltip>
							<md-icon class="material-icons-new" style="color: rgb(68,138,255);">launch</md-icon>
						</button>
					</td>
				</tr>
			</tbody>
			<tbody ng-if="adverse_reports==null">
				<tr>
					<td colspan="10" class="text-center">No Devices Found...</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!--   <div flex layout="row" class="marginb-10" ng-if="no_of_recs!=0"><div flex-xs="100" flex="20" layout-align="start start" flex layout="column"><md-button class="md-icon-button md-primary md-raised" aria-label="Total"><md-tooltip md-direction="top">Total Records</md-tooltip>                    {{no_of_recs}}                </md-button></div><div flex="20" hide-xs hide-sm>
	<!-- Space --/></div><div flex-xs="100" flex="60" layout="column" layout-align="end end"><cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getAdverseReport(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging></div></div>-->
</div></md-content>