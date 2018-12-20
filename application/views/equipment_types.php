<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" layout-wrap md-theme="hospiclr">
    <h3 class="heading-stylerespond">Equipment Types</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
             <md-button ng-if="Add_Equipment_Type==Add" ui-sref="home.add_equipment_type" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th style="width:70%">{{equp_type_labels.TYPE}}</th>
                <th style="width:15%">{{equp_type_labels.CODE}}</th>
                <th style="width:15%">{{equp_type_labels.STATUS}}</th>
                <th style="width:10%">{{equp_type_labels.ACTION}}</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="isObject(cg_equp_types)" ng-repeat="equp_type in cg_equp_types">
                <td>{{equp_type.TYPE}}</td>
                <td>{{equp_type.CODE}}</td>
                <td>
                    <span ng-if="equp_type.STATUS=='A'">Active</span>
                    <span ng-elif="equp_type.STATUS=='I'">Inactive</span>
                    <span ng-else>-</span>
                </td>
                <td style="text-align: center;">
                    <button ng-disabled="Edit_Equipment_Type!=Edit" ng-click="editEqupType($event,equp_type)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if="!isObject(cg_equp_types)">
                <td colspan="3" class="text-center">No Records Found</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div flex layout="row" class="marginb-10" ng-if="cg_equp_types!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getEqupTypes(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>