<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Escaltions</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <center>
            <form method="POST" name="EditEsclForm" flex class="" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Equipment Type*</label>
                        <md-select type="text" name="equp_type" required ng-disabled="true" ng-model="edit_escl.equp_type" aria-label="equp_type">
                           <md-option ng-value="equp_cat.ID" ng-repeat="equp_cat in equp_cats">{{equp_cat.NAME}}</md-option>
                        </md-select>
                        <div ng-messages="EditEsclForm.equp_type.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Call Type*</label>
                        <md-select name="es_module" required ng-model="edit_escl.es_module1" aria-label="es_module">
                            <md-option  ng-value="escalttype.ES_NAME" ng-repeat="escalttype in escalts_types">{{escalttype.ES_NAME}}</md-option>
                        </md-select>
                        <div ng-messages="EditEsclForm.es_module.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Utilization *</label>
                        <md-select name="es_util" required ng-model="edit_escl.es_util" aria-label="es_util">
                            <md-option ng-value="util_value.VALUE" ng-repeat="util_value in util_values">{{util_value.NAME}}</md-option>
                        </md-select>
                        <div ng-messages="EditEsclForm.es_util.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="column">
                    <div flex layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Level1</label>
                            <input only-digits="only-digits" type="text" required ng-model="edit_escl.level1" ng-pattern="/^(\d)+$/" md-maxlength="5"  name="level1" aria-label="level1"/>
                            <div ng-messages="EditEsclForm.level1.$error">
                                <div ng-message="required">Required.</div>								<div ng-message="md-maxlength">Max limit is reached.</div>								<div ng-show="EditEsclForm.level1.$error.pattern">Input is only numbers.</div>
                            </div>
                        </md-input-container>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Type</label>
                            <md-select name="l1_type" required ng-model="edit_escl.l1_type" aria-label="l1_type">
                                <md-option  ng-value="type" ng-repeat="type in time_types">{{type}}</md-option>
                            </md-select>
                            <div ng-messages="EditEsclForm.l1_type.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div flex layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Level2</label>
                            <input only-digits="only-digits" type="text" required ng-model="edit_escl.level2"  ng-pattern="/^(\d)+$/"  md-maxlength="5" name="level2" aria-label="level2"/>
                            <div ng-messages="EditEsclForm.level2.$error">
                                <div ng-message="required">Required.</div>								<div ng-message="md-maxlength">Max limit is reached.</div>                                <div ng-show="EditEsclForm.level2.$error.pattern">Input is only numbers.</div>
                            </div>
                        </md-input-container>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Type</label>
                            <md-select name="l2_type" required ng-model="edit_escl.l2_type" aria-label="l2_type">
                                <md-option  ng-value="type" ng-repeat="type in time_types">{{type}}</md-option>
                            </md-select>
                            <div ng-messages="EditEsclForm.l2_type.$error">
                                <div ng-message="required">Required.</div>								
                            </div>
                        </md-input-container>
                    </div>
                    <div flex layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Level3</label>
                            <input only-digits="only-digits" type="text" required md-maxlength="5" ng-model="edit_escl.level3" ng-pattern="/^(\d)+$/"  md-maxlength="5"  name="level" aria-label="level3"/>
                            <div ng-messages="EditEsclForm.level3.$error">
                                <div ng-message="required">Required.</div>								<div ng-message="md-maxlength">Max limit is reached.</div>                                <div ng-show="EditEsclForm.level3.$error.pattern">Input is only numbers.</div>
                            </div>
                        </md-input-container>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Type</label>
                            <md-select name="l3_type" required ng-model="edit_escl.l3_type" aria-label="l3_type">
                                <md-option  ng-value="type" ng-repeat="type in time_types">{{type}}</md-option>
                            </md-select>
                            <div ng-messages="EditEsclForm.l3_type.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                </div>


                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateEscalations1(edit_escl)" ng-disabled="addEsclForm.$invalid" aria-label="submit" style="float:left">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
            </center>
        </div>
    </md-dialog-content>

</md-dialog>