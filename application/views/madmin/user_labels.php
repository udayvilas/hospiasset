<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding">

    <div layout="column">

        <h3 class="heading-stylerespond">User Labels List</h3>

        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

            <div flex="33" flex-sm="50" flex-md="50">

                <md-button ui-sref="home.haadmin_add_user_label" class="md-raised md-primary">Add New</md-button>

            </div>

        </div>

        <table class="md-api-table table table-bordered">

            <thead>

            <tr>
                <th>MODULE NAME</th>

                <th>USER NAME</th>

                <th>EMAIL</th>

                <th>CONTACT</th>

                <th>ROLE</th>

                <th>LEVELS</th>

                <th>BRANCH</th>

                <th>STATUS</th>

                <th>Action</th>
                <th>Actions</th>


            </tr>

            </thead>

            <tbody>

            <tr ng-repeat="user in user_label">
                <td>
                    {{user.MODULE_ID}}
                </td>

                <td>
                    {{user.USER_NAME}}
                </td>
                <td>
                    {{user.EMAIL_ID}}
                </td>
                <td>
                    {{user.EMP_NO}}
                </td>
                <td>
                    {{user.ROLE_NAME}}
                </td>
                <td>
                    {{user.LEVEL}}
                </td>
                <td>
                    {{user.BRANCH}}
                </td>
                <td>
                    {{user.STATUS}}
                </td>
                <td>
                    {{user.ACTION}}
                </td>


                <td style="text-align: center;">
                    <button  ng-click="edituserlabels($event,user)" class="btn btn-xs btn-default" aria-label="Edit">
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

