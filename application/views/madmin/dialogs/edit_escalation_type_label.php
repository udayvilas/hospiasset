<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Esc Type List</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditEsctypelist" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
                        <!--<md-select name="module_id" required ng-model="eesctype.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>-->
                        <input  type="text" ng-model="eesctype.module_id" ng-disabled="true" name="module_id" >
                        <div ng-messages="EditEsctypelist.module_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Esc Name</label>
                    <input  type="text" ng-model="eesctype.esc_name"  name="esc_name" >
                    <div ng-messages="EditEsctypelist.esc_name.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Status</label>
                    <input  type="text" ng-model="eesctype.status"  name="status" >
                    <div ng-messages="EditEsctypelist.status.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Action</label>
                    <input  type="text" ng-model="eesctype.actions"  name="actions" >
                    <div ng-messages="EditEsctypelist.actions.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="updateescalationtypelabel(eesctype)" ng-disabled="EditEsctypelist.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>