<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content  class="mylayout-padding"  md-theme="hospiclr" ng-cloak>
<div layout="column">
    <h3 class="heading-stylerespond">Call Log Report</h3>

    <div flex="45">
        <p>Bar Chart</p>
        <canvas id="bar" class="chart chart-bar" height="50"
                chart-data="call_logsgraphdata" chart-labels="call_logsgraphlabels" chart-colors="call_logsgraphcolors" chart-series="call_logsgraphseries">
        </canvas>
    </div>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="start" style="margin-top:10px;">
        <md-button class="md-raised md-accent"  ng-if="callog_reports_pdfs!=null" ng-click="callLogTCPDF(ev,callog_reports_pdfs)"  md-theme="default" aria-label="submit">
            Print Pdf
        </md-button>
    </div>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="left">
        <!--<md-button ui-sref="home.transfer_within_unit" class="md-raised md-primary">Transfer</md-button>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
        <mdp-date-picker ng-model="calllog_report_search.fromdate" mdp-placeholder="From Date" mdp-format="DD-MM-YYYY" flex="15" mdp-max-date="minDate">
        </mdp-date-picker>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <mdp-date-picker ng-model="calllog_report_search.todate" mdp-placeholder="To Date" flex="15" mdp-max-date="maxDate"  mdp-format="DD-MM-YYYY" mdp-min-date="calllog_report_search.fromdate">
        </mdp-date-picker>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
        <!--<md-autocomplete class="md-block" flex-gt-sm
                         md-no-cache="false"
                         md-selected-item="searched.EID"
						 ng-value="calllog_report_search.equp_id=searched.EID"
                         md-search-text="calllog_report_search.searchEid"
                         md-items="item in searchTextChange(searchEid)"
                         md-item-text="calllog_report_search.equp_id=item.E_ID"
                         md-min-length="1"
                         md-floating-label="Search Eq. id?">
            <md-item-template>
                <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
            </md-item-template>
            <md-not-found>
                No Equipment Match Found
            </md-not-found>
        </md-autocomplete>
		  <!--<span ng-value="calllog_report_search.equp_id = searched.EID.E_ID" ></span>-->
		  <md-autocomplete   class="md-block" flex-gt-sm flex="25"
                           md-no-cache="false"
                           md-input-name="Eq.ID"
                           ng-value="calllog_report_search.equp_id=searched.EID"
                           md-selected-item="searched.E_ID"
                           md-search-text="calllog_report_search.searchEid"
                           md-items="item in searchTextChange(calllog_report_search.searchEid)"
                           md-item-text="calllog_report_search.equp_id = item.E_ID"
                           md-min-length="0"
                           md-search-text-change="calllog_report_search.equp_id = ''"
                           md-floating-label="Search Eq. id">
            <md-item-template>
                <span md-highlight-text="searchText"  md-highlight-flags="^i">{{item.E_ID}}</span>
            </md-item-template>
            <md-not-found>
                No Equipment Match Found
            </md-not-found>
        </md-autocomplete>
        <span ng-value="calllog_report_search.equp_id = searched.EID.E_ID" ></span>		
		
		<!--<md-autocomplete class="md-block" flex-gt-sm
                         md-no-cache="false"
                         md-selected-item="searched.EID"
                         md-search-text="searchEid"
                         md-items="item in searchTextChange(searchEid)"
                         md-item-text="item.E_ID"
                         md-min-length="0"
                         md-floating-label="Search Eq. id?">
            <md-item-template>
                <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
            </md-item-template>
            <md-not-found>
                No Equipment Match Found
            </md-not-found>
        </md-autocomplete>--->
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
        <!---<md-input-container flex="20">
            <label>Select Department</label>
            <md-select  ng-model="calllog_report_search.dept_id" name="dept_id">
                <md-option ng-value="all">All</md-option>
                <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                </md-option>
            </md-select>
        </md-input-container>--->				
		<md-autocomplete flex="20" class="md-block" flex-gt-sm        
		                  ng-value="calllog_report_search.dept_id=searched.CODE"        
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
                      <md-not-found>                
                            No Department Found           
                    </md-not-found>           
					</md-autocomplete>   
 <span ng-value="calllog_report_search.dept_id = searched.CODE.CODE"></span>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
        <md-input-container class="md-block" flex-gt-sm flex="15">
            <label>Contract Type *</label>
            <md-select ng-model="calllog_report_search.contract_type" name="contract_type" aria-label="contract_type">
                <md-option ng-value="nullValue">
                    {{allValue}}
                </md-option>
                <md-option ng-repeat="contract_type in contract_types" ng-value="contract_type.CTYPE">
                    {{contract_type.CTYPE}}
                </md-option>
            </md-select>
        </md-input-container>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
        <div layout="row" layout-align="right"><span style="text-decoration: underline;color:red;font-size: 12px;" ng-click="ShowHide()"><md-button class="md-raised md-accent">ADV Filter ({{isvisiblevalue}})</md-button></span></div>
        <div ng-if="IsVisible" layout="row" layout-align="space-around center" style="border-bottom:1px solid #DDD;margin-bottom: 8px;" class="reveal-animation">
    </div>
        <md-button class="md-icon-button md-raised md-accent" ng-click="loadCalllogsReports()"  md-theme="default" aria-label="submit">
            <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
        </md-button>
        </div>
    <div layout="row" ng-if="IsVisible">
        <md-input-container class="md-block">
            <label>Call Cost</label>
            <input type="text"  ng-model="calllog_report_search.call_cost" name="call_cost" only-digits="only-digits"  aria-label="call_cost"/>
        </md-input-container>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
        <!--<md-input-container class="md-block" flex-gt-sm flex="20">
            <label style="color:#000000 !important;">Contract Vendor *</label>
            <md-select ng-model="calllog_report_search.vendor" name="vendor" required aria-label="vendor">
                <md-option ng-repeat="sprt_vendr in vendors" ng-value="sprt_vendr.ORG_ID">
                    {{sprt_vendr.ORG_NAME}}
                </md-option>
            </md-select>
        </md-input-container>--->
		<md-autocomplete class="md-block" flex-gt-sm flex="20"
		                     ng-value="calllog_report_search.vendor==searched.ORG_ID"
							 md-no-cache="false"
							 md-input-name="distributor"
							 md-selected-item="searched.ORG_ID"
							 md-search-text="searchORG_NAME"
							 md-items="item in searchTextChange(searchORG_NAME,'Vendor')"
							 md-item-text="item.ORG_NAME"
							 md-min-length="0"
							 md-floating-label="Vendor">
				<md-item-template>
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
				</md-item-template>
		      <md-not-found>                
                            No Department Found           
                    </md-not-found> 
			</md-autocomplete>
           <span ng-value="calllog_report_search.venodor = searched.ORG_ID.ORG_ID" ></span>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
        <div>
        <mdp-time-picker ng-model="calllog_report_search.completed_time" mdp-format="HH:mm A" mdp-placeholder="Completed Time"></mdp-time-picker>
        </div>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
        <mdp-time-picker name="timeFormat" ng-model="calllog_report_search.responded_time" mdp-format="HH:mm A" mdp-placeholder="Responded Time">
        </mdp-time-picker>
    </div>

 <!--   <div id="exportthis">
        <div  layout="row" layout-align="end end" flex>
            <button ng-click="printPdf()" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</button>
        </div>
        <div layout="row" layout-align="center center"  flex="90" style="margin-bottom:5px;">
            <div layout-align="center center" flex="100">
                <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                        BIOMEDICAL ENGINEERING DEPARTMENT<br>
                        CALL LOG REPORT</center></h5>
            </div>
            <div layout-align="end end" flex="0">
                <img style="float:right" src="<?php /*echo base_url();*/?>assets/images/carepdflogo.jpg">
            </div>
        </div>-->
    </div>
        <center>
            <div layout="row" flex="100" id="customers" layout-align="center center">

                <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                    <thead>
                    <tr>
                     <th>Equp ID</th>
                     <th>Equp Name</th>
                     <th>Vendor</th>
                     <th>Reasons</th>
                     <th>Call date & Time</th>
                     <th>Raised</th>
                     <th>Responded By</th>
                     <th>Pending</th>
                     <th>Closed</th>
                     <th>Call Cost</th>
                     <th>Responded Time</th>
                     <th>Completed Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="callog_reports_pdf in callog_reports_pdfs">
                        <td>{{callog_reports_pdf.EID}} </td>
                        <td>{{callog_reports_pdf.eq_name}} </td>
                        <td>{{callog_reports_pdf.vendorname}} </td>
                        <td>{{callog_reports_pdf.NATURE_OF_COMP}} </td>
                        <td>{{callog_reports_pdf.CDATE}} {{callog_reports_pdf.CTIME}}</td>
                        <td>{{callog_reports_pdf.CALLER_NAME}}</td>
                        <td>{{callog_reports_pdf.RESPONDED_BY_NAME}}</td>
                        <td>{{callog_reports_pdf.ATTENDEE_NAME}}</td>
                        <td>{{callog_reports_pdf.ATTENDEE_NAME}}</td>
                        <td>{{callog_reports_pdf.COST}}</td>
                        <td>{{callog_reports_pdf.RESPONDED_TIME}}</td>
                        <td>{{callog_reports_pdf.JOBCOMPLETED_TIME}}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </center>
    </div>
    </div>
</md-content>