<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--<md-sidenav style="overflow-x: hidden;" class="md-sidenav-left md-whiteframe-z2" md-component-id="left" md-is-locked-open="$mdMedia('gt-sm')">
    <header class="nav-header" ss-style-color="{'background-color': 'primary.default'}">
        <a href="javascript:void(0)" class="docs-logo" style="background-color: #FFFFFF;padding: 0 0 9px;">
            <img src="<?php echo base_url(); ?>assets/images/ha_logo-mini.png" style="height:40px;width: 84%;" alt="Hospiasset">
        </a>
        <a ui-sref="{{user_path}}" class="docs-logo">
            <img src="<?php echo base_url(); ?>assets/images/care-logo.png" style="height:100px;width: 84%;" alt="Hospiasset">
        </a>
    </header>

    <md-content role="navigation" ss-style-color="{'background-color': 'primary.default'}" flex>
        <ss-sidenav flex menu="menu"></ss-sidenav>
    </md-content>
</md-sidenav>-->
<div layout="column" flex>
    <div ng-include="'includes/dashboard_header-hadmin'" xmlns="http://www.w3.org/1999/html"></div>
    <div layout="column" flex role="main" style="margin-bottom: 27px;">
        <div ui-view flex layout="column"></div>
    </div>
    <div flex layout="row" class="footer fixed-footer-bottom" layout-align="center center">
        <a href="http://www.renownanalytics.com" target="_blank" style="color:#fff">Powered by <img src="<?= base_url()?>assets/images/company_logo.png"></a>
    </div>
</div>
<style>
    body,body > div
    {
        max-width: 100%;
        max-height: 100%;
        overflow: hidden;
    }
    .full-height
    {
        height: 100%;
    }
</style>