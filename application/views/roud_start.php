<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Round Start</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="Roundstartform" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div class="row">
                    <div style="float: left">
                        <md-button class="md-raised md-primary" ng-disabled="sround!=undefined" style="width:80px;height:30px;" ng-click="StartRound($event)">Start<span ng-if="sround!=undefined">ed</span></md-button>

                        <md-button class="md-raised md-warn" ng-disabled="eround!=undefined" style="width:80px;height:30px;"  ng-click="StopRound($event)">End</md-button>
                    </div>
                    <md-button class="md-raised" ui-sref="home.hbbme_generate_call" style="width:120px;height:30px;
margin-top:0px;float:right">Generate Call</md-button>
                </div>
                <div flex layout="row">
                    <md-input-container flex="30">
                        <label>Department</label>
                        <md-select ng-model="round_start.departments" name="depts" ng-disabled="sround!=undefined">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>
                    <div class="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Remarks</label>
                            <input ng-model="round_start.remarks" required>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Suggestions</label>
                            <input ng-model="round_start.sugessions">
                        </md-input-container>
                    </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="RoundSubmit()" ng-disabled="Roundstartform.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>