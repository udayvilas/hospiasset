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
        <h3 class="heading-stylerespond">Pending Requests</h3>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center" style="margin-top:10px;">
        <mdp-date-picker mdp-placeholder="From Date" name="from_date" flex="20" mdp-format="DD-MM-YYYY" mdp-min-date="maxDate"  ng-model="training_requests_send.fromdate">
        </mdp-date-picker>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <mdp-date-picker mdp-placeholder="To Date" name="to_date" flex="20" mdp-format="DD-MM-YYYY" mdp-min-date="training_requests_send.fromdate" mdp-max-date="minDate" ng-model="training_requests_send.todate">
        </mdp-date-picker>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <md-button class="md-icon-button md-raised md-primary" ng-click="loadTraingRequestdata()"  md-theme="default" aria-label="submit">
            <md-tooltip md-direction="top">Search</md-tooltip>
            <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
        </md-button>
    </div>
    <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Username</th>
                <th>Training Types</th>
                <th>Trainers</th>
                <th>Training Date</th>
                <th>Trainees </th>
                <th>Subjects </th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody ng-if="trng_rquests!=null">
            <tr ng-if="trng_rquests.FEED_GIVEN!=yesstate" ng-repeat="trng_rquest in trng_rquests">
                <td>{{trng_rquest.USER_NAME}}</td>
                <td>{{trng_rquest.TRAINING_TYPE}}</td>
                <td>{{trng_rquest.TRAINING_BY}}</td>
                <td>{{trng_rquest.TDATETIME+'000' | date : "dd-MM-yyyy hh:mm a"}}</td>
                <td>
                    <span ng-repeat="TRAINING_TO in trng_rquest.TRAINING_TO track by $index"><b ng-show="$index>0">,</b>{{TRAINING_TO.ROLE_NAME}}</span>
                    </span>
                </td>
                <td>{{trng_rquest.SUBJECT}}</td>
                <td>
                    <md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="RequestToApprovedDialog($event,trng_rquest)" aria-label="Conduct Button{{$index}}">
                        <md-tooltip md-direction="top">Confirm</md-tooltip>
                        <i class="fa fa-outdent" aria-hidden="true" style="color:blue"></i>
                    </ng-md-icon>
                    </md-button>
                </td>
            </tr>
            </tbody>
            <tbody ng-else>
            <tr>
                <td colspan="7" style="text-align:center">No Pending Requests Found...</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</md-content>