<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Table </h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addTableName" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="column">
				<md-input-container class="md-block" flex-gt-sm flex="40">
                       <label>Org Module</label>
                        <md-select ng-model="add_table_name.module_id" name="module_id"    aria-label="module_id">
                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">
                                {{hamodule.MODULE_NAME}}
                            </md-option>
                        </md-select>
                        <div ng-messages="addTableName.table_name.$error">
                            <div ng-message=="required">Required.</div>
                        </div>
                    </md-input>
					   <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Table Name</label>
                        <input type="text" required ng-model="add_table_name.table_name" name="table_name" aria-label="location_name"/>
                        <div ng-messages="addTableName.table_name.$error">
                            <div ng-message=="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="addTablelabel(add_table_name)" ng-disabled="addTableName.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-accent" ng-click="switchState('home.get_table_name')" aria-label="cancel">Cancel</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>