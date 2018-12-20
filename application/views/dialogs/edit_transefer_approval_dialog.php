<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Transfer Approval</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center" flex="100">
        <div class="md-dialog-content">
            <div flex layout="row" layout-align="center center">
                <md-input-container  class="md-block" flex-gt-sm flex="30">
                    <label>Transfers Status</label>
                    <md-select ng-model="atransfer_status" name="transfer_status">
                        <md-option ng-repeat="transfer_status in transfer_statuss" ng-value="transfer_status">
                            {{transfer_status}}
                        </md-option>
                    </md-select>
                </md-input-container>
            </div>
            <div ng-if="atransfer_status==transfer_statuss[0]" flex="100" layout="row" layout-align="center center">
            <form method="POST" name="EditTApprovalFeorm" flex="100"  autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>User Name</label>
                        <input type="text"  ng-model="edit_transfer_approval.username"  ng-disabled="true"  name="uname" aria-label="uname" />
                        <div ng-messages="EditTApprovalFeorm.uname.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Equipment Name</label>
                        <input type="text"  ng-model="edit_transfer_approval.E_NAME"  ng-disabled="true"  name="equp_name" aria-label="equp_name"/>
                        <div ng-messages="EditTApprovalFeorm.equp_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Department</label>
                        <md-select ng-model="edit_transfer_approval.DEPT_ID" name="depts"   ng-disabled="true">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Physical Location</label>
                        <input type="text"  ng-disabled="true"  ng-model="edit_transfer_approval.PHYSICAL_LOCATION" name="plocation" aria-label="plocation" />
                        <div ng-messages="EditTApprovalFeorm.plocation.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Date & Time</label>
                        <input type="text"  ng-model="edit_transfer_approval.ADDED_ON" name="date_time" aria-label="date_time"  ng-disabled="true" />
                        <div ng-messages="EditTApprovalFeorm.date_time.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Branch </label>
                        <input type="text"  ng-model="edit_transfer_approval.branchname"  ng-disabled="true"  name="branchname" aria-label="branchname"/>
                        <div ng-messages="EditTApprovalFeorm.branchname.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Reasons</label>
                        <textarea ng-model="edit_transfer_approval.REASON" ng-disabled="true" name="reasons" rows="5" md-select-on-focus> </textarea>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Admin Feedback</label>
                        <textarea ng-model="edit_transfer_approval.feedback" name="feedback" rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="EditTApprovalFeorm.feedbak.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateApprovalList(edit_transfer_approval,atransfer_status)" ng-disabled="EditTApprovalFeorm.$invalid" aria-label="submit">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
                </div>

            <div ng-if="atransfer_status==transfer_statuss[1]" flex layout="row" layout-align="center center">
                <form method="POST" name="EditTApprovalFeorm"  autocomplete="off" flex="100">
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Name</label>
                            <input type="text"  ng-model="edit_transfer_approval.E_NAME" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                            <div ng-messages="EditTApprovalFeorm.equp_name.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Physical Location</label>
                            <input type="text"  ng-model="edit_transfer_approval.PHYSICAL_LOCATION" name="plocation"  ng-disabled="true" aria-label="plocation" />
                            <div ng-messages="EditTApprovalFeorm.plocation.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>User Name</label>
                            <input type="text"  ng-model="edit_transfer_approval.username" name="uname" aria-label="uname" ng-disabled="true" />
                            <div ng-messages="EditTApprovalFeorm.uname.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Date & Time</label>
                            <input type="text"  ng-model="edit_transfer_approval.ADDED_ON" name="date_time" aria-label="date_time" ng-disabled="true" />
                            <div ng-messages="EditTApprovalFeorm.date_time.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Branch </label>
                            <input type="text"  ng-model="edit_transfer_approval.branchname"  ng-disabled="true"  name="branchname" aria-label="branchname"/>
                            <div ng-messages="EditTApprovalFeorm.branchname.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Reasons</label>
                            <textarea ng-model="edit_transfer_approval.REASON" ng-disabled="true" name="reasons" rows="5" md-select-on-focus> </textarea>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Admin Feedback</label>
                            <textarea ng-model="edit_transfer_approval.feedback" name="feedback" rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="EditTApprovalFeorm.feedbak.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>

                    <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateDisApprovalList(edit_transfer_approval,atransfer_status)" ng-disabled="EditTApprovalFeorm.$invalid" aria-label="submit">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                    </div>
                </form>
            </div>
        </div>
    </md-dialog-content>
</md-dialog>