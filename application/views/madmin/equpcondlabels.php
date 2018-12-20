<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding">

    <div layout="column">

        <h3 class="heading-stylerespond">Equipcondition Labels</h3>

        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

            <div flex="33" flex-sm="50" flex-md="50">

                <md-button ui-sref="home.haadmin_add_equpcondlabels" class="md-raised md-primary">Add New</md-button>

            </div>

        </div>

        <table class="md-api-table table table-bordered">

            <thead>

            <tr>
                <th>MODULE NAME</th>

                <th>Equp COND NAME</th>

                <th>CODE</th>

                <th>STATUS</th>

                <th>Action</th>
                <th>Actions</th>


            </tr>

            </thead>

            <tbody>

            <tr ng-repeat="equpconditon in equpconditionlabel">
                <td>
                    {{equpconditon.MODULE_ID}}
                </td>

                <td>
                    {{equpconditon.ECODE}}
                </td>
             <td>
                 {{equpconditon.EVAL}}
             </td>
                <td>
                    {{equpconditon.STATUS}}
                </td>

                <td>
                    {{equpconditon.ACTION}}
                </td>

                <td style="text-align: center;">
                    <button  ng-click="editEqupConditonlabel($event,equpconditon)" class="btn btn-xs btn-default" aria-label="Edit">
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

