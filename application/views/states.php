<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="column">
    <h3 class="heading-stylerespond">States</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
            <md-button ng-if="Add_State==Add"  ui-sref="home.haadmin_add_state" class="md-raised md-primary">Add State</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
			    <th>Country Name</th>
                <th>State Name</th>
                <th>State Code</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="state in states">
			    <td>{{state.country_name}}</th>
                <td>{{state.STATE_NAME}}</td>
                <td>{{state.STATE_CODE}}</td>
                <td>
                    <span>{{state.STATUS=='A' ? 'Active' : 'Inactive'}}</span>
                </td>
                <td>
                    <button ng-disabled="Edit_State!=Edit" ng-click="editState($event,state)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color: #614da4;">mode_edit</md-icon>
                    </button>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadStates(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>