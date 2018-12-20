<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Branch Labels List</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditBranchlabels" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
                        <!--<md-select name="module_id" required ng-model="ebranchlabel.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>--->
                        <input  type="text" ng-model="ebranchlabel.module_id" ng-disabled="true" name="module_id" >
                        <div ng-messages="EditBranchlabels.module_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
               
				<div flex="5" hide-xs hide-sm><!-- Space --></div>
				 <md-input-container class="md-block" flex-gt-sm>
                        <label>Org Name</label>
                        <!--<md-select name="module_id" required ng-model="ebranchlabel.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>--->
                        <input  type="text" ng-model="ebranchlabel.org_id" ng-disabled="true" name="org_id" >
                        <div ng-messages="EditBranchlabels.org_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
					
					 </div>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Branch Name</label>
                    <input  type="text" ng-model="ebranchlabel.branch_name"  name="branch_name" >
                    <div ng-messages="EditBranchlabels.branch_name.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Branch Code</label>
                    <input  type="text" ng-model="ebranchlabel.branch_code"  name="branch_code">
                    <div ng-messages="EditBranchlabels.branch_code.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>HOD</label>
                    <input  type="text" ng-model="ebranchlabel.hod"  name="hod">
                    <div ng-messages="EditBranchlabels.hod.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Address</label>
                    <input  type="text" ng-model="ebranchlabel.address"  name="address" >
                    <div ng-messages="EditBranchlabels.address.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Added</label>
                    <input  type="text" ng-model="ebranchlabel.added_date"  name="added_date" >
                    <div ng-messages="EditBranchlabels.added_date.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Status</label>
                    <input  type="text" ng-model="ebranchlabel.status"  name="status" >
                    <div ng-messages="EditBranchlabels.status.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Action</label>
                    <input  type="text" ng-model="ebranchlabel.actions"  name="actions" >
                    <div ng-messages="EditBranchlabels.actions.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="UpdateBranchlabel(ebranchlabel)" ng-disabled="EditBranchlabels.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>