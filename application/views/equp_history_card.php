<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content  class="mylayout-padding"  md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Equipment History Report</h3>

        <div layout="row">
            <div flex="100">
                <p>Equipment History Graph</p>
                <canvas id="bar" class="chart chart-bar" height="40" chart-data="equipmentHistorydata" chart-labels="equipmentHistorylabels" chart-colors="equipmentHistorycolors" chart-series="equipmentHistoryseries">
                </canvas>
            </div>
        </div>

        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="left">
            <!--<md-button ui-sref="home.transfer_within_unit" class="md-raised md-primary">Transfer</md-button>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
            <!--<mdp-date-picker ng-model="equp_history__report_search.fromdate" mdp-placeholder="From Date" mdp-format="DD-MM-YYYY" flex="15" mdp-max-date="minDate">
            </mdp-date-picker>

            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

            <mdp-date-picker ng-model="equp_history_report_search.todate" mdp-placeholder="To Date" flex="15"  mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" mdp-min-date="equp_history__report_search.fromdate">
            </mdp-date-picker>--->

            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
            <md-autocomplete class="md-block" flex-gt-sm flex="30"
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
            <!---<md-input-container flex="20">
                <label>Select Department</label>
                <md-select  ng-model="equp_history_report_search.dept_id" name="dept_id">
                    <md-option ng-value="all">All</md-option>
                    <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                        {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                    </md-option>
                </md-select>
            </md-input-container>--->									<md-autocomplete flex="20" class="md-block" flex-gt-sm                             ng-value="equp_history_report_search.dept_id=searched.CODE"                             md-no-cache="false"                             md-selected-item="searched.CODE"                             md-search-text="searchDepartment"                             md-items="item in searchTextChange(searchDepartment,'Department')"                             md-item-text="item.USER_DEPT_NAME"                             md-min-length="0"                             md-floating-label="Department">                <md-item-template>                    <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>                </md-item-template>                <md-not-found>                    No Department Found                </md-not-found>            </md-autocomplete>            <span ng-value="equp_history_report_search.dept_id = searched.CODE.CODE"></span>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>
            <md-button class="md-icon-button md-raised md-accent" ng-show="Report_History_Pdf==Generate PDF" ng-show="" ng-click="getEquipmentHistory(equp_history_report_search)"  md-theme="default" aria-label="submit">
                <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
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

            <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th rowspan="2">Equipment</th>
                    <th rowspan="2">Model</th>
                    <th rowspan="2">Serial No</th>
                    <th rowspan="2">Equp Id</th>
                    <th rowspan="2">Manfature Date</th>
                    <th rowspan="2">Dealer</th>
                    <th rowspan="2">Equp Cost</th>
                    <th rowspan="2">Installation Date </th>
                    <th rowspan="2">Life Cycle Cost</th>
                    <th rowspan="2">User Dept</th>
                    <th rowspan="2">Contracts</th>
                    <th rowspan="2">From</th>
                    <th rowspan="2">To</th>
                    <th rowspan="2">Contract Cost</th>
                    <th>action</th>
                </tr>

                </thead>
                <tbody ng-if="!isEmpty(equp_history_cards)">
                <tr ng-repeat="equp_history_card in equp_history_cards">
                    <td>{{equp_history_card.E_NAME}}</td>
                    <td>{{equp_history_card.E_MODEL}}</td>
                    <td>{{equp_history_card.ES_NUMBER}}</td>
                    <td>{{equp_history_card.E_ID}}</td>
                    <td>{{equp_history_card.MF_DATE}}</td>
                    <td>{{equp_history_card.DISTRIBUTOR}}</td>
                    <td>{{equp_history_card.E_COST}}</td>
                    <td>{{equp_history_card.DATEOF_INSTALL}}</td>
                    <td></td>
                    <td>{{equp_history_card.department}}</td>
                    <td>{{equp_history_card.contarct_type}}</td>
                    <td>{{equp_history_card.C_FROM}}</td>
                    <td>{{equp_history_card.C_TO}}</td>
                    <td>{{equp_history_card.AMC_VALUE}}</td>
                    <td>
                        <button ng-show="Report_History_Pdf==Generate PDF" ng-click="pdfEquipmentHistorytReportTCPDF($event,equp_history_card)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Pdf</md-tooltip>
                            <md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tbody ng-else="equp_history_cards==null">
                <tr><td colspan="20" style="text-align:center">No Rows are Found</td></tr>
                </tbody>
            </table>
        </div>
    </center>
    </div>
    <div flex layout="row" class="marginb-10" >
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getEquipmentHistory(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
    </div>
</md-content>