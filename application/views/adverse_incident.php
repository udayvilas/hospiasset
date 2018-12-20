<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="column">
        <h3 class="heading-stylerespond">Adverse Incidents</h3>

        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

        <!--    <md-datepicker  ng-model="adverseincdent.fromdate" md-placeholder="From Date" md-max-date="maxDate"  flex-gt-sm flex="20" style="margin-top:5px;">
            </md-datepicker>-->

            <mdp-date-picker mdp-placeholder="From Date"  class="md-block" flex-gt-sm flex="15" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate"  ng-model="adverseincdent.fromdate">
            </mdp-date-picker>
            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <mdp-date-picker mdp-placeholder="To Date"  class="md-block" flex-gt-sm flex="15" mdp-format="DD-MM-YYYY" mdp-min-date="adverseincdent.fromdate" mdp-max-date="maxDate" ng-model="adverseincdent.todate">
            </mdp-date-picker>

            <!--<mdp-datepicker  ng-model="adverseincdent.todate" md-placeholder="To Date" md-max-date="maxDate" flex-gt-sm  flex="20" style="margin-top:5px;">-->
            </mdp-datepicker>



            <!--
            <div flex="5" hide-xs hide-sm><!-- Space </div>
              <md-input-container flex-gt-sm flex="20">
                      <label>Department</label>
                      <md-select ng-model="incdent.departments" name="depts">
                          <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                              {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                          </md-option>
                      </md-select>
                  </md-input-container>-->

            <div flex="5" hide-xs hide-sm><!-- Space --></div>
            <md-autocomplete class="md-block" flex-gt-sm flex="30"
                             md-no-cache="false"
                             md-selected-item="searched.EID"
                             md-search-text="searchEid"
                             md-items="item in searchTextChange(searchEid)"
                             md-item-text="item.E_ID"
                             md-min-length="0"
                             md-floating-label="Search Eq. id">
                <md-item-template>
                    <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
                </md-item-template>
                <md-not-found>
                    No Equipment Match Found
                </md-not-found>
            </md-autocomplete>

            <div flex="5" hide-xs hide-sm ><!-- Space --></div>
            <md-input-container class="md-block" flex-gt-sm flex="20">
                <label>Incident Type *</label>
                <md-select name="itype" required ng-model="adverseincdent.itype" aria-label="itype">
                    <md-option  ng-value="itype.CODE" ng-repeat="itype in itypes">{{itype.ITYPE}}</md-option>
                </md-select>
            </md-input-container>
            <div flex="5" hide-xs hide-sm flex="15"><!-- Space --></div>
            <md-button class="md-icon-button md-raised md-accent" ng-click="getAdverseIncedents()"  md-theme="default" aria-label="submit">
                <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
        </div>
        <div layout="row" flex>

            <table class="md-api-table table table-bordered">
                <thead>
                <tr>
                    <th>Date of Occurance</th>
                    <th>Incident Type</th>
                    <th>Feedback</th>
                    <th>Dept ID</th>
                    <th>Equipment ID</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody ng-if="adverse_incednts!=null && adverse_incednts!='undefined'">
                <tr ng-repeat="adverse_incednt in adverse_incednts">
                    <td>{{adverse_incednt.DATE_OCCRANCE}}</td>
                    <td>{{adverse_incednt.incidents_type}}</td>
                    <td>{{adverse_incednt.FEEDBACK}}</td>
                    <td>{{adverse_incednt.DEPT_ID}}</td>
                    <td>{{adverse_incednt.EQUP_ID}}</td>
                    <td>
                        <button ng-click="editadverseIncidents($event,adverse_incednt)" ng-show="Edit_Adverse_Incident==Edit" class="btn btn-xs btn-default" aria-label="Edit">
                            <md-tooltip md-direction="top">Edit</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#0D7CFF">mode_edit</md-icon>
                        </button>

                        <button ng-click="viewAdverseIncedentsDetalis($event,adverse_incednt)" class="btn btn-xs btn-default" aria-label="View">
                            <md-tooltip md-direction="top">View</md-tooltip>
                            <md-icon class="material-icons-new" style="color:#009688">launch</md-icon>
                        </button>
                    </td>
                </tr>
                </tbody>
                <tbody ng-if=adverse_incednts==null || adverse_incednts=='undefined'>
                <tr>
                    <td colspan="9" class="text-center">No Adverse Incedents Found</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div flex layout="row" class="marginb-10" >
            <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                    <md-tooltip md-direction="top">Total Records</md-tooltip>
                    {{no_of_recs}}
                </md-button>
            </div>
            <div flex="20" hide-xs hide-sm><!-- Space --></div>
            <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getAdverseIncedents(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
    </div>
</md-content>