<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Transfer Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditTransferform"   autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Name</label>
                        <input type="text"  ng-model="edit_transfer.req_eq_name" ng-disabled="true" name="equp_name" aria-label="equp_name"/>
                        <div ng-messages="EditTransferform.equp_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment ID</label>
                        <md-select placeholder="Select Equipment" ng-model="edit_transfer.EQUP_ID"             name="equp_id" aria-label="equp_id">                             <!--<md-select-header class="demo-select-header">                                <input type="text" ng-model="searchTerm" placeholder="Search Branch" class="demo-header-searchbox md-text">                            </md-select-header>--->                             <!--ng-disabled="trnsfer.EQUP_ID==get_same_equps_cat.E_ID"--->
                            <md-option ng-value="get_same_equps_cat.E_ID" ng-repeat="get_same_equps_cat in get_same_equps_cats">{{get_same_equps_cat.E_ID}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Accssories</label>
                        <input type="text"  ng-model="edit_transfer.accssories" required name="accssories" aria-label="accssories"/>
                        <div ng-messages="EditTransferform.accssories.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Feedback</label>
                        <textarea ng-model="edit_transfer.feedback" name="feedback" md-maxlength="350" rows="5" md-select-on-focus required> </textarea>
                        <div ng-messages="EditTransferform.feedbak.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateOtherunitTransferList(edit_transfer)" ng-disabled="EditTransferform.$invalid" aria-label="submit">Transfer</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>