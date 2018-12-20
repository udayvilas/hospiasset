<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding">

    <div layout="column">

        <h3 class="heading-stylerespond">Cities Labels List</h3>

        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

            <div flex="33" flex-sm="50" flex-md="50">

                <md-button ui-sref="home.haadmin_add_city_label" class="md-raised md-primary">Add New</md-button>

            </div>

        </div>

        <table class="md-api-table table table-bordered">

            <thead>

            <tr>
                <th>MODULE NAME</th>

                <th>CITY NAME</th>

                <th>CITY CODE</th>

                <th>STATUS</th>

                <th>Action</th>


            </tr>

            </thead>

            <tbody>

            <tr ng-repeat="citylabels in citieslabelslist">
                <td>
                    {{citylabels.MODULE_ID}}
                </td>

                <td>
                    {{citylabels.CITY_NAME}}
                </td>
                <td>
                    {{citylabels.CITY_CODE}}
                </td>
                <td>
                    {{citylabels.STATUS}}
                </td>


                <td style="text-align: center;">
                    <button  ng-click="editcitieslabels($event,citylabels)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>

            </tr>

            </tbody>

            <tbody ng-else>

            <tr>

                <td style="text-align:center" colspan="6">No Rows Found</td>

            </tr>

            </tbody>

        </table>

    </div>

</md-content>

