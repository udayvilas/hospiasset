<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <div ng-include="'includes/my_call_alerts'"></div>
        <div>
            <h3 class="heading-stylerespond">Non Scheduled Calls</h3>
            <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
                <!-- <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
                 <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
                <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="non_sheduled_search_new.fromdate" mdp-max-date="maxDate" ></mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <mdp-date-picker mdp-placeholder=" To Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="non_sheduled_search_new.todate" ></mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

                <md-input-container class="md-block" flex-gt-sm  flex="25">
                    <label>Departments</label>
                    <md-select ng-model="non_sheduled_search_new.dept_id" name="reasons">
                        <md-option ng-repeat="dept in depts "  ng-value="dept.CODE">
                            {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                        </md-option>
                    </md-select>
                </md-input-container>
                <md-button class="md-icon-button md-raised md-accent" ng-click="getSCCallsNew()" md-theme="default" aria-label="submit">
                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                </md-button>
            </div>

        </div>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <table class="md-api-table table table-bordered" ng-cloak style="margin-bottom: 0px;">
                <thead>
                <tr>
                    <th style="width:15%">Eq Id</th>
                    <th style="width:15%">Eq Name</th>
                    <th style="width:8%">Dept</th>
                    <th style="width:8%">Serial no</th>
                    <th style="width:15%">Assignes By</th>
                    <th style="width:8%">Completed By</th>
                </tr>
                </thead>
                <tbody ng-if="!isEmpty(scr_calls_news)">
                <tr ng-repeat="scr_calls_new in scr_calls_news">
                    <td>{{scr_calls_new.EID}}</td>
                    <td>{{scr_calls_new.equp_name}}</td>
                    <td>{{scr_calls_new.CALLER_DEPT}}</td>
                    <td>{{scr_calls_new.serial_number}}</td>
                    <td>{{scr_calls_new.assigned_by}}</td>
                    <td>{{scr_calls_new.Responded_by}}</td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="7" style="text-align:center">No Devices Found...!</td>
                </tr>
                </tbody>
            </table>

        </div>

        <div flex layout="row" class="marginb-10" ng-if="no_of_recs!=0">
            <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                    <md-tooltip md-direction="top">Total Records</md-tooltip>
                    {{no_of_recs}}
                </md-button>
            </div>
            <div flex="20" hide-xs hide-sm><!-- Space --></div>
            <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getSCCallsNew(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>