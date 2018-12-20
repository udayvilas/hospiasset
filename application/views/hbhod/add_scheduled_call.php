<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Add Scheduled Call</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="addScheduledForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="45">

                        <label>Caller Name</label>

                        <input type="text" required ng-model="add_schedule.name"  ng-change="check_scheduled_call(add_schedule.name)" name="name" aria-label="equp_condition"/>
                        <span ng-bind="CMessage" ng-style="{color:CColor}"></span>


                    </md-input-container>

                    <div flex="10" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                      <!--  <label>Contract Type *</label>-->
                        <md-select ng-model="add_schedule.value" name="values"  placeholder="select" aria-label="values">
                            <md-option ng-repeat="month in months" ng-value="month">
                                {{month}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="10" hide-xs hide-sm><!-- Space --></div>



                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <!--  <label>Contract Type *</label>-->
                        <md-select ng-hide="true" ng-show="add_schedule.value=='Day'"   placeholder="DAY" ng-model="add_schedule.days"  aria-label="contract">
                            <md-option ng-repeat="day in days" ng-value="day">
                                {{day}}
                            </md-option>
                        </md-select>


                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <!--  <label>Contract Type *</label>-->
                        <md-select ng-hide="true" ng-show="add_schedule.value=='Year'" placeholder="YEAR"  ng-model="add_schedule.years"  aria-label="contract">
                            <md-option ng-repeat="year in years" ng-value="year">
                                {{year}}
                            </md-option>
                        </md-select>

                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <!--  <label>Contract Type *</label>-->
                        <md-select ng-hide="true" ng-show="add_schedule.value=='Month'"  placeholder="MONTH"  ng-model="add_schedule.months"  aria-label="contract">
                            <md-option ng-repeat="month_value in months_values" ng-value="month_value">
                                {{month_value}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">



                        <md-button class="md-raised md-accent" ng-click="addscheduledcall(add_schedule)"  aria-label="submit">Submit</md-button>
                        <md-button class-="md-raised md-accent" ng-click="switchState('home.hbhod_scheduled_calls')" aria-label="cancel">Cancel</md-button>

                </div>

            </form>

        </div>

    </div>

</md-content>