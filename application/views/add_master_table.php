<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Master Tables</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addStatusForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Master Table Name</label>
                        <input type="text" required ng-model="add_master_table.master_table_name" name="master_table_name" md-maxlength="50" aria-label="master_table_name"/>
                        
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Master Table Desc</label>
                        <input type="text" required ng-model="add_master_table.master_table_desc"  aria-label="master_table_desc"/>                        
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addMasterTable(add_master_table)" ng-disabled="addStatusForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.ha_master_table">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>