<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Escalation Types</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addEsclForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label> Escalations</label>
                        <input type="text" required ng-model="add_escal.escalation" name="escalation"  md-maxlength="50" aria-label="escalation"/>
                        <div ng-messages="addEsclForm.escalation.$error">
                            <div ng-message="required">Required.</div>							<div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addEscalation(add_escal)" ng-disabled="addEsclForm.$invalid" aria-label="submit">Submit</md-button>
                         <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.escalation">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>