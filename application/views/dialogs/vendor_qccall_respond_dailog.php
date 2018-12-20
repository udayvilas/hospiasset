<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>QC Call Response / Assign</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <md-tabs md-dynamic-height md-border-bottom>
                <md-tab md-primary label="Self Response">
                    <!-- Self Response Tab Begin -->
                    <md-content>
                        <div layout="column">
                            <md-input-container class="md-block" flex-gt-sm>
                                <label>Equipment ID</label>
                                <input type="text" ng-disabled="true" ng-model="user_org == qcv_details.ORG_ID ? qcv_details.EID : qcv_details.ASSIGN_ID" aria-label="EID"/>
                            </md-input-container>
                            <md-input-container>
                                <label>Equipment Name</label>
                                <input type="text" ng-model="qcv_details.eq_name" ng-disabled="true" aria-label="CALLER_ID"/>
                            </md-input-container>
                            <md-input-container class="md-block" flex-gt-sm flex="45" style="margin-top:15px;">
                                <label>Serial Number</label>
                                <input type="text" ng-model="qcv_details.serial_number" ng-disabled="true" aria-label="SERIAL NO"/>
                            </md-input-container>
                            <md-input-container class="md-block" flex-gt-sm>
                                <label>Remarks</label>
                                <textarea ng-model="qcv_details.REMARKS" rows="5" md-select-on-focus></textarea>
                            </md-input-container>
                            <div layout="row" layout-align="center center">
                                <input type="button" value="Submit" class="md-raised md-accent md-button md-ink-ripple" ng-click="qcselfRespondToCall(qcv_details)" aria-label="submit" />
                                <div flex="2" hide-xs hide-sm>
                                    <!-- Space -->
                                </div>
                                <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                            </div>
                        </div>
                    </md-content>
                </md-tab>
                <!-- Self Response Tab End -->
                <md-tab md-primary label="Assign">
                    <!-- Assign Tab Begin -->
                    <md-content>
                        <form layout="column" name="RTCForm" autocomplete="off" ng-cloak>
                            <md-input-container class="md-block" flex-gt-sm>
                                <label>Equipment ID</label>
                                <input type="text" ng-disabled="true" ng-model="user_org == qcv_details.ORG_ID ? qcv_details.EID : qcv_details.ASSIGN_ID" aria-label="EID"/>
                            </md-input-container>
                            <md-input-container>
                                <label>Equipment Name</label>
                                <input type="text" ng-model="qcv_details.eq_name" ng-disabled="true" aria-label="CALLER_ID"/>
                            </md-input-container>
                            <md-input-container class="md-block" flex-gt-sm flex="45" style="margin-top:15px;">
                                <label>Serial Number</label>
                                <input type="text" ng-model="qcv_details.serial_number" ng-disabled="true" aria-label="SERIAL NO"/>
                            </md-input-container>
                            <md-input-container class="md-block" flex-gt-sm flex="45">
                                <md-input-container class="md-block" flex-gt-sm flex="45">
                                    <label>Select User*</label>
                                    <md-select  ng-model="qcv_details.user_id" name="user_id">
                                        <md-option ng-repeat="userdetail in userdetails"  ng-value="userdetail.USER_ID">
                                            {{userdetail.USER_NAME}}
                                        </md-option>
                                    </md-select>
                                    <div ng-messages="editIndentApprovedForm.branch_id.$error">
                                        <div ng-message="required">Required.</div>
                                    </div>
                                </md-input-container>
                                <div flex="5" hide-xs hide-sm></div>
                            </md-input-container>
                            <md-input-container class="md-block" flex-gt-sm>
                                <label>Remarks</label>
                                <textarea ng-model="qcv_details.REMARKS" rows="5" md-select-on-focus></textarea>
                            </md-input-container>
                            <div layout="row" layout-align="center center">
                                <input type="submit" value="Submit" ng-disabled="RTCForm.$invalid" class="md-raised md-accent md-button md-ink-ripple" ng-click="qcselfRespondToCall(qcv_details)" aria-label="submit"  style="float:left"/>
                                <div flex="2" hide-xs hide-sm>
                                    <!-- Space -->
                                </div>
                                <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                            </div>
                        </form>
                    </md-content>
                </md-tab>
                <!-- Assign Tab End -->
            </md-tabs>
        </div>
    </md-dialog-content>
</md-dialog>