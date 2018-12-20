<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Edit Classification Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditClassificationForm" flex="100" autocomplete="off">
                <div layout="column">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Master Class</label>
                        <input  type="text" ng-model="eclassification.master_class" md-maxlength="50" name="master_class" required>
                        <div ng-messages="EditClassificationForm.master_class.$error">
                           <div ng-message="required">Required.</div>                         
						   <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>

                    <md-autocomplete flex="45" class="md-block" flex-gt-sm
					  required
					  md-input-name="department"
					  md-no-cache="true"
					  md-selected-item="searched.CODE"
					  md-search-text="eclassification.searchDepartment"
					  md-items="item in searchTextChange(eclassification.searchDepartment,'Department')"
					  md-item-text="eclassification.responsible_dept=item.USER_DEPT_NAME"
					  md-min-length="0"
					  md-search-text-change="eclassification.responsible_dept=''"
					  md-selected-item-change="eclassification.responsible_dept = item.CODE"
					  md-floating-label="Search Reaponsible Dept.">
                <md-item-template>
                  <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
                </md-item-template>
				<div ng-messages="EditClassificationForm.department.$error" ng-if="EditClassificationForm.department.$touched">
					<div ng-message="required">Required</div>
				</div>
                <md-not-found>
				No Department Found
				</md-not-found>
              </md-autocomplete>
              <span ng-value="eclassification.responsible_dept = searched.CODE.CODE" ></span>
              


				   <!--<md-input-container class="md-block" flex-gt-sm>
                        <label>Responsible Depatments</label>
                        <input  type="text" ng-model="eclassification.responsible_dept" md-maxlength="50" name="responsible_dept" required>
                        <div ng-messages="EditClassificationForm.responsible_dept.$error">
                            <div ng-message="required">Required.</div>     
							<div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>--->

                    <md-input-container class="md-block" flex-gt-sm flex="100">
                        <label>Code</label>
                        <input type="text" required ng-model="eclassification.code" name="code" md-maxlength="3" ng-pattern= "/^[a-zA-Z. ]*[a-zA-Z]$/"  ng-change="eclassification.code = (eclassification.code | uppercase)" aria-label="code"/>
                        <div ng-messages="EditClassificationForm.code.$error">
                             <div ng-message="required">Required.</div>                    
							 <div ng-message="md-maxlength">Max limit is reached.</div>						
							 <div ng-show="EditClassificationForm.code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Status*</label>
                        <md-select name="status" required ng-model="eclassification.status" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EditClassificationForm.status.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                        <input type="submit" value="Submit" class="md-raised md-button md-accent" ng-click="updateClassification(eclassification)" ng-disabled="EditClassificationForm.$invalid" aria-label="submit" />
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>