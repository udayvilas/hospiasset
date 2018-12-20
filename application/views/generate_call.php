<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
    <h3 class="heading-stylerespond">Select Call Criteria</h3>
	<div layout-gt-sm="row" layout-xs="column" layout-align="center center" layout-gt-xs="column" layout="row">
		<md-input-container flex="25">
	    <label>Equipment ID</label>
	    	<md-select ng-model="cgsd.device_id" name="device_id">
	    		  <md-option ng-value="allValue">Select Equipment ID</md-option>
	              <md-option ng-repeat="cg_device in cg_devices"  ng-value="cg_device.E_ID">
	                {{cg_device.E_ID}}
	              </md-option>
	    	</md-select>
	    </md-input-container>
		<!--<div flex="20" hide-xs hide-sm><!-- Space </div>
		 <div flex="25" flex-sm="50" flex-md="30" layout-align="end end">
               <md-button ui-sref="home.incident" class="md-raised">Incident Call</md-button>
           </div>-->
	</div>
	<div layout-gt-sm="row" layout-xs="column" layout-align="center center" layout-gt-xs="column" layout="row">
	(OR)
	</div>
	<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
	    <md-input-container class="md-block" flex-gt-sm>
	    <label>Equipment Name</label>
	     <md-select ng-model="cgsd.device_name" name="device_name">
			 <md-option ng-value="allValue">{{allValue}}</md-option>
	        <md-option ng-repeat="cg_equp_name in cg_equp_names" ng-value="cg_equp_name.E_NAME">{{cg_equp_name.E_NAME}}</md-option>
	     </md-select>
	    </md-input-container>

	 	<div flex="5" hide-xs hide-sm><!-- Space --></div>

	    <md-input-container class="md-block" flex-gt-sm>
	    <label>Equipment Type</label>
	     <md-select ng-model="cgsd.device_type" name="cgsd.device_type">
             <md-option ng-value="allValue">{{allValue}}</md-option>
	        <md-option ng-repeat="cg_equp_type in cg_equp_types" ng-value="cg_equp_type.CODE">
	        {{cg_equp_type.TYPE}}
	        </md-option>
	      </md-select>
	    </md-input-container>

	     <div flex="5" hide-xs hide-sm><!-- Space --></div>

	    <md-input-container class="md-block" flex-gt-sm>
	    <label>Company Name</label>
	     <md-select ng-model="cgsd.device_company" name="device_company">
             <md-option ng-value="allValue">{{allValue}}</md-option>
          <md-option ng-repeat="cg_equp_company in cg_equp_companies" ng-value="cg_equp_company.C_NAME">
            {{cg_equp_company.C_NAME}}
          </md-option>
         </md-select>
	    </md-input-container>
	</div>
	<div layout-gt-sm="row" flex layout-xs="column" layout-gt-xs="column" layout="row">
	    <md-input-container class="md-block" flex-gt-sm>
	    <label>Present Condition</label>
	     <md-select ng-model="cgsd.equp_condition" name="equp_condition">
             <md-option ng-value="allValue">{{allValue}}</md-option>
	        <md-option ng-repeat="cg_equp_condition in cg_equp_conditions" ng-value="cg_equp_condition.EVAL">{{cg_equp_condition.ECODE}}</md-option>
	     </md-select>
	    </md-input-container>

	 	<div flex="5" hide-xs hide-sm><!-- Space --></div>

	    <md-input-container class="md-block" flex-gt-sm>
	    <label>Department Name</label>
	     <md-select ng-model="cgsd.cg_equp_depart" name="cg_equp_depart">
             <md-option ng-value="allValue">{{allValue}}</md-option>
	        <md-option ng-repeat="cg_equp_depart in cg_equp_departs" ng-value="cg_equp_depart.DEPT_ID">
	        {{cg_equp_depart.DEPT_NAME}}
	        </md-option>
	      </md-select>
	    </md-input-container>

	    <div flex="5" hide-xs hide-sm><!-- Space --></div>
	    <md-input-container class="md-block">
	    <md-button type="submit" class="md-raised md-accent md-button md-ink-ripple" ng-click="CallGenerationsearchDevice(cgsd)" aria-label="submit">Search</md-button>
	    </md-input-container>
	    <div flex="20" hide-xs hide-sm></div>
	</div>
	<div flex layout="row" ng-if="cg_rdevices!=null">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Equipment ID</th>
                <th>Equipment</th>
                <th>Company</th>
                <th>Department</th>
                <th>Present Condition</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="cg_rdevice in cg_rdevices">
                <td>{{cg_rdevice.E_ID}}</td>
                <td>{{cg_rdevice.E_NAME}}</td>
                <td>{{cg_rdevice.C_NAME}}</td>
                <td>{{cg_rdevice.DEPT_NAME}}</td>
                <td>{{cg_rdevice.PRSNT_COND}}</td>
                <td><md-button class="md-fab md-mini md-accent" ng-click="generateCall($event,cg_rdevice.E_ID)" aria-label="{{cg_rdevice.E_ID}}">Go</md-button></td>
            </tr>
            </tbody>
        </table>
	</div>
    </div>
</md-content>