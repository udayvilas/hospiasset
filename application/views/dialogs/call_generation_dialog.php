<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h4>Equipment Call Generation</h4>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-font-set="material-icons">clear</md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content flex layout-align="center center">
            <div class="md-dialog-content">
            <form layout="column" name="CGFrom" autocomplete="off" ng-cloak>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45" style="margin-top:15px;">
                        <label>Serial Number</label>
                        <input type="text" ng-model="fcg.serial_number" ng-disabled="true" aria-label="SERIAL NO"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45" style="margin-top:15px;">
                        <label>Contract Type</label>
                        <input type="text" ng-model="fcg.contract_type" ng-disabled="true" aria-label="Contract Type"/>
                    </md-input-container>
                </div>
                <md-input-container>
                    <label>Manfacture</label>
                    <input type="text" ng-model="fcg.company_name" ng-disabled="true" aria-label="C_NAME"/>
                </md-input-container>
                <md-input-container>
                    <label>Equipment ID</label>
                    <input type="text" ng-model="fcg.device_id" ng-disabled="true" name="device_id" aria-label="device_id"/>
                </md-input-container>

                <md-input-container class="md-block" flex-gt-sm>
                    <label>Caller Name</label>
                    <input type="text" ng-disabled="true" ng-model="fcg.caller_name" name="caller_name" aria-label="caller_name"/>
                </md-input-container>

                <md-input-container class="md-block" flex-gt-sm>
                    <label>Issue/Comment</label>
                    <md-select ng-model="fcg.complaint" required name="complaint">
                        <md-option ng-repeat="device_reason in device_reasons" ng-value="device_reason.COMPLANT_NAME">
                            {{device_reason.COMPLANT_NAME}}
                        </md-option>
                        <md-option ng-value="Other">{{Other}}</md-option>
                    </md-select>
                    <div class="md-errors-spacer"></div>
                    <div ng-messages="CGFrom.complaint.$error" md-auto-hide="true">
                        <div ng-message="required">Required</div>
                    </div>
                </md-input-container>

                <md-input-container ng-if="fcg.complaint==Other" class="md-block" flex-gt-sm>
                    <label>Other Issue</label>
                    <input type="text" ng-model="fcg.other_compalint" ng-required="fcg.complaint==Other" name="other_compalint" aria-label="other_compalint"/>
                    <div ng-messages="CGFrom.other_compalint.$error" md-auto-hide="true">
                        <div ng-message="required">Required</div>
                    </div>
                </md-input-container>

                <md-input-container class="md-block" flex-gt-sm>
                    <label>Priority</label>
                    <md-select ng-model="fcg.priority" required name="priority">
                        <md-option ng-repeat="device_priority in device_priorities" ng-value="device_priority.PID">
                            {{device_priority.PNAME}}
                        </md-option>
                    </md-select>
                    <div ng-messages="CGFrom.priority.$error" md-auto-hide="true">
                        <div ng-message="required">Required</div>
                    </div>
                </md-input-container>

                <md-input-container class="md-block" flex-gt-sm>
                    <label>Remarks</label>
                    <textarea ng-model="fcg.generationremarks" name="generationremarks" rows="5" md-select-on-focus></textarea>
                </md-input-container>
                <div lay="row" layout-align="center center">
                <input type="submit" value="Submit" class="md-raised md-accent md-button md-ink-ripple" ng-click="GenerateCallByUser(fcg)" ng-disabled="CGFrom.$invalid" aria-label="submit" style="float:left" />
                <div flex="2" hide-xs hide-sm><!-- Space --></div>
                <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
            </div>
        </md-dialog-content>
</md-dialog>