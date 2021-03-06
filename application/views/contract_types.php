<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Contract Types</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button ng-if="Add_Contract_Type==Add" ui-sref="home.hbbme_add_contract_type" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>{{ctype_labels.CTYPE}}</th>
                <th>{{ctype_labels.CFORM}}</th>
                <th>{{ctype_labels.STATUS}}</th>
                <th>{{ctype_labels.ACTION}}</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="ctypes!=null && ctypes!='undefined'" ng-repeat="ctype in ctypes">
                <td>{{ctype.CTYPE}}</td>
                <td>{{ctype.CFORM}}</td>
                <td>{{ctype.STATUS=='A' ? 'Active' : 'Inactive'}}</td>
                <td style="text-align: center;">
                    <button ng-disabled="Edit_Contract_Type!=Edit" ng-click="editCtype($event,ctype)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if=ctypes==null || ctypes=='undefined'>
                <td colspan="3" class="text-center">No Contract types Found</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div flex layout="row" class="marginb-10" ng-if="ctypes!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadContractTypeList(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>