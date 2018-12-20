<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="left">
        <!--<md-button ui-sref="home.transfer_within_unit" class="md-raised md-primary">Transfer</md-button>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
        <mdp-date-picker ng-model="calllog_report_search.fromdate" mdp-placeholder="From Date" mdp-format="DD-MM-YYYY" flex="15" mdp-max-date="minDate">
        </mdp-date-picker>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <mdp-date-picker ng-model="calllog_report_search.todate" mdp-placeholder="To Date" flex="15"  mdp-format="DD-MM-YYYY" mdp-min-date="calllog_report_search.fromdate">
        </mdp-date-picker>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
        <md-autocomplete class="md-block" flex-gt-sm
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
        </md-autocomplete>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
        <md-input-container flex="20">
            <label>Select Department</label>
            <md-select  ng-model="calllog_report_search.dept_id" name="dept_id">
                <md-option ng-value="all">All</md-option>
                <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                </md-option>
            </md-select>
        </md-input-container>
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
        <md-button class="md-icon-button md-raised md-accent" ng-click="loadCalllogsReports()"  md-theme="default" aria-label="submit">
            <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
        </md-button>
    </div>
    <button ng-click="demoFromHTML();">PDF</button>
    <div id="customers">
        <h1>This dummy pdf</h1>
        <center>
        <table border="2" width="90%" class="table table-striped" id="tab_customers">
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
                <td>{{callog_reports_pdf.vendor}} </td>
                <td>{{callog_reports_pdf.REPAIR_DELAY_REASON}} </td>
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
        </center>
    </div>


</md-content>