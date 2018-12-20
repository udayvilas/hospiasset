<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Equipment Class</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addEqclassForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label> Equipment Class</label>
                        <input type="text" required ng-model="add_eqclass.equp_class" name="equp_class" md-maxlength="5" aria-label="equp_class"/>
                        <div ng-messages="addEqclassForm.equp_class.$error">
                            <div ng-message="required">Required.</div>                            <div ng-message="md-maxlength">Max limit is reached.</div>					
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Code</label>
                        <input type="text" required ng-model="add_eqclass.eq_code" name="eq_code"  ng-change="add_eqclass.eq_code = (add_eqclass.eq_code | uppercase)" md-maxlength="3" ng-pattern="/^[a-zA-Z0-9 -]*$/" aria-label="eq_code"/>
                        <div ng-messages="addEqclassForm.eq_code.$error">
                            <div ng-message="required">Required.</div>                             <div ng-message="md-maxlength">Max limit is reached.</div>					        <div ng-show="addTtypeForm.eq_code.$error.pattern">Please Provide Valid Input.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addEqClass(add_eqclass)" ng-disabled="addEqclassForm.$invalid" aria-label="submit">Submit</md-button>
                         <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbbme_equipment_class">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>