<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Incident Type Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditItypeForm" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{itypes_label.ITYPE}}</label>
                        <input  type="text" ng-model="eityp.itype" name="itype" md-maxlength="50"  required>
                        <div ng-messages="EditItypeForm.itype.$error">                            <div ng-message="required">Required.</div>							<div ng-message="md-maxlength">Max limit is reached.</div>							
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{itypes_label.CODE}}</label>
                        <input  type="text" ng-model="eityp.icode" name="icode" md-maxlength="3" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" ng-change="eityp.icode = (eityp.icode | uppercase)"  required>
                        <div ng-messages="EditItypeForm.icode.$error">
                            <div ng-message="required">Required.</div>							<div ng-message="md-maxlength">Max limit is reached.</div>							<div ng-show="EditItypeForm.icode.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{itypes_label.STATUS}}*</label>
                        <md-select name="status" required ng-model="eityp.status" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EditItypeForm.status.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateIncidenttype(eityp)" ng-disabled="EditItypeForm.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>

</md-dialog>