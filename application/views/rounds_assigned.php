<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content layout="column" class="mylayout-padding" ng-cloak>
    <h3 class="heading-stylerespond">Rounds Assigned</h3>
    <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Department</th>
                <th>Assigned By</th>
                <th>Assigned To</th>
                <th>Assigned Date</th>
                <th>Remarks </th>
                <th>Status</th>

            </tr>
            </thead>
            <tbody ng-if="round_assigneds!=null">
            <tr ng-if="round_assigned.exp==nostate" ng-repeat="round_assigned in round_assigneds">
                <td>{{round_assigned.departs}}</td>
                <td>{{round_assigned.assigned_by}}</td>
                <td>{{round_assigned.assigned_to}}</td>
                <td>{{round_assigned.ROUND_DATE}}</td>
                <td>{{round_assigned.REMARKS}}</td>
                <td>{{round_assigned.STATUS}}</td>
            </tr>
        </tbody>
        <tbody ng-else>
        <tr>
            <td colspan="8" style="text-align:center">No Rounds are Assigned...!</td>
        </tr>
        </tbody>
        </table>
    </div>
    <div flex layout="row" class="marginb-10"  ng-if="round_assigneds!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadRoundAssigned(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>

