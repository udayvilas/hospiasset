<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="column">
        <h3 class="heading-stylerespond">Location</h3>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <div flex="33" flex-sm="50" flex-md="50">
                <md-button   ui-sref="home.add_location" class="md-raised md-primary">Add Location</md-button>
            </div>
        </div>

        <div layout="column" flex>
            <table class="md-api-table table table-bordered">
                <thead>
                <tr>
                    <th>{{label_location.LABEL_1}}</th>
                    <th>{{label_location.LABEL_2}}</th>
                    <th>{{label_location.LABEL_3}}</th>

                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="loc in location">
                    <td>{{loc.location}}</td>
                    <td>
                        <span>{{loc.status=='A' ? 'Active' : 'Inactive'}}</span>
                    </td>
                    <td>
                        <button  ng-click="editLocation($event,loc)" class="btn btn-xs btn-default" aria-label="Edit">
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadLocation(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>