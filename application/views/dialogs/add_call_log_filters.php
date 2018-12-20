<div layout="row">
    <md-input-container class="md-block">
        <label>Call Cost</label>
        <input type="text"   ng-model="calllog_report_search.call_cost" name="call_cost" only-digits="only-digits"  aria-label="call_cost"/>
    </md-input-container>
    <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
    <md-input-container class="md-block" flex-gt-sm flex="20">
        <label style="color:#000000 !important;">Contract Vendor *</label>
        <md-select ng-model="calllog_report_search.vendor" name="vendor"  aria-label="vendor">
            <md-option ng-repeat="sprt_vendr in sprt_vendrs" ng-value="sprt_vendr.ID">
                {{sprt_vendr.NAME}}
            </md-option>
        </md-select>
    </md-input-container>
    <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
    <div>
        <mdp-time-picker ng-model="calllog_report_search.completed_time" mdp-format="HH:mm A" mdp-placeholder="Completed Time"></mdp-time-picker>
    </div>
    <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
    <mdp-time-picker name="timeFormat" ng-model="calllog_report_search.responded_time" mdp-format="HH:mm A" mdp-placeholder="Responded Time">
    </mdp-time-picker>
</div>