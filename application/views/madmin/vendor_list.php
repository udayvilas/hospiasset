<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Vendors</h3>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <div flex="33" flex-sm="50" flex-md="50">
                <md-button ui-sref="home.haadmin_add_vendors" class="md-raised md-primary">Add New</md-button>
            </div>
        </div>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Vendor Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>EmpNo</th>
                <th>Role</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody ng-if="!isempty(havendors)">
            <tr ng-repeat="vendor in havendors">
                <td>{{vendor.USER_NAME}}</td>
                <td>{{vendor.EMAIL_ID}}</td>
                <td>{{vendor.MOBILE_NO}}</td>
                <td>{{vendor.EMP_NO}}</td>
                <td>{{vendor.ROLE_CODE}}</td>
                <td>{{vendor.LEVEL}}</td>
                <!--<td>
                    <button class="btn btn-xs btn-default" ng-click="EditHospitals($event,hospital)">
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
