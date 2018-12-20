<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <div ng-include="'includes/my_call_alerts'"></div>
        <div>
            <h3 class="heading-stylerespond">Scheduled Calls</h3>
            <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
                <!-- <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
                 <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
                <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="sheduled_search_new.fromdate" mdp-max-date="maxDate"></mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <mdp-date-picker mdp-placeholder=" To Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="sheduled_search_new.todate" ></mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

                <md-input-container class="md-block" flex-gt-sm  flex="25">
                    <label>Scheduled Type</label>
                    <md-select ng-model="sheduled_search_new.schduled_type" name="reasons">
                        <md-option ng-repeat="sheduled_type in sheduled_types "  ng-value="sheduled_type">
                            {{sheduled_type}}
                        </md-option>
                    </md-select>
                </md-input-container>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

                <md-input-container class="md-block" flex-gt-sm  flex="25">
                    <label>Departments</label>
                    <md-select ng-model="sheduled_search_new.dept_id" name="reasons">
                        <md-option ng-repeat="dept in depts "  ng-value="dept.CODE">
                            {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                        </md-option>
                    </md-select>
                </md-input-container>
                <md-button class="md-icon-button md-raised md-accent" ng-click="getSCCallsNew()()" md-theme="default" aria-label="submit">
                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                </md-button>
            </div>

        </div>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <div ng-show="sheduled_types[0]=='PMS'" flex="100">
                <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                    <thead>
                    <tr>
                        <th>Equipment ID</th>
                        <th>Eq. Name</th>
                        <th>Location</th>
                        <th>Raised By</th>
                        <th>Complaint</th>
                        <th>Dept</th>
                        <th>Type </th>
                        <th>Call Date</th>
                        <th>Status</th>
                        <th>Respond</th>
                        <th>Attend</th>
                        <th>In Progress</th>
                        <th>Complete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-if="cpms_device_new!=null" ng-repeat="cpms_device in cpms_device_new">
                        <td>{{cpms_device.EID}}</td>
                        <td>{{cpms_device.eq_name}}</td>
                        <td>{{cpms_device.location}}</td>
                        <td></td>
                        <td>PMS Call</td>
                        <td>{{cpms_device.department}}</td>
                        <td>{{cpms_device.type}}</td>
                        <td>{{cpms_device.PMS_DONE_DATE}}</td>
                        <td>Completed</td>
                        <td>{{cpms_device.Assigned_by}}</td>
                        <td>{{cpms_device.Assigned_to}}</td>
                        <td></td>
                        <td>{{cpms_device.COMPLETED_BY_NAME}}</td>
                    </tr>
                    <tr ng-if="cqc_device_new!=null" ng-repeat="cqc_device in cqc_device_new">
                        <td>{{cqc_device.EID}}</td>
                        <td>{{cqc_device.eq_name}}</td>
                        <td>{{cqc_device.location}}</td>
                        <td></td>
                        <td>Calibration Call</td>
                        <td>{{cqc_device.department}}</td>
                        <td></td>
                        <td>{{cqc_device.QC_DONE | date : 'dd-MM-yyyy'}}</td>
                        <td>Completed</td>
                        <td>{{cqc_device.Assigned_by}}</td>
                        <td>{{cqc_device.Assigned_to}}</td>
                        <td></td>
                        <td>{{cqc_device.COMPLETED_BY_NAME}}</td>
                    </tr>
                    </tbody>
                    <tbody ng-else>
                    <tr>
                        <td colspan="13" style="text-align:center"> No Completed Pms Found</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>
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