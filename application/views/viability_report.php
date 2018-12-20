<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Viability Report</h3>
        <div layout ="row">
            <canvas id="bar" class="chart chart-bar" height="50"
                    chart-data="viabiltygraphdata" chart-labels="viabiltygraphlabels" chart-series="viabiltygraphseries">
            </canvas>
        </div>
        <div layout="row">
            <div flex="100" style="text-align: right;">
            <md-button ng-show="viability_list!=null && Viability_pdf_report==Generate PDF" ng-click="getViabilityTCPDF(nostate)" class="md-raised md-primary">Export</md-button>
            </div>
        </div>
        <div layout-gt-sm="row" layout="row">
            <table class="md-api-table table table-bordered" style="width:100%;">
                <thead>
                <tr>
                    <th style="width:15%">Eq. ID</th>
                    <th style="width:10%">Eq. Name</th>
                    <th style="width:10%">Serial No</th>
                    <th style="width:10%">Contract Type</th>
                    <th style="width:5%">Dept</th>
                    <th style="width:8%">Cost of Consumables</th>
                    <th style="width:8%">Disposable Cost</th>
                    <th style="width:8%">No.of Cases Per Day</th>
                    <th style="width:8%">Code Operation</th>
                    <th style="width:8%">Advantages</th>
                    <th style="width:8%">Action</th>
                </tr>
                </thead>
                <tbody ng-if="!isEmpty(viability_list)">
                <tr ng-repeat="viabilty in viability_list">
                    <td>{{viabilty.E_ID}}</td>
                    <td>{{viabilty.ename}}</td>
                    <td>{{viabilty.esnumber}}</td>
                    <td>{{viabilty.contract_type}}</td>
                    <td>{{viabilty.DEPT_ID}}</td>
                    <td>{{viabilty.COST_OF_CONSUMABLES}}</td>
                    <td>{{viabilty.DISPOSABLE_COST}}</td>
                    <td>{{viabilty.NO_CASES_DONE_DAILY}}</td>
                    <td>{{viabilty.CHRGS_PER_OPE}}</td>
                    <td>{{viabilty.ADVANTAGES}}</td>
                    <td>
                        <button ng-show="Viability_pdf_report==Generate PDF" ng-if="user_role_code!=HMADMIN" ng-click="pdfViabilityReportTCPDF($event,viabilty)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Pdf</md-tooltip>
                            <md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tbody ng-if="viability_list==null">
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getViability(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>