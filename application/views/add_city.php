<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add City</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addCityForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="column" ng-repeat="cities in citieslabelslist">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{cities.COUNTRY_NAME}}</label>
                        <md-select ng-model="add_city.country" name="country" ng-change="getStateDetailsByCountryID(add_city.country);add_city.states=''" required aria-label="country">
                            <md-option ng-repeat="country in countries" ng-value="country.COUNTRY_CODE">                                
							{{country.COUNTRY_NAME}}
							</md-option>
                        </md-select>                      
						<div ng-messages="addCityForm.country.$error">		
						<div ng-message=="required">Required.</div>			
						</div>
                    </md-input-container>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{cities.STATE_NAME}}</label>
                        <md-select ng-model="add_city.states" ng-disabled="add_city.country==null" name="states" required aria-label="states">
                            <md-option ng-repeat="state in country_states" ng-value="state.STATE_CODE">{{state.STATE_NAME}}</md-option>
                        </md-select>                     
						<div ng-messages="addCityForm.states.$error">			
						<div ng-message=="required">Required.</div>			
						</div>
                    </md-input-container>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{cities.CITY_NAME}}</label>
                        <input type="text" ng-disabled="add_city.states==null" required ng-model="add_city.city_name" name="city_name" aria-label="city_name"/>               
						<div ng-messages="addCityForm.city_name.$error">			
						<div ng-message=="required">Required.</div>			
						</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{cities.CITY_CODE}}</label>
                        <input type="text" ng-disabled="add_city.states==null" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" ng-change="add_city.city_code = (add_city.city_code | uppercase)" required ng-minlength="3" ng-maxlength="3" ng-model="add_city.city_code" name="city_code" aria-label="city_code"/>                      
						<div ng-messages="addCityForm.city_code.$error">	
						<div ng-message=="required">Required.</div>			
						<div ng-show="addCityForm.city_code.$error.maxlength">Max length is Exceeds</div>
						<div ng-show="addCityForm.city_code.$error.minlength">Min is required 3</div>					
						</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <div flex layout="row" layout-align="center center">
                   
                        <md-button class="md-raised md-accent" ng-click="addCity(add_city)" ng-disabled="addUserForm.$invalid" aria-label="submit">Submit</md-button>                        <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hmadmin_cities">Cancel</md-button>
                      
                </div>
            </form>
        </div>
    </div>
</md-content>