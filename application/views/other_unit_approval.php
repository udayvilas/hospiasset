<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content layout="column" class="mylayout-padding" ng-cloak>
    <h3 class="heading-stylerespond">Other Unit Approval</h3>
    <div layout="column">
    <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Requested Branch</th>
                <th>Dept</th>
                <th>Eq. Name</th>
                <th>Location</th>
                <th>Reason</th>
                <th>Requested by</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody ng-if="Other_unit_approvals!=null">
            <tr ng-repeat="Other_unit_approval in Other_unit_approvals">
                <td>{{Other_unit_approval.branchname}}</td>
                <td>{{Other_unit_approval.DEPT_ID}}</td>
                <td>{{Other_unit_approval.ename}}</td>
                <td>{{Other_unit_approval.PHYSICAL_LOCATION}}</td>
                <td>{{Other_unit_approval.REASON}}</td>
                <td>{{Other_unit_approval.username}}</td>
                <td>{{Other_unit_approval.added_on+'000' | date : "dd-MM-yy hh:mm a"}}</td>
                <td>{{Other_unit_approval.TRANSFER_STATUS}}</td>
                <td>
                    <button ng-disabled="Other_unit_approval.EQUP_ID!=null" class="btn btn-xs btn-default" ng-click="OtherUnitApprovedBySuperAdmin($event,Other_unit_approval)" aria-label="Conduct Button{{$index}}">
                        <md-tooltip md-direction="top">Approve</md-tooltip>
                        <md-icon class="material-icons-new" aria-hidden="true" style="color:mediumblue">mode_edit</md-icon>
                    </button>
                    <div>
                        <button ng-disabled="true" class="btn btn-xs btn-default" ng-click="OtherUnitTransfer($event,Other_unit_approval)" aria-label="Transfer Button{{$index}}">
                            <md-tooltip md-direction="top">Transfer</md-tooltip>
                            <md-icon class="material-icons-new" style="color:orangered">local_shipping</md-icon>
                        </button>
                        <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="Conduct Button{{$index}}">
                            <md-tooltip md-direction="top">Deploy</md-tooltip>
                            <md-icon class="material-icons-new" style="color:green;">near_me
                            </md-icon>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
            <tbody ng-else>
            <tr>
                <td colspan="8" style="text-align:center">No Other Unit Approval Records Found...!</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</md-content>