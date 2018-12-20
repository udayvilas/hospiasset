<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="column">
        <div ng-include="'includes/my_call_alerts'"></div>
        <h3 class="heading-stylerespond">Contracts</h3>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
            <!-- <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
             <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
            <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="contracts_search_new.fromdate" mdp-max-date="maxDate" ></mdp-date-picker>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
            <mdp-date-picker mdp-placeholder=" To Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="contracts_search_new.todate" ></mdp-date-picker>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

            <md-input-container class="md-block" flex-gt-sm  flex="25">
                <label>Departments</label>
                <md-select ng-model="contracts_search_new.dept_id" name="reasons">
                    <md-option ng-repeat="dept in depts "  ng-value="dept.CODE">
                        {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                    </md-option>
                </md-select>
            </md-input-container>
            <md-button class="md-icon-button md-raised md-accent" ng-click="loadMaintanceContractsNew()"  md-theme="default" aria-label="submit">
                <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
        </div>
        <div layout="row" flex>
            <table class="md-api-table table table-bordered">
                <thead>
                <tr>
                    <th style="width: 15%">Eq. ID</th>
                    <th style="width: 17%">Eq. Name</th>
                    <th style="width: 21%">Vendor Name</th>
                    <th style="width: 10%">Contract Type</th>
                    <th style="width: 8%">Contract From</th>
                    <th style="width: 8%">Contract To</th>
                    <th style="width: 8%">Status</th>
                    <th style="width: 8%">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-if="m_contracts!=null && m_contracts!='undefined'" ng-repeat="m_contract in m_contracts">
                    <td>{{m_contract.EID}}</td>
                    <td>{{m_contract.eq_name}}</td>
                    <td>{{m_contract.VENDOR_NAME}}</td>
                    <td>{{m_contract.AMC_TYPE}}</td>
                    <td>
                        <div ng-if="m_contract.AMC_FROM!=null && m_contract.AMC_FROM!='1970-01-01'">
                            {{m_contract.AMC_FROM | date:"dd-MM-yyyy"}}
                        </div>
                        <div ng-else>-</div>
                    </td>
                    <td>
                        <div ng-if="m_contract.AMC_TO!=null && m_contract.AMC_TO!='1970-01-01'">
                            {{m_contract.AMC_TO | date:"dd-MM-yyyy"}}
                        </div>
                        <div ng-else>-</div>
                    </td>
                    <td>{{m_contract.status}}</td>
                    <td style="text-align: center;">
                        <button ng-click="editMContracts($event,m_contract)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Edit</md-tooltip>
                            <md-icon class="material-icons-new" style="color: #614da4;">mode_edit</md-icon>
                        </button>
                        <button ng-click="editRenuvalType($event,m_contract)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Renewal Type</md-tooltip>
                            <md-icon class="material-icons-new" style="color: rgb(68,138,255);">settings_backup_restore</md-icon>
                        </button>
                    </td>
                </tr>
                <tr ng-if=m_contracts==null || m_contracts=='undefined'>
                    <td colspan="8" class="text-center">No Contracts Found</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div flex layout="row" class="marginb-10"  ng-if="m_contracts!=null">
            <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                    <md-tooltip md-direction="top">Total Records</md-tooltip>
                    {{no_of_recs}}
                </md-button>
            </div>
            <div flex="20" hide-xs hide-sm><!-- Space --></div>
            <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadMaintanceContractsNew(paging.current,mcontract.expiry_in)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>