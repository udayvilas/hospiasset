<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Appointment Organizations</h3>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
            <div flex="33" flex-sm="50" flex-md="50">
                <md-button ui-sref="home.add_organization_appointments" class="md-raised md-primary">Add New</md-button>
            </div>
        </div>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Contact Persons</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody ng-if="!isempty(apt_hospitals)">
            <tr ng-repeat="apt_hospital in apt_hospitals">
                <td>{{apt_hospital.ORG_NAME}}</td>
                <td>{{apt_hospital.ORG_EMAIL}}</td>
                <td>{{apt_hospital.ORG_CONTACTNO}}</td>
                <td style="text-align:center;"><button class="btn btn-xs btn-default" ng-click="viewContactPersonsAppointmentOrg($event,apt_hospital.CONTACT_PERSONS)">
                        <md-tooltip md-direction="top">View</md-tooltip>
                        <md-icon class="material-icons-new" style="color:deepskyblue">account_box</md-icon>
                    </button>
                </td>
                <td>{{apt_hospital.ORG_ADDRESS}}</td>
                <td>
                    <button class="btn btn-xs btn-default" ng-click="EditAPThospitals($event,apt_hospital)">
                        <md-tooltip md-direction="top">Update</md-tooltip>
                        <md-icon class="material-icons-new" style="color:deepskyblue">
                            mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            </tbody>
            <tbody ng-if="isempty(apt_hospitals)">
            <tr>
                <td style="text-align:center" colspan="6">No Rows Found</td>
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
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadAPTOrgnigations(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>
