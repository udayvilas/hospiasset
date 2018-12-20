<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
  md-card md-card-title
  {
    /*padding-top: 0px;*/
  }
</style>
<div layout="column" layout-fill ng-cloak flex>
  <div layout="row" layout-align="center center" layout-fill ng-cloak flex>
  <md-content layout="row" class="mylayout-padding" ng-cloak>
    <md-card class="color-white md-whiteframe-4dp" layout-padding layout="row" layout-sm="row" layout-xs="column">
      <md-card-actions>
        <img src="<?php echo base_url() ?>assets/images/ha_logo_main.jpg" class="img-responsive" />
      </md-card-actions>
      <md-divider></md-divider>
      <md-card-content md-theme="hospiclr">
        <form layout="column" name="LoginForm" autocomplete="off">
          <md-card-title>
            <md-card-title-text layout-align="center center">
              <span class="md-headline">Login </span>
            </md-card-title-text>
          </md-card-title>
          <md-input-container class="md-block">
            <md-icon md-font-set="material-icons" flex> account_circle </md-icon>
            <input only-digits="only-digits" type="text" ng-change="loadUserBranches(lgn.username)" required ng-model="lgn.username" name="username" placeholder="Employee ID" aria-label="username"/>
            <div ng-messages="LoginForm.username.$error">
              <div ng-message="required">Email ID required.</div>
            </div>
          </md-input-container>
          <md-input-container>
            <md-icon md-font-set="material-icons" flex> lock </md-icon>
            <input type="password" required ng-model="lgn.password" name="password" placeholder="Password" aria-label="password"/>
            <div ng-messages="LoginForm.password.$error">
              <div ng-message="required">Password required.</div>
            </div>
          </md-input-container>
          <md-input-container ng-show="user_lbranches!=HMADMIN">
            <md-icon md-font-set="material-icons" flex> business </md-icon>
            <md-select ng-required="user_lbranches!=HMADMIN" placeholder="Select Branch" ng-model="lgn.branch" name="branch" aria-label="branch" style="min-width: 200px;">
              <md-option ng-value="user_lbranch.BRANCH_ID" ng-repeat="user_lbranch in user_lbranches track by $index">{{user_lbranch.BRANCH_NAME}}</md-option>
            </md-select>
            <div ng-messages="LoginForm.branch.$error">
              <div ng-message="required">Select Branch.</div>
            </div>
          </md-input-container>
          <input type="submit" value="{{login_text}}" class="md-raised md-accent md-button md-ink-ripple" ng-click="defaultLogin(lgn)" ng-disabled="LoginForm.$invalid" aria-label="login" />
        </form>
        <div layout="row" layout-align="space-around">
          <a class="md-primary">Forgot password?</a>
        </div>
        <div layout="row" layout-align="space-around">
          <a ui-sref="callgeneration" class="md-primary">Raise Call</a>
        </div>
      </md-card-content>
    </md-card>
  </md-content>
  </div>
  <div flex layout="row" class="footer fixed-footer-bottom" layout-align="center center">
        <a href="http://www.renownanalytics.com" target="_blank" style="color:#fff">Powered by Renown Analytics</a>
  </div>
</div>