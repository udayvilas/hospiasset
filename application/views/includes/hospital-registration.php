<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<form name="RegFormH" class="ng-hide my-show-hide-animation" ng-hide="uc_divs.hospital_div">
<div layout="row">
    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> account_box </md-icon>
      <input type="text" ng-pattern="/^[a-zA-Z\s]*$/" required ng-model="reguser.rhusername" name="rhusername" placeholder="Your Full Name" aria-label="rh username"/>
      <div ng-messages="RegFormH.rhusername.$error" multiple md-auto-hide="true">
        <div ng-message="required">Required.</div>
        <div ng-message="pattern">Only Alphabets Allows!</div>
      </div>
    </md-input-container>

    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> contact_phone </md-icon>
      <input type="text" ng-pattern="/^[0-9]{8,15}$/" required ng-model="reguser.rhnumber" name="rhnumber" placeholder="Contact Number" aria-label="rh contact number"/>
        <div ng-messages="RegFormH.rhnumber.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
          <div ng-message="pattern">Enter Valid Number!</div>
        </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> local_hospital </md-icon>
      <input type="text" ng-pattern="/^[a-zA-Z\s]*$/" required ng-model="reguser.rhname" name="rhname" placeholder="Hospital Name" aria-label="rh hospital name"/>
        <div ng-messages="RegFormH.rhname.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
          <div ng-message="pattern">Enter Alphabets Only!</div>
        </div>
    </md-input-container>

    <md-input-container class="flex-50">
    <md-icon md-font-set="material-icons" flex> location_city </md-icon>
    <md-select placeholder="Choose Country" name="rhcountry" required ng-model="reguser.rhcountry" md-on-open="loadCountries()">
      <md-option ng-value="country.COUNTRY_CODE" ng-repeat="country in countries">{{country.COUNTRY_NAME}}</md-option>
    </md-select>
    <div class="md-errors-spacer"></div>
    <div ng-messages="RegFormH.rhcountry.$error" multiple md-auto-hide="true">
        <div ng-message="required">Required</div>
      </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container class="flex-50">
    <md-icon md-font-set="material-icons" flex> location_city </md-icon>
    <md-select placeholder="Choose State" name="rhstate" required ng-model="reguser.rhstate" md-on-open="loadStatesbyCountry(reguser.rhcountry)">
      <md-option ng-value="state.STATE_CODE" ng-repeat="state in states">{{state.STATE_NAME}}</md-option>
    </md-select>
    <div class="md-errors-spacer"></div>
    <div ng-messages="RegFormH.rhstate.$error" multiple md-auto-hide="true">
        <div ng-message="required">Required</div>
      </div>
    </md-input-container>

    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> location_city </md-icon>
      <md-select placeholder="Choose City" name="rhcity" required ng-model="reguser.rhcity" md-on-open="loadCitiesbyState(reguser.rhstate)">
        <md-option ng-value="city.CITY_CODE" ng-repeat="city in cities">{{city.CITY_NAME}}</md-option>
      </md-select>
      <div class="md-errors-spacer"></div>
      <div ng-messages="RegFormH.rhcity.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
        </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container class="flex-100">
      <md-icon md-font-set="material-icons" flex> location_on </md-icon>
      <textarea name="rhlocation" ng-model="reguser.rhlocation" placeholder="Hospital Location/Address" required md-maxlength="250"></textarea>
        <div ng-messages="RegFormH.rhlocation.$error" multiple>
          <div ng-message="required">Required</div>
          <div ng-message="md-maxlength">Maximum 250 Charecters Only!</div>
        </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> contact_mail </md-icon>
      <input type="email" ng-pattern="/^.+@.+\..+$/" required ng-model="reguser.rhemail" name="rhemail" placeholder="Email Address" aria-label="rh emailid"/>
        <div ng-messages="RegFormH.rhemail.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
          <div ng-message="pattern">Enter Valid Email Address!</div>
        </div>
    </md-input-container>
    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> lock </md-icon>
      <input type="password" required ng-model="reguser.rhpswrd" name="rhpswrd" placeholder="Enter Password" aria-label="rh password"/>
        <div ng-messages="RegFormH.rhpswrd.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
        </div>
    </md-input-container>
</div>
<div layout="row" layout-align="center center">
<md-button class="md-raised md-accent" ng-disabled="RegFormH.$invalid" aria-label="register">Register</md-button>
</div>
</form>