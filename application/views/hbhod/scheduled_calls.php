<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr"">
<div layout="column"><h3 class="heading-stylerespond">Scheduled Types</h3>
    <div  layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="100" flex-sm="50" flex-md="50">
            <md-button  ui-sref="home.hbhod_add_scheduled_call" class="md-raised md-primary">Add Scheduled Call</md-button>
        </div>
        <div flex="20" hide-xs hide-sm></div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Scheduled Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="scheduled_types!=null && scheduled_types!='undefined'" ng-repeat="scheduled_type in scheduled_types">
                <td>{{scheduled_type.SCHEDULE_TYPE}}</td>
                <td>
                    <button ng-click="editCity($event,city)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color: #614da4;">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if="scheduled_types==null || scheduled_types=='undefined'">
                <td colspan="7" class="text-center">No Scheduled Types Found</td>
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
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadScheduledtypes(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</div>
</md-content>
