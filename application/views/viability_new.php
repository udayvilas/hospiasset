<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <div>
            <div ng-include="'includes/my_call_alerts'"></div>
            <h3 class="heading-stylerespond">Viability</h3>
            <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
                <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="viability_search_new.fromdate" mdp-max-date="maxDate" ></mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <mdp-date-picker mdp-placeholder=" To Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="viability_search_new.todate" ></mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <md-input-container class="md-block" flex-gt-sm  flex="25">
                    <label>Departments</label>
                    <md-select ng-model="viability_search_new.dept_id" name="reasons">
                        <md-option ng-repeat="dept in depts "  ng-value="dept.CODE">
                            {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                        </md-option>
                    </md-select>
                </md-input-container>
                <md-button class="md-icon-button md-raised md-accent" ng-click="getViabilityNew()"  md-theme="default" aria-label="submit">
                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                </md-button>
            </div>
        </div>
        <div layout-gt-sm="row" layout="row" >
            <table class="md-api-table table table-bordered" style="width:100%;">
                <thead>
                <tr>
                    <th style="width:15%">Equp ID</th>
                    <th style="width:15%">Dept</th>
                    <th style="width:8%">Cost of Consumables</th>
                    <th style="width:8%">Disposable Cost</th>
                    <th style="width:8%">No.of Cases Per Day</th>
                    <th style="width:8%">Code Operation</th>
                    <th style="width:8%">Advantages</th>
                    <th style="width:8%">Action</th>
                </tr>
                </thead>
                <tbody ng-if="!isEmpty(viability_list)">
                <tr ng-repeat="viabilty in viability_list">
                    <td>{{viabilty.E_ID}}</td>
                    <td>{{viabilty.DEPT_ID}}</td>
                    <td>{{viabilty.COST_OF_CONSUMABLES}}</td>
                    <td>{{viabilty.DISPOSABLE_COST}}</td>
                    <td>{{viabilty.NO_CASES_DONE_DAILY}}</td>
                    <td>{{viabilty.CHRGS_PER_OPE}}</td>
                    <td>{{viabilty.ADVANTAGES}}</td>
                    <td>
                        <button ng-if="user_role_code!=HMADMIN" ng-click="EditViability($event,viabilty)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Edit</md-tooltip>
                            <md-icon class="material-icons-new" style="color: #614da4;">edit</md-icon>
                        </button>
                        <button ng-if="user_role_code!=HMADMIN" ng-click="pdfViabilityReportTCPDF($event,viabilty)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Pdf</md-tooltip>
                            <md-icon class="material-icons-new" style="color: #614da4;">picture_as_pdf</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tbody ng-if="viability_list==null">
                <tr>
                    <td colspan="10" class="text-center">No Devices Found...</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div flex layout="row" class="marginb-10">
            <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                    <md-tooltip md-direction="top">Total Records</md-tooltip>
                    {{no_of_recs}}
                </md-button>
            </div>
            <div flex="20" hide-xs hide-sm><!-- Space --></div>
            <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getViabilityNew(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>