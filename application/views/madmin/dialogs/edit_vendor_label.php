<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Edit Vendors Labels</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditVendorlabels" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
                        <!--<md-select name="module_id" required ng-model="evendor_label.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>-->
                        <input  type="text" ng-model="evendor_label.module_id"  ng-disabled="true" name="module_id" >
                        <div ng-messages="EditVendorlabels.module_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm>
                        <label>Org Name</label>
                        <!--<md-select name="module_id" required ng-model="evendor_label.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>-->
                        <input  type="text" ng-model="evendor_label.org_id"  ng-disabled="true" name="org_id" >
                        <div ng-messages="EditVendorlabels.org_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Vendor Name</label>
                    <input  type="text" ng-model="evendor_label.vendor_name"  name="vendor_name" >
                    <div ng-messages="EditVendorlabels.user_name.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Type</label>
                    <input  type="text" ng-model="evendor_label.type"  name="type">
                    <div ng-messages="EditVendorlabels.type.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Email</label>
                    <input  type="text" ng-model="evendor_label.email"  name="email" >
                    <div ng-messages="EditVendorlabels.email.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Contact</label>
                    <input  type="text" ng-model="evendor_label.contactno"  name="contactno" >
                    <div ng-messages="EditVendorlabels.role.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Contact Person</label>
                    <input  type="text" ng-model="evendor_label.contactperson"  name="contactperson">
                    <div ng-messages="EditVendorlabels.levels.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>cpnumber</label>
                    <input  type="text" ng-model="evendor_label.cpnumber"  name="cpnumber" >
                    <div ng-messages="EditVendorlabels.cpnumber.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>cpemail</label>
                    <input  type="text" ng-model="evendor_label.cpemail"  name="cpemail" >
                    <div ng-messages="EditVendorlabels.cpemail.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
				 <md-input-container class="md-block" flex-gt-sm>
                    <label>status</label>
                    <input  type="text" ng-model="evendor_label.status"  name="status" >
                    <div ng-messages="EditVendorlabels.status.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Action</label>
                    <input  type="text" ng-model="evendor_label.actions"  name="actions" >
                    <div ng-messages="EditVendorlabels.actions.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="updatevendorlabel(evendor_label)" ng-disabled="EditVendorlabels.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>