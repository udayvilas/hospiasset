<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

	<div ui-sref="home.{{user_role_code | lowercase}}_today_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#007e7a;" layout="column">
		<div flex class="card-margin-4" layout="row" layout-align="center center">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">today</md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.tickets_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span  style="color:#FFF;">Total Calls</span>
		</div>
	</div>
	<div ui-sref="home.open_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row"  class="widget margin-4"  style="background-color:#00b9ee;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<span flex="20" class=" icon-phone-wave" flex layout-align="start" style="color:#fff;background-color: transparent;border-radius: 0px;width: 24px;height: 24px;font-size: 17px;text-align:left;line-height: 1.5;"></span>
			<div flex="70"></div>
			<div flex="10" style="color:#fff;" layout-align="end">{{call_counts.today_calls_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Non-scheduled</span>
		</div>
	</div>

	<div ui-sref="home.{{user_role_code | lowercase}}_responded_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#353bf0;" layout="column">
		<div flex class="card-margin-4" layout="row" layout-align="center center">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">call_end</md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.responded_calls_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span  style="color:#FFF;">Assigned Calls</span>
		</div>
	</div>
	<div ui-sref="home.{{user_role_code | lowercase}}_attended_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#f58f20;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">call_received </md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.attended_calls_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">In Progress Calls</span>
		</div>
	</div>
	<div ui-sref="home.{{user_role_code | lowercase}}_propen_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#ffc425;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">settings_phone </md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.pending_calls_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">On Hold Calls</span>
		</div>
	</div>
	<div ui-sref="home.{{user_role_code | lowercase}}_pending_pms" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#cbb778;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">sms_failed  </md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.pending_pms}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">PMS</span></div>
	</div>
	<div ui-sref="home.{{user_role_code | lowercase}}_pending_qcs" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#2989c3;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;"> toc </md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.pending_qc}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Calibration</span>
		</div>
	</div>

	<div ui-sref="home.adverse_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#5dd27c;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">
				sync_disabled </md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.adverse_incidents_count}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Adverse</span>
		</div>
	</div>

	<div ui-sref="home.rounds_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#c62828;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;"> directions_walk</md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.rounds_count}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Rounds</span>
		</div>
	</div>
	<div ui-sref="home.transfer_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#2b247d;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">compare_arrows </md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.transfers_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Transfers</span>
		</div>
	</div>
	<div ui-sref="home.condemnation_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#ff1979;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">delete_sweep </md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.condemnation_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Condemnations</span>
		</div>
	</div>
	<div ui-sref="home.{{user_role_code | lowercase}}_completed_calls" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#6c1f7d;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">done_all </md-icon>
			<div style="color:#fff;" layout-align="end">{{call_counts.completed_calls_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Completed Calls</span>
		</div>
	</div>
</div>
<hr style="border:1px solid #DDD;" flex/>
</div>