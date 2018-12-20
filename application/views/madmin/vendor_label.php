<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding">

    <div layout="column">

        <h3 class="heading-stylerespond">Vendor Labels</h3>

        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

            <div flex="33" flex-sm="50" flex-md="50">

                <md-button ui-sref="home.haadmin_add_vendor_label" class="md-raised md-primary">Add New</md-button>

            </div>

        </div>

        <table class="md-api-table table table-bordered">

            <thead>

            <tr>
                <th>MODULE NAME</th>

                <th>vendor name</th>
                <th>type</th>
                <th>email</th>
                <th>contactno</th>
                <th>contactperson</th>
                <th>cpemail</th>
                <th>cpnumber</th>

                <th>Action</th>


            </tr>

            </thead>

            <tbody>

            <tr ng-repeat="vendor_label in vendorlabels">
                <td>
                    {{vendor_label.MODULE_ID}}
                </td>

                <td>
                    {{vendor_label.NAME}}
                </td>

                <td>
                    {{vendor_label.TYPE}}
                </td>
                <td>
                    {{vendor_label.EMAIL_ID}}
                </td>
                <td>
                    {{vendor_label.MOBILE_NO}}
                </td>
                <td>
                    {{vendor_label.CP_NAME}}
                </td>
                <td>
                    {{vendor_label.CP_NUMBER}}
                </td>
                <td>
                    {{vendor_label.ACTION}}
                </td>

                <td style="text-align: center;">
                    <button  ng-click="editvendorlabels($event,vendor_label)" class="btn btn-xs btn-default" aria-label="Edit">
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

