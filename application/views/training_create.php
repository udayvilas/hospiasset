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
        <h3 class="heading-stylerespond">Create Training </h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="createtrainingForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div flex layout="row">
                     
					 <md-input-container  class="md-block" flex-gt-sm flex="20">
                        <label>Select Branch * </label>
                        <md-select ng-model="training_create.branch_id" name="branch_id" required>
                            <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs"  ng-if="branch.BRANCH_ID !='All'">                                {{branch.BRANCH_NAME}}                            </md-option>
                        </md-select>
                        <div ng-messages="createtrainingForm.branch_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
					 <div flex="20" hide-xs hide-sm><!-- Space --></div>
					 
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Training Type</label>
                        <md-select name="traningtype" required ng-model="training_create.ttype"  aria-label="Traningtype"'>                       <md-option ng-value="ttype.CODE" ng-repeat="ttype in ttypes"  style='width:300px'>{{ttype.TRAINING_TYPE}}</md-option>
                        </md-select>
                        <div ng-messages="createtrainingForm.ttype.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Trainer</label>
                        <md-select name="roleid" required ng-model="training_create.trngby" aria-label="trngby">                       
						<md-option ng-value="trngby.ROLE_CODE" ng-repeat="trngby in trngbys">
                                {{trngby.ROLE_NAME}}</md-option>
                        </md-select>
                        <div ng-messages="createtrainingForm.trngby.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div layout="row">
                    <mdp-date-picker mdp-placeholder="Date" required class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="training_create.current_date" mdp-max-date="maxDate" >
					<div ng-messages="createtrainingForm.current_date.$error">
                            <div ng-message="required">Required.</div>
                        </div>
					</mdp-date-picker>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <mdp-time-picker required mdp-placeholder="Time" class="md-block" mdp-format="hh:mm A" flex-gt-sm flex="40" mdp-max-time="maxTime" ng-model="training_create.current_time">
					<div ng-messages="createtrainingForm.current_time.$error">
                            <div ng-message="required">Required.</div>
                        </div>
					</mdp-time-picker>
                </div>

                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Trainee *</label>
                        <md-select name="roleid" required multiple ng-model="training_create.trainees" aria-label="roleid">
                        <md-option ng-value="role.ROLE_CODE" ng-repeat="role in roles">{{role.ROLE_NAME}}</md-option>
                        </md-select>
                        <div ng-messages="createtrainingForm.trainees.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block">
                        <label>Training Content</label>
                        <input ng-model="training_create.content" required>          
						<div ng-messages="createtrainingForm.content.$error">     
						<div ng-message="required">Required.</div>           
						</div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                   
                        <md-button class="md-raised md-accent" ng-click="CreateTraining(training_create)" ng-disabled="createtrainingForm.$invalid" aria-label="submit">Submit</md-button>
                   
                </div>
            </form>
        </div>
    </div>
</md-content>