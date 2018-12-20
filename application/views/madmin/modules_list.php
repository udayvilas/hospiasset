<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Modules</h3>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <div flex="33" flex-sm="50" flex-md="50">
                <md-button ui-sref="home.haadmin_add_modules" class="md-raised md-primary">Add New</md-button>
            </div>
        </div>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Module Name</th>
                <!--<th>Action</th>-->
            </tr>
            </thead>
            <tbody ng-if="!isempty(hamodules)">
            <tr ng-repeat="module in hamodules">
                <td>{{module .MODULE_NAME}}</td>
                
               <!--<td>
                    <button class="btn btn-xs btn-default" ng-click="EditModulelist($event,module)">
                        <md-tooltip md-direction="top">Update</md-tooltip>
                        <md-icon class="material-icons-new" style="color:deepskyblue">
                            mode_edit</md-icon>
                    </button>
                </td>-->
            </tr>
            </tbody>
            <tbody ng-else>
            <tr>
                <td style="text-align:center" colspan="6">No Rows Found</td>
            </tr>
            </tbody>
        </table>
    </div>
</md-content>
