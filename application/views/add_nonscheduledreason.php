<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Reason</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addNonReasonForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <!---<md-input-container class="md-block" flex-gt-sm flex="45"><label>Select Branch</label><md-select ng-model="add_reason.branch_id" name="branch_id" aria-label="user_branch"><md-option ng-repeat="branch in branchs" ng-value="branch.BRANCH_ID" ng-selected="branch.BRANCH_ID==user_branch">                                {{branch.BRANCH_NAME}}                            </md-option></md-select></md-input-container>--->
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Complant Name</label>
                        <input type="text" required ng-model="add_nonscheduledreason.reason" name="reason" md-maxlength="50" aria-label="reason"/>
                        <div ng-messages="addNonReasonForm.reason.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                </div>
            </form>

            <div flex layout="row" layout-align="center center">

                <md-button class="md-raised md-accent" ng-click="addnonshceduledreason(add_nonscheduledreason)" ng-disabled="addNonReasonForm.$invalid" aria-label="submit">Submit</md-button>
                <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.reasons">Cancel</md-button>
            </div>

        </div>
    </div></md-content>