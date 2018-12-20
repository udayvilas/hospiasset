<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Gate Pass Report</h3>
        <div  layout="row" layout-align="end end">
            <md-button ng-show="Report_Gatepass_Pdf==Generate PDF" class="md-button md-raised md-accent" ng-click="getGatepassReportPDF(gate_pass_news)" aria-label="submit">Export</md-button>
        </div>

        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th>Eq. ID</th>
                    <th>GatePass ID</th>
                    <th>Department</th>
                    <th>Branch</th>
                    <th>Eq. Name</th>
                    <th>Serial no</th>
                    <th>Contract Type</th>
                    <th>Location</th>
                    <th>Spares</th>
                    <th>Accessories</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody ng-if="gate_pass_news!=null">
                <tr ng-repeat="gate_pass_new in gate_pass_news">
                    <td>{{gate_pass_new.E_ID}}</td>
                    <td>{{gate_pass_new.GP_ID}}</td>
                    <td>{{gate_pass_new.department}}</td>
                    <td>{{gate_pass_new.branch_name}}</td>
                    <td>{{gate_pass_new.equp_name}}</td>
                    <td>{{gate_pass_new.serial_no}}</td>
                    <td>{{gate_pass_new.contract_type}}</td>
                    <td>{{gate_pass_new.LOCATION}}</td>
                    <td>{{gate_pass_new.SPARES}}</td>
                    <td>{{gate_pass_new.ACCESSORIES}}</td>
                    <td style="text-align: center;">
                        <button ng-show="Report_Gatepass_Pdf==Generate PDF"  ng-click="GatepasspdfNEW(gate_pass_new)"  class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Pdf</md-tooltip>
                            <md-icon class="material-icons-new" href="" style="color:#614DA4">picture_as_pdf</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="10" style="text-align:center"> No Gate Pass Found</td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadGatepass(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
</md-content>