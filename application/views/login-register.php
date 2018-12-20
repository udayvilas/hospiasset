<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login_style.css?<?php echo time(); ?>">
<style>
  body{
    background-image:url('<?= base_url() ?>assets/images/bg_login.png');
    background-repeat: no-repeat;
    background-size: cover;
    width:100%;
    height:100%;
  }
</style>
  <div layout="row" layout-align="center center" layout-fill ng-cloak flex style="">
    <div class="mylayout-padding" style="overflow-x: hidden;">
      <div class="row" style="background-color:#e9e8c4;display:block;position:absolute;top:13%;left:18%">
        <div class="col-lg-9 hidden-xs" style="padding: 0px;">
          <img src="<?= base_url() ?>assets/images/ha_logo_main.jpg" class="img-responsive" />
        </div>
        <md-divider style="border-top-style: none;"></md-divider>
        <div class="col-lg-3" md-theme="inputs">
          <img src="<?= base_url() ?>assets/images/renown_logo.png" class="img-responsive" style="margin-top: 20%;" />
          <form class="form" layout="column" name="LoginForm" autocomplete="off" style="background-color: #FFFFFF;border-radius: 0px;">
            <div class="" style="color:#848a85"><h5>LOGIN HERE</h5></div>
            <input type="text" required ng-model="lgn.username" name="username" class="form-control" placeholder="Employee Id" aria-label="username" autofocus/>
            <span id="valid"></span>
            <input type="password" required ng-model="lgn.password" class="form-control" name="password" placeholder="Password" aria-label="password"/>
            <!--
              <select ng-required="isArray(user_lbranches)" ng-show="isArray(user_lbranches)" ng-model="lgn.branch" name="branch" aria-label="branch" class="select-form" required ng-options="user_lbranch.BRANCH_ID as user_lbranch.BRANCH_NAME for user_lbranch in user_lbranches">
              <option value="">----------Select-----------</option>
            </select>
            -->
            <center>
            <md-button class="md-button md-raised md-accent" ng-disabled="LoginForm.$invalid" aria-label="login" type="submit" name="submit" ng-click="defaultLogin(lgn)">{{login_text}}</md-button>
              </center>
          </form>
          <!--<div layout="row" layout-align="space-around">
            <a style="font-size: 12px;text-decoration: underline;color: #00447f;margin-top: 3%;" class="md-primary">Forgot password?</a>
          </div>-->
          <div layout="row" layout-align="space-around">
            <a style="font-size: 12px;text-decoration: underline;color: #00447f;margin-top: 2%;" ui-sref="callgeneration" class="md-primary">
              Guest Login
            </a>
          </div>
          <div layout="row" layout-align="space-around" style="margin-top:10px;">
            <a href="https://play.google.com/store/apps/details?id=com.renown.hospiasset" target="_blank" class="md-primary"><img src="<?php echo base_url();?>/assets/images/google_play_img.png" style="width:120px;height:50px;"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div flex layout="row" class="footer fixed-footer-bottom" layout-align="center center">
    <a href="http://www.renownanalytics.com" target="_blank" style="color:#fff">Powered by <img src="<?= base_url()?>assets/images/company_logo.png"></a>
  </div>