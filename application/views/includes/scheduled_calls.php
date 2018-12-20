<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
<div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container ng-scope layout-xs-column layout-md-row layout-row flex-gt-sm">

    <div flex="40" hide-xs hide-sm>&nbsp;&nbsp;</div>
    <div ui-sref="home.{{user_role_code | lowercase}}_pending_pms" flex="12" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2 layout-margin layout-xs-row  flex-xs-100 flex-gt-sm-66 flex-12" style="background-color:#546E7A;" layout="column" layout-margin="">
        <div flex="" layout="row" class="layout-row flex">
            <md-icon md-font-set="material-icons" flex="" layout-align="start" style="color:#fff;" class="material-icons layout-align-start-stretch flex">sms_failed  </md-icon>
            <div style="color:#fff;" layout-align="end">{{call_counts.pending_pms}}</div>
        </div>
        <div flex="" layout="row" layout-align="center center" class="layout-align-center-center layout-row flex">
            <span style="color:#FFF;">Pending PMS's</span></div>
    </div>
    <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;</div>
    <div ui-sref="home.{{user_role_code | lowercase}}_pending_qcs" flex="12" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2 layout-margin layout-xs-row layout-column flex-xs-100 flex-gt-sm-66 flex-12" style="background-color:rgb(63, 81, 181);" layout="column" layout-margin="">
        <div flex="" layout="row" class="layout-row flex">
            <md-icon md-font-set="material-icons" flex="" layout-align="start" style="color:#fff;" class="material-icons layout-align-start-stretch flex"> toc </md-icon>
            <div style="color:#fff;" layout-align="end">{{call_counts.pending_qc}}</div>
        </div>
        <div flex="" layout="row" layout-align="center center" class="layout-align-center-center layout-row flex">
            <span style="color:#FFF;">Pending QC's</span>
        </div>
    </div>
    <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;</div>
    <div ui-sref="home.{{user_role_code | lowercase}}_completed_pms" flex="12" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2 layout-margin layout-xs-row layout-column flex-xs-100 flex-gt-sm-66 flex-12" style="background-color:#1A237E" layout="column" layout-margin="">
        <div flex="" layout="row" class="layout-row flex">
            <md-icon md-font-set="material-icons" flex="" layout-align="start" style="color:#fff;" class="material-icons layout-align-start-stretch flex">  check_circle  </md-icon>
            <div style="color:#fff;" layout-align="end">{{call_counts.completed_pms}}</div>
        </div>
        <div flex="" layout="row" layout-align="center center" class="layout-align-center-center layout-row flex">
            <span style="color:#FFF;">Completed PMS</span>
        </div>
    </div>
    <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;</div>
    <div ui-sref="home.{{user_role_code | lowercase}}_completed_qcs" flex="12" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2 layout-margin layout-xs-row layout-column flex-xs-100 flex-gt-sm-66 flex-12" style="background-color:#00838F" layout="column" layout-margin="">
        <div flex="" layout="row" class="layout-row flex">
            <md-icon md-font-set="material-icons" flex="" layout-align="start" style="color:#fff;" class="material-icons layout-align-start-stretch flex">   playlist_add_check   </md-icon>
            <div style="color:#fff;" layout-align="end">{{call_counts.completed_qcs}}</div>
        </div>
        <div flex="" layout="row" layout-align="center center" class="layout-align-center-center layout-row flex">
            <span style="color:#FFF;">Completed QC</span>
        </div>
    </div>		<div ui-sref="home.hbhod_pending_scheduled" flex="12" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2 layout-margin layout-xs-row layout-column flex-xs-100 flex-gt-sm-66 flex-12" style="background-color:#00838F" layout="column" layout-margin="">        <div flex="" layout="row" class="layout-row flex">            <md-icon md-font-set="material-icons" flex="" layout-align="start" style="color:#fff;" class="material-icons layout-align-start-stretch flex">   playlist_add_check   </md-icon>            <div style="color:#fff;" layout-align="end">{{call_counts.pending_scheduled}}</div>        </div>        <div flex="" layout="row" layout-align="center center" class="layout-align-center-center layout-row flex">            <span style="color:#FFF;">Pending Scheduled</span>        </div>    </div>
    <div flex="40" hide-xs hide-sm>&nbsp;&nbsp;</div>
</div>
</div>
</md-content>