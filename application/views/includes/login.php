<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-card-content md-theme="hospiclr">
  <form layout="column" name="LoginForm" autocomplete="off">
      <md-card-title>
        <md-card-title-text layout-align="center center">
          <span class="md-headline">Login </span>
        </md-card-title-text>
      </md-card-title>
      <md-input-container class="md-block">
        <md-icon md-font-set="material-icons" flex> account_circle </md-icon>
        <input type="text" required ng-model="lgn.username" name="username" placeholder="Email ID/Mobile Number" aria-label="username"/>
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
      <input type="submit" value="Login" class="md-raised md-accent md-button md-ink-ripple" ng-click="defaultLogin(lgn)" ng-disabled="LoginForm.$invalid" aria-label="login" />
  </form>
  <div layout="row" layout-align="space-around">
    <a class="md-primary">Forgot password?</a>
  </div>
</md-card-content>