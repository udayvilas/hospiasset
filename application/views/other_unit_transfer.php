<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content layout="column" class="mylayout-padding" ng-cloak>
    <h3 class="heading-stylerespond">Other Unit Transfer</h3>
    <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Branch Id</th>
                <th>Department</th>
                <th>Equp Name</th>
                <th>Physical Location</th>
                <th>Feedback </th>
                <th>Person Name</th>
                <th>Date & Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody ng-if="Other_unit_transfers!=null">
            <tr ng-repeat="Other_unit_transfer in Other_unit_transfers">
                <td>{{Other_unit_transfer.branchname}}</td>
                <td>{{Other_unit_transfer.department}}</td>
                <td>{{Other_unit_transfer.ename}}</td>
                <td>{{Other_unit_transfer.PHYSICAL_LOCATION}}</td>
                <td>{{Other_unit_transfer.FEEDBACK}}</td>
                <td>{{Other_unit_transfer.username}}</td>
                <td>{{Other_unit_transfer.DATE_TIME+'000' | date : "dd-MM-yyyy hh:mm a"}}</td>
                <td>
                    <md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="OtherUnitTransfer($event,Other_unit_transfer)" aria-label="Conduct Button{{$index}}">
                        <md-tooltip md-direction="top">Approval</md-tooltip>
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:mediumblue"></i>
                       </ng-md-icon>
                    </md-button>
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
</md-content>
</md-content>