<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content layout="column" class="mylayout-padding" ng-cloak>
    <h3 class="heading-stylerespond">Condemination</h3>
  <!--  <div layout="row" >
        <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
    </div>-->
    <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Equipement Id</th>
                <th>Department</th>
                <th>Equp Name</th>
                <th>Reason </th>
                <th>Feed Back</th>
                <th>Admin FeedBack</th>
                <th>Date & Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody ng-if="condeminations!=null">
            <tr ng-repeat="condemination in condeminations">
                <td>{{condemination.EQUP_ID}}</td>
                <td>{{condemination.DEPT_ID}}</td>
                <td>{{condemination.equp_name}}</td>
                <td>{{condemination.REASONS}}</td>
                <td>{{condemination.FEEDBACK}}</td>
                <td>{{condemination.ADMIN_FEEDBACK}}</td>
                <td>{{condemination.ADDED_ON | date : "dd-MM-yyyy hh:mm a"}}</td>
                <td>
                    <button ng-disabled="condemination.CONDEMNATION_STATUS!=null" class="btn btn-xs btn-default" ng-click="EditAdminCondemination($event,condemination)" aria-label="Conduct Button{{$index}}">
                        <md-tooltip md-direction="top">Response</md-tooltip>
                        <md-icon class="material-icons-new" style="color:deepskyblue">
                            done</md-icon>
                    </button>
                </td>
            </tr>
            </tbody>
            <tbody ng-else>
            <tr>
                <td colspan="8" style="text-align:center">No Condemnation Records Found...!</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div flex layout="row" class="marginb-10">

        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column"  >
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>

        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadCondemenationRequest(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>

</md-content>