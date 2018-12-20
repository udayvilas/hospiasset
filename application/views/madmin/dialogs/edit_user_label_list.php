<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>User Labels List</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditUserlabels" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
                        <!--<md-select name="module_id" required ng-model="euserlabel.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>-->
                        <input  type="text" ng-model="euserlabel.module_id" ng-disabled="true" name="module_id" >
                        <div ng-messages="EditUserlabels.module_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
               
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				
				<md-input-container class="md-block" flex-gt-sm>
                        <label>ORG Name</label>
                        <!--<md-select name="module_id" required ng-model="euserlabel.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>-->
                        <input  type="text" ng-model="euserlabel.org_id" ng-disabled="true" name="org_id" >
                        <div ng-messages="EditUserlabels.org_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
					 </div>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>User Name</label>
                    <input  type="text" ng-model="euserlabel.user_name"  name="user_name" >
                    <div ng-messages="EditUserlabels.user_name.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Email</label>
                    <input  type="text" ng-model="euserlabel.email"  name="email">
                    <div ng-messages="EditUserlabels.email.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Contact</label>
                    <input  type="text" ng-model="euserlabel.contact"  name="contact" >
                    <div ng-messages="EditUserlabels.contact.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Role</label>
                    <input  type="text" ng-model="euserlabel.role"  name="role" >
                    <div ng-messages="EditUserlabels.role.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Level</label>
                    <input  type="text" ng-model="euserlabel.levels"  name="levels" >
                    <div ng-messages="EditUserlabels.levels.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Branch</label>
                    <input  type="text" ng-model="euserlabel.branch"  name="branch" >
                    <div ng-messages="EditUserlabels.branch.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Status</label>
                    <input  type="text" ng-model="euserlabel.status"  name="status" >
                    <div ng-messages="EditUserlabels.status.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Action</label>
                    <input  type="text" ng-model="euserlabel.actions"  name="actions" >
                    <div ng-messages="EditUserlabels.actions.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="UpdateUserlabel(euserlabel)" ng-disabled="EditUserlabels.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>