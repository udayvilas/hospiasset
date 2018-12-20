<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<form name="RegFormV" class="ng-hide my-show-hide-animation" ng-hide="uc_divs.vendor_div">
<div layout="row">
    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> account_box </md-icon>
      <input type="text" ng-pattern="/^[a-zA-Z\s]*$/" required ng-model="reguser.rvusername" name="rvusername" placeholder="Your Full Name" aria-label="rv username"/>
      <div ng-messages="RegFormV.rvusername.$error" multiple md-auto-hide="true">
        <div ng-message="required">Required.</div>
        <div ng-message="pattern">Only Alphabets Allows!</div>
      </div>
    </md-input-container>

    <md-input-container  class="flex-50">
      <md-icon md-font-set="material-icons" flex> contact_phone </md-icon>
      <input type="text" ng-pattern="/^[0-9]{8,15}$/" required ng-model="reguser.rvnumber" name="rvnumber" placeholder="Contact Number" aria-label="rv contact number"/>
        <div ng-messages="RegFormV.rvnumber.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
          <div ng-message="pattern">Enter Valid Number!</div>
        </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container  class="flex-50">
      <md-icon md-font-set="material-icons" flex> domain </md-icon>
      <input type="text" ng-pattern="/^[a-zA-Z\s]*$/" required ng-model="reguser.rvname" name="rvname" placeholder="Company Name" aria-label="rv company name"/>
        <div ng-messages="RegFormV.rvname.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
          <div ng-message="pattern">Only Alphabets Allows!</div>
        </div>
    </md-input-container>

    <md-input-container  class="flex-50">
      <md-icon md-font-set="material-icons" flex> location_city </md-icon>
      <md-select placeholder="Choose Country" name="rvcountry" required ng-model="reguser.rvcountry" md-on-open="loadCountries()">
        <md-option ng-value="country.COUNTRY_CODE" ng-repeat="country in countries">{{country.COUNTRY_NAME}}</md-option>
      </md-select>
      <div class="md-errors-spacer"></div>
      <div ng-messages="RegFormV.rvcountry.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
        </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container  class="flex-50">
      <md-icon md-font-set="material-icons" flex> location_city </md-icon>
      <md-select placeholder="Choose State" name="rvstate" required ng-model="reguser.rvstate" md-on-open="loadStatesbyCountry(reguser.rvcountry)">
        <md-option ng-value="state.STATE_CODE" ng-repeat="state in states">{{state.STATE_NAME}}</md-option>
      </md-select>
      <div class="md-errors-spacer"></div>
      <div ng-messages="RegFormV.rvstate.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
        </div>
    </md-input-container>

    <md-input-container  class="flex-50">
        <md-icon md-font-set="material-icons" flex> location_city </md-icon>
        <md-select placeholder="Choose City" name="rvcity" required ng-model="reguser.rvcity" md-on-open="loadCitiesbyState(reguser.rvstate)">
          <md-option ng-value="city.CITY_CODE" ng-repeat="city in cities">{{city.CITY_NAME}}</md-option>
        </md-select>
        <div class="md-errors-spacer"></div>
        <div ng-messages="RegFormV.rvcity.$error" multiple md-auto-hide="true">
            <div ng-message="required">Required</div>
          </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container class="flex-100">
      <md-icon md-font-set="material-icons" flex> location_on </md-icon>
      <textarea name="rvlocation" ng-model="reguser.rvlocation" placeholder="Company Location" required md-maxlength="250"></textarea>
        <div ng-messages="RegFormV.rvlocation.$error" multiple>
          <div ng-message="required">Required</div>
          <div ng-message="md-maxlength">Maximum 250 Charecters Only!</div>
        </div>
    </md-input-container>
</div>
<div layout="row">
    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> contact_mail </md-icon>
      <input type="email" ng-pattern="/^.+@.+\..+$/" required ng-model="reguser.rvemail" name="rvemail" placeholder="Email Address" aria-label="rvemailid"/>
        <div ng-messages="RegFormV.rvemail.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
          <div ng-message="pattern">Enter Valid Email Address!</div>
        </div>
    </md-input-container>

    <md-input-container class="flex-50">
      <md-icon md-font-set="material-icons" flex> lock </md-icon>
      <input type="password" required ng-model="reguser.rvpswrd" name="rvpswrd" placeholder="Enter Password" aria-label="rv password"/>
        <div ng-messages="RegFormV.rvpswrd.$error" multiple md-auto-hide="true">
          <div ng-message="required">Required</div>
        </div>
    </md-input-container>
</div>
<div layout="row " layout-align="center center">
    <md-button class="md-raised md-accent" ng-disabled="RegFormV.$invalid" aria-label="register">Register</md-button>
</div>
</form>