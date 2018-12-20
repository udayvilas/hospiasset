<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add State</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addStateForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="column" ng-repeat="states in stateslabelslist">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label >{{states.COUNTRY_NAME}}</label>
                        <md-select ng-model="add_state.county_code" name="country" required aria-label="country">
                            <md-option ng-repeat="country in countries" ng-value="country.COUNTRY_CODE">                                {{country.COUNTRY_NAME}}</md-option>
                        </md-select><div ng-messages="addStateForm.county_code.$error">						<div ng-message=="required">Required.</div>						</div>
                    </md-input-container>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{states.STATE_NAME}}</label>
                        <input type="text" required ng-model="add_state.state_name" name="state_name" aria-label="state_name"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{states.STATE_CODE}}</label>
                        <input type="text" required ng-model="add_state.state_code" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" ng-change="add_state.state_code = (add_state.state_code | uppercase)"  ng-maxlength="2" name="state_code" aria-label="state_code"/>                    
						<div ng-messages="addStateForm.state_code.$error">	
						<div ng-message=="required">Required.</div>
						<div ng-show="addStateForm.state_code.$error.maxlength">Max length is Exceeds</div>	
						<div ng-show="addStateForm.state_code.$error.pattern">Please type text only</div>
						</div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="addState(add_state)" ng-disabled="addStateForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-accent" ng-click="switchState('home.haadmin_states')" aria-label="cancel">Cancel</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>