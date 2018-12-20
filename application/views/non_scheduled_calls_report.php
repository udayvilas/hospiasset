<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Non Scheduled Calls Report</h3>
    </div>
    <div>
        <form name="Search" method="post">
            <div flex layout-gt-sm="row"  layout="row">
                <md-autocomplete class="md-block"  flex-gt-sm flex="20"
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
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	(OR)</div>
                <md-input-container class="md-block" flex-gt-sm flex="10">
                    <label>Serial No</label>
                    <input type="search" ng-model="nscr_report_search.saccessoriesno" name="saccessoriesno" aria-label="saccessoriesno"/>
                </md-input-container>

                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
                <md-input-container class="md-block"  flex-gt-sm flex="15">
                    <label>Eq. Name</label>
                    <input type="text" ng-model="nscr_report_search.ename" name="ename" aria-label="ename"/>
                </md-input-container>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
                <md-input-container flex="20">
                    <label>Select Department</label>
                    <md-select  ng-model="nscr_report_search.dept_id" name="depts">
                        <md-option ng-value="all">All</md-option>
                        <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                            {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                        </md-option>
                    </md-select>
                </md-input-container>

                <div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm></div>
                <md-button type="submit" value="Submit" class="md-icon-button md-raised md-primary" ng-click="getNSCReport()" aria-label="submit">
                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                </md-button>
                <div flex="10" hide-xs hide-sm></div>
                <md-button class="md-button md-raised md-accent" ng-click="getNSCReportPDF(nostate)" aria-label="submit">Print PDF</md-button>
            </div>
        </form>

    </div>
    <div layout-gt-sm="row" layout="row" >
        <table class="md-api-table table table-bordered" style="width:100%;">
            <thead>
            <tr>
                <th style="width:15%">Eq Id</th>
                <th style="width:15%">Eq Name</th>
                <th style="width:8%">Dept</th>
                <th style="width:8%">Serial no</th>
                <th style="width:15%">Genarated By</th>
                <th style="width:8%">Pending By</th>
                <th style="width:8%">Completed By</th>
                <th style="width:15%">Down Time</th>
                <th style="width:15%">Action</th>
            </tr>
            </thead>
            <tbody ng-if="!isEmpty(nscr_reports)">
            <tr ng-repeat="nscr_report in nscr_reports">
                <td>{{nscr_report.EID}}</td>
                <td>{{nscr_report.equp_name}}</td>
                <td>{{nscr_report.CALLER_DEPT}}</td>
                <td>{{nscr_report.serial_number}}</td>
                <td>{{nscr_report.CALLER_NAME}}</td>
                <td>{{nscr_report.Attended_by}}</td>
                <td>{{nscr_report.Responded_by}}</td>
                <td>{{nscr_report.DOWN_TIME}}</td>
                <td>
                    <button ng-if="user_role_code!=HMADMIN" ng-click="pdfNSCReportTCPDF($event,nscr_report)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Pdf</md-tooltip>
                        <md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
                    </button>
                    <button ng-click="viewNSCRDetails($event,nscr_report)" class="btn btn-xs btn-default" aria-label="Edit">

                        <md-icon class="material-icons-new material-icons" style="color: rgb(68,138,255);">launch</md-icon>
                    </button>
                </td>
            </tr>
            </tbody>
            <tbody ng-if="nscr_reports==null">
            <tr>
                <td colspan="10" class="text-center">No Devices Found...</td>
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
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getNSCReport(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>

    </div>
</md-content>