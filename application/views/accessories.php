<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="33" flex-sm="50" flex-md="50">
             <md-button ui-sref="home.add_accessor" class="md-raised md-primary">Add New</md-button>
        </div>
    </div>

    <div layout="column" flex>
        <h3>Accessories</h3>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th style="width:70%">Name</th>
                <th style="width:15%">Code</th>
                <th style="width:10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="isObject(m_accessories)" ng-repeat="m_accessor in m_accessories">
                <td>{{m_accessor.NAME}}</td>
                <td>{{m_accessor.CODE}}</td>
                <td>
                    <md-button ng-click="editAccessor($event,m_accessor)" class="md-icon-button md-primary" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon>mode_edit</md-icon>
                    </md-button>
                </td>
            </tr>
            <tr ng-if="!isObject(m_accessories)">
                <td colspan="3" class="text-center">No Records Found</td>
            </tr>
            </tbody>
        </table>
    </div>
</md-content>