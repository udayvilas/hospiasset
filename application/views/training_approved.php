<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="start" style="margin-top:1px;">
            <md-button ng-if="can_add_training==yesstate" ui-sref="home.{{user_role_code | lowercase}}_training_create" class="md-fab md-mini" aria-label="Create Training">
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
            <md-button ng-if="can_approve_training==yesstate" ui-sref="home.{{user_role_code | lowercase}}_training_request" class="md-fab md-mini" aria-label="Training Request">
                <md-tooltip md-direction="top">Requests</md-tooltip>
                <md-icon class="material-icons" md-tool>report</md-icon>
            </md-button>
        </div>
    <h3 class="heading-stylerespond">Trainings {{training_list.tstatus}}</h3>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="start center" style="margin-top:10px;">
        <!--<md-button class="md-raised md-accent md-default">Create</md-button>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>-->
        <mdp-date-picker mdp-placeholder="From Date" name="from_date" mdp-max-date="maxDate" flex="20" mdp-format="DD-MM-YYYY"  ng-model="training_list.fromdate">
        </mdp-date-picker>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <mdp-date-picker mdp-placeholder="To Date" name="to_date" flex="20" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" mdp-min-date="training_list.fromdate" ng-model="training_list.todate">
        </mdp-date-picker>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
        <md-input-container>
            <label>Training Status</label>
            <md-select name="status" ng-model="training_list.tstatus" style="width:200px" ng-change="TrainingsApproved()" aria-label="Status">
                <md-option ng-value="trngstatus"  ng-repeat="trngstatus in trngstatuss">                             {{trngstatus}}
                </md-option>
            </md-select>
        </md-input-container>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>

        <md-button class="md-icon-button md-raised md-primary" ng-click="TrainingsApproved()"
                   md-theme="default" aria-label="submit">
            <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
    </div>
        <div layout="row">
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>Subject</th>
                <th>Username</th>
                <th>Training Type</th>
                <th>Trainer</th>
                <th>Training Date</th>
                <th>Trainees</th>

                <th ng-if="trngstatuss[2]==training_list.tstatus">Remind</th>
            </tr>
            </thead>
            <tbody ng-if="approved_trainings!=null">
            <tr ng-repeat="approved_training in approved_trainings">
                <td>{{approved_training.SUBJECT}}</td>
                <td>{{approved_training.USER_NAME}}</td>
                <td>{{approved_training.TRAINING_TYPE}}</td>
                <td>{{approved_training.TRAINING_BY}}</td>
                <td>{{approved_training.TDATETIME+'000' | date : "dd-MM-yyyy hh:mm a"}}</td>
                <td>
                    <span ng-repeat="TRAINING_TO in approved_training.TRAINING_TO track by $index"><b ng-show="$index>0">,</b>{{TRAINING_TO.ROLE_NAME}}</span>
                    </span>
                </td>
                <td ng-if="trngstatuss[2]==training_list.tstatus && user_role_code!=HBHOD">
                    <md-button class="md-icon-button my-md-icon-button md-raised md-default" ng-click="RemindToHod(approved_training,ROUND)" aria-label="Conduct Button{{$index}}">
                        <md-tooltip md-direction="top">Remind to HOD</md-tooltip>
                        <i class="fa fa-bell-o" aria-hidden="true" style="color:#ffa076"></i>
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
    <!--<md-button class="md-fab md-primary md-fab-bottom-right md-ink-ripple" ui-sref="home.{{user_role_code | lowercase}}_training_create">
        <md-tooltip md-direction="top">Create Training</md-tooltip>
        <ng-md-icon icon="add" style="fill:#FFFFFF" size="24"></ng-md-icon>
    </md-button>-->
</md-content>