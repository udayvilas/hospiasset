<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Equipment Class</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <!--<md-button ng-show="user_role_code==HBHOD" ui-sref="home.hbhod_add_equipment_class" class="md-raised md-primary">Add Eclass</md-button>
            <md-button ng-show="user_role_code==HMADMIN" ui-sref="home.hmadmin_add_equipment_class" class="md-raised md-primary">Add Eclass</md-button>-->
            <md-button ng-if="Add_Classes==Add" ui-sref="home.hbbme_add_equipment_class" class="md-raised md-primary">Add Eclass</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <h3>Equipment Class List</h3>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Equipment Class</th>
                <th>Equipment Code</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="eclass!=null && eclass!='undefined'" ng-repeat="eclas in eclass">
                <td>{{eclas.EQ_CLASS}}</td>
                <td>{{eclas.EQ_CODE}}</td>
                <td style="text-align: center;">
                    <button ng-disabled="Edit_Classes!=Edit" ng-click="editEqupClass($event,eclas)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if=eclas==null || eclas=='undefined'>
                <td colspan="3" class="text-center">No Equipment Condition Found</td>
            </tr>
            </tbody>
        </table>
    </div>
</md-content>