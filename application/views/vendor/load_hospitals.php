<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Select Hospital</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="LoadvendorForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="column">
                    <md-input-container class="md-block" flex-gt-sm flex="100">
                        <label>Hospitals *</label>
                        <div class="icon-office" style="hieght:10px;width:20px;" ></div>
                        <md-select ng-model="vendor_select.org_id" name="org_id"  required  aria-label="org_id">
                            <md-option ng-repeat="hospital in hospitals_vendor" ng-value="hospital.ORG_ID">
                                {{hospital.ORG_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="vendor_call(vendor_select)" ng-disabled="LoadvendorForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>
