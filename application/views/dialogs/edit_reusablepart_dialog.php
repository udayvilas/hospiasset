<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Condemnation Reusable Parts Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditReusableform" flex="100" autocomplete="off">
                <div layout="column">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Reusable Parts</label>
                        <input  type="text" ng-model="edit_cond_reusableparts.reusableparts" name="reasons" required>
                        <div ng-messages="EditReusableform.reasons.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>

                    <md-input-container class="md-block" flex-gt-sm flex="100">
                        <label>Code</label>
                        <input type="text" required ng-model="edit_cond_reusableparts.code" name="code" aria-label="code"/>
                        <div ng-messages="EditReusableform.code.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Status*</label>
                        <md-select name="status" required ng-model="edit_cond_reusableparts.status" aria-label="status">
                            <md-option ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EditReusableform.status.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    <input type="submit" value="Submit" class="md-raised md-button md-accent" ng-click="UpdateConReusableparts(edit_cond_reusableparts)" ng-disabled="EditReusableform.$invalid" aria-label="submit" />
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>