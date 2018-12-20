<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content  class="mylayout-padding"  md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Equipment Down Time Report</h3>

        <div flex="45">
            <canvas id="bar" class="chart chart-bar" height="50" chart-data="equipment_downtime_data" chart-labels="equipment_downtime_labels" chart-colors="equipment_downtime_colors"> equipment_downtime_-series="call_logsseries"
            </canvas>
        </div>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="left">
            <mdp-date-picker ng-model="equp_dwtime_report_search.fromdate" mdp-placeholder="From Date" mdp-format="DD-MM-YYYY" flex="15" mdp-max-date="minDate">
            </mdp-date-picker>

            <div flex="5" hide-xs hide-sm></div>

            <mdp-date-picker ng-model="equp_dwtime_report_search.todate" mdp-placeholder="To Date" flex="15" mdp-max-date="maxDate"  mdp-format="DD-MM-YYYY" mdp-min-date="equp_dwtime_report_search.fromdate">
            </mdp-date-picker>

            <div flex="5" hide-xs hide-sm></div>
            <md-autocomplete class="md-block" flex-gt-sm
                             md-no-cache="false"
                             md-selected-item="searched.EID"
                             md-search-text="searchEid"
                             md-items="item in searchTextChange(searchEid)"
                             md-item-text="item.E_ID"
                             md-min-length="0"
                             md-floating-label="Search Eq. id">
                <md-item-template>
                    <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
                </md-item-template>
                <md-not-found>
                    No Equipment Match Found
                </md-not-found>
            </md-autocomplete>
            <div flex="5" hide-xs hide-sm></div>
            <!---<md-input-container flex="20">
                <label>Select Department</label>
                <md-select  ng-model="equp_dwtime_report_search.dept_id" name="dept_id">
                    <md-option ng-value="all">All</md-option>
                    <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                        {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                    </md-option>
                </md-select>
            </md-input-container>---->															<md-autocomplete flex="20" class="md-block" flex-gt-sm                             ng-value="equp_dwtime_report_search.dept_id=searched.CODE"                             md-no-cache="false"                             md-selected-item="searched.CODE"                             md-search-text="searchDepartment"                             md-items="item in searchTextChange(searchDepartment,'Department')"                             md-item-text="item.USER_DEPT_NAME"                             md-min-length="0"                             md-floating-label="Department">                <md-item-template>                    <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>                </md-item-template>                <md-not-found>                    No Department Found                </md-not-found>            </md-autocomplete>            <span ng-value="equp_dwtime_report_search.dept_id = searched.CODE.CODE"></span>
            <div flex="5" hide-xs hide-sm></div>
            <md-button class="md-icon-button md-raised md-accent" ng-click="getEquipmentDownTime()"  md-theme="default" aria-label="submit">
                <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
            <md-button ng-if="equp_down_times.list!=null" ng-click="eupDownTimeTCPDF(ev,equp_down_times)" md-theme="default"  class="md-raised md-accent" >Print PDF</md-button>
            </div>

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

            <table class="md-api-table table table-bordered" ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th rowspan="2">Date of Failure</th>
                    <th rowspan="2">Dept</th>
                    <th rowspan="2">Equipment</th>
                    <th rowspan="2">OEM</th>
                    <th rowspan="2">Serial No</th>
                    <th rowspan="2">Date of Installation</th>
                    <th rowspan="2">Action Taken</th>
                    <th rowspan="2">Problems</th>
                    <th rowspan="2">Standard by Status</th>
                    <th rowspan="2">Total No.of Equp Same Type </th>
                    <th rowspan="2">Total Down Time (Hrs%)</th>
                    <th colspan="3">Finally Equipments is Repaired Date</th>
                </tr>
                <tr>
                    <th> Repaired Dates</th>
                    <th> Delay (days)</th>
                    <th> Delay (Hrs)</th>
                </tr>
                </thead>
                <tbody ng-if="equp_down_times.list!=null">
                <tr ng-repeat="equp_down_time in equp_down_times.list">
                   <td>{{equp_down_time.CDATE}}</td>
                   <td>{{equp_down_time.CALLER_DEPT}}</td>
                   <td>{{equp_down_time.equp_name}}</td>
                   <td>{{equp_down_time.cmpny_name}}</td>
                   <td>{{equp_down_time.serial_no}}</td>
                   <td>{{equp_down_time.date_of_install}}</td>
                   <td>{{equp_down_time.NATURE_OF_COMP}}</td>
                   <td>{{equp_down_time.ACTION_TAKEN}}</td>
                   <td>{{equp_down_time.STATUS}}</td>
                   <td>{{equp_down_time.no_same_equpts}}</td>
                   <td>{{equp_down_time.total_down_time}} %</td>
                    <td>{{equp_down_time.JOBCOMPLETED_DATE}}</td>
                    <td>{{equp_down_time.TIME_TO_REPAIR}}</td>
                    <td>{{equp_down_time.Deal_in_Hours}}</td>
                </tr>
                <tr>
                   <td colspan="9">Total</td>
                   <td>{{equp_down_times.total_no_same_equpts}}</td>
                   <td>{{equp_down_times.all_total_down_time}} %</td>
                    <td></td>
                    <td>{{equp_down_times.total_delay_in_days}}</td>
                    <td>{{equp_down_times.total_delay_in_hours}}</td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr><td colspan="16" style="text-align:center">No Rows are Found</td></tr>
                </tbody>
            </table>
        </div>
    </center>
    </div>
    <!--<div flex layout="row" class="marginb-10" >
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --/></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getEquipmentDownTime(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>-->
    </div>
</md-content>