<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Levels</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addLevelForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{level_labels.LEVEL_NAME}} </label>
                        <input type="text" required ng-model="add_level.level" name="level" md-maxlength="10" aria-label="level"/>
                        <div ng-messages="addLevelForm.level.$error">
                            <div ng-message="required">Required.</div>							
							<div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					 <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{level_labels.LEVEL_CODE}} </label>
                        <input type="text" required ng-model="add_level.level_code" ng-change="add_level.level_code = (add_level.level_code | uppercase)" name="level_code" md-maxlength="3" aria-label="level_code"/>
                        <div ng-messages="addLevelForm.level_code.$error">
                            <div ng-message="required">Required.</div>							
							<div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>

                </div>
                <div flex layout="row" layout-align="center center">
                   
                        <md-button class="md-raised md-accent" ng-click="addLevels(add_level)" ng-disabled="addLevelForm.$invalid" aria-label="submit">Submit</md-button>
                         <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.levels">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>