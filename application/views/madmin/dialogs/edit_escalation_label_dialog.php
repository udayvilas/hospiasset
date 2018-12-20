<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Escalation Labels List</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditEscalationlabels" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
                        <!--<md-select name="module_id" required ng-model="eescalation.module_id" aria-label="module_id">
                            <md-option  ng-value="hamodule.MODULE_ID" ng-repeat="hamodule in hamodules">{{hamodule.MODULE_NAME}}</md-option>
                        </md-select>-->
                        <input  type="text" ng-model="eescalation.module_id" ng-disabled="true" name="module_id">
                        <div ng-messages="EditEscalationlabels.module_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Equp Type</label>
                    <input  type="text" ng-model="eescalation.equp_type"  name="equp_type" >
                    <div ng-messages="EditEscalationlabels.equp_type.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Esc Type</label>
                    <input  type="text" ng-model="eescalation.esc_types"  name="esc_types">
                    <div ng-messages="EditEscalationlabels.esc_types.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Escalation Category</label>
                    <input  type="text" ng-model="eescalation.esc_cat"  name="esc_cat" >
                    <div ng-messages="EditEscalationlabels.esc_cat.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>L1</label>
                    <input  type="text" ng-model="eescalation.l1"  name="l1" >
                    <div ng-messages="EditEscalationlabels.l1.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>L2</label>
                    <input  type="text" ng-model="eescalation.l2"  name="l2" >
                    <div ng-messages="EditEscalationlabels.l2.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>

                <md-input-container class="md-block" flex-gt-sm>
                    <label>L3</label>
                    <input  type="text" ng-model="eescalation.l3"  name="l3" >
                    <div ng-messages="EditEscalationlabels.l3.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="updateescalationlabel(eescalation)" ng-disabled="EditEscalationlabels.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>