<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Classifications</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addClassificationForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Master Class</label>
                        <input type="text" required ng-model="add_classification.master_class" name="master_class" md-maxlength="50" aria-label="master_class"/>
                        <div ng-messages="addClassificationForm.master_class.$error">
                            <div ng-message="required">Required.</div>                         
                            <div ng-message="md-maxlength">Max limit is reached.</div>						  						 
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
					   <md-autocomplete flex="40" class="md-block" flex-gt-sm
									 required
									 md-require-match="true"
									 md-input-name="responsibledept"
                                     ng-value="add_classification.responsible_dept=searched.CODE"
                                     md-no-cache="false"
                                     md-selected-item="searched.CODE"
                                     md-search-text="searchDepartment"
                                     md-items="item in searchTextChange(searchDepartment,'Department')"
                                     md-item-text="item.USER_DEPT_NAME"
                                     md-min-length="0"
                                     md-search-text-change="add_classification.responsible_dept=''"
                                     md-floating-label="Search Responsible Dept."
                                     >
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
                        </md-item-template>
						<div ng-messages="addClassificationForm.responsibledept.$error" ng-if="addClassificationForm.responsibledept.$touched">
							<div ng-message="required">required</div>
						</div>
                        <!--<md-not-found>
                            No Department Found
                        </md-not-found>-->
                    </md-autocomplete>
                    <span ng-value="add_classification.responsible_dept = searched.CODE.CODE" ></span>
                   
				   <!--<md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Responsible Dept.</label>
                        <input type="text" required ng-model="add_classification.responsible_dept" name="responsible_dept" md-maxlength="50" aria-label="responsible_dept"/>
                        <div ng-messages="addClassificationForm.responsible_dept.$error">
                            <div ng-message="required">Required.</div>                         <div ng-message="md-maxlength">Max limit is reached.</div>						 <!---<div ng-show="addClassificationForm.responsible_dept.$error.pattern"></div>
                        </div>
                    </md-input-container>--->
                    </div>
                    <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Code</label>
                        <input type="text" required ng-model="add_classification.code" ng-change="add_classification.code = (add_classification.code | uppercase)" name="code" md-maxlength="3" ng-pattern= "/^[a-zA-Z. ]*[a-zA-Z]$/"  aria-label="code"/>
                        <div ng-messages="addClassificationForm.code.$error">
                            <div ng-message="required">Required.</div>                             
                            <div ng-message="md-maxlength">Max limit is reached.</div>				
                            <div ng-show="addClassificationForm.code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addClassification(add_classification)" ng-disabled="addClassificationForm.$invalid" aria-label="submit">Submit</md-button>
                         <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.classifications">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>