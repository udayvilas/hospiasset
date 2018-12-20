<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="column">
        <h3 class="heading-stylerespond">Depreciation</h3>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container"></div>
        <div>
            <form name="Search" method="post">
                <div flex layout-gt-sm="row"  layout="row">
                    <!--<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Equipment ID</label>
                        <input type="search" ng-model="depreciation_device_search.eqpid" name="eqpid" aria-label="eqpid"/>
                    </md-input-container>-->
                    <md-autocomplete flex="20" class="md-block" flex-gt-sm
                                     md-input-name="EQID"
                                     ng-value="depreciation_device_search.eqpid=searched.E_ID"
                                     md-no-cache="false"
                                     md-selected-item="searched.E_ID"
                                     md-search-text="searchEid"
                                     md-items="item in searchTextChange(searchEid,user_branch,user_org)"
                                     md-item-text="item.E_ID"
                                     md-min-length="0"
                                     md-floating-label="Search Equipment">
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
                        </md-item-template>
                    </md-autocomplete>
                    <span ng-value="depreciation_device_search.eqpid = searched.E_ID.E_ID"></span>
                    <div flex="5" hide-xs hide-sm> (OR) </div>

                    <!--<md-input-container class="md-block"  flex-gt-sm flex="15">
                        <label>Eq. Name</label>
                        <input type="text" ng-model="depreciation_device_search.equip_name" name="equip_name" aria-label="equip_name"/>
                    </md-input-container>-->


                    <md-autocomplete flex="20" class="md-block" flex-gt-sm
                                     md-input-name="equipmentname"
                                     ng-value="depreciation_device_search.equip_name=searched.E_NAME"
                                     md-no-cache="false"
                                     md-selected-item="searched.E_NAME"
                                     md-search-text="searchEquipmentname"
                                     md-items="item in searchTextChange(searchEquipmentname,'Eqname')"
                                     md-item-text="item.E_NAME"
                                     md-min-length="0"
                                     md-floating-label="Search Equipment Name">
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_NAME}}</span>
                        </md-item-template>
                    </md-autocomplete>
                    <span ng-value="depreciation_device_search.equip_name = searched.E_NAME.E_NAME"></span>


                    <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
                    <md-autocomplete flex="20" class="md-block" flex-gt-sm
                                     md-input-name="equipmentdept"
                                     ng-value="depreciation_device_search.dept_id=searched.CODE"
                                     md-no-cache="false"
                                     md-selected-item="searched.CODE"
                                     md-search-text="searchDepartment"
                                     md-items="item in searchTextChange(searchDepartment,'Department')"
                                     md-item-text="item.USER_DEPT_NAME"
                                     md-min-length="0"
                                     md-floating-label="Search Department">
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
                        </md-item-template>
                    </md-autocomplete>
                    <span ng-value="depreciation_device_search.dept_id = searched.CODE.CODE"></span>
                    <div flex="5" hide-xs hide-sm></div>
                    <md-button type="submit" value="Submit" class="md-icon-button md-raised md-primary" ng-click="getdepreciationdevices();" aria-label="submit">
                        <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
                    </md-button>

                </div>
            </form>
        </div>
        <div layout="column" flex>
            <table class="md-api-table table table-bordered">
                <thead>
                <tr>
                    <th>Equipment ID</th>
                    <th>Name</th>
                    <th>Date Of Install</th>
                    <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="depreciation_detail in depreciation_details">
                    <td>{{depreciation_detail.E_ID}}</td>
                    <td>{{depreciation_detail.E_NAME}}</td>
                    <td>{{depreciation_detail.DATEOF_INSTALL}}</td>
                    <td>
                        <button ng-click="viewDepreciationDetails($event,depreciation_detail)" class="btn btn-xs btn-default"  aria-label="View">
                            <md-tooltip md-direction="top">View</md-tooltip>
                            <md-icon class="material-icons-new" style="color: rgb(68,138,255);">launch</md-icon>
                    </td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getdepreciationdevices(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>