<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content layout="column" class="mylayout-padding" ng-cloak>

    <div ng-include="'includes/my_call_alerts'"></div>
    <h3 class="heading-stylerespond">Rounds</h3>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
        <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="rounds_search_new.fromdate" mdp-max-date="maxDate" ></mdp-date-picker>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
        <mdp-date-picker mdp-placeholder=" To Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="rounds_search_new.todate"></mdp-date-picker>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <md-input-container class="md-block" flex-gt-sm  flex="25">
            <label>Departments</label>
            <md-select ng-model="rounds_search_new.dept_id" name="reasons">
                <md-option ng-repeat="dept in depts "  ng-value="dept.CODE">
                    {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                </md-option>
            </md-select>
        </md-input-container>
        <md-button class="md-icon-button md-raised md-accent" ng-click="loadRoundCompletedNew()"  md-theme="default" aria-label="submit">
            <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
        </md-button>
    </div>

    <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>User name</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Remarks </th>
                <th>Suggestions</th>

            </tr>
            </thead>
            <tbody ng-if="round_complets_new!=null">
            <tr ng-repeat="round_complet in round_complets_new">
                <td>{{round_complet.Username}}</td>
                <td>{{round_complet.DEPT_ID}}</td>
                <td>{{round_complet.Designation}}</td>
                <td>{{round_complet.START_DATE | date:'dd-MM-yyyy'}}</td>
                <td>{{round_complet.START_TIME | date:'hh:mm:ss a'}}</td>
                <td>{{round_complet.END_TIME | date:'hh:mm:ss a'}}</td>
                <td>{{round_complet.SUGESSIONS}}</td>
                <td>{{round_complet.REMARKS}}</td>
            </tr>
            </tbody>
            <tbody ng-else>
            <tr>
                <td colspan="8" style="text-align:center">No Rounds Found, Please Select a Department to Search..</td>
            </tr>
            </tbody>
        </table>

    </div>
    <div flex layout="row" class="marginb-10"  ng-if="round_complets_new!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadRoundCompletedNew(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>
