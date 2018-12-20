<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Module</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addModuleForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="column">
                    

                <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label> Module Name</label>
                        <input type="text"  required ng-model="add_module.module_name" name="module_name" aria-label="module_name"/>
                    </md-input-container>
</div>
                                    <div flex layout="row" layout-align="center center">
                   
                        <md-button class="md-raised md-accent" ng-click="addhamodule(add_module)"  aria-label="submit">Submit</md-button>
                         <md-button class="md-raised md-accent" ng-click="switchState('home.haadmin_modules')" aria-label="cancel">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>

