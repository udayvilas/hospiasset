<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
  <div layout="column">
    <h3 class="heading-stylerespond">Print Labels</h3>
    <div layout-align="center center" layout="row">
      <md-input-container ng-show="user_role_code==HMADMIN" flex="20">
        <label>Select Branch</label>
        <md-select ng-model="user_branch" aria-label="plbranch" ng-change="branch_all_loading(user_branch)">
          <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
        </md-select>
      </md-input-container>
      <div flex="5" hide-xs hide-sm>
        <!-- Space -->
      </div>
      <!---<md-input-container flex="20"><label>Select Department</label><md-select ng-change="PrintLables(pl_depatment)"						   ng-model="pl_depatment" name="all_depts"><md-option ng-value="all">All</md-option><md-option  ng-repeat="dept in depts" ng-value="dept.CODE">{{dept.USER_DEPT_NAME}} ({{dept.CODE}})</md-option></md-select></md-input-container>---->
      <md-autocomplete flex="20" class="md-block" flex-gt-sm                             ng-value="pl_depatment=searched.CODE"                             md-no-cache="false"                             md-selected-item="searched.CODE"                             md-search-text="searchDepartment"                          
	  md-items="item in searchTextChange(searchDepartment)"                             md-item-text="item.USER_DEPT_NAME"                             md-selected-item-change="PrintLables(pl_depatment)"                          
	  md-min-length="0"                             
	  md-floating-label="Department">
        <md-item-template>
          <span md-highlight-text="searchText"   md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
        </md-item-template>
        <md-not-found>                  
		No Department Found               
		</md-not-found>
      </md-autocomplete>
      <span ng-value="pl_depatment=searched.CODE.CODE" ></span>
    </div>
    <div layout="row" layout-wrap flex>
      <div flex-xs="100" flex="50" ng-if="prnt_device_ids.length!=0">
        <md-checkbox aria-label="Select All" ng-checked="pd_isChecked()" md-indeterminate="pd_isIndeterminate()" ng-click="pd_toggleAll()">
          <span ng-if="pd_isChecked()">Un-</span>Select All
        </md-checkbox>
      </div>
    </div>
    <div layout="column" ng-if="isObject(prnt_devices) && !isEmpty(prnt_devices)">
      <div layout="row" layout-wrap>
        <div flex="30" ng-repeat="prnt_dvc in prnt_devices" style="margin-bottom:10px;">
          <table style="border-collapse:collapse;border:1px solid #000;" class border="1" height='20px'>
            <tr>
              <td rowspan='5' style='padding:0px;'>
                <md-checkbox ng-checked="pd_exists(prnt_dvc.E_ID, pd_selected)" ng-click="pd_toggle(prnt_dvc.E_ID, pd_selected)" aria-label="{{prnt_dvc.E_ID}}">
                  <span> Select</span>
                </md-checkbox>
                <br>
                  <img src="{{prnt_dvc.QR_CODE}}" width="80px" height="80px">
                  </td>
                  <td>Eq.ID</td>
                  <td>{{prnt_dvc.E_ID}}</td>
                </tr>
                <tr>
                  <td>Dept</td>
                  <td>{{prnt_dvc.DEPT_NAME ? prnt_dvc.DEPT_NAME : prnt_dvc.DEPT_ID}}</td>
                </tr>
                <tr>
                  <td>Eq.Name</td>
                  <td>{{prnt_dvc.E_NAME}}</td>
                </tr>
                <tr>
                  <td>Serial No</td>
                  <td>{{prnt_dvc.ES_NUMBER}}</td>
                </tr>
                <tr>
                  <td>Model</td>
                  <td>{{prnt_dvc.E_MODEL}}</td>
                </tr>
              </table>
            </div>
          </div>
          <div layout="row" layout-wrap layout-align="center center">
            <input ng-if="pd_selected.length!=0" type="button" value="print" class="md-raised md-accent md-button md-ink-ripple" ng-click="wordPrintLables()" aria-label="print"/>
          </div>
        </div>
        <div layout="column" ng-if="!isObject(prnt_devices)" layout-align="center center">				{{prnt_devices}}		</div>
      </div>
    </md-content>