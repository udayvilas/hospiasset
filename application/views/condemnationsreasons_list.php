<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Condemnation Reasons</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button ui-sref="home.add_condemnation" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Reason</th>
                <th>Code</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="conreasons!=null && conreasons!='undefined'" ng-repeat="conreason in conreasons">
                <td>{{conreason.REQUEST_NAME}}</td>
                <td>{{conreason.CODE}}</td>
                <td>
                    <md-button ng-click="editCondmnReasons($event,conreason)" class="md-icon-button md-primary" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon>mode_edit</md-icon>
                    </md-button>
                </td>
            </tr>
            <tr ng-if=conreasons==null || conreasons=='undefined'>
                <td colspan="3" class="text-center">No Condemnation Reasons Found</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div flex layout="row" class="marginb-10" ng-show="conreasons!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadCondmnReasonsList(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>