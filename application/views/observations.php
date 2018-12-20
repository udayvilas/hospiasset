<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="column">
        <h3 class="heading-stylerespond">Adverse Incidents</h3>
        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
           <!-- <div flex="33" flex-sm="50" flex-md="50">
                <md-button ui-sref="home.incident" class="md-raised md-primary">Add New</md-button>
            </div>-->
        </div>

        <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">

            <md-datepicker  ng-model="incdent.fromdate" md-placeholder="From Date" md-max-date="maxDate"  flex-gt-sm flex="20" style="margin-top:5px;">
            </md-datepicker>

            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <md-datepicker  ng-model="incdent.todate" md-placeholder="To Date" md-max-date="maxDate" flex-gt-sm  flex="20" style="margin-top:5px;">
            </md-datepicker>

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
            <md-select name="itype" required ng-model="incdent.itype" aria-label="itype">
                <md-option  ng-value="itype.CODE" ng-repeat="itype in itypes">{{itype.ITYPE}}</md-option>
            </md-select>
        </md-input-container>
        <div flex="5" hide-xs hide-sm flex="15"><!-- Space --></div>
        <md-button class="md-icon-button md-raised  md-primary" ng-click="loadAdverseIncedents(incdent)"  md-theme="default" aria-label="submit">
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
            <tbody>
            <tr ng-if="ad_incednts!=null && ad_incednts!='undefined'" ng-repeat="ad_incednt in ad_incednts">
                <td>{{ad_incednt.DATE_OCCRANCE}}</td>
                <td>{{ad_incednt.incidents_type}}</td>
                <td>{{ad_incednt.FEEDBACK}}</td>
                <td>{{ad_incednt.DEPT_ID}}</td>
                <td>{{ad_incednt.EQUP_ID}}</td>
                <td>
                    <button ng-click="editObservations($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#0D7CFF">mode_edit</md-icon>
                    </button>
                    <button ng-click="viewAdverseIncedentsDetalis($event,ad_incednt)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">View</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#009688">launch</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if=ad_incednts==null || ad_incednts=='undefined'>
                <td colspan="9" class="text-center">No Adverse Incedents Found</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</md-content>