<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">CEAR Reports</h3>
        <div  layout="row" layout-align="end end">
            <md-button class="md-button md-raised md-accent"  ng-show="CEAR_pdf_report==Generate PDF" ng-click="getCearReportPDF(cear_lists)" aria-label="submit">Export</md-button>
        </div>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th>Cear Number</th>
                    <th>Project Number</th>
                    <th>Project Title</th>
                    <th>Requesting Unit</th>
                    <th>Requesting Category</th>
                    <th>Requesting Department</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody ng-if="cear_lists!=null">
                <tr ng-repeat="cear_list in cear_lists">
                    <td>{{cear_list.CEAR_ID}}</td>
                    <td>{{cear_list.PROJECT_ID}}</td>
                    <td>{{cear_list.TITLE}}</td>
                    <td>{{cear_list.REQ_UNIT}}</td>
                    <td>{{category}}</td>
                    <td>{{cear_list.REQ_DEPT}}</td>
                    <td style="text-align: center;">
                        <button ng-if="user_role_code!=HMADMIN" ng-show="CEAR_pdf_report==Generate PDF" ng-click="pdfCearReportTCPDF($event,cear_list)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Pdf</md-tooltip>
                            <md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="7" style="text-align:center"> No CEAR Found</td>
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
    <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadCear(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>