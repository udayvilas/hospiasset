<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Table Names</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button  ui-sref="home.ha_add_master_table" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="row" layout-align="center center" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <!--<th style="width: 25%;">Tabel Name</th>-->
				<th style ="width:25%;">Master Table </th>
				<th style="width: 25%">Action</th>
				</tr>
            </thead>
            <tbody>
            <tr  ng-repeat="master in mastertables">
                <!--<td>{{master.MASTER_TABLE_NAME}}</td>-->
				<td>{{master.MASTER_TABLE_DESC}}</td>
				
                <td style="text-align: center;">
                    <button   ng-click="edittablename($event,master)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if=mastertables==null || mastertables=='undefined'>
                <td colspan="4" class="text-center">No tables Found</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div flex layout="row" class="marginb-10" ng-if="mastertables!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="get_master_table(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>