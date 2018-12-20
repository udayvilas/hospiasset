<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Equipment Class Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditClassForm" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Contract Type</label>
                        <input  type="text" ng-model="eclass_data.equp_class"  md-maxlength="5" name="equp_class" required>
                       <div ng-messages="EditClassForm.equp_class.$error">                            <div ng-message="required">Required.</div>                            <div ng-message="md-maxlength">Max limit is reached.</div>					                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Contract Code</label>
                        <input  type="text" ng-model="eclass_data.eclass_code" name="eclass_code" ng-change="eclass_data.eclass_code = (eclass_data.eclass_code | uppercase)" md-maxlength="3" ng-pattern="/^[a-zA-Z0-9 -]*$/" required>
                        <div ng-messages="EditClassForm.eclass_code.$error">
                                                      <div ng-message="required">Required.</div>                             <div ng-message="md-maxlength">Max limit is reached.</div>					        <div ng-show="EditClassForm.eclass_code.$error.pattern">Please Provide Valid Input.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Status*</label>
                        <md-select name="status" required ng-model="eclass_data.status" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EditClassForm.status.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateEqClass(eclass_data)" ng-disabled="EditClassForm.$invalid " aria-label="submit"  style="float:left" >Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>