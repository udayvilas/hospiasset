<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Scheduled Calls Reports</h3>
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
                    <input type="search" ng-model="scr_report_search.saccessoriesno" name="saccessoriesno" aria-label="saccessoriesno"/>
                </md-input-container>

                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
                <md-input-container class="md-block"  flex-gt-sm flex="15">
                    <label>Eq. Name</label>
                    <input type="text" ng-model="scr_report_search.ename" name="ename" aria-label="ename"/>
                </md-input-container>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
                <md-input-container flex="20">
                    <label>Select Department</label>
                    <md-select  ng-model="scr_report_search.dept_id" name="depts">
                        <md-option ng-value="all">All</md-option>
                        <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                            {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                        </md-option>
                    </md-select>
                </md-input-container>

                <div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm></div>
                <md-button type="submit" value="Submit" class="md-icon-button md-raised md-primary" ng-click="getSCReport()" aria-label="submit">
                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                </md-button>
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
                <th style="width:15%">Assignes By</th>
                <th style="width:8%">Completed By</th>
                <th style="width:15%">Action</th>
            </tr>
            </thead>
            <tbody ng-if="!isEmpty(scr_reports)">
            <tr ng-repeat="scr_report in scr_reports">
                <td>{{scr_report.EID}}</td>
                <td>{{scr_report.equp_name}}</td>
                <td>{{scr_report.dept_id}}</td>
                <td>{{scr_report.serial_number}}</td>
                <td>{{scr_report.assigned_by}}</td>
                <td>{{scr_report.Completed_by}}</td>

                <td>
                    <button ng-if="user_role_code!=HMADMIN" ng-click="pdfSCReportTCPDF($event,scr_report)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Pdf</md-tooltip>
                        <md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
                    </button>
                    <button ng-click="viewSCRDetails($event,scr_report)" class="btn btn-xs btn-default" aria-label="Edit">

                        <md-icon class="material-icons-new material-icons" style="color: rgb(68,138,255);">launch</md-icon>
                    </button>
                </td>
            </tr>
            </tbody>
            <tbody ng-if="scr_reports==null">
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
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getSCReport(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>

    </div>
</md-content>