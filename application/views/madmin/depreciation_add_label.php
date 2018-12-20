<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Add Depreciation  Label</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="Deprlabel" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>MODULE NAME *</label>

                        <md-select ng-model="add_depreciation_lable.module_id" name="module_id"  required  aria-label="module_id">

                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">

                                {{hamodule.MODULE_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                      
					  <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>ORG NAME *</label>

                        <md-select ng-model="add_depreciation_lable.org_id" name="org_id"  required  aria-label="org_id">

                            <md-option ng-repeat="hospital in hospitals" ng-value="hospital.ORG_ID">

                                {{hospital.ORG_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>
					  
 <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Name</label>

                        <input type="text" required ng-model="add_depreciation_lable.name" name="name" aria-label="name"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Percentage</label>

                        <input type="text" required ng-model="add_depreciation_lable.percentage" name="percentage" aria-label="percentage"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>



                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Status</label>

                        <input type="text" required ng-model="add_depreciation_lable.status" name="status" aria-label="status"/>

                        <div ng-messages="Deprlabel.status.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>


                </div>
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>Action</label>

                    <input type="text" required ng-model="add_depreciation_lable.actions" name="actions" aria-label="actions"/>

                    <div ng-messages="Deprlabel.actions.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>

                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="addDepreciationlabel(add_depreciation_lable)"  aria-label="submit">Submit</md-button>
                    <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.haadmin_depreciation_label">Cancel</md-button>

                </div>


            </form>

        </div>

    </div>

</md-content>



