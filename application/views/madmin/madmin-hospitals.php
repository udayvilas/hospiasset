<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
     <div layout="column">
          <h3 class="heading-stylerespond">Organisations</h3>
          <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
               <div flex="33" flex-sm="50" flex-md="50">
                    <md-button ui-sref="home.add_hospitals" class="md-raised md-primary">Add New</md-button>
               </div>
          </div>
          <table class="md-api-table table table-bordered">
               <thead>
                    <tr>
                    <th>Hospital Name</th>
                    <th>Address</th>
                    <th>No of Branches</th>
                    <th>No of Users</th>
                    <th>No of Equipments</th>										<th>Expire Hospital</th>
                    <th>Action</th>
                    </tr>
               </thead>
               <tbody ng-if="!isempty(hospitals)">
                    <tr ng-repeat="hospital in hospitals" >
                    <td>{{hospital.ORG_NAME}}</td>
                    <td>{{hospital.ORG_ADDRESS}}</td>
                    <td>{{hospital.NO_OF_BRANCHES}}</td>
                    <td>{{hospital.NO_OF_USERS}}</td>
                    <td>{{hospital.NO_OF_EQUPIMENTS}}</td>										<td>{{hospital.EX_DATE}}</td>
                    <td>
                         <button class="btn btn-xs btn-default" ng-click="EditHospitals($event,hospital)">
                              <md-tooltip md-direction="top">Update</md-tooltip>
                              <md-icon class="material-icons-new" style="color:deepskyblue">
                                   mode_edit</md-icon>
                         </button>
                        <button class="btn btn-xs btn-default" ng-click="AssignHospital($event,hospital)" ng-if="hospital.ORG_TYPE == 'Vendor'" >
                            <md-tooltip md-direction="top">Assign</md-tooltip>
                            <md-icon class="material-icons-new" style="color:deepskyblue">
                                swap_horiz</md-icon>
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
		  
		   <div flex layout="row" class="marginb-10">
             <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                 <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                     <md-tooltip md-direction="top">Total Records</md-tooltip>
                     {{no_of_recs}}
                 </md-button>
             </div>
             <div flex="20" hide-xs hide-sm><!-- Space --></div>
             <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                 <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadHospitals(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
             </div>
         </div>

     </div>


</md-content>
