<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="start" style="margin-top:1px;">
            <md-button ui-sref="home.{{user_role_code | lowercase}}_training_create" class="md-fab md-mini" aria-label="Create Training">
                <md-tooltip md-direction="top">Create Training</md-tooltip>
                <md-icon class="material-icons" md-tool>add</md-icon>
            </md-button>
            <md-button ui-sref="home.{{user_role_code | lowercase}}_training_approved" class="md-fab md-mini" aria-label="Approved Training">
                <md-tooltip md-direction="top">Trainings</md-tooltip>
                <md-icon class="material-icons" md-tool>pageview</md-icon>
            </md-button>
            <md-button ui-sref="home.{{user_role_code | lowercase}}_training_conduct" class="md-fab md-mini" aria-label="Conduct Training">
                <md-tooltip md-direction="top">Conduct Training</md-tooltip>
                <md-icon class="material-icons" md-tool>done</md-icon>
            </md-button>
            <md-button ui-sref="home.{{user_role_code | lowercase}}_training_feedback" class="md-fab md-mini" aria-label="Feedback Training">
                <md-tooltip md-direction="top">Feedbacks</md-tooltip>
                <md-icon class="material-icons" md-tool>comment</md-icon>
            </md-button>
            <md-button ng-if="user_role_code==HBHOD" ui-sref="home.{{user_role_code | lowercase}}_training_request" class="md-fab md-mini" aria-label="Training Request">
                <md-tooltip md-direction="top">Requests</md-tooltip>
                <md-icon class="material-icons" md-tool>report</md-icon>
            </md-button>
        </div>
        <h3 class="heading-stylerespond">Conduct Training</h3>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center" style="margin-top:10px;">
            <mdp-date-picker mdp-placeholder="From" name="from_date" flex="20" mdp-format="DD-MM-YYYY" mdp-max-date="minDate" ng-model="conduct_trainings_send.fromdate">
            </mdp-date-picker>

            <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>

            <mdp-date-picker mdp-placeholder="To" name="to_date" flex="20" mdp-format="DD-MM-YYYY" mdp-min-date="conduct_trainings_send.fromdate" mdp-max-date="maxDate"  ng-model="conduct_trainings_send.todate">
            </mdp-date-picker>

            <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>

			<md-button class="md-icon-button md-raised md-primary" ng-click="loadTraingConductdata()"  md-theme="default" aria-label="submit">
			<ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
        </div>
    <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Subject</th>
                <th>User Name</th>
                <th>Training Types</th>
                <th>Trainers</th>
                <th>Training Date</th>
                <th>Trainees</th>
                <th>Remarks</th>
                <th>Conduct</th>
            </tr>
            </thead>
            <tbody ng-if="trng_cndts!=null">
            <tr ng-repeat="trng_cndt in trng_cndts">
                <td>{{trng_cndt.SUBJECT}}</td>
                <td>{{trng_cndt.USER_NAME}}</td>
                <td>{{trng_cndt.TRAINING_TYPE}}</td>
                <td>{{trng_cndt.TRAINING_BY}}</td>
                <td>{{trng_cndt.TDATETIME+'000' | date : "dd-MM-yyyy hh:mm a"}}</td>
                <td>
                    <span ng-repeat="TRAINING_TO in trng_cndt.TRAINING_TO track by $index"><b ng-show="$index>0">,</b>{{TRAINING_TO.ROLE_NAME}}</span>
                    </span>
                </td>
                <td>{{trng_cndt.REMARKS}}</td>
                <td>
                    <div ng-if="trng_cndt.TR_COMP==null">
                    <md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="ConductTrainingDialog($event,trng_cndt)" aria-label="Conduct Button{{$index}}">
                        <md-tooltip md-direction="top">Conduct</md-tooltip>
                        <ng-md-icon icon="done_all" style="fill:orange" size="24"></ng-md-icon>
                    </md-button>
                    </div>
                    <div ng-else>
                    <md-button ng-disabled="trng_cndt.FEEDBACK==null" class="md-icon-button my-md-icon-button md-raised md-default" ng-click="getMyTrainingFeedbacks($event,trng_cndt.ID)" aria-label="Conduct Button{{$index}}">
                        <md-tooltip ng-if="trng_cndt.FEEDBACK==null" md-direction="top">No Feedbacks yet</md-tooltip>
                        <md-tooltip ng-if="trng_cndt.FEEDBACK!=null" md-direction="top">Show Feedbacks</md-tooltip>
                        <ng-md-icon icon="done_all" style="fill:green" size="24"></ng-md-icon>
                    </md-button>
                    </div>
                </td>
            </tr>
            </tbody>
            <tbody ng-else>
            <tr>
                <td colspan="8" style="text-align:center">No Training Records Found...!</td>
            </tr>
            </tbody>
        </table>
    </div>
</md-content>
