<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Training Types</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addTtypeForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label> Training Type</label>
                        <input type="text" required ng-model="add_ttype.training_type" name="training_type" md-maxlength="50" aria-label="training_type"/>
                        <div ng-messages="addTtypeForm.training_type.$error"> 
						<div ng-message="required">Required.</div>		
						<div ng-message="md-maxlength">Max limit is reached.</div>  
						</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Training Type Code</label>
                        <input type="text" required ng-model="add_ttype.training_code" ng-change="add_ttype.training_code = (add_ttype.training_code | uppercase)" name="training_code" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/"  md-maxlength="3"   aria-label="training_code"/>
                        <div ng-messages="addTtypeForm.training_code.$error">                            
						<div ng-message="required">Required.</div>             
						<div ng-message="md-maxlength">Max limit is reached.</div>				
						<div ng-show="addTtypeForm.training_code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>

                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addTrainigType(add_ttype)" ng-disabled="addTtypeForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbbme_training_type">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>