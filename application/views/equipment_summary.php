<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
	<div layout="column">
		<h3 class="heading-stylerespond">Equipment Summary Report</h3>
		<div layout="row">
			<div flex="100">
				<p>Equipment Summary Graph</p>
				<canvas id="bar" class="chart chart-bar" height="40" chart-data="equipmentsumarydata" chart-labels="equipmentsumarylabels" chart-colors="equipmentsumarycolors" chart-series="equipmentsumaryseries"></canvas>
			</div>
		</div>
		<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="end" style="margin-top:10px;">
			<md-button ng-show="Report_Summary_Pdf='Generate PDF'" class="md-raised md-accent" ng-click="showEqupSummaryPdf()"  md-theme="default" aria-label="submit">                Export            </md-button>
		</div>
		<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center" style="margin-top:10px;">
			<mdp-date-picker ng-model="equipment_summary_report_search.fromdate" mdp-placeholder="From Date" mdp-format="DD-MM-YYYY" flex="15" mdp-max-date="minDate"></mdp-date-picker>
			<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
			<mdp-date-picker ng-model="equipment_summary_report_search.todate" mdp-placeholder="To Date" flex="15"  mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" mdp-min-date="equipment_summary_report_search.fromdate"></mdp-date-picker>
			<div flex="1" hide-xs hide-sm>&nbsp;&nbsp;</div>
			<md-autocomplete flex="20" class="md-block" flex-gt-sm 
			ng-value="equipment_summary_report_search.department=searched.CODE"  
			md-no-cache="false"                          
			md-selected-item="searched.CODE"         
			md-search-text="searchDepartment"        
			md-items="item in searchTextChange(searchDepartment,'Department')"  
			md-item-text="item.USER_DEPT_NAME"         
			md-min-length="0"                    
			md-floating-label="Department">
				<md-item-template>
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
				</md-item-template>
				<md-not-found>                    No Department Found                </md-not-found>
			</md-autocomplete>
			<span ng-value="equipment_summary_report_search.department=searched.CODE.CODE"></span>
			<!---<md-input-container class="md-block" flex-gt-sm><label>Department</label><md-select ng-model="equipment_summary_report_search.department"><md-option ng-value="nullValue">                        Select Department                    </md-option><md-option ng-repeat="dept in depts"  ng-value="dept.CODE" >                        {{dept.USER_DEPT_NAME}}({{dept.CODE}})                    </md-option></md-select><div ng-messages="AddDevice.depts.$error"><div ng-message="required">Required</div></div></md-input-container>---->
			<div flex="1" hide-xs hide-sm>&nbsp;&nbsp;</div>
			<md-autocomplete class="md-block" flex-gt-sm     
			md-no-cache="false"                       
			md-selected-item="searched.EID" 
            ng-value="equipment_summary_report_search.equp_id=searched.CODE"			
			md-search-text="searchEid"              
			md-items="item in searchTextChange(searchEid)"     
			md-item-text="equipment_summary_report_search.equp_id=item.E_ID"                
			md-min-length="0"                     
			md-floating-label="Search Eq. id?">
				<md-item-template>
				
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
				</md-item-template>
				<md-not-found>              
				No Equipment Match Found      
				</md-not-found>
			</md-autocomplete>
			<span ng-value="equipment_summary_report_search.equp_id=searched.EID.E_ID"></span>
			<md-button class="md-icon-button md-raised md-accent" ng-click=""  md-theme="default" aria-label="submit">
				<ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
			</md-button>
		</div>
		<!--            <div id="exportthis"><div layout="row" layout-align="end center" flex="100"><button ng-click="printTCPDF()" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</button></div><div layout="row" flex style="margin-bottom:5px;"><div layout-align="center center" flex="100"><h5 style="font-weight:700"><center>CARE HOSPITALS<br>                                BIOMEDICAL ENGINEERING DEPARTMENT<br>                                EQUIPMENT SUMMARY REPORT</center></h5></div><div layout-align="end end" flex="0"><img style="float:right" src="
		<?php /*echo base_url();*/?>assets/images/carepdflogo.jpg"></div></div>-->
		<div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
			<table class="md-api-table table table-bordered" ng-cloak style="font-size:12px;width:100%;margin-bottom:5px;border:1px solid #dbd7da;">
				<tr>
					<th colspan="6" width="600" style="text-align:center">EQUIPMENTS SUMMARY</th>
					<th colspan="4" width="400" style="text-align:center">CONTRACTS</th>
				</tr>
				<tr>
					<th style="text-align:center">UNIT</th>
					<th style="text-align:center">EQ COUNT</th>
					<th style="text-align:center">TOTAL VALUE OF                                    
						<br>EQUIPMENT
						</th>
						<th style="text-align:center">CONT:                                    COUNT</th>
						<th style="text-align:center">                                    VALUE or CONTRACTS                                </th>
						<th style="text-align:center">                                    VALUE of EQ  UNDER
							<br> CONTRACTS                                
							</th>
							<th style="text-align:center">NUMBER (%)</th>
							<th style="text-align:center">T-VALUE  (%)</th>
							<th style="text-align:center">C-VALUE (%)</th>
							<th style="text-align:center">C/T-VALUE  (%)</th>
						</tr>
						<tr ng-repeat="equp_reports_pdf in equp_reports_pdfs">
							<td>{{equp_reports_pdf.BRANCH_NAME}}</td>
							<td>{{equp_reports_pdf.no_of_equipment}}</td>
							<td>{{equp_reports_pdf.value_equipment | currency:''}}</td>
							<td>{{equp_reports_pdf.no_of_contracts}}</td>
							<td>{{equp_reports_pdf.value_contracts | currency:''}}</td>
							<td>{{equp_reports_pdf.cec | currency:''}}</td>
							<td>{{equp_reports_pdf.NUMBER}} %</td>
							<td>{{equp_reports_pdf.TVALUE}} %</td>
							<td>{{equp_reports_pdf.CVALUE}} %</td>
							<td>{{equp_reports_pdf.CTVALUE}} %</td>
						</tr>
						<tr>
							<th>Total</th>
							<th>{{equp_reports_pdfs.no_eqp_total}}</th>
							<th>{{equp_reports_pdfs.no_equp_value_total}}</th>
							<th>{{equp_reports_pdfs.no_contract_total | currency:''}}</th>
							<th>{{equp_reports_pdfs.no_cont_value_total | currency:''}}</th>
							<th>{{equp_reports_pdfs.no_valueeq_unser_contract_total | currency:''}}</th>
							<th>{{equp_reports_pdfs.number_total}} %</th>
							<th>{{equp_reports_pdfs.tvalue_total}} %</th>
							<th>{{equp_reports_pdfs.cvalue_total}} %</th>
							<th>{{equp_reports_pdfs.ctvalue_total}} %</th>
						</tr>
						<tr>
							<td colspan="10">
								<b>* NOTES</b>
							</td>
						</tr>
						<tr>
							<td colspan="10">NUMBER% - Number of equipments under contract -out of total number of equipments</td>
							<tr>
								<tr>
									<td colspan="10">T-VALUE% - Total contract value over the total value of equipment in the unit</td>
									<tr>
										<tr>
											<td colspan="10">C-VALUE% - Total contract value over the total value of equipment that are under contract only</td>
											<tr>
												<tr>
													<td colspan="10">C/T-VALUE% - Total contract equipment over the total assets value in the unit</td>
													<tr>
												<tr>
													<td colspan="10">CONT:COUNT - Total contract equipment count under the contract only</td>
												</tr>
											</table>
										</div>
									</div>
								</md-content>