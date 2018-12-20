<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button ui-sref="home.add_condmnation_resold_values" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <h3>Condemnation Resold Details</h3>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Reusable Parts</th>
                <th>Reusable Code</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody ng-if="conreasons!=null">
            <tr ng-if="reusable_parts!=null && reusable_parts!='undefined'" ng-repeat="reusable_part in reusable_parts">
                <td>{{reusable_part.REUSABLE_PARTS}}</td>
                <td>{{reusable_part.CODE}}</td>
                <td>
                    <md-button ng-click="editReusableparts($event,reusable_part)" class="md-icon-button md-primary" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon>mode_edit</md-icon>
                    </md-button>
                </td>
            </tr>
            <tr ng-if=reusable_parts==null || reusable_parts=='undefined'>
                <td colspan="3" class="text-center">No Reusable Parts Found</td>
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
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadReusableParts(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>