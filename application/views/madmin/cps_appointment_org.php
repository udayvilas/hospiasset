<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>

<md-dialog aria-label="dialog-box" flex="40">

        <md-toolbar>

            <div class="md-toolbar-tools">

                <h4>Contact Persons</h4>

                <span flex></span>

                <md-button class="md-icon-button" ng-click="cancel()">

                    <md-icon md-font-set="material-icons">clear</md-icon>

                </md-button>

            </div>

        </md-toolbar>



        <md-dialog-content flex layout-align="center center">

            <div class="md-dialog-content">
			<table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Designation</th>
            </tr>
            </thead>
            <tbody ng-if="dialog_of_cpoa_data!=null">
            <tr ng-repeat="new_all_ocp in dialog_of_cpoa_data.contact_persons track by $index">
				<td>{{new_all_ocp.contact_person}}</td>
				<td>{{new_all_ocp.contact_person_no}}</td>
				<td>{{new_all_ocp.cpemail}}</td>
				<td>{{new_all_ocp.cp_designation}}</td>
            </tr>
            </tbody>
            <tbody ng-else>
            <tr>
                <td style="text-align:center" colspan="4">No Contact Persons Found</td>
            </tr>
            </tbody>
        </table>
            </div>

        </md-dialog-content>

</md-dialog>