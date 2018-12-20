<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
  <div layout="column">
    <h3 class="heading-stylerespond">GatePass Request</h3>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="start center">
      <md-button ng-click="addnewGatePass($event)" class="md-raised md-primary">Add New</md-button>
      <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
    </div>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
      <table class="md-api-table table table-bordered" ng-cloak style="width:100%;margin-bottom: 5px;">
        <thead>
          <tr>
            <th>Branch</th>
            <th>Department</th>
            <th>Eq. ID</th>
            <th>Location</th>
            <th>To Whom</th>
            <th>Gate pass Type</th>
            <th>Expected Return</th>
            <th>Spares</th>
            <th>Spares Count</th>
            <th>Accessories</th>
            <th>Accessories Count</th>
            <th>Reasons</th>
            <th>Remarks</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody ng-if="!isEmpty(add_gate_pass)">
          <tr ng-repeat="add_gate_pas in add_gate_pass track by $index">
            <td>{{add_gate_pas.branch_id}}                    
              <td>{{add_gate_pas.dept_id}}</td>
              <td>{{add_gate_pas.device_id}}</td>
              <td>{{add_gate_pas.phy_location}}</td>
              <td>{{add_gate_pas.to_whom}}</td>
              <td>{{add_gate_pas.gtype}}</td>
              <td>{{add_gate_pas.expert_return}}</td>
              <td>{{add_gate_pas.critical_spare}}</td>
              <td>{{add_gate_pas.spars_cnt}}</td>
              <td>{{add_gate_pas.accessories}}</td>
              <td>{{add_gate_pas.accessories_cnt}}</td>
              <td>{{add_gate_pas.reasons}}</td>
              <td>{{add_gate_pas.remarks}}</td>
              <td style="text-align: center;">
                <button ng-click="editGatePassnew($event,add_gate_pas)"  class="btn btn-xs btn-default" aria-label="Edit">
                  <md-tooltip md-direction="top">Edit</md-tooltip>
                  <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                </button>
                <button ng-click="removeGatepass(add_gate_pas)"  class="btn btn-xs btn-default" aria-label="Edit">
                  <md-tooltip md-direction="top">Delete</md-tooltip>
                  <md-icon class="material-icons-new" style="color:#614DA4">highlight_off</md-icon>
                </button>
              </td>
            </tr>
          </tbody>
          <tbody ng-else>
            <tr>
              <td colspan="12" style="text-align:center">No GatePass Added </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div flex layout="row" layout-align="end center">
        <md-button class="md-raised md-accent" ng-click="addGatePass(add_gate_pass)"  aria-label="submit" style="float:left">Submit</md-button>
      </div>
    </div>
  </md-content>
</div>