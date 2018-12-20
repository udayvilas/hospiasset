<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Contract Type</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addCtypeForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <!--<md-input-container class="no-margin-padding-md-input" flex="20" flex-xs="100"><md-select placeholder="Select Branch *" ng-model="add_ctype.branch_id" name="branch_id" aria-label="user_branch"><md-option ng-value="branch.BRANCH_ID" ng-selected="branch.BRANCH_ID == user_branch" ng-repeat="branch in branchs" ng-if="branch.BRANCH_ID != 'All'" >{{branch.BRANCH_NAME}}</md-option></md-select></md-input-container>--->
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{ctype_labels.CTYPE}}</label>
                        <input type="text" required ng-model="add_ctype.contract_type" md-maxlength="50" name="contract_type" aria-label="contract_type"/>
                        <div ng-messages="addCtypeForm.contract_type.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{ctype_labels.CFORM}}</label>
                        <input type="text" required ng-model="add_ctype.contract_code" name="ctype_code" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/"  md-maxlength="3"  ng-change="add_ctype.contract_code = (add_ctype.contract_code | uppercase)"   aria-label="ctype_code"/>
                        <div ng-messages="addCtypeForm.ctype_code.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                            <div ng-show="addCtypeForm.ctype_code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="addContractType(add_ctype)" ng-disabled="addCtypeForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbbme_contract_type">Cancel</md-button>

                </div>
            </form>
        </div>
    </div>
</md-content>