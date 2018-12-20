<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding">

    <div layout="column">

        <h3 class="heading-stylerespond">Labels</h3>

        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

            <div flex="33" flex-sm="50" flex-md="50">

                <md-button ui-sref="home.haadmin_add_device_label" class="md-raised md-primary">Add New</md-button>

            </div>

        </div>

        <table class="md-api-table table table-bordered">

            <thead>

            <tr>
                <th>Module Name</th>

				<th>Organizations</th>
				
				<th>Table Name</th>

                <th>STATUS</th>

                <th>Action</th>


            </tr>

            </thead>

            <tbody>

            <tr ng-repeat="label in label_list">
                <td>
                    {{label.MODULE_ID}}
                </td>

                <td>
                    {{label.ORG_NAME}}
                </td>

                <td>
                    {{label.TABLE_NAME}}
                </td>
               <td>
                   {{label.ACTION}}
               </td>

                <td style="text-align: center;">
                    <button  ng-click="editlabellist($event,label)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>

            </tr>
            </tr>
			<tr>
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

