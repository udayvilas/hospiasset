<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Country</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addCountryForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="column">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Country Name</label>
                        <input type="text" required ng-model="add_country.country_name" name="country_name" aria-label="country_name"/>                         <div ng-messages="addCountryForm.country_name.$error">						<div ng-message=="required">Required.</div>						</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Country Code</label>
                        <input type="text" required ng-model="add_country.country_code" ng-change="add_country.country_code = (add_country.country_code | uppercase)"  ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" name="country_code" ng-maxlength="3" aria-label="country_code"/>                       <div ng-messages="addCountryForm.county_code.$error">						<div ng-message=="required">Required.</div>						<div ng-show="addCountryForm.country_code.$error.maxlength">Max length is Exceeds</div>						<div ng-show="addCountryForm.country_code.$error.pattern">Please type text only</div>						</div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                   
                        <md-button class="md-raised md-accent" ng-click="addCountry(add_country)" ng-disabled="addCountryForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-accent" ng-click="switchState('home.haadmin_countries')" aria-label="cancel">Cancel</md-button>
                
                </div>
            </form>
        </div>
    </div>
</md-content>