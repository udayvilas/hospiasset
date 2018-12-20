<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
	<div layout="column">
		<h3 class="heading-stylerespond">Service Report</h3>
		<div>
			<div layout ="row">
				<h3 style="float:left" flex="75">Bar Chart</h3>
			</div>
			<div layout ="row">
				<div layout ="row" flex="100">
					<br>
						<canvas id="bar" class="chart chart-bar" height="50"                            chart-data="servicegraphdata" chart-labels="servicegraphlabels" chart-series="servicegraphseries"></canvas>
					</div>
					<!--<div layout ="row" flex="25"><canvas id="pie" class="chart chart-pie" height="80" width="200"                            chart-data="servicegraphdata" chart-labels="servicegraphlabels" chart-options="options"></canvas></div>-->
				</div>
				<form name="Search" method="post">
					<div flex layout-gt-sm="row"  layout="row">
						<!--  <md-input-container class="md-block" flex-gt-sm flex="20"><label>Equipment ID</label><input type="search" ng-model="deployement_report_search.eqpid" name="seqpid" aria-label="seqpid"/></md-input-container>-->
						<md-autocomplete class="md-block"  flex-gt-sm flex="20"                                     md-no-cache="false"                                     md-selected-item="searched.EID"                                     md-search-text="searchEid"                                     md-items="item in searchTextChange(searchEid)"                                     md-item-text="item.E_ID"                                     md-min-length="0"                                     md-floating-label="Search Eq. id?">
							<md-item-template>
								<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
							</md-item-template>
							<md-not-found>No Equipment Match Found</md-not-found>
						</md-autocomplete>
						<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	(OR)</div>
						<md-input-container class="md-block" flex-gt-sm flex="10">
							<label>Serial No</label>
							<input type="search" ng-model="deployement_report_search.saccessoriesno" name="saccessoriesno" aria-label="saccessoriesno"/>
						</md-input-container>
						<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
						<md-input-container class="md-block"  flex-gt-sm flex="15">
							<label>Eq. Name</label>
							<input type="text" ng-model="deployement_report_search.ename" name="ename" aria-label="ename"/>
						</md-input-container>
						<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
						<!---<md-input-container flex="20"><label>Select Department</label><md-select  ng-model="deployement_report_search.dept_id" name="depts"><md-option ng-value="all">All</md-option><md-option ng-repeat="dept in depts"  ng-value="dept.CODE">                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                            </md-option></md-select></md-input-container>--->
						<md-autocomplete flex="20" class="md-block" flex-gt-sm                             ng-value="deployement_report_search.dept_id=searched.CODE"                             md-no-cache="false"                             md-selected-item="searched.CODE"                             md-search-text="searchDepartment"                             md-items="item in searchTextChange(searchDepartment,'Department')"                             md-item-text="item.USER_DEPT_NAME"                             md-min-length="0"                             md-floating-label="Department">
							<md-item-template>
								<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
							</md-item-template>
							<md-not-found>                    No Department Found                </md-not-found>
						</md-autocomplete>
						<span ng-value="deployement_report_search.dept_id = searched.CODE.CODE"></span>
						<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
						<md-input-container ng-show="user_role_code==HMADMIN" flex="20">
							<label>Select Branch</label>
							<md-select ng-model="user_branch" aria-label="plbranch" ng-change="branch_all_loading(user_branch)">
								<md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
							</md-select>
						</md-input-container>
						<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm></div>
						<md-button type="submit" value="Submit" class="md-icon-button md-raised md-primary" ng-click="getDeployementReport()" aria-label="submit">
							<ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
						</md-button>
						<div flex="5" ng-show="user_role_code==HMADMIN && Service_pdf_report='Generate PDF'" hide-xs hide-sm></div>
						<md-button class="md-button md-raised md-accent" ng-click="RegetServiceReportPDF(deployemnt_reports)" aria-label="submit">Export</md-button>
					</div>
				</form>
			</div>
			<div layout-gt-sm="row" layout="row" >
				<table class="md-api-table table table-bordered" style="width:100%;">
					<thead>
						<tr>
							<th style="width:15%">Equp ID</th>
							<th style="width:15%">DEPT ID</th>
							<th style="width:8%">Equp Name</th>
							<th style="width:8%">MODEL</th>
							<th style="width:8%">Serial No.</th>
							<th style="width:8%">Contract type</th>
							<th style="width:8%">Action</th>
						</tr>
					</thead>
					<tbody ng-if="!isEmpty(deployemnt_reports)">
						<tr ng-repeat="deployemnt_report in deployemnt_reports">
							<td>{{deployemnt_report.E_ID}}</td>
							<td>{{deployemnt_report.DEPT_ID}}</td>
							<td>{{deployemnt_report.E_NAME}}</td>
							<td>{{deployemnt_report.E_MODEL}}</td>
							<td>{{deployemnt_report.ES_NUMBER}}</td>
							<td>{{deployemnt_report.contrat_type}}</td>
							<td>
								<button ng-if="user_role_code!=HMADMIN" ng-show="Service_pdf_report='Generate PDF'" ng-click="pdfServicesReportTCPDF($event,deployemnt_report)" class="btn btn-xs btn-default" aria-label="Edit">
									<md-tooltip md-direction="top">Pdf</md-tooltip>
									<md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
								</button>
							</td>
						</tr>
					</tbody>
					<tbody ng-if="deployemnt_reports==null">
						<tr>
							<td colspan="6" class="text-center">No Devices Found...</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div flex layout="row" class="marginb-10" ng-if="no_of_recs!=0">
				<div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
					<md-button class="md-icon-button md-primary md-raised" aria-label="Total">
						<md-tooltip md-direction="top">Total Records</md-tooltip>                       {{no_of_recs}}                   
					</md-button>
				</div>
				<div flex="20" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<div flex-xs="100" flex="60" layout="column" layout-align="end end">
					<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getDeployementReport(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
				</div>
			</div>
		</div>
	</md-content>