<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Add Branch Label</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="Branchlabel" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>MODULE NAME *</label>

                        <md-select ng-model="add_branch_label.module_id" name="module_id"  required  aria-label="module_id">

                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">

                                {{hamodule.MODULE_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                     <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>ORG NAME *</label>

                        <md-select ng-model="add_branch_label.org_id" name="org_id"  required  aria-label="org_id">

                            <md-option ng-repeat="hospital in hospitals" ng-value="hospital.ORG_ID">

                                {{hospital.ORG_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>
					
					  <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Branch Name</label>

                        <input type="text" required ng-model="add_branch_label.branch_name" name="branch_name" aria-label="branch_name"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Email</label>

                        <input type="text" required ng-model="add_branch_label.branch_code" name="branch_code" aria-label="branch_code"/>

                        <div ng-messages="Branchlabel.branch_code.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Hod</label>

                        <input type="text" required ng-model="add_branch_label.hod" name="hod" aria-label="hod"/>

                        <div ng-messages="Branchlabel.hod.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Address</label>

                        <input type="text" required ng-model="add_branch_label.address" name="address" aria-label="address"/>

                        <div ng-messages="Branchlabel.address.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>	ADDED DATE</label>

                        <input type="text" required ng-model="add_branch_label.addeddate" name="addeddate" aria-label="addeddate"/>

                        <div ng-messages="Branchlabel.addeddate.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Status</label>

                        <input type="text" required ng-model="add_branch_label.status" name="status" aria-label="status"/>

                        <div ng-messages="Branchlabel.status.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Action</label>

                        <input type="text" required ng-model="add_branch_label.actions" name="actions" aria-label="actions"/>

                        <div ng-messages="Branchlabel.actions.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>

                </div>
                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="addBranchLabels(add_branch_label)"  aria-label="submit">Submit</md-button>
                    <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.haadmin_branch_label">Cancel</md-button>



                </div>


            </form>

        </div>

    </div>

</md-content>



