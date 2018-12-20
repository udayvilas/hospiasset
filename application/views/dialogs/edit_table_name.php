<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Location Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EdittableForm" flex="100" autocomplete="off">
                <div flex layout="row">
				<md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
                        <input  type="text" ng-model="etable.module_id" name="table_name"  ng-disabled="true" required>
                        <div ng-messages="EdittableForm.table_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
						<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    </md-input-container>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Table Name</label>
                        <input  type="text" ng-model="etable.table_name" name="table_name" required>
                        <div ng-messages="EdittableForm.table_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    
                </div>

                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="UpdateTablename(etable)" ng-disabled="EditLocationForm.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>