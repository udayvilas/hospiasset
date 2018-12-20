<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
     <div layout="column">
          <h3 class="heading-stylerespond">Appointment</h3>
          <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
               <div flex="66" flex-sm="50" flex-md="50" layout="row">
                    <mdp-date-picker mdp-placeholder="Appointment From" name="date_of_apt" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="search_apt_dates.search_apt_date_of_apt_from">					</mdp-date-picker>					<div flex="5" hide-xs hide-sm></div>					<mdp-date-picker mdp-placeholder="Appointment To" name="date_of_apt2" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="search_apt_dates.search_apt_date_of_apt_to">					</mdp-date-picker>					<div flex="5" hide-xs hide-sm></div>				<md-button class="md-icon-button md-raised md-accent" ng-click="loadAppointments()" md-theme="default" aria-label="submit">                    <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>                </md-button>
               </div>			   			   <div flex="33" flex-sm="50" flex-md="50" style="text-align:right">
                    <md-button ui-sref="home.add_appointments" class="md-raised md-primary">Add New</md-button>
				</div>
          </div>
          <table class="md-api-table table table-bordered">
               <thead>
                    <tr>
                    <th>ORG Name</th>
                    <th>APT Date</th>
                    <th>APT Time</th>
                    <th>Contact Person</th>
                    <th>APT Place</th>
                    <th>APT Feedbacks</th>
                    <th>APT Status</th>
                    <th>Action</th>
                    </tr>
               </thead>
               <tbody ng-if="!isempty(appointments)">
                    <tr ng-repeat="appointment in appointments">
                    <td>{{appointment.org_name}}</td>
                    <td>{{appointment.date_time+'000' | date : "dd/MM/yyyy"}}</td>
					<td>{{appointment.date_time+'000' | date : "hh:mm a"}}</td>
                    <td>{{appointment.CONTACT_PERSON}}</td>
                    <td>{{appointment.APT_PLACE}}</td>
                    <td>{{appointment.APT_FEEDBACKS}}</td>
                    <td>{{appointment.APT_STATUS}}</td>
                    <td>
                         <button class="btn btn-xs btn-default" ng-click="viewAppointmentsList($event,appointment)">
                              <md-tooltip md-direction="top">View</md-tooltip>
                              <md-icon class="material-icons-new" style="color:green">
                                   view_list</md-icon>
                         </button>
                         <button class="btn btn-xs btn-default" ng-click="EditAppointments($event,appointment)">
                              <md-tooltip md-direction="top">Update</md-tooltip>
                              <md-icon class="material-icons-new" style="color:deepskyblue">
                                   mode_edit</md-icon>
                         </button>
                         <button class="btn btn-xs btn-default" ng-click="ConvertAppointments($event,appointment)">
                              <md-tooltip md-direction="top">Convert</md-tooltip>
                              <md-icon class="material-icons-new" style="color:orange">directions</md-icon>

                         </button>
                    </td>
                    </tr>
               </tbody>
               <tbody ng-if="isempty(appointments)">
                    <tr>
                    <td style="text-align:center" colspan="9">No Rows Found</td>
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
               <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadAppointments(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
          </div>
     </div>
</md-content>
