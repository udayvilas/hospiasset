<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Incident Type</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addItypeForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row" >
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{itypes_label.ITYPE}}</label>
                        <input type="text" required ng-model="add_itype.itype" name="itype"  md-maxlength="50"  aria-label="itype"/>
                        <div ng-messages="addItypeForm.itype.$error">     
						<div ng-message="required">Required.</div>         	
						<div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{itypes_label.CODE}}</label>
                        <input type="text" required ng-model="add_itype.icode" 
 ng-change="add_itype.icode = (add_itype.icode | uppercase)" name="icode" md-maxlength="3"  ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" aria-label="icode"/>
                        <div ng-messages="addItypeForm.icode.$error">    
						<div ng-message="required">Required.</div>   
						<div ng-show="addItypeForm.icode.$error.pattern">Please Provide Text Only.</div>  		
						<div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addIncidentType(add_itype)" ng-disabled="addItypeForm.$invalid" aria-label="submit">Submit</md-button>
                         <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.incident_type">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>