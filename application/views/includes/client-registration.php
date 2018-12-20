<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<form name="RegForm" class="ng-hide my-show-hide-animation" ng-hide="uc_divs.client_div">
<div layout="row">
    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> account_box </md-icon>
      <input type="text" ng-pattern="/^[a-zA-Z\s]*$/" required ng-model="reguser.rcusername" name="rcusername" placeholder="Full Name" aria-label="rc username"/>
      <div ng-messages="RegForm.rcusername.$error" multiple md-auto-hide="true">
        <div ng-message="required">Required.</div>
        <div ng-message="pattern">Only Alphabets Allows!</div>
      </div>
    </md-input-container>

    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> contact_phone </md-icon>
      <input type="text" ng-pattern="/^[0-9]{8,15}$/" required ng-model="reguser.rcnumber" name="rcnumber" placeholder="Contact Number" aria-label="rc contact number"/>
        <div ng-messages="RegForm.rcnumber.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
          <div ng-message="pattern">Enter Valid Number!</div>
        </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container class="flex-50">
    <md-icon md-font-set="material-icons" flex> location_city </md-icon>
    <md-select placeholder="Choose Country" name="rccountry" required ng-model="reguser.rccountry" md-on-open="loadCountries()">
      <md-option ng-value="country.COUNTRY_CODE" ng-repeat="country in countries">{{country.COUNTRY_NAME}}</md-option>
    </md-select>
    <div class="md-errors-spacer"></div>
    <div ng-messages="RegForm.rccountry.$error" multiple md-auto-hide="true">
        <div ng-message="required">Required</div>
      </div>
    </md-input-container>

    <md-input-container class="flex-50">
    <md-icon md-font-set="material-icons" flex> location_city </md-icon>
    <md-select placeholder="Choose State" name="rcstate" required ng-model="reguser.rcstate" md-on-open="loadStatesbyCountry(reguser.rccountry)">
    <md-option ng-value="state.STATE_CODE" ng-repeat="state in states">{{state.STATE_NAME}}</md-option>
    </md-select>
    <div class="md-errors-spacer"></div>
    <div ng-messages="RegForm.rcstate.$error" multiple md-auto-hide="true">
        <div ng-message="required">Required</div>
      </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> location_city </md-icon>
      <md-select placeholder="Choose City" name="rccity" required ng-model="reguser.rccity" md-on-open="loadCitiesbyState(reguser.rcstate)">
        <md-option ng-value="city.CITY_CODE" ng-repeat="city in cities">{{city.CITY_NAME}}</md-option>
      </md-select>
      <div class="md-errors-spacer"></div>
      <div ng-messages="RegForm.rccity.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
      </div>
    </md-input-container>

    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> location_on </md-icon>
      <textarea name="rclocation" ng-model="reguser.rclocation" placeholder="Location/Address" required md-maxlength="250"></textarea>
        <div ng-messages="RegForm.rclocation.$error" multiple>
          <div ng-message="required">Required</div>
          <div ng-message="md-maxlength">Maximum 250 Charecters Only!</div>
        </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> contact_mail </md-icon>
      <input type="email" ng-pattern="/^.+@.+\..+$/" required ng-model="reguser.rcemail" name="rcemail" placeholder="Email Address" aria-label="rcemailid"/>
        <div ng-messages="RegForm.rcemail.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
          <div ng-message="pattern">Enter Valid Email Address!</div>
        </div>
    </md-input-container>

    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> lock </md-icon>
      <input type="password" required ng-model="reguser.rcpswrd" name="rcpswrd" placeholder="Enter Password" aria-label="rc password"/>
        <div ng-messages="RegForm.rcpswrd.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
        </div>
    </md-input-container>
</div>
<div layout="row" layout-align="center center">
    <md-button class="md-raised md-accent" ng-disabled="RegForm.$invalid" aria-label="register">Register</md-button>
</div>
</form>