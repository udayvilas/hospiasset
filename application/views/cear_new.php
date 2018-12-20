<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <div>
            <div ng-include="'includes/my_call_alerts'"></div>
            <h3 class="heading-stylerespond">Capital Expenditure Authorization Request(CEAR)</h3>
            <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
                <!-- <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
                 <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
                <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="cear_search_new.fromdate" mdp-max-date="maxDate" ></mdp-date-picker>

                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="cear_search_new.todate"></mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

                <md-input-container class="md-block" flex-gt-sm  flex="25">
                    <label>Departments</label>
                    <md-select ng-model="cear_search_new.dept_id" name="reasons">
                        <md-option ng-repeat="dept in depts "  ng-value="dept.CODE">
                            {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                        </md-option>
                    </md-select>
                </md-input-container>
                <md-button class="md-icon-button md-raised md-accent" ng-click="loadCearNew()" md-theme="default" aria-label="submit">
                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                </md-button>
            </div>

        </div>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th>Cear Number</th>
                    <th>Project Number</th>
                    <th>Project Title</th>
                    <th>Requesting Unit</th>
                    <th>Requesting Category</th>
                    <th>Requesting Department</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody ng-if="cear_list_new!=null">
                <tr ng-repeat="cear_list in cear_list_new">
                <td>{{cear_list.CEAR_ID}}</td>
                <td>{{cear_list.PROJECT_ID}}</td>
                <td>{{cear_list.TITLE}}</td>
                <td>{{cear_list.REQ_UNIT}}</td>
                <td>{{category}}</td>
                <td>{{cear_list.REQ_DEPT}}</td>
                    <td style="text-align: center;">
                        <button ng-click="editCear($event,cear_list)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Edit</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="7" style="text-align:center"> No CEAR Found</td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadCearNew(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>