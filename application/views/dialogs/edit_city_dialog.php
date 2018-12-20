<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>City Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditCityForm" flex="100" autocomplete="off">
                <div flex layout="row" ng-repeat="cities in citieslabelslist">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{cities.CITY_NAME}}</label>
                        <input  type="text" ng-model="ecity_data.city_name" name="city_name" required>
                        <div ng-messages="EditCityForm.city_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{cities.CITY_NAME}}</label>
                        <input  type="text" ng-model="ecity_data.city_code" ng-maxlength="3" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" ng-change="ecity_data.city_code = (ecity_data.city_code | uppercase)" name="city_code" required>
                        <div ng-messages="EditCityForm.city_code.$error">
                            <div ng-message="required">Required.</div>							<div ng-show="EditCityForm.city_code.$error.maxlength">Maxlength is Exceeds</div>						   <div ng-show="EditCityForm.city_code.$error.pattern">Please type text only</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{cities.STATUS}}*</label>
                        <md-select name="status" required ng-model="ecity_data.status" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EditCityForm.status.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                        <md-button class="md-raised md-accent" ng-click="UpdateCity(ecity_data)" ng-disabled="EditCityForm.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>