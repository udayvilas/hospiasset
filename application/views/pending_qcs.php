<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
    <!--<div ng-include="'includes/call_alerts'"></div>-->
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
    <div flex flex-xs="100">
        <h3 class="heading-stylerespond">Pending QC </h3>
    </div>
        <div ng-if="user_role_code==HMADMIN" flex="5" hide-xs hide-sm> </div>
        <md-input-container ng-if="user_role_code==HMADMIN" ng-show="user_role_code==HMADMIN" class="no-margin-padding-md-input" flex="20" flex-xs="100">
            <md-select placeholder="Select Branch *" ng-model="pendingqc_search.branch_id" ng-change="SearchPendingQc()" aria-label="user_branch">
                <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
            </md-select>
        </md-input-container>
    </div>

            <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center" style="margin-top:0px;">
                <md-datepicker  ng-model="pendingqc_search.fromdate" md-placeholder="From Date" md-max-date="maxDate"  flex-gt-sm>
                </md-datepicker>

                <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <md-datepicker  ng-model="pendingqc_search.todate" md-placeholder="To Date" md-max-date="maxDate" flex-gt-sm>
                </md-datepicker>
                <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>

                <md-input-container  class="md-block" flex-gt-sm>
                    <md-select placeholder="Department" ng-model="pendingqc_search.department">
                        <md-option ng-value="nullValue" >
                            Select Department
                        </md-option>
                        <md-option ng-repeat="dept in depts"  ng-value="dept.CODE" >
                            {{dept.USER_DEPT_NAME}}
                        </md-option>
                    </md-select>
                    <div ng-messages="AddDevice.depts.$error">
                        <div ng-message="required">Required</div>
                    </div>
                </md-input-container>
                <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;</div>
                <md-autocomplete class="md-block" flex-gt-sm
                                 md-no-cache="false"
                                 md-selected-item="searched.EID"
                                 md-search-text="searchEid"
                                 md-items="item in searchTextChange(searchEid)"
                                 md-item-text="item.E_ID"
                                 md-min-length="0"
                                 md-floating-label="Search Eq. id?">
                    <md-item-template>
                        <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
                    </md-item-template>
                    <md-not-found>
                        No Equipment Match Found
                    </md-not-found>
                </md-autocomplete>
                <md-button class="md-icon-button md-raised md-accent" ng-click="SearchPendingQc()"  md-theme="default" aria-label="submit">
                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                </md-button>
    </div>
    <div class="clearfix"></div>
    <div layout="row">
          <table class="md-api-table">
               <thead>
               <tr>
                   <th>Eq.ID</th>
                   <th>Last Qc Done</th>
                   <th>Due Date</th>
                   <th>Assigned By</th>
                   <th>Assigned To</th>
                   <th>Action</th>
               </tr>
               </thead>
               <tbody ng-if="pqc_devices!=null">
               <tr ng-repeat="pqc_device in pqc_devices">
                   <td>{{pqc_device.EID}}</td>
                   <td>{{pqc_device.QC_DONE}}</td>
                   <td>{{pqc_device.QC_DUE}}</td>
                   <td>{{pqc_device.Assigned_by}}</td>
                   <td>{{pqc_device.Assigned_to}}</td>
                   <td style="text-align: center;">
                       <div ng-if="pqc_device.ASSIGNED_TO==user_id">
                           <button class="btn btn-xs btn-default" ng-click="PendingQcDialog($event,pqc_device)" aria-label="QC Button{{$index}}">
                               <md-tooltip md-direction="top">Pending QC</md-tooltip>
                               <md-icon class="material-icons-new" style="color:#ffa602">sms_failed</md-icon>
                           </button>
                       </div>
                       <div ng-elif="pqc_device.ASSIGNED_TO==null">
                           <button class="btn btn-xs btn-default" ng-click="PendingQcDialog($event,pqc_device)" aria-label="QC Button{{$index}}">
                               <md-tooltip md-direction="top">Pending QC</md-tooltip>
                               <md-icon class="material-icons-new" style="color:#ffa602">sms_failed</md-icon>
                           </button>
                       </div>

                       <div ng-else>
                           <button ng-disabled="true" class="btn btn-xs btn-default" aria-label="QC Button{{$index}}">
                               <md-icon class="material-icons-new" style="color:#614da4">sms_failed</md-icon>
                           </button>
                       </div>
                   </td>
               </tr>
               </tbody>
              <tbody ng-else>
              <tr>
                  <td colspan="8" style="text-align:center">No calls Found...!</td>
              </tr>
              </tbody>
          </table>
     </div>
     </div>
</md-content>
