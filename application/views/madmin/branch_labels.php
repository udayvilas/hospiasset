<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding">

    <div layout="column">

        <h3 class="heading-stylerespond">Branch Labels</h3>

        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

            <div flex="33" flex-sm="50" flex-md="50">

                <md-button ui-sref="home.haadmin_add_branch_label" class="md-raised md-primary">Add New</md-button>

            </div>

        </div>

        <table class="md-api-table table table-bordered">

            <thead>

            <tr>
                <th>MODULE NAME</th>

                <th>Branch Name</th>

                <th>Code</th>

                <th>Hod</th>

                <th>Address</th>

                <th>Added Date</th>

                <th>Status</th>

                <th>Action</th>


            </tr>

            </thead>

            <tbody>

            <tr ng-repeat="branchlabel in branch_labels">
                <td>
                    {{branchlabel.MODULE_ID}}
                </td>

                <td>
                    {{branchlabel.BRANCH_NAME}}
                </td>
                <td>
                    {{branchlabel.BRANCH_CODE}}
                </td>
                <td>
                    {{branchlabel.HOD}}
                </td>
                <td>
                    {{branchlabel.ADDRESS}}
                </td>
                <td>
                    {{branchlabel.ADDED_DATE}}
                </td>
                <td>
                    {{branchlabel.STATUS}}
                </td>
                <td>
                    {{branchlabel.ACTION}}
                </td>


                <td style="text-align: center;">
                    <button  ng-click="editbranchlabel($event,branchlabel)" class="btn btn-xs btn-default" aria-label="Edit">
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

