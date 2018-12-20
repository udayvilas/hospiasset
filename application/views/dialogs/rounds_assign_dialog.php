<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-dialog aria-label="dialog-box" flex="40">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Round Attend / Assign</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <md-tabs md-dynamic-height md-border-bottom>
                <md-tab md-primary label="Attend"><!-- Self Response Tab Begin -->
                    <md-content>
                        <form method="POST" name="RoundAttendForm" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                            <div flex layout="column">
                                <md-input-container>
                                    <label>Name</label>
                                    <input type="text" ng-model="round_assigned.assigned_to" name="assigned_to" aria-label="assigned_to" ng-disabled="true">
                                </md-input-container>
                                <md-input-container>
                                    <label>Assigned By</label>
                                    <input type="text" ng-model="round_assigned.assigned_by" name="assigned_by" aria-label="assigned_by" ng-disabled="true">
                                </md-input-container>
                                <md-input-container>
                                    <label>Department</label>
                                    <input type="text" ng-model="round_assigned.departs" name="departs" aria-label="departs" ng-disabled="true">
                                </md-input-container>
                            </div>

                            <div flex layout="row" layout-align="center center">
                                <center>
                                    <md-button class="md-raised md-accent" ng-click="AttendRound(round_assigned)" ng-disabled="RoundAttendForm.$invalid" aria-label="submit">Attend</md-button>
                                </center>
                                <center>
                                    <md-button class="md-raised md-default" ng-click="cancel()"  aria-label="cancel">Cancel</md-button>
                                </center>
                            </div>
                        </form>
                    </md-content>
                </md-tab> <!-- Self Response Tab End -->
                <md-tab md-primary label="Assign"><!-- Assign Tab Begin -->
                    <md-content>
                        <form method="POST" name="RoundsassignForm" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                            <div flex layout="column">
                                <md-input-container>
                                    <label>Assign to *</label>
                                    <md-select ng-model="round_assigned.assigning_to" name="assigning_to" required name="assigning_to">
                                        <md-option ng-repeat="bmehod in bmehods" ng-value="bmehod.USER_ID">
                                            {{bmehod.USER_NAME}}
                                        </md-option>
                                    </md-select>
                                </md-input-container>
                                <md-input-container>
                                    <label>Department </label>
                                    <input type="text" ng-disabled="true" ng-model="round_assigned.departs" name="departs" aria-label="departs">
                                </md-input-container>
                            </div>

                            <div flex layout="row" layout-align="center center">
                                <center>
                                    <md-button class="md-raised md-accent" ng-click="ReRoundAssign(round_assigned)" ng-disabled="RoundsassignForm.$invalid" aria-label="submit">Assign</md-button>
                                </center>
                                <center>
                                    <md-button class="md-raised md-default" ng-click="cancel()" aria-label="cancel">Cancel</md-button>
                                </center>
                            </div>
                        </form>
                    </md-content>
                </md-tab> <!-- Assign Tab End -->
            </md-tabs>
        </div>
    </md-dialog-content>
</md-dialog>