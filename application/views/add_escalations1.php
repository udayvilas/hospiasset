<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Escalations</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addEsclForm" flex="50" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Equipment Type*</label>
                        <md-select name="equp_type" required ng-model="add_escl.equp_type" aria-label="equp_type">
                            <md-option  ng-value="equp_cat.ID" ng-repeat="equp_cat in equp_cats">{{equp_cat.NAME}}</md-option>
                        </md-select>
                        <div ng-messages="addEsclForm.equp_type.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Call Type*</label>
                        <md-select name="es_module" required ng-model="add_escl.es_module" aria-label="es_module">
                            <md-option  ng-value="escalttype.ES_NAME" ng-repeat="escalttype in escalts_types">{{escalttype.ES_NAME}}</md-option>
                        </md-select>
                        <div ng-messages="addEsclForm.es_module.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Utilization*</label>
                        <md-select name="es_util" required ng-model="add_escl.es_util" aria-label="es_util">
                            <md-option ng-value="util_value.VALUE" ng-repeat="util_value in util_values">{{util_value.NAME}}</md-option>
                        </md-select>
                        <div ng-messages="addEsclForm.es_util.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="column">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Level1</label>
                        <input only-digits="only-digits" type="text" required ng-pattern="/^(\d)+$/" ng-model="add_escl.level1" name="level1"  md-maxlength="5"  aria-label="level1"/>
                        <div ng-messages="addEsclForm.level1.$error">
                            <div ng-message="required">Required.</div>							<div ng-message="md-maxlength">Max limit is reached.</div>                            <div ng-show="addEsclForm.level1.$error.pattern">Input is only numbers.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Type</label>
                        <md-select name="l1_type" required ng-model="add_escl.l1_type" aria-label="l1_type">
                            <md-option  ng-value="type" ng-repeat="type in time_types">{{type}}</md-option>
                        </md-select>
                        <div ng-messages="addEsclForm.l1_type.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    </div>
                    <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Level2</label>
                        <input only-digits="only-digits" type="text" required  ng-pattern="/^(\d)+$/" ng-model="add_escl.level2"  md-maxlength="5" name="level2" aria-label="level2"/>
						<span ng-bind="LMessage" ng-style="{color:LColor}"></span>
                        <div ng-messages="addEsclForm.level2.$error">
                            <div ng-message="required">Required.</div>							<div ng-message="md-maxlength">Max limit is reached.</div>                            <div ng-show="addEsclForm.level2.$error.pattern">Input is only numbers.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Type</label>
                        <md-select name="l2_type" required ng-model="add_escl.l2_type" aria-label="l2_type"
						ng-change="level_check(add_escl.level1,add_escl.l1_type,add_escl.level2,add_escl.l2_type);">
                            <md-option  ng-value="type" ng-repeat="type in time_types">{{type}}</md-option>
                        </md-select>
                        <div ng-messages="addEsclForm.l2_type.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    </div>
                    <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Level3</label>
                        <input only-digits="only-digits" type="text" required ng-model="add_escl.level3" ng-pattern="/^(\d)+$/" md-maxlength="5" name="level" aria-label="level3"/>
						<span ng-bind="LLMessage" ng-style="{color:LLColor}"></span>
                        <div ng-messages="addEsclForm.level3.$error">
                            <div ng-message="required">Required.</div>							<div ng-message="md-maxlength">Max limit is reached.</div>							<div ng-show="addEsclForm.level3.$error.pattern">Input is only numbers.</div>
                        </div>
                    </md-input-container>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Type</label>
                            <md-select name="l3_type" required ng-model="add_escl.l3_type" aria-label="l3_type"
							ng-change="level_check1(add_escl.level2,add_escl.l1_type,add_escl.level3,add_escl.l3_type);">
                                <md-option  ng-value="type" ng-repeat="type in time_types">{{type}}</md-option>
                            </md-select>
                            <div ng-messages="addEsclForm.l3_type.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                </div>


                <div flex layout="row" layout-align="center center">
                    
               <md-button class="md-raised md-accent" ng-click="addEscalations1(add_escl)" ng-disabled="addEsclForm.$invalid" aria-label="submit">Submit</md-button>
                <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.escalations">Cancel</md-button>
				</div>
            </form>
        </div>
    </div>
</md-content>