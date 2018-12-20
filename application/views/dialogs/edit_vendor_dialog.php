<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Vendor Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content md-theme="inputs" flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditVendorForm" flex="100" autocomplete="off">
                <div flex layout="row" layout-align="center center">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>{{vendor_label.TYPE}} *</label>
                        <md-select name="type" required ng-model="evendor_data.type" name="type" aria-label="type" multiple>
                            <md-option ng-value="vdr_type.NAME" ng-repeat="vdr_type in vdr_types">{{vdr_type.NAME}}</md-option>
                        </md-select>
                        <div ng-messages="EditVendorForm.type.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{vendor_label.NAME}}</label>
                        <input required ng-model="evendor_data.vendor_name" md-maxlength="200" name="vendor_name">
                        <div ng-messages="EditVendorForm.vendor_name.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{vendor_label.MOBILE_NO}}Vendor Contact Number</label>
                        <input only-digits="only-digits" type="text" required ng-model="evendor_data.vendor_mbno" md-maxlength="14" ng-minlength="8" name="vendor_mbno" aria-label="mbl_no"/>
                        <div ng-messages="EditVendorForm.vendor_mbno.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                            <div ng-message="minlength">Min limit is 8.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{vendor_label.EMAIL_ID}}Vendor Email</label>
                        <input  ng-model="evendor_data.email_id" md-maxlength="50" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" name="email_id">
                        <div ng-messages="EditVendorForm.email_id.$error">
                           <div ng-message="required">Required.</div>
                            <div ng-message="pattern">Please Provide Email Format</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex="40">
                        <label>Vendor Address</label>
                        <input type="text" ng-model="evendor_data.address" md-maxlength="250"  name="address"  md-select-on-focus>
                        <div ng-messages="EditVendorForm.email_id.$error">
                            <div ng-message="required">Required.</div>
                            <div>
                    </md-input-container>
                </div>

                <div flex layout="row">
                    <md-button class="md-raised md-accent" ng-click="UpdateVendor(evendor_data)" ng-disabled="EditVendorForm.$invalid" aria-label="submit"  >Submit</md-button>
                    <md-button class="md-raised"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>