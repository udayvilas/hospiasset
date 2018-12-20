<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Equipment Condition</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center" ng-repeat="equpcond in equpconditionlabel">
            <form method="POST" name="addEqcondForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>{{equpcond.CONDITION_NAME}}</label>
                        <input type="text" required ng-model="add_eqcond.equp_condition" name="equp_condition" md-maxlength="50" aria-label="equp_condition"/>
                        <div ng-messages="addEqcondForm.equp_condition.$error">
                            <div ng-message="required">Required.</div>                           <div ng-message="md-maxlength">Max limit is reached.</div>					
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>{{equpcond.CODE}}</label>
                        <input type="text" required ng-model="add_eqcond.equp_code" name="equp_code" ng-change="add_eqcond.equp_code = (add_eqcond.equp_code | uppercase)" md-maxlength="3" ng-pattern="/^[a-zA-Z0-9 -]*$/" aria-label="equp_code"/>
                        <div ng-messages="addEqcondForm.equp_code.$error">
                            <div ng-message="required">Required.</div>                               <div ng-message="md-maxlength">Max limit is reached.</div>                               <div ng-show="addEqcondForm.equp_code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                </div>
                <div flex layout="row" layout-align="center center">
                   
                        <md-button class="md-raised md-accent" ng-click="addEqupCondition(add_eqcond)" ng-disabled="addEqcondForm.$invalid" aria-label="submit">Submit</md-button>
                         <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbbme_equipment_condition">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>