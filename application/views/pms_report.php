<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
	<div layout="column">
		<h3 class="heading-stylerespond">PMS Reports</h3>
		<div layout="row">
			<!--<p>Bar Chart Monthly Performanc <span>Lable</span> :<span style="color:red;">DEPT IDS</span><span>No of Records</span> :<span style="color:red;">COUNT</span></p>-->
		</div>
		<div layout ="row">
			<div layout ="row" flex>
				<br>
					<canvas id="bar" class="chart chart-bar" height="50" chart-data="pmsgraphdata" chart-labels="pmsgraphlabels" chart-series="pmsgraphseries"></canvas>
				</div>
			</canvas>
		</div>
	</div>
	<div>
	<div layout="row" flex="50" hide-xs hide-sm>
	<md-button class="md-button md-raised md-accent"  ng-show="PMS_pdf_report='Generate PDF'" ng-click="getPMSReportPDF(pms_reports)" aria-label="submit">Export</md-button>
			</md-button>
			</div>
		<form name="Search" method="post">
			<div flex layout-gt-sm="row"  layout="row">
				<!--  <md-input-container class="md-block" flex-gt-sm flex="20"><label>Equipment ID</label><input type="search" ng-model="viabilty_report_search.eqpid" name="seqpid" aria-label="seqpid"/></md-input-container>-->
				<md-autocomplete class="md-block"  flex-gt-sm flex="25"                                     md-no-cache="false"                                     md-selected-item="searched.EID"                                     md-search-text="searchEid"                                     md-items="item in searchTextChange(searchEid)"                                     md-item-text="item.E_ID"                                     md-min-length="0"                                     md-floating-label="Search Eq. id?">
					<md-item-template>
						<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
					</md-item-template>
					<md-not-found>                            No Equipment Match Found                        </md-not-found>
				</md-autocomplete>
				<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	(OR)</div>
				<md-input-container class="md-block" flex-gt-sm flex="10">
					<label>Serial No</label>
					<input type="search" ng-model="pms_report_search.saccessoriesno" name="saccessoriesno" aria-label="saccessoriesno"/>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
				<md-input-container class="md-block"  flex-gt-sm flex="15">
					<label>Eq. Name</label>
					<input type="text" ng-model="pms_report_search.ename" name="ename" aria-label="ename"/>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
				<!---<md-input-container flex="20"><label>Select Department</label><md-select  ng-model="pms_report_search.dept_id" name="depts">
				<!--<md-option ng-value="all">All</md-option>-->
				<!--<md-option ng-repeat="dept in depts"  ng-value="dept.CODE">                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                            </md-option></md-select></md-input-container>--->
				<md-autocomplete flex="20" class="md-block" flex-gt-sm                             ng-value="pms_report_search.dept_id=searched.CODE"                             md-no-cache="false"                             md-selected-item="searched.CODE"                             md-search-text="searchDepartment"                             md-items="item in searchTextChange(searchDepartment,'Department')"                             md-item-text="item.USER_DEPT_NAME"                             md-min-length="0"                             md-floating-label="Department">
					<md-item-template>
						<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
					</md-item-template>
					<md-not-found>                    No Department Found                </md-not-found>
				</md-autocomplete>
				<span ng-value="pms_report_search.dept_id = searched.CODE.CODE"></span>
				<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
				<md-input-container ng-show="user_role_code==HMADMIN" flex="20">
					<label>Select Branch</label>
					<md-select ng-model="user_branch"  ng-change="branch_all_loading(user_branch)" aria-label="plbranch">
						<md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
					</md-select>
				</md-input-container>
				<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm></div>
				<mdp-date-picker mdp-placeholder="Due Date" class="md-block" flex-gt-sm flex="15" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="pms_report_search.fromdate"></mdp-date-picker>
				<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)
					<!-- Space -->
				</div>
				<md-input-container flex="15">
					<label>Pms Type</label>
					<md-select required ng-model="pms_report_search.pms_type" name="pms_type">
						<md-option ng-repeat="pms_type in pms_types" ng-value="pms_type">                                {{pms_type}}                            </md-option>
					</md-select>
				</md-input-container>
				<div flex="0" ng-show="user_role_code==HMADMIN" hide-xs hide-sm></div>
				<md-button type="submit" value="Submit" class="md-icon-button md-raised md-primary" ng-click="getPMSReport()" aria-label="submit">
					<ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
				</md-button>
				
				
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
				<th style="width:8%">Contract Type</th>
				<th style="width:8%">Action</th>
			</tr>
		</thead>
		<tbody ng-if="!isEmpty(pms_reports)">
			<tr ng-repeat="pms_report in pms_reports">
				<td>{{pms_report.EID}}</td>
				<td>{{pms_report.dept_id}}</td>
				<td>{{pms_report.equp_name}}</td>
				<td>{{pms_report.model}}</td>
				<td>{{pms_report.es_number}}</td>
				<td>{{qc_report.contract_type}}</td>
				<td>
					<button ng-if="user_role_code!=HMADMIN" ng-show="PMS_pdf_report==Generate PDF" ng-click="pdfPMSReportTCPDF($event,pms_report)" class="btn btn-xs btn-default" aria-label="Edit">
						<md-tooltip md-direction="top">Pdf</md-tooltip>
						<md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
					</button>
				</td>
			</tr>
		</tbody>
		<tbody ng-if="pms_reports==null">
			<tr>
				<td colspan="10" class="text-center">No Devices Found...</td>
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
		<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getPMSReport(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
	</div>
</div></div></md-content>