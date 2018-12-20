<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Cear Category Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditCearCategoryForm" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Cear Category Name</label>
                        <input  type="text" ng-model="cear_category_edit.cear_category_name"  md-maxlength="50"  name="cear_category_name" required>
                        <div ng-messages="EditCearCategoryForm.cear_category_name.$error">                               						<div ng-message="required">Required.</div>           						<div ng-message="md-maxlength">Max limit is reached.</div>	
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Cear Category  Code</label>
                        <input  type="text" ng-model="cear_category_edit.code" name="code"  ng-pattern  = "/^[a-zA-Z. ]*[a-zA-Z]$/" ng-change="cear_category_edit.code = (cear_category_edit.code | uppercase)" md-maxlength="3"  required>
                        <div ng-messages="EditCearCategoryForm.code.$error">                                                  						<div ng-message="required">Required.</div>									<div ng-show="EditCearCategoryForm.code.$error.pattern">Please Provide Text Only.</div>                         <div ng-message="md-maxlength">Max limit is reached.</div>							                        
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Status*</label>
                        <md-select name="status" required ng-model="cear_category_edit.status" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EditCearCategoryForm.status.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="updateCearCategory(cear_category_edit)" ng-disabled="EditCearCategoryForm.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>