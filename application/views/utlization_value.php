<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Utilizations</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button ng-if="Add_Utilization==Add" ui-sref="home.hbbme_add_utlization_value" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Equipment Utilization</th>
                <th>Code</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="uvalues!=null && uvalues!='undefined'" ng-repeat="uvalue in uvalues  | orderBy: 'NAME'">
                <td style="width: 40%;">{{uvalue.NAME}}</td>
                <td style="width: 20%;">{{uvalue.VALUE}}</td>
                <td  style="width: 20%;">{{uvalue.STATUS=='A' ? 'Active' : 'Inactive'}}</td>
                <td style="width: 10%;text-align: center;">
                    <button ng-disabled="Edit_Utilization!=Edit" ng-click="editUtillValue($event,uvalue)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if=uvalues==null || uvalues=='undefined'>
                <td colspan="3" class="text-center">No Utilization Values Found</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div flex layout="row" class="marginb-10" ng-if="uvalues!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadUtillizationValue(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>