<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <div ng-include="'includes/my_call_alerts'"></div>
        <div>
            <h3 class="heading-stylerespond">Instalations</h3>
            <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
                <!-- <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
                 <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
                <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="install_search_new.fromdate" mdp-max-date="maxDate" ></mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <mdp-date-picker mdp-placeholder=" To Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="install_search_new.todate"></mdp-date-picker>
                <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

                <md-input-container class="md-block" flex-gt-sm  flex="25">
                    <label>Departments</label>
                    <md-select ng-model="install_search_new.dept_id" name="reasons">
                        <md-option ng-repeat="dept in depts "  ng-value="dept.CODE">
                            {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                        </md-option>
                    </md-select>
                </md-input-container>
                <md-button class="md-icon-button md-raised md-accent" ng-click="UndeployedDevicesnew()" md-theme="default" aria-label="submit">
                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                </md-button>
            </div>

        </div>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <table class="md-api-table table table-bordered">
                <thead>
                <tr>
                    <th>Equipment Name</th>
                    <th>Equipment Model</th>
                    <th>PO No.</th>
                    <th>Serial No.</th>
                    <th>Vendor</th>
                    <th>Contract Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody ng-if="!isEmpty(ud_devices)">
                <tr ng-repeat="ud_device in ud_devices">
                    <td>{{ud_device.E_NAME}}</td>
                    <td>{{ud_device.E_MODEL}}</td>
                    <td>{{ud_device.PONO}}</td>
                    <td>{{ud_device.ES_NUMBER}}</td>
                    <td>{{ud_device.VENDOR_NAME}}</td>
                    <td>{{ud_device.AMC_TYPE}}</td>
                    <td style="text-align: center;">
                        <button class="btn btn-xs btn-default" ng-click="UndeployedDevicesnew(ud_device.ID)" aria-label="Deploy Button{{$index}}">
                            <md-tooltip md-direction="top">Deploy</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#a2a46d">near_me</md-icon>
                        </button>
                    </td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="UndeployedDevices(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>