<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content layout="column" class="mylayout-padding" ng-cloak>

    <h3 class="heading-stylerespond">Completed Rounds</h3>
       <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
       <!--<md-button ui-sref="home.{{user_role_code | lowercase}}_rounds_assign" class="md-raised md-accent md-default">Assign</md-button>-->
           <mdp-date-picker mdp-placeholder="From" name="from_date" flex="20" mdp-format="DD-MM-YYYY" ng-model="rounds_completed_search.fromdate" mdp-max-date="maxDate">
           </mdp-date-picker>

        <div flex="1" hide-xs hide-sm>&nbsp;&nbsp; </div>
           <mdp-date-picker mdp-placeholder="To" name="to_date" flex="20" mdp-format="DD-MM-YYYY" ng-model="rounds_completed_search.todate" mdp-min-date="rounds_completed_search.fromdate">
           </mdp-date-picker>
        <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <md-input-container flex="20" class="md-block" flex-gt-sm>
            <label>Department</label>
            <md-select ng-model="rounds_completed_search.department">
                <md-option ng-repeat="dept in depts"  ng-value="dept.CODE" >
                    {{dept.USER_DEPT_NAME}}
                </md-option>
            </md-select>
            <div ng-messages="AddDevice.depts.$error">
                <div ng-message="required">Required</div>
            </div>
        </md-input-container>
        <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;</div>

        <center>
            <md-button class="md-icon-button md-raised md-primary" ng-click="loadRoundCompleted(0)"  md-theme="default" aria-label="submit">
                <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
        </center>
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
            <tbody ng-if="round_complets!=null">
            <tr ng-repeat="round_complet in round_complets">
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
    <div flex layout="row" class="marginb-10"  ng-if="round_complets!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadRoundCompleted(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>
