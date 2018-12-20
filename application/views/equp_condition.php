<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Equipment Conditions</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button ng-if="Add_Condition==Add" ui-sref="home.hbbme_add_equp_condition" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>{{econd_labels.ECODE}}</th>
                <th>{{econd_labels.EVAL}}</th>
                <th>{{econd_labels.STATUS}}</th>
                <th>{{econd_labels.ACTION}}</th>
                
            </tr>
            </thead>
            <tbody>
            <tr ng-if="econds!=null && econds!='undefined'" ng-repeat="econd in econds">
                <td>{{econd.ECODE}}</td>
                <td>{{econd.EVAL}}</td>
                <td>{{econd.STATUS=='A' ? 'Active' : 'Inactive'}}</td>
                <td style="text-align: center;">
                    <button ng-disabled="Edit_Condition!=Edit" ng-click="editEqupConditon($event,econd)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if=econds==null || econds=='undefined'>
                <td colspan="3" class="text-center">No Equipment Condition Found</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div flex layout="row" class="marginb-10" ng-if="econds!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadEqupCondition(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>