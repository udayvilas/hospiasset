<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Viability</h3>
        <div>
           <!-- <form name="Search" method="post">
                <div flex layout-gt-sm="row"  layout="row">
                    <md-autocomplete class="md-block"  flex-gt-sm flex="20"
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
                    <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	(OR)</div>
                    <md-input-container class="md-block" flex-gt-sm flex="10">
                        <label>Serial No</label>
                        <input type="search" ng-model="viabilty_search.saccessoriesno" name="saccessoriesno" aria-label="saccessoriesno"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
                    <md-input-container class="md-block"  flex-gt-sm flex="15">
                        <label>Eq. Name</label>
                        <input type="text" ng-model="viabilty_search.ename" name="ename" aria-label="ename"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
                    <md-input-container flex="20">
                        <label>Select Department</label>
                        <md-select  ng-model="viabilty_search.dept_id" name="depts">
                            <md-option ng-value="all">All</md-option>
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
                    <md-input-container ng-show="user_role_code==HMADMIN" flex="20">
                        <label>Select Branch</label>
                        <md-select ng-model="viabilty_search.branch_id" aria-label="plbranch">
                            <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm></div>
                    <md-button type="submit" value="Submit" class="md-icon-button md-raised md-primary" ng-click="getViabilityReport()" aria-label="submit">
                        <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                    </md-button>
                </div>
            </form>-->
            <!--ng-if="can_add_viability==yesstate"--->
        </div>
        <div  layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <div flex="33" flex-sm="50" flex-md="50">
                <md-button  ng-if="Add_Viability==Add" ui-sref="home.add_viabilty" class="md-raised md-primary">Add New</md-button>
            </div>
        </div>
        <div layout-gt-sm="row" layout="row" >
            <table class="md-api-table table table-bordered" style="width:100%;">
                <thead>
                <tr>
                    <th style="width:12%">Eq. ID</th>
                    <th style="width:5%">Eq. name</th>
                    <th style="width:5%">Serial No.</th>
                    <th style="width:7%">Contract</th>
                    <th style="width:5%">Dept</th>
                    <th style="width:8%">Cost of Consumables</th>
                    <th style="width:6%">Disposable Cost</th>
                    <th style="width:6%">Cases Per Day</th>
                    <th style="width:8%">Code Operation</th>
                    <th style="width:8%">Advantages</th>
                    <th style="width:8%">Action</th>
                </tr>
                </thead>
                <tbody ng-if="!isEmpty(viability_list)">
                <tr ng-repeat="viabilty in viability_list">
                    <td>{{viabilty.E_ID}}</td>
                    <td>{{viabilty.ename}}</td>
                    <td>{{viabilty.esnumber}}</td>
                    <td>{{viabilty.contract_type}}</td>
                    <td>{{viabilty.DEPT_ID}}</td>
                    <td>{{viabilty.COST_OF_CONSUMABLES}}</td>
                    <td>{{viabilty.DISPOSABLE_COST}}</td>
                    <td>{{viabilty.NO_CASES_DONE_DAILY}}</td>
                    <td>{{viabilty.CHRGS_PER_OPE}}</td>
                    <td>{{viabilty.ADVANTAGES}}</td>
                    <td>
                        <button ng-if="user_role_code!=HMADMIN" ng-disabled="Edit_Viabilty==Edit" ng-click="EditViability($event,viabilty)" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Edit</md-tooltip>
                            <md-icon class="material-icons-new" style="color: #614da4;">edit</md-icon>
                        </button>
                        <button ng-if="user_role_code!=HMADMIN" ng-show="Viability_Generate_PDF==Generate PDF" ng-click="pdfViabilityReportTCPDF($event,viabilty)" class="btn btn-xs btn-default" aria-label="Edit">
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getViability(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>