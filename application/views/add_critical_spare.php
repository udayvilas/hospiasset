<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Critical Spare</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addCriSpareForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Spare Name</label>
                        <input type="text" required ng-model="add_critical_spare.name" name="name" aria-label="equp_condition"/>
                        <div ng-messages="addCriSpareForm.name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Code</label>
                        <input type="text" required ng-model="add_critical_spare.code" name="code" aria-label="code"/>
                        <div ng-messages="addCriSpareForm.code.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Select Branch *</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" name="branch" required ng-model="add_critical_spare.branchid" aria-label="branchid">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Branch" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="branches">
                                <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs |
              filter:searchTerm">{{branch.BRANCH_NAME}}</md-option>
                            </md-optgroup>
                        </md-select>
                        <div ng-messages="addCriSpareForm.branchid.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Count</label>
                        <input type="text" only-digits="only-digits" required ng-model="add_critical_spare.count" name="count" aria-label="count"/>
                        <div ng-messages="addCriSpareForm.count.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="addCriticalSpare(add_critical_spare)" ng-disabled="addCriSpareForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>