<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><md-content class="mylayout-padding" ng-cloak>    <div layout="column">        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">            <div flex flex-xs="100">                <h3 class="heading-stylerespond">Inprogress Calls</h3>            </div>            <div ng-if="user_role_code==HMADMIN" flex="5" hide-xs hide-sm> </div>            <md-input-container class="no-margin-padding-md-input" flex="20" flex-xs="100">                <md-select placeholder="Select Branch *" ng-model="pprocesscall_search.branch_id" ng-change="SearchProcessPendimgCalls()" aria-label="user_branch">                    <md-option ng-value="branch.BRANCH_ID" ng-selected="branch.BRANCH_ID == 'All'" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>                </md-select>            </md-input-container>        </div>        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">            <md-datepicker  ng-model="pprocesscall_search.fromdate" md-placeholder="From Date" md-max-date="maxDate"  flex-gt-sm>            </md-datepicker>            <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>            <md-datepicker  ng-model="pprocesscall_search.todate" md-placeholder="To Date" md-max-date="maxDate" flex-gt-sm>            </md-datepicker>            <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>            <md-input-container  class="md-block" flex-gt-sm>                <label>Department</label>                <md-select ng-model="pprocesscall_search.department">                    <md-option ng-value="nullValue" >                        Select Department                    </md-option>                    <md-option ng-repeat="dept in depts"  ng-value="dept.CODE" >                        {{dept.USER_DEPT_NAME}}                    </md-option>                </md-select>                <div ng-messages="AddDevice.depts.$error">                    <div ng-message="required">Required</div>                </div>            </md-input-container>            <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;</div>            <md-autocomplete class="md-block" flex-gt-sm                             md-no-cache="false"                             md-selected-item="searched.EID"                             md-search-text="searchEid"                             md-items="item in searchTextChange(searchEid)"                             md-item-text="item.E_ID"                             md-min-length="0"                             md-floating-label="Search Eq. id?">                <md-item-template>                    <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>                </md-item-template>                <md-not-found>                    No Equipment Match Found                </md-not-found>            </md-autocomplete>            <center>                <md-button class="md-icon-button md-raised md-accent" ng-click="SearchProcessPendimgCalls()"  md-theme="default" aria-label="submit">                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>                </md-button>            </center>        </div>        <div layout="row">            <table class=" md-api-table table table-bordered">                <thead>                <tr>                    <th>Caller ID</th>                    <th>Equipment ID</th>                    <th>Complaint</th>                    <th>Caller</th>                    <th>Dept</th>                    <th>Contract Type </th>                    <th>Call Date</th>                    <th>Attended By</th>                    <th>Pending Reason</th>                    <th>Status</th>                    <th ng-if="user_role_code==HBHOD">Remind</th>                </tr>                </thead>                <tbody ng-if="ppc_devices!=null">                <tr ng-repeat="ppc_device in ppc_devices">                    <td>{{ppc_device.CALLER_ID}}</td>                    <td>{{ppc_device.EID}}</td>                    <td>{{ppc_device.NATURE_OF_COMP}}</td>                    <td>{{ppc_device.CALLER_UNAME}}</td>                    <td>{{ppc_device.DEPT_NAME}}</td>                    <td>{{ppc_device.TYPE}}</td>                    <td>{{ppc_device.CDATETIME+'000' | date:'dd-MM-yyyy hh:mm a'}}</td>                    <td>{{ppc_device.ATTENDEE_NAME}}</td>                    <td>{{ppc_device.PENDING_REASON}}</td>                    <td>{{ppc_device.STATUS}}</td>                    <td ng-if="user_role_code==HBHOD">                        <md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="RemindtoBME(ppc_device,call_alert_type[2])" aria-label="Conduct Button{{$index}}">                            <md-tooltip md-direction="top">Remind</md-tooltip>                            <i class="fa fa-bell-o" aria-hidden="true" style="color:#ffa076"></i>                        </md-button>                    </td>                </tr>                </tbody>                <tbody ng-else>                <tr>                    <td colspan="10" style="text-align:center">No calls Found...!</td>                </tr>                </tbody>            </table>        </div>    </div></md-content>