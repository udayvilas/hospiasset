<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Conduct Training</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="TconductForm" flex="100"  autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Traning Type</label>
                        <input ng-model="condct_traing_data.TR_TYPE"  ng-disabled="true">
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Trainer</label>
                        <input ng-model="condct_traing_data.TR_BY" ng-disabled="true">
                    </md-input-container>
                </div>
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Traning Date</label>
                        <input ng-model="condct_traing_data.TR_DATE"  ng-disabled="true">
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Training Time</label>
                        <input ng-model="condct_traing_data.TR_TIME" ng-disabled="true">
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Trainees</label>
                        <input ng-model="condct_traing_data.TR_TO" ng-disabled="true">
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Subject</label>
                        <textarea ng-model="condct_traing_data.SUBJECT" rows="5" ng-disabled="true"                         md-select-on-focus></textarea>
                    </md-input-container>
                </div>

                <div flex layout="row">
                    <mdp-date-picker mdp-placeholder="End Date" class="md-block" flex-gt-sm mdp-format="DD/MM/YYYY" ng-model="condct_traing_data.End_date" mdp-min-date="condct_traing_data.tr_date" mdp-max-date="maxDate">
                    </mdp-date-picker>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Members Attended</label>
                        <input only-digits="only-digits" type="text" required               ng-model="condct_traing_data.tcount" name="tcount" aria-label="Training Count"/>
                        <div ng-messages="TconductForm.tcount.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                    <label>Remarks</label>
                    <textarea ng-model="condct_traing_data.Remarks" rows="5" md-select-on-focus>
                    </textarea>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                        <md-button class="md-raised md-accent" ng-click="ConductTraining(condct_traing_data)" ng-disabled="TconductForm.$invalid" aria-label="submit" style="float:left" >Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
            </div>
        </md-dialog-content>
</md-dialog>