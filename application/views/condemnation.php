<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content layout="column" class="mylayout-padding" ng-cloak>
    <h3 class="heading-stylerespond">Condemination</h3>
    <!--<div layout="row" >
        <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
    </div>-->

    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
       <!-- <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
        <mdp-date-picker  ng-model="condimnation_search.fromdate" mdp-placeholder="From Date" mdp-max-date="maxDate"  flex-gt-sm>
        </mdp-date-picker>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
        <mdp-date-picker  ng-model="condimnation_search.todate" mdp-placeholder="To Date" mdp-min-date="condimnation_search.fromdate" mdp-max-date="maxDate" flex-gt-sm>
        </mdp-date-picker>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <md-input-container class="md-block" flex-gt-sm  flex="25">
            <label>Reasons*</label>
            <md-select ng-model="condimnation_search.reasons" name="reasons">
                <md-option ng-repeat="reusable_part in reusable_parts"  ng-value="reusable_part.CODE">
                    {{reusable_part.REUSABLE_PARTS}} ({{reusable_part.CODE}})
                </md-option>
            </md-select>

        </md-input-container>
        <md-button class="md-icon-button md-raised md-accent" ng-click="loadCondemenationRequest()"  md-theme="default" aria-label="submit">
            <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
        </md-button>
    </div>
    <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Eq. Id</th>
                <th>Dept</th>
                <th>Eq. Name</th>
                <th>Reason </th>
                <th>Feed Back</th>
                <th>Admin Feed Back</th>
                <th>Eq. Cost</th>
                <th>Expected Cost</th>
                <th>Resold Cost</th>
                <th>Reusable Parts</th>
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
                <td>{{condemination.equp_cost}}</td>
                <td>{{condemination.EXPECTED_COST}}</td>
                <td>{{condemination.RESOLD_VALUE}}</td>
                <td>{{condemination.REUSABLE_PARTS}}</td>
                <td>{{condemination.ADDED_ON | date : "dd-MM-yy hh:mm a"}}</td>
                <td>
                    <button class="btn btn-xs btn-default" ng-show="Edit_Condemnation=='Edit'" ng-click="EditCondeminationRequest($event,condemination)" aria-label="Conduct Button{{$index}}">
                        <md-tooltip md-direction="top">Request</md-tooltip>
                        <md-icon class="material-icons-new" style="color:deepskyblue">
                            mode_edit</md-icon>
                    </button>

                    <button  ng-if="condemination.CONDEMNATION_STATUS=='Approved' "  ng-show="Approve_Condemnation='Approve'"  ng-disabled="condemination.RESOLD_VALUE !=null"  class="btn btn-xs btn-default" ng-click="EditApprovedCondemnation($event,condemination)" aria-label="Conduct Button{{$index}}">
                        <md-tooltip md-direction="top">Approved</md-tooltip>
                        <md-icon class="material-icons-new" style="color:deepskyblue">
                            done_all</md-icon>
                    </button>
                </td>
            </tr>
            </tbody>
            <tbody ng-else>
            <tr>
                <td colspan="11" style="text-align:center">No Condemnation Records Found...!</td>
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
                <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadCondemenationRequest(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
            </div>
        </div>
</md-content>