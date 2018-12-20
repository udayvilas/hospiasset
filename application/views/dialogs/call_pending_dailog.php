<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h4>Pending/Complete Call</h4>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel()">
                    <md-icon md-font-set="material-icons">clear</md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content flex layout-align="center center">
            <div class="md-dialog-content">
                <form layout="column" name="MPCForm" autocomplete="off" ng-cloak>
                    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                        <md-input-container class="md-block" flex-gt-sm flex="45" style="margin-top:15px;">
                            <label>Serial Number</label>
                            <input type="text" ng-model="mpending_device_dtls.serial_number" ng-disabled="true" aria-label="SERIAL NO"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45" style="margin-top:15px;">
                            <label>Contract Type</label>
                            <input type="text" ng-model="mpending_device_dtls.contract_type" ng-disabled="true" aria-label="Contract Type"/>
                        </md-input-container>
                    <!--</div>-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container flex="45">
                        <label>Manufacturer</label>
                        <input type="text" ng-model="mpending_device_dtls.company_name" ng-disabled="true" aria-label="C_NAME"/>
                    </md-input-container>
                    <!--<div layout="row">-->
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Name</label>
                            <input type="text" ng-model="mpending_device_dtls.eq_name" ng-disabled="true" aria-label="CALLER_ID"/>
                        </md-input-container>

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment ID</label>
                            <input type="text" ng-disabled="true" name="EID" ng-model="user_org == mpending_device_dtls.ORG_ID ? mpending_device_dtls.EID : mpending_device_dtls.ASSIGN_ID" aria-label="EID"/>
                        </md-input-container>
                    <!--</div>-->
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--<div layout="row">-->
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Action Taken</label>
                        <input type="text" ng-model="mpending_device_dtls.ACTION_TAKEN" required name="ACTION_TAKEN" aria-label="ACTION_TAKEN"/>
                        <div ng-messages="MPCForm.ACTION_TAKEN.$error" md-auto-hide="true">
                            <div ng-message="required">Required</div>
                        </div>
                    </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Pending Reason *</label>
                        <md-select  required ng-model="mpending_device_dtls.PENDING_REASON" ng-change="changePendingReason(mpending_device_dtls.PENDING_REASON)" ng name="PENDING_REASON">
                            <md-option ng-value="causecode.CAUSE" ng-repeat="causecode in cause_codes">{{causecode.CAUSE}}</md-option>
                            <md-option ng-value="Other">{{Other}}</md-option>
                        </md-select>
                        <div ng-messages="MPCForm.PENDING_REASON.$error" md-auto-hide="true">
                            <div ng-message="required">Required</div>
                        </div>
                    </md-input-container>
                        <div flex="5" ng-show="mpending_device_dtls.PENDING_REASON=='Other'" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container ng-show="mpending_device_dtls.PENDING_REASON=='Other'" class="md-block" flex-gt-sm flex="45">
                            <label>Other Reason</label>
                            <input type="text" required ng-model="mpending_device_dtls.other_reason" ng-required="mpending_device_dtls.PENDING_REASON=='Other'" name="other_reason" aria-label="other_reason"/>
                            <div ng-messages="MPCForm.other_reason.$error" md-auto-hide="true">
                                <div ng-message="required">Required</div>
                            </div>
                        </md-input-container>
                    <!--</div>-->
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--<div layout="row">-->
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Parts Changed *</label>
                            <md-select ng-model="mpending_device_dtls.PARTS_CHANGE" required name="PARTS_CHANGE">
                                <md-option ng-value="yesstate">{{yesstate}}</md-option>
                                <md-option ng-value="nostate">{{nostate}}</md-option>
                            </md-select>
                            <div ng-messages="MPCForm.PARTS_CHANGE.$error" md-auto-hide="true">
                                <div ng-message="required">Required</div>
                            </div>
                        </md-input-container>

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container ng-show="mpending_device_dtls.PARTS_CHANGE!=null" class="md-block" flex-gt-sm flex="45">
                            <label>Part Type <span ng-if="mpending_device_dtls.PARTS_CHANGE==yesstate">*</span></label>
                            <md-select required ng-model="mpending_device_dtls.PART_TYPE" ng-required="mpending_device_dtls.PARTS_CHANGE==yesstate" name="PART_TYPE" aria-label="PART_TYPE">
                                <md-option ng-value="nullValue">Select Type</md-option>
                                <md-option ng-value="inhouse">{{inhouse}}</md-option>
                                <md-option ng-value="company">{{company}}</md-option>
                            </md-select>
                            <div ng-messages="MPCForm.PART_TYPE.$error" md-auto-hide="true">
                                <div ng-message="required">Required</div>
                            </div>
                        </md-input-container>
                     <!--</div>

                    <div layout="row">-->
                        <div flex="5" ng-show="mpending_device_dtls.PARTS_CHANGE!=null" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Part Name</label>
                            <input type="text" name="PART_NAME" ng-model="mpending_device_dtls.PART_NAME" aria-label="PART_NAME"/>
                        </md-input-container>

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>PO Number</label>
                            <input type="text" name="PO_NUMBER" ng-model="mpending_device_dtls.PO_NUMBER" aria-label="PO_NUMBER"/>
                        </md-input-container>
                    <!--</div>

                    <div layout="row">-->
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <mdp-date-picker mdp-placeholder="PO Date" class="md-block" flex-gt-sm flex="45" name="PO_DATE" ng-model="mpending_device_dtls.PO_DATE" aria-label="PO_DATE" mdp-format="DD-MM-YYYY"/>
                        </mdp-date-picker>

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <mdp-date-picker class="md-block" flex="45" flex-gt-sm ng-model="mpending_device_dtls.DELIVERY_DATE" name="DELIVERY_DATE" mdp-placeholder="Delivery Date" md-min-data="MaxDate" aria-label="Delivery Date" mdp-format="DD-MM-YYYY">
                        </mdp-date-picker>

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Total Cost</label>
                            <input type="text" name="COST" ng-model="mpending_device_dtls.COST" aria-label="COST"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Spent Cost</label>
                            <input type="text" name="SPENT_COST" ng-required="mpending_device_dtls.COST!=''" ng-model="mpending_device_dtls.SPENT_COST" aria-label="SPENT_COST"/>
                        </md-input-container>

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Remarks</label>
                            <textarea ng-model="mpending_device_dtls.REMARKS" rows="5" md-select-on-focus></textarea>
                        </md-input-container>
                    </div>
                    <div layout="row" layout-align="center center">
                        <input type="submit" value="Pending" ng-disabled="MPCForm.$invalid" class="md-raised md-accent md-button md-ink-ripple" ng-click="MakeCallAsPending(mpending_device_dtls)" style="float:left" aria-label="submit" />
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <input type="submit" value="Complete" ng-disabled="mpending_device_dtls.ACTION_TAKEN==null" class="md-raised md-accent md-button md-ink-ripple" ng-click="completeCall(mpending_device_dtls)" style="float:left" aria-label="submit" />
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>
                    </div>
                </form>
            </div>
        </md-dialog-content>
</md-dialog>