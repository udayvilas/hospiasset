<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="inputs">
    <div  class="row">
	
        <h3 class="heading-stylerespond">Add Device</h3>
		
		
        <div style="margin-bottom: 5px;" layout-gt-sm="row" layout-align="space-between center" layout-xs="column" layout-gt-xs="column" layout="row">
            <div flex-xs="100">
                <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
            </div>
            <div flex-xs="100">
                <span style="font-size:12px "><a style="text-decoration: underline" ui-sref="home.{{user_role_code | lowercase}}_import_asset">Click Here</a> to Import Equipments from Excel Sheet</span>
            </div>
        </div>
		</div>
		 <!--<div ng-repeat="item in module_forms"  class="row">
        <div class="col-xs-4">{{item.FIELD_TYPE}}</div>
        <div class="col-xs-4">{{item.FIELD_TYPE}}</div>
        <div class="col-xs-4">{{item.FIELD_TYPE}}</div>
    </div>--->

	<div class="row" style="border-radius:5px;">
	<form name="AddDevice" method="POST">
	   <div ng-repeat="item in module_forms">
	   <div class="clearfix" ng-if="item.FIELD_TYPE == 'S' && item.FIELD_ID=='100'"></div>
	 <h5  class="sub_heading-style-respond"  ng-if="item.FIELD_TYPE=='S' && item.FIELD_ID=='100'">{{item.FIELD_DESC}}</h5>
	 </div>
	  <div ng-repeat="item in module_forms"  class="row">
	<div   class="col-xs-4">
    <div ng-if="item.FIELD_TYPE == 'T' && item.FIELD_ID != '214' && item.FIELD_ID != '213' && item.FIELD_ID != '209' && item.FIELD_ID != '210' && item.FIELD_ID != '212' && item.FIELD_ID !='219' && item.FIELD_ID != 220 && item.FIELD_ID !='203' && item.FIELD_ID !='206'">	
    <md-input-container>
					<label>{{item.FIELD_DESC}}</label>
					<input type="text" ng-model="demog[item.DB_FIELD]" ng-required="item.MANDETORY == 'Y'" />		
				       <div ng-messages="AddDevice.demog[item.DB_FIELD].$error">						
					   <div ng-message=="required">Required.</div>	
					   </div>
				</md-input-container>				
				</div>
				</div>
				<div  class="col-xs-4">
                  <div ng-if="item.FIELD_TYPE =='DA'">				
   			
						<!--<mdp-date-picker  mdp-placeholder="{{item.FIELD_DESC}}" id="{{'datepic' + $index }}" name="{{'datepic' + $index }}"  ng-model="demog[item.DB_FIELD]" ng-required="item.MANDETORY == 'Y'">
						</mdp-date-picker>-->
					
					<md-datepicker md-placeholder="{{item.FIELD_DESC}}" id="{{'datepic' + $index }}" name="{{'datepic' + $index }}"
                                       ng-model="demog[item.DB_FIELD]"
                                       ng-required="item.MANDETORY == 'Y'"
                        ></md-datepicker>
				</div>
				</div>
				<div  class="col-xs-4">
	             <div ng-if="item.FIELD_TYPE=='D'">
                        <md-input-container>
					<label>{{item.FIELD_DESC}}</label>
					<!--<md-select ng-model="demog[item.DB_FIELD]" ng-change="getorgmastertable({{item.DB_FIELD}})"  ng-required="item.MANDETORY == 'N'">
						  <md-option ng-repeat="itm in dropdown_master" ng-value="{{itm.code}}" >{{itm.name}}</md-option>
						</md-select>-->
                   <md-select  ng-required="item.MANDETORY == 'Y'" ng-model="demog[item.DB_FIELD]">
                        <md-option ng-value="nullValue">Select Type</md-option>
                        <md-option  ng-value="{{itm.code}}"  ng-repeat="itm in item.masters">{{itm.name}}</md-option>
                    </md-select>
				</md-input-container>
					</div>
				<!--<div ng-if="item.FIELD_TYPE=='AT'">
				<md-autocomplete class="md-block" flex="20"
							 md-input-name="{{item.FIELD_DESC}}"
                         md-no-cache="false"
						 ng-value="add_device.cat=searched.DID"
                         md-selected-item="searched.DID"
                         md-search-text="searchEcategory"
                         md-items="item in searchTextChange(searchEcategory)"
                         md-item-text="item.NAME1"
							 md-search-text-change="item.searchTextChange(item.searchText)"
							 md-search-text="item.searchText"
                             md-selected-item-change="item.selectedItemChange(item)"
							 md-floating-label="{{item.FIELD_DESC}}">
				<!--<md-item-template>
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.CODE}}</span>
				</md-item-template>
			</md-autocomplete>--->
           <!--<span ng-value="item.CODE = searched.ORG_ID.ORG_ID" ></span>-->
		  
                 		</div>	
				</div>				
</div>

  <div ng-repeat="item in module_forms">
	   <div class="clearfix" ng-if="item.FIELD_TYPE == 'S' && item.FIELD_ID=='101'"></div>
	 <h5  class="sub_heading-style-respond"  ng-if="item.FIELD_TYPE=='S' && item.FIELD_ID=='101'">{{item.FIELD_DESC}}</h5>
	 </div>	
		<div class="row" style="margin-top: 15px;">
		<div flex layout="row" layout-align="center center">
		<input type="submit" class="md-button md-raised md-accent"  layout-align="center center" ng-click="SaveValues(demog)"    aria-label="submit">
		<md-button class="md-raised md-default" aria-label="submit" ng-click="equipment_clear();" ui-sref="home.view_devies">Cancel</md-button>
		</div>
	</div>
	</form>
	</div>
</md-content>