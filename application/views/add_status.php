<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Status</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addStatusForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{stat_label.STATUS}}</label>
                        <input type="text" required ng-model="add_status.status" name="status" md-maxlength="50" aria-label="status"/>
                        <div ng-messages="addStatusForm.status.$error">
                            <div ng-message="required">Required.</div>                               <div ng-message="md-maxlength">Max limit is reached.</div>						    
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{stat_label.SCODE}}</label>
                        <input type="text" required ng-model="add_status.status_code" name="status_code" ng-change="add_status.status_code = (add_status.status_code | uppercase)" md-maxlength="3" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" aria-label="status_code"/>
                        <div ng-messages="addStatusForm.status_code.$error">
                            <div ng-message="required">Required.</div>							   <div ng-message="md-maxlength">Max limit is reached.</div>							  <div ng-show="addStatusForm.status_code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addStatus(add_status)" ng-disabled="addStatusForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbbme_status">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>