<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="column" flex>
    <h3 class="heading-stylerespond">Equipment Status</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button ng-if="Add_status==Add" ui-sref="home.hbbme_add_status" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="row" flex layout-align="center center">
        <div flex="100">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>{{stat_label.STATUS}}</th>
                <th>{{stat_label.SCODE}}</th>
                <th>{{stat_label.STATUSS}}</th>
                <th>{{stat_label.ACTION}}</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="equp_statuses!=null" ng-repeat="status in equp_statuses | orderBy: 'STATUS'">
                <td>{{status.STATUS}}</td>
                <td>{{status.SCODE}}</td>
                <td>{{status.STATUSS=='A' ? 'Active' : 'Inactive'}}</td>
                <td style="text-align: center;">
                    <button ng-disabled="Edit_status!=Edit" ng-click="editStatus($event,status)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if=equp_statuses=='null'>
                <td colspan="3" class="text-center">No Status Found</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
    <!---<div flex layout="row" class="marginb-10" ng-if="equp_statuses!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadStatusList(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>--->
    </div>
</md-content>