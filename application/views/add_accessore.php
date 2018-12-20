<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Accessor</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addAccessorForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Accessor</label>
                        <input type="text" required ng-model="add_accessor.name" name="name" aria-label="equp_condition"/>
                        <div ng-messages="addAccessorForm.name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Code</label>
                        <input type="text" required ng-model="add_accessor.code" name="code" aria-label="code"/>
                        <div ng-messages="addAccessorForm.code.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="addAccessor(add_accessor)" ng-disabled="addAccessorForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>