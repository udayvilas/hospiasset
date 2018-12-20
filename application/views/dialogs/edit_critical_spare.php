<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Critical Spare Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditCricSparesForm" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Name</label>
                        <input  type="text" ng-model="ecrispare.name" name="name" required>
                        <div ng-messages="EditCricSparesForm.name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Code</label>
                        <input  type="text" ng-model="ecrispare.code" name="code" required>
                        <div ng-messages="EditCricSparesForm.code.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Select Branch *</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" name="branch" required ng-model="ecrispare.branch" aria-label="branch">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Branch" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="branches">
                                <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs |
              filter:searchTerm">{{branch.BRANCH_NAME}}</md-option>
                            </md-optgroup>
                        </md-select>
                        <div ng-messages="EditCricSparesForm.branch.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Count</label>
                        <input type="text" only-digits="only-digits" required ng-model="ecrispare.count" name="count" aria-label="count"/>
                        <div ng-messages="EditCricSparesForm
                        .count.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="updatecrickSpare(ecrispare)" ng-disabled="EditCricSparesForm.$invalid" aria-label="submit" style="float:left">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>

</md-dialog>