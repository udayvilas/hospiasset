<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Utillization Values</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addEqUtillForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label> Equipment Usage</label>
                        <input type="text" required ng-model="add_utlization.util_name" name="util_name" md-maxlength="50" aria-label="util_name"/>
                        <div ng-messages="addEqUtillForm.util_name.$error">
                            <div ng-message="required">Required.</div>                            
							<div ng-message="md-maxlength">Max limit is reached.</div>                           
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Code</label>
                        <input type="text" required ng-model="add_utlization.util_value" name="util_value" ng-pattern= "/^[a-zA-Z. ]*[a-zA-Z]$/" ng-change="add_utlization.util_value = (add_utlization.util_value | uppercase)"  md-maxlength="3"   aria-label="util_value"/>
                        <div ng-messages="addEqUtillForm.util_value.$error">
                            <div ng-message="required">Required.</div>                        
							<div ng-message="md-maxlength">Max limit is reached.</div>						
							<div ng-show="addEqUtillForm.util_value.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addUtillValue(add_utlization)" ng-disabled="addEqUtillForm.$invalid" aria-label="submit">Submit</md-button>
                         <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbbme_utlization_value">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>