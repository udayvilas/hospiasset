<div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

	<div ui-sref="home.non_scheduled_calls_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row"  class="widget margin-4"  style="background-color:#00b9ee;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<span flex="20" class=" icon-phone-wave" flex layout-align="start" style="color:#fff;background-color: transparent;border-radius: 0px;width: 24px;height: 24px;font-size: 17px;text-align:left;line-height: 1.5;"></span>
			<div flex="70"></div>
			<div flex="10" style="color:#fff;" layout-align="end">{{mytrans_call_counts.non_sheduled_calls_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Non-Scheduled</span>
		</div>
	</div>
	<div ui-sref="home.scheduled_calls_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#007e7a;" layout="column">
		<div flex class="card-margin-4" layout="row" layout-align="center center">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">today</md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.scheduled_call_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span  style="color:#FFF;">Scheduled Calls</span>
		</div>
	</div>
	<div ui-sref="home.adverse_call_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#353bf0;" layout="column">
		<div flex class="card-margin-4" layout="row" layout-align="center center">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">sync_disabled</md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.completed_adverse_calls}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span  style="color:#FFF;">Adverse</span>
		</div>
	</div>
	<div ui-sref="home.rounds_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#f58f20;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">directions_walk </md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.completed_rounds_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Rounds</span>
		</div>
	</div>
	<div ui-sref="home.transfer_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#ffc425;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">transform </md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.transfers_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Transfers</span>
		</div>
	</div>
	<div ui-sref="home.condemination_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#cbb778;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">delete_sweep  </md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.completed_condemnation_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Condiminations</span></div>
	</div>
	<div ui-sref="home.instalation_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#5986d2;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;"> format_indent_increase </md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.installs_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Installations</span>
		</div>
	</div>

	<div ui-sref="home.gate_pass_new_mytransion" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#c8d255;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">
				call_merge </md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.gatepass_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Gatepass</span>
		</div>
	</div>

	<div ui-sref="home.maintance_contracts_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#c62828;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;"> contacts</md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.contracts_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Contracts</span>
		</div>
	</div>
	<div ui-sref="home.viability_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#2b247d;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">vertical_align_center </md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.viability_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Viability</span>
		</div>
	</div>
	<div ui-sref="home.cear_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#ff1979;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">last_page </md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.cear_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Cear</span>
		</div>
	</div>
	<div ui-sref="home.indent_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#6c1f7d;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">first_page </md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.indent_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Indents</span>
		</div>
	</div>
	<div ui-sref="home.generated_calls_new" flex="10" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#d25d7d;" layout="column">
		<div flex class="card-margin-4" layout="row">
			<md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">
				ring_volume </md-icon>
			<div style="color:#fff;" layout-align="end">{{mytrans_call_counts.generated_calls_cnt}}</div>
		</div>
		<div flex layout="row" layout-align="center center">
			<span style="color:#FFF;">Generated Calls</span>
		</div>
	</div>
</div>