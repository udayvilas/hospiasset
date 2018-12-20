<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="inputs">
    <div class="row">
	
        <h3 class="heading-stylerespond">Add Org Form</h3>
		
		
        <div style="margin-bottom: 5px;" layout-gt-sm="row" layout-align="space-between center" layout-xs="column" layout-gt-xs="column" layout="row">
            <div flex-xs="100">
                <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
            </div>
            <div flex-xs="100">
                <span style="font-size:12px "><a style="text-decoration: underline" ui-sref="home.{{user_role_code | lowercase}}_import_asset">Click Here</a> to Import Equipments from Excel Sheet</span>
            </div>
        </div>
	<div class="md-whiteframe-2dp mylayout-padding" style="border-radius:5px;">
	<form name="AddDevice" method="POST">
	<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Org Module</label>
                        <md-select ng-model="demog.MODULE_ID" name="module_id" ng-change="getorgform(demog.MODULE_ID)"   aria-label="MODULE_ID">
                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">
                                {{hamodule.MODULE_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
	   <div ng-repeat="item in module_form">
	   <div class="clearfix" ng-if="item.FIELD_TYPE == 'S' && item.FIELD_ID=='100'"></div>
	 <h5  class="sub_heading-style-respond"  ng-if="item.FIELD_TYPE=='S' && item.FIELD_ID=='100'">{{item.FIELD_DESC}}</h5>
	 </div>
	  <div ng-repeat="item in module_form">
	 <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
	<div  ng-if="item.FIELD_TYPE =='T'">	
    <md-input-container>
					<label>{{item.FIELD_DESC}}</label>
					<input type="text" ng-model="demog[item.DB_FIELD]" ng-required="item.MANDETORY == 'Y'" />		
				</md-input-container>				
				</div>
				<!--<div  ng-if="item.FIELD_TYPE =='D'">
	
    <md-input-container>
					<label>{{item.FIELD_DESC}}</label>
					<md-select ng-model="demog[demo.Q_ID]" ng-required="item.MANDETORY == 'Y'" >
							<md-option value="{{opt.split('|')[0]}}" ng-repeat="opt in item.OPT_ARR" >{{opt.split('|')[0]}}</md-option>
						</md-select>		
				</md-input-container>		
				</div>-->
				<!--<div ng-if="item.FIELD_TYPE =='S'">
				<md-input-container>
				<label>{{item.FIELD_DESC}}
				<input type="text" ng-model="demog[item.Q_ID]" ng-required="item.MANDETORY == 'Y'" />		
				</md-input-container>				
				</div>
				<div flex="5" hide-xs hide-sm><!----><!--</div>--->
							
</div>



</div>
  <div ng-repeat="item in module_form">
	   <div class="clearfix" ng-if="item.FIELD_TYPE == 'S' && item.FIELD_ID=='101'"></div>
	 <h5  class="sub_heading-style-respond"  ng-if="item.FIELD_TYPE=='S' && item.FIELD_ID=='101'">{{item.FIELD_DESC}}</h5>
	 </div>	
		<div class="row" style="margin-top: 15px;">
		<div flex layout="row" layout-align="center center">
		<input type="submit" class="md-button md-raised md-accent"  layout-align="center center"  ng-click="SaveValues()"   aria-label="buttonsd" value="Save">
		<md-button class="md-raised md-default" aria-label="submit" ng-click="equipment_clear();" ui-sref="home.view_devies">Cancel</md-button>
		</div>
	</div>
	</form>
     </div>
	</div>
</md-content>