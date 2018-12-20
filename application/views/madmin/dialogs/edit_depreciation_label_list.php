<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Depreciation Labels Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="DeprLabel" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
						 <input  type="text"  ng-disabled="true" ng-model="edepreciation.module_id"  name="module_id" >
                        <!---<md-select name="module_id"  ng-value="hamodule.MODULE_ID"  ng-repeat="hamodule in hamodules" ng-model="edepreciation.module_id"  ng-disabled="true" aria-label="module_id">
                            
                        </md-select>-->
                        
                    </md-input-container>
					
               <div flex="5" hide-xs hide-sm><!-- Space --></div>
				
				<md-input-container class="md-block" flex-gt-sm>
                        <label>Org Name</label>
						 <input  type="text"  ng-disabled="true" ng-model="edepreciation.org_id"  name="org_id" >
                        <!---<md-select name="module_id"  ng-value="hamodule.MODULE_ID"  ng-repeat="hamodule in hamodules" ng-model="edepreciation.module_id"  ng-disabled="true" aria-label="module_id">
                            
                        </md-select>-->
                        
                    </md-input-container>
					
					 </div>
                
                <md-input-container class="md-block" flex-gt-sm>
                    <label>name</label>
                    <input  type="text" ng-model="edepreciation.name"  name="name" >
                    <div ng-messages="DeprLabel.name.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Percentage</label>
                    <input  type="text" ng-model="edepreciation.percentage"  name="percentage">
                    <div ng-messages="DeprLabel.percentage.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Status*</label>
                    <input  type="text" ng-model="edepreciation.status"  name="status">
                    <div ng-messages="DeprLabel.status.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Action</label>
                    <input  type="text" ng-model="edepreciation.actions"  name="actions">
                    <div ng-messages="DeprLabel.status.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>

                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="Updatedepreciationlabel(edepreciation)" ng-disabled="DeprLabel.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>