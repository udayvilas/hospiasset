<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Equipment Summary</h3>
 <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
     <md-input-container ng-show="user_role_code=='abce'" flex="20" flex-xs="100">
         <label>Select Branch</label>
         <md-select ng-model="user_branch" aria-label="user_branch">
             <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
         </md-select>
     </md-input-container>
     <div flex="5" hide-xs hide-sm><!-- Space --></div>
  <md-input-container flex="20" flex-xs="100">
    <label>Select Department</label>
    <md-select ng-model="equp_summary_dept" name="equp_summary" ng-change="equipmentSummary(equp_summary_dept)">
      <md-option ng-value="select_department">{{select_department}}</md-option>
      <md-option ng-value="all">{{all}}</md-option>
      <md-option ng-repeat="equp_dept in equp_depts" ng-value="equp_dept.DEPT_ID">{{equp_dept.DEPT_NAME}}</md-option>
    </md-select>
  </md-input-container>
 </div>
 <div ng-if="equp_summary_dept==select_department">
 <h3 style="background-color:#546E7A;border-radius:5px;color:#fff;font-weight:500;margin:0px;padding:3px;"> Equipment Wise Details </h3>
 <br>
<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center" ng-if="unit_equps!=null">
	<div flex="50">
 	<table class="md-api-table" >
 		<thead>
 		<tr style="text-align:center;">
 			<th>Equipment Name</th>
 			<th>No.of.Equipments(Unitwise)</th>
 			<th>Total</th>
 		</tr>
 		</thead>
 		<tbody>
 		<tr ng-repeat="unit_equp in unit_equps">
 			<td>{{unit_equp.E_NAME}}</td>
 			<td style="text-align:center;">{{unit_equp.TOTAL}}</td>
 			<td>{{unit_equp.TOTAL}}</td>
 		</tr>
 		<tr style="color:#006699;font-weight:bold">
    <td>Total</td>
    <td style="text-align:center;">{{gt_unit_equps}}</td>
    <td>{{gt_unit_equps}}</td>
 		</tr>
 		</tbody>
 	</table>
	</div>	
 </div>
  <h3 style="background-color:#546E7A;border-radius:5px;color:#fff;font-weight:500;margin:0px;padding:3px;"> Company Wise Details </h3><br>
<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
  <div flex="80">
  <table class="md-api-table" border="1">
    <thead>
    <tr style="text-align:center;">
      <th>Company Name</th>
      <th>
      Unitwise - Contract Value (No.of.Equipments)
        <table style="border-collapse:collapse;" width="100%">
        <tr>
        <th>Contract Type</th>
        <th style="text-align:right;">Contract Value(No.of.Equipments)</th>
        <tr>
        </table>
      </th>
      <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="cmpny_equp in cmpny_equps">
      <td>{{cmpny_equp.cname}}</td>
      <td style="text-align:center;">
        <table width="100%">
        <tr rowspan="5">
        <td  style="background-color: transparent;text-align:left;">{{cmpny_equp.A.type}}</td>
         <td  style="background-color: transparent;text-align:right;">{{cmpny_equp.A.dv | currency:''}}({{cmpny_equp.A.dc}})</td>
         </tr>
          <tr>
        <td  style="background-color: transparent;text-align:left;">{{cmpny_equp.B.type}}</td>
         <td  style="background-color: transparent;text-align:right;">{{cmpny_equp.B.dv | currency:''}}({{cmpny_equp.B.dc}})</td>
         </tr>
          <tr>
        <td  style="background-color: transparent;text-align:left;">{{cmpny_equp.C.type}}</td>
         <td  style="background-color: transparent;text-align:right;">{{cmpny_equp.C.dv| currency:''}}({{cmpny_equp.C.dc}})</td>
         </tr>
          <tr>
        <td  style="background-color: transparent;text-align:left;">{{cmpny_equp.W.type}}</td>
         <td  style="background-color: transparent;text-align:right;">{{cmpny_equp.W.dv| currency:''}}({{cmpny_equp.W.dc}})</td>
         </tr>
         <tr style="background-color:#546E7A;color:#006699;font-weight:bold;">
         <td>Sub Total</td>
         <td style="text-align:right;">{{cmpny_equp.dv_stotal| currency:''}}({{cmpny_equp.dc_stotal}})</td>
         </tr>
        </table>
      </td>
      <td>
        <table width="100%">
          <tr rowspan="5">
            <td style="background-color: transparent;text-align:right;">{{cmpny_equp.A.dv| currency:''}}({{cmpny_equp.A.dc}})</td>
            </tr>
            <tr>
            <td style="background-color: transparent;text-align:right;">{{cmpny_equp.B.dv| currency:''}}({{cmpny_equp.B.dc}})</td>
            </tr>
            <tr>
            <td style="background-color: transparent;text-align:right;">{{cmpny_equp.C.dv| currency:''}}({{cmpny_equp.C.dc}})</td>
            </tr>
            <tr>
            <td style="background-color: transparent;text-align:right;">{{cmpny_equp.W.dv| currency:''}}({{cmpny_equp.W.dc}})</td>
          </tr>
          <tr style="background-color:#546E7A;color:#006699;font-weight:bold;">
         <td style="text-align:right;">{{cmpny_equp.dv_stotal| currency:''}}({{cmpny_equp.dc_stotal}})</td>
         </tr>
        </table>

      </td>
    </tr>
 <tr style="color:#006699;font-weight:bold">
    <td>Total</td>
    <td style="text-align:right;"> {{c_wise.amc_gtotal | currency:''}}({{c_wise.equp_gtotal}})</td>
    <td>{{c_wise.amc_gtotal | currency:''}}({{c_wise.equp_gtotal}})</td>
    </tr>
    </tbody>
  </table>
  </div>  
 </div>
 </div>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center" ng-if="sequp_depts!=null">
        <table  class="md-api-table">
            <thead>
            <tr style="text-align:center;">
                <th>Equipment ID</th>
                <th>Equipment Name</th>
                <th>Equipment Type</th>
                <th>Department</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="sequp_dept in sequp_depts | orderBy : 'DEPT_NAME'">
                <td>{{sequp_dept.E_ID}}</td>
                <td>{{sequp_dept.E_NAME}}</td>
                <td>{{sequp_dept.E_TYPE}}</td>
                <td>{{sequp_dept.DEPT_NAME}}</td>
            </tr>
            </tbody>
        </table>

     </div>
    </div>
</md-content>