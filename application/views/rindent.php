<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Indent Report</h3>
        <div  layout="row" layout-align="end end">
            <md-button class="md-button md-raised md-accent" ng-show="Indent_pdf_report==Generate PDF" ng-click="getIndentReportPDF(indent_equps)" aria-label="submit">Export</md-button>
        </div>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th>Indent ID</th>
                    <th>Dept Id</th>
                    <th>Eq. Name</th>
                    <th>serial. No</th>
                    <th>contract Type</th>
                    <th>Quantity</th>
                    <th>Essential Features</th>
                    <th>Desirous Features</th>
                    <th>Luxurious Features</th>
                    <th>Standard Accessories</th>
                    <th>Optional Accessories</th>
                    <th>Estimated Cost</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody ng-if="indent_equps!=null">
                <tr ng-repeat="indent_equp in indent_equps">
                    <td>{{indent_equp.INDENT_ID}}</td>
                    <td>{{indent_equp.DEPT}}</td>
                    <td>{{indent_equp.EQ_NAME}}</td>
                    <td>{{indent_equp.serial_no}}</td>
                    <td>{{indent_equp.contact_type}}</td>
                    <td>{{indent_equp.QTY}}</td>
                    <td>{{indent_equp.ESNTL_FEATURES}}</td>
                    <td>{{indent_equp.OPTIMAL_FEATURES}}</td>
                    <td>{{indent_equp.OPTIONAL_FEATURES}}</td>
                    <td>{{indent_equp.STNRD_ACCESSORIES}}</td>
                    <td>{{indent_equp.OPTIONAL_ACCESSORIES}}</td>
                    <td>{{indent_equp.ESTIMATED_COST}}</td>
                    <td style="text-align: center;">
                        <button ng-if="user_role_code!=HMADMIN" ng-show="Indent_pdf_report==Generate PDF" ng-click="pdfIndentReportTCPDF($event,indent_equp)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Pdf</md-tooltip>
                            <md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="11" style="text-align:center"> No Indent Equipment Found</td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadIncidentsElements(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
</md-content>