<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Location</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addlocationForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="column">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Location Name</label>
                        <input type="text" required ng-model="add_location.location_name" name="location_name" aria-label="location_name"/>
                        <div ng-messages="addlocationForm.location_name.$error">
                            <div ng-message=="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="addLocation(add_location)" ng-disabled="addlocationForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-accent" ng-click="switchState('home.location')" aria-label="cancel">Cancel</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>