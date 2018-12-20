<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Add State Label</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="DepartmentLabel" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>MODULE NAME *</label>

                        <md-select ng-model="add_dept_label.module_id" name="module_id"  required  aria-label="module_id">

                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">

                                {{hamodule.MODULE_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>

                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                      
					  <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>ORG NAME *</label>

                        <md-select ng-model="add_dept_label.org_id" name="org_id"  required  aria-label="org_id">

                            <md-option ng-repeat="hospital in hospitals" ng-value="hospital.ORG_ID">

                                {{hospital.ORG_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>
                      
					   <div flex="10" hide-xs hide-sm><!-- Space --></div>
                      

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>State Name</label>

                        <input type="text" required ng-model="add_dept_label.department" name="department" aria-label="department"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Code</label>

                        <input type="text" required ng-model="add_dept_label.code" name="code" aria-label="code"/>

                        <div ng-messages="DepartmentLabel.state_code.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Status</label>

                        <input type="text" required ng-model="add_dept_label.status" name="status" aria-label="status"/>

                        <div ng-messages="DepartmentLabel.status.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>
                </div>
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>Action</label>

                    <input type="text" required ng-model="add_dept_label.actions" name="actions" aria-label="actions"/>

                    <div ng-messages="DepartmentLabel.actions.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>

                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="adddeptLabels(add_dept_label)"  aria-label="submit">Submit</md-button>
                    <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.haadmin_dept_label">Cancel</md-button>


                </div>


            </form>

        </div>

    </div>

</md-content>



