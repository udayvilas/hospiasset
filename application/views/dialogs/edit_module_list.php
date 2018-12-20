<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Modules List</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditModuleslist" flex="100" autocomplete="off">
                <div flex layout="column">
                   
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
                        <input  type="text" ng-model="hamodule.module_name" name="MODULE_NAME"   required>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>STATUS</label>
                        <md-select name="status" required ng-model="hamodule.status" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                        <md-button class="md-raised md-accent" ng-click="updateModules(hamodule)" ng-disabled="EditModuleslist.$invalid" aria-label="submit" style="float:left" >Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>