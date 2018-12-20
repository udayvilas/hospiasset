<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Branch Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EdirBranchDialog" flex="100"  autocomplete="off">
                <div flex layout="row" ng-repeat="branch in branch_labels">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{branch.BRANCH_NAME}}</label>
                        <input required ng-model="ebranch_data.branch_name" minlength="3" md-maxlength="50"  ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/">
                        <div ng-messages="EdirBranchDialog.branch_name.$error">
                            <div ng-message="required">Required.</div>
                            <div ng-message="md-maxlength">Max limit is reached.</div>
                            <div ng-show="EdirBranchDialog.branch_name.$error.pattern">Please Provide Text Only.</div>                       							
							<div ng-show="EdirBranchDialog.branch_name.$error.minlength">minlength 3</div>
							</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{branch.BRANCH_CITY}}Location *</label>
                        <md-select name="roleid" required ng-model="ebranch_data.city_name" aria-label="city_name">
                            <md-option  ng-value="city_name.CITY_CODE" ng-repeat="city_name in city_names">{{city_name.CITY_NAME}}</md-option>
                        </md-select>
                        <div ng-messages="EdirBranchDialog.city_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                     <md-input-container class="md-block" flex-gt-sm>
                    <label>{{branch.ADDRESS}}</label>
                    <input type="text"  ng-model="ebranch_data.branch_address" name="branch_address"  md-maxlength="250"  aria-label="branch_address"/>                        <!---<textarea ng-model="add_branch.branch_address" md-maxlength="3" md-select-on-focus></textarea>   --->                          <!-- <div ng-messages="addBranchForm.branch_address.$error">							  <div ng-show="addBranchForm.branch_address.$error.maxlength">max length Exceeds</div>                              </div>-->
                         <div ng-messages="EdirBranchDialog.branch_address.$error">
                             <div ng-message="md-maxlength">Max limit is reached.</div>
                         </div>
                    <!---<textarea required ng-model="ebranch_data.branch_address" rows="5" md-select-on-focus></textarea>--->
                </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{branch.STATUS}}</label>
                        <md-select required ng-model="ebranch_data.status">
                            <md-option ng-value="user_status.ID" ng-repeat="user_status in user_statues">{{user_status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EdirBranchDialog.branch_address.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                        <md-button class="md-raised md-accent" ng-click="UpdateBranch(ebranch_data)" ng-disabled="EdirBranchDialog.$invalid" aria-label="submit" style="float:left">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>