<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button ng-if="Add_Role==Add"  ui-sref="home.add_org_roles" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>{{role_labels.ROLE_CODE}}</th>
                <th>{{role_labels.ROLE_NAME}}</th>
                <th>{{role_labels.ACTION}}</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="org_roles!=null && org_roles!='undefined'" ng-repeat="org_role in org_roles">
                <td>{{org_role.ROLE_CODE}}</td>
                <td>{{org_role.ROLE_NAME}}</td>
                <td>
                <button class="btn btn-xs btn-default" ng-disabled="Edit_Role!=Edit"  ng-click="EditOrgrole($event,org_role)"  aria-label="Edit Org_roles{{$index}}">
                <md-tooltip md-direction="top">Edit</md-tooltip>
                <md-icon class="material-icons-new" style="color:#ffa602">mode_edit</md-icon>
                </button>
                </td>
            </tr>
            <tr ng-if=org_roles==null || org_roles=='undefined'>
                <td colspan="7" class="text-center">No Org Roles Found</td>
            </tr>
            </tbody>
        </table>
    </div>
</md-content>