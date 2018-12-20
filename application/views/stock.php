<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Stock</h3>
        <div>

        </div>

  <!--      <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <div flex="33" flex-sm="50" flex-md="50">
                <md-button ui-sref="home.add_stock_list" class="md-raised md-primary">Add New</md-button>
            </div>
        </div>-->
        <div ng-if="user_role_code==PURCHASE || user_role_code==HMADMIN" layout="row" flex layout-padding>
            <md-input-container class="no-margin-padding-md-input" flex="60" flex-xs="100">
                <md-select placeholder="Select Branch *" ng-model="stock_elements.branch_id" ng-change="getStock()" aria-label="user_branch">
                    <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
                </md-select>
            </md-input-container>
            <div ui-sref="" flex="5" flex-xs="100" flex-gt-sm="66" layout-xs="row"  class="widget margin-6"  style="background-color:#00b9ee;" layout="column">
                <div flex class="card-margin-4" layout="row" >

                    <md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">assignment_late</md-icon>
                    <div flex="10" style="color:#fff;" layout-align="end">{{stock_indent_counts.pending_indent_cnt}}</div>
                </div>
                <div flex layout="row" layout-align="center center">
                    <span style="color:#FFF;">Pending Indents</span>
                </div>
            </div>

            <div ui-sref="" flex="5" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4" style="background-color:#353bf0;" layout="column">
                <div flex class="card-margin-4" layout="row" layout-align="center center">
                    <md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">done_all</md-icon>
                    <div style="color:#fff;" layout-align="end">{{stock_indent_counts.sanctioned_indent_cnt}}</div>
                </div>
                <div flex layout="row" layout-align="center center">
                    <span  style="color:#FFF;">Sanctioned Indent</span>
                </div>
            </div>
            <div ui-sref="" flex="5" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#5dd27c;" layout="column">
                <div flex class="card-margin-4" layout="row">
                    <md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">
                        call_received   </md-icon>
                    <div style="color:#fff;" layout-align="end">{{stock_indent_counts.in_stock_cnt}}</div>
                </div>
                <div flex layout="row" layout-align="center center">
                    <span style="color:#FFF;">In Stock</span>
                </div>
            </div>
            <div ui-sref="" flex="5" flex-xs="100" flex-gt-sm="66" layout-xs="row" class="widget margin-4"  style="background-color:#f58f20;" layout="column">
                <div flex class="card-margin-4" layout="row">
                    <md-icon md-font-set="material-icons" flex layout-align="start" style="color:#fff;">call_made </md-icon>
                    <div style="color:#fff;" layout-align="end">{{stock_indent_counts.out_stock_cnt}}</div>
                </div>
                <div flex layout="row" layout-align="center center">
                    <span style="color:#FFF;">Out Stock</span>
                </div>
            </div>
            <div flex="40"> &nbsp;&nbsp;&nbsp;</div>
        </div>
        <div layout-gt-sm="row" layout="row" >
            <table class="md-api-table table table-bordered" style="width:100%;">
                <thead>
                <tr>
                    <th style="width:10%">ID</th>
                    <th style="width:10%">Type</th>
                    <th style="width:10%">Branch</th>
                    <th style="width:10%">Accessories</th>
                    <th style="width:10%">Spares</th>
                    <th style="width:10%">Name</th>
                    <th style="width:8%">Category</th>
                    <th style="width:12%">Make</th>
                    <th style="width:10%">Model</th>
                    <th style="width:10%">Serial No</th>
                </tr>
                </thead>
                <tbody ng-if="!isEmpty(stock_lists)">
                <tr ng-repeat="stock_list in stock_lists">
                    <td>{{stock_list.INDENT_ID}}</td>
                    <td>{{stock_list.INDENT_TYPE}}</td>
                    <td>{{stock_list.branch_name}}</td>
                    <td>{{stock_list.ACCSSORIES}}</td>
                    <td>{{stock_list.SPARES}}</td>
                    <td>{{stock_list.E_NAME}}</td>
                    <td>{{stock_list.eq_cat}}</td>
                    <td>{{stock_list.make}}</td>
                    <td>{{stock_list.E_MODEL}}</td>
                    <td>{{stock_list.ES_NUMBER}}</td>
                </tr>
                </tbody>
                <tbody ng-if="stock_lists==null">
                <tr>
                    <td colspan="10" class="text-center">No Stock Found...</td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getStock(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>