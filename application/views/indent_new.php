<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">

        <div ng-include="'includes/my_call_alerts'"></div>
        <h3 class="heading-stylerespond">Indents</h3>
        <div>
            <div>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">

                    <mdp-date-picker mdp-placeholder=" From Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="indent_search_new.fromdate" mdp-max-date="maxDate" ></mdp-date-picker>
                    <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                    <mdp-date-picker mdp-placeholder=" To Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="indent_search_new.todate" ></mdp-date-picker>
                    <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

                    <md-input-container class="md-block" flex-gt-sm  flex="25">
                        <label>Departments</label>
                        <md-select ng-model="indent_search_new.dept_id" name="reasons">
                            <md-option ng-repeat="dept in depts "  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <md-button class="md-icon-button md-raised md-accent" ng-click="loadIndentNew()"  md-theme="default" aria-label="submit">
                        <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                    </md-button>
                </div>
            </div>
            </div>


            <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <table class="md-api-table table table-bordered" fixed-header ng-cloak style="width:100%;margin-bottom: 5px;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Dept Id</th>
                    <th ng-hide="user_role_code==HBBME || user_role_code==HBHOD">Branch</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Essential Features</th>
                    <th>Desirous Features</th>
                    <th>Luxurious Features</th>
                    <th>Standard Accessories</th>
                    <th>Optional Accessories</th>
                    <th>Estimated Cost</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody ng-if="indent_equps!=null">
                <tr ng-repeat="indent_equp in indent_equps">
                    <td>{{indent_equp.INDENT_ID}}</td>
                    <td>{{indent_equp.INDENT_TYPE}}</td>
                    <td>{{indent_equp.DEPT}}</td>
                    <td ng-hide="user_role_code==HBBME || user_role_code==HBHOD">{{indent_equp.branch_name}}</td>
                    <td>{{indent_equp.EQ_NAME}}</td>
                    <td>{{indent_equp.QTY}}</td>
                    <td>{{indent_equp.ESNTL_FEATURES}}</td>
                    <td>{{indent_equp.OPTIMAL_FEATURES}}</td>
                    <td>{{indent_equp.OPTIONAL_FEATURES}}</td>
                    <td>{{indent_equp.STNRD_ACCESSORIES}}</td>
                    <td>{{indent_equp.OPTIONAL_ACCESSORIES}}</td>
                    <td>{{indent_equp.ESTIMATED_COST}}</td>
                    <td style="text-align: center;">
                        <button ng-click="editIndentEqupment($event,indent_equp)" ng-show="indent_equp.INDENT_STATUS!==indent_statuss[0]" class="btn btn-xs btn-default" aria-label="Edit" ng-if="user_role_code!=PURCHASE">
                            <md-tooltip md-direction="top">Edit</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                        </button>
                        <button ng-show="user_role_code==HBHOD && indent_equp.no_of_res!=indent_equp.QTY && indent_equp.SANCTION_STATUS==indent_sactioned_statuss[0]" ng-click="addtoStock(indent_equp)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Add Stock</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#614DA4">send</md-icon>
                        </button>
                        <button ng-if="indent_equp.INDENT_TYPE==indent_requests[0] && indent_equp.CEAR_RAISED!=yesstate && user_role_code!=PURCHASE" ng-click="addIndendtCearRequest($event,indent_equp)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Rise CEAR</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#614DA4">add_circle</md-icon>
                        </button>
                        <button ng-if="user_role_code==HMADMIN && indent_equp.SANCTION_STATUS!=indent_sactioned_statuss[0]" class="btn btn-xs btn-default" ng-click="adminApprovedStatus($event,indent_equp)" aria-label="Conduct Button{{$index}}">
                            <md-tooltip md-direction="top">Approved</md-tooltip>
                            <md-icon class="material-icons-new" style="color:deepskyblue">done_all</md-icon>
                        </button>
                        <button ng-if="user_role_code==PURCHASE && indent_equp.SANCTION_STATUS!==indent_sactioned_statuss[0]" class="btn btn-xs btn-default" ng-click="adminSactionedStatus($event,indent_equp)" aria-label="Conduct Button{{$index}}">
                            <md-tooltip md-direction="top">Sanction</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#4FB626">offline_pin</md-icon>
                        </button>
                        <button ng-if="user_role_code==PURCHASE && indent_equp.SANCTION_STATUS==indent_sactioned_statuss[0]" class="btn btn-xs btn-default" ng-disabled="true" ng-click="adminSactionedStatus($event,indent_equp)" aria-label="Conduct Button{{$index}}">
                            <md-tooltip md-direction="top">Sanctioned</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#4FB626">offline_pin</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tbody ng-else>
                <tr>
                    <td colspan="12" style="text-align:center"> No Indent Requests Found</td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadIndentNew(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
</md-content>