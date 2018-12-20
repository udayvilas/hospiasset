<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Escalations</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button ng-if="Add_Escalations==Add" ui-sref="home.add_escalations1" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Equp Type</th>
                <th>Esc Types</th>
                <th>Esc Category</th>
                <th>L1</th>
                <th>L2</th>
                <th>L3</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="escalts!=null && escalts!='undefined'" ng-repeat="escalt in escalts">
                <td>{{escalt.equp_cat}}</td>
                <td>{{escalt.equp_util}}</td>
                <td>{{escalt.ES_MODULE}}</td>
                <td>{{escalt.L1}} Minutes</td>
                <td>{{escalt.L2}} Minutes</td>
                <td>{{escalt.L3}} Minutes</td>
                <td style="text-align: center;">
                    <button ng-disabled="Edit_Escalations!=Edit" ng-click="editrEscalations1($event,escalt)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if=escalts==null || escalts=='undefined'>
                <td colspan="7" class="text-center">No Escalations  Found</td>
            </tr>
            </tbody>
        </table>
        <div flex layout="row" class="marginb-10">
            <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                    <md-tooltip md-direction="top">Total Records</md-tooltip>
                    {{no_of_recs}}
                </md-button>
            </div>
            <div flex="20" hide-xs hide-sm><!-- Space --></div>
            <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadEscalations(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>