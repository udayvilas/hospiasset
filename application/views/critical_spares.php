<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
             <md-button ui-sref="home.add_critical_spare" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <h3>Critical Spares</h3>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th style="width:70%">Name</th>
                <th style="width:15%">Code</th>
                <th style="width:15%">Branch</th>
                <th style="width:15%">Count</th>
                <th style="width:10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="isObject(m_critical_spares)" ng-repeat="m_critical_spare in m_critical_spares">
                <td>{{m_critical_spare.NAME}}</td>
                <td>{{m_critical_spare.CODE}}</td>
                <td>{{m_critical_spare.Branch_name}}</td>
                <td>{{m_critical_spare.COUNT}}</td>
                <td>
                    <md-button ng-click="editCriticalSpare($event,m_critical_spare)" class="md-icon-button md-primary" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon>mode_edit</md-icon>
                    </md-button>
                </td>
            </tr>
            <tr ng-if="!isObject(m_critical_spares)">
                <td colspan="3" class="text-center">No Records Found</td>
            </tr>
            </tbody>
        </table>
    </div>
</md-content>