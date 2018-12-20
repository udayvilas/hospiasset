<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
	<div ui-sref="home.{{user_role_code | lowercase}}_today_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row"  class="widget md-whiteframe-z2"  style="background-color:#009688;" layout="column" layout-margin>
	  <div flex layout="row">
	  	<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;"> call </md-icon>
	   <div style="color:#fff;" layout-align="end">{{call_counts.today_calls_cnt}}</div>
	  </div>
	  <div flex layout="row" layout-align="center center">
		  <span style="color:#FFF;">Open Calls</span>
	  </div>
	</div>

	<div ui-sref="home.{{user_role_code | lowercase}}_responded_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2"  style="background-color:#dd9106;" layout="column" layout-margin>
	  <div flex  layout="row" layout-align="center center">
	  	<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">call_end</md-icon>
	   <div style="color:#fff;" layout-align="end">{{call_counts.responded_calls_cnt}}</div>
	  </div>
	  <div flex layout="row" layout-align="center center">
		  <span  style="color:#FFF;">Responded Calls</span>
	  </div>
	</div>
	<div ui-sref="home.{{user_role_code | lowercase}}_attended_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2"  style="background-color:#673AB7;" layout="column" layout-margin>
	  <div flex  layout="row">
	  	<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">call_received </md-icon>
	   <div style="color:#fff;" layout-align="end">{{call_counts.attended_calls_cnt}}</div>
	  </div>
	  <div flex layout="row" layout-align="center center">
		  <span style="color:#FFF;">Attended Calls</span>
	  </div>
	</div>
	<div ui-sref="home.{{user_role_code | lowercase}}_propen_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2"  style="background-color:#800;" layout="column" layout-margin>
	  <div flex  layout="row">
	  	<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">settings_phone </md-icon>
	   <div style="color:#fff;" layout-align="end">{{call_counts.pending_calls_cnt}}</div>
	  </div>
	  <div flex layout="row" layout-align="center center">
		  <span style="color:#FFF;">Inprogress Calls</span>
	  </div>
	</div>
	<div  ui-sref="home.{{user_role_code | lowercase}}_completed_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2"  style="background-color:green;" layout="column" layout-margin>
	  <div flex  layout="row">
	  	<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">done_all </md-icon>
	   <div style="color:#fff;" layout-align="end">{{call_counts.completed_calls_cnt}}</div>
	  </div>
	  <div flex layout="row" layout-align="center center">
		  <span style="color:#FFF;">Completed Calls</span>
	  </div>
	</div>
	<div ui-sref="home.{{user_role_code | lowercase}}_pending_pms" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2"  style="background-color:#546E7A;" layout="column" layout-margin>
	  <div flex  layout="row">
	  	<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">sms_failed  </md-icon>
	   <div style="color:#fff;" layout-align="end">{{call_counts.pending_pms}}</div>
	  </div>
	  <div flex layout="row" layout-align="center center">
		  <span style="color:#FFF;">PMS</span></div>
	</div>
	<div ui-sref="home.{{user_role_code | lowercase}}_pending_qcs" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget md-whiteframe-z2"  style="background-color:rgb(63, 81, 181);" layout="column" layout-margin>
	  <div flex  layout="row">
	  	<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;"> toc </md-icon>
	   <div style="color:#fff;" layout-align="end">{{call_counts.pending_qc}}</div>
	  </div>
	  <div flex layout="row" layout-align="center center">
		<span style="color:#FFF;">QC</span>
	  </div>
	</div>
</div>
<hr style="border:1px solid #DDD;" flex/>
</div>