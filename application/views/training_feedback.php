<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
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
    <h3 class="heading-stylerespond">Trainings Feedback</h3>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center" style="margin-top:10px;">

        <mdp-date-picker mdp-placeholder="From" name="from_date" flex="20" mdp-format="DD-MM-YYYY" mdp-max-date="minDate"   ng-model="training_feedback.fromdate">
        </mdp-date-picker>

        <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <mdp-date-picker mdp-placeholder="To" name="to_date" flex="20" mdp-format="DD-MM-YYYY"   mdp-min-date="training_feedback.fromdate" mdp-max-date="maxDate" ng-model="training_feedback.todate">
        </mdp-date-picker>

        <div flex="1" hide-xs hide-sm>&nbsp;&nbsp;	</div>
		<md-button class="md-icon-button md-raised md-primary" ng-click="loadTraingFeedbackdata()"  md-theme="default" aria-label="submit">
		<ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
    </div>
    <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>User Name</th>
                <th>Training Types</th>
                <th>Trainers</th>
                <th>Training Date</th>
                <th>Trainees </th>
                <th>Training Complete</th>
                <th>Remarks</th>
                <th>Feedback</th>
            </tr>
            </thead>
            <tbody ng-if="trng_fdbks!=null">
            <tr ng-repeat="trng_fdbk in trng_fdbks">
                <td>{{trng_fdbk.USER_NAME}}</td>
                <td>{{trng_fdbk.TRAINING_TYPE}}</td>
                <td>{{trng_fdbk.TRAINING_BY}}</td>
                <td>{{trng_fdbk.TDATETIME+'000' | date : "dd-MM-yyyy hh:mm a"}}</td>
                <td>
                    <span ng-repeat="TRAINING_TO in trng_fdbk.TRAINING_TO track by $index"><b ng-show="$index>0">,</b>{{TRAINING_TO.ROLE_NAME}}</span>
                    </span>
                </td>
                <td>{{trng_fdbk.TR_COMP | date : "dd-MM-yyyy"}}</td>
                <td>{{trng_fdbk.REMARKS}}</td>
<td>
    <md-button ng-disabled="trng_fdbk.FEED_GIVEN==yesstate" class="md-icon-button my-md-icon-button md-raised md-default" ng-click="FeedbackTrainingDialog($event,trng_fdbk)" aria-label="Conduct Button{{$index}}">
        <md-tooltip ng-hide="trng_fdbk.FEED_GIVEN==yesstate" md-direction="top">Feedback</md-tooltip>
        <md-tooltip ng-hide="trng_fdbk.FEED_GIVEN==no" md-direction="top">{{trng_fdbk.FEEDBACK_DATA}}</md-tooltip>
        <i class="fa fa-comment-o" aria-hidden="true" style="color:orange"></i></ng-md-icon>
    </md-button>
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
</div>
</md-content>