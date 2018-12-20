<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" layout-wrap md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Equipment Type</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addEqupTypeForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>{{equp_type_labels.TYPE}}</label>
                        <input type="text" required ng-model="add_equp_type.type" md-maxlength="50" name="type" aria-label="type"/>
                        <div ng-messages="addEqupTypeForm.type.$error">                            <div ng-message="required">Required.</div>                            <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>{{equp_type_labels.CODE}}</label>
                        <input type="text" required ng-model="add_equp_type.code" md-maxlength="3" ng-change="add_equp_type.code = (add_equp_type.code | uppercase)"  ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" name="code" aria-label="code"/>
                        <div ng-messages="addEqupTypeForm.code.$error">                            <div ng-message="required">Required.</div>                             <div ng-message="md-maxlength">Max limit is reached.</div>							 <div ng-show="addEqupTypeForm.code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addEqupType(add_equp_type)" ng-disabled="addEqupTypeForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.equipment_types">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>