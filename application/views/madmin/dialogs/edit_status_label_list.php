<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Edit Status List</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditStatuslist" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
                        <!---<md-select name="module_id" required ng-model="estatuslabel.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>--->
                        <input  type="text" ng-model="estatuslabel.module_id" ng-disabled="true" name="module_id">
                        <div ng-messages="EditStatuslist.module_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
					 <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm>
                        <label>Org Name</label>
                        <!---<md-select name="module_id" required ng-model="estatuslabel.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>--->
                        <input  type="text" ng-model="estatuslabel.org_id" ng-disabled="true" name="org_id">
                        <div ng-messages="EditStatuslist.org_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Status Name</label>
                    <input  type="text" ng-model="estatuslabel.status_name"  name="status_name" >
                    <div ng-messages="EditStatuslist.status_name.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Code</label>
                    <input  type="text" ng-model="estatuslabel.code"  name="code" >
                    <div ng-messages="EditStatuslist.code.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<md-input-container class="md-block" flex-gt-sm>
                    <label>Status</label>
                    <input  type="text" ng-model="estatuslabel.status"  name="status" >
                    <div ng-messages="EditStatuslist.status.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Action</label>
                    <input  type="text" ng-model="estatuslabel.actions"  name="actions" >
                    <div ng-messages="EditStatuslist.actions.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="Updatestatuslabel(estatuslabel)" ng-disabled="EditStatuslist.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>