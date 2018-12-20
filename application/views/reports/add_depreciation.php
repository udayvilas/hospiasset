<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Depreciation Value</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addDepreciationForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="column">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Name</label>
                        <input type="text" required ng-model="add_depreciation.equipment_name" name="equipment_name" aria-label="equipment_name"/>
						<div ng-messages="addDepreciationForm.equipment_name.$error">						
							<div ng-message=="required">Required.</div>	
						</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Percentage</label>
                        <input type="text" required ng-model="add_depreciation.percentage"   name="percentage" aria-label="percentage"/>
						<div ng-messages="addDepreciationForm.percentage.$error">
							<div ng-message=="required">Required.</div>
						</div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="addDepreciation(add_depreciation)" ng-disabled="addDepreciationForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-accent" ng-click="switchState('home.depreciation')" aria-label="cancel">Cancel</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>