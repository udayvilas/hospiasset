<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Add User Label</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="Userlabel" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>MODULE NAME *</label>

                        <md-select ng-model="add_user_label.module_id" name="module_id"  required  aria-label="module_id">

                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">

                                {{hamodule.MODULE_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                      <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>ORG NAME *</label>

                        <md-select ng-model="add_user_label.org_id" name="org_id"  required  aria-label="org_id">

                            <md-option ng-repeat="hospital in hospitals" ng-value="hospital.ORG_ID">

                                {{hospital.ORG_NAME}}
                            </md-option>

                        </md-select>

                    </md-input-container>
                   <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>User Name</label>

                        <input type="text" required ng-model="add_user_label.user_name" name="user_name" aria-label="user_name"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Email</label>

                        <input type="text" required ng-model="add_user_label.email" name="email" aria-label="email"/>

                        <div ng-messages="Userlabel.email.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Contact</label>

                        <input type="text" required ng-model="add_user_label.contact" name="contact" aria-label="contact"/>

                        <div ng-messages="Userlabel.contact.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Status</label>

                        <input type="text" required ng-model="add_user_label.status" name="status" aria-label="status"/>

                        <div ng-messages="Userlabel.status.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>
                </div>
                <div layout="row">
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>Action</label>

                    <input type="text" required ng-model="add_user_label.actions" name="actions" aria-label="actions"/>

                    <div ng-messages="Userlabel.actions.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>Role</label>

                    <input type="text" required ng-model="add_user_label.role" name="role" aria-label="role"/>

                    <div ng-messages="Userlabel.role.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>Level</label>

                    <input type="text" required ng-model="add_user_label.levels" name="levels" aria-label="levels"/>

                    <div ng-messages="Userlabel.levels.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>Branch</label>

                    <input type="text" required ng-model="add_user_label.branch" name="branch" aria-label="branch"/>

                    <div ng-messages="Userlabel.branch.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>
                   </div>
                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="addUSerLabels(add_user_label)"  aria-label="submit">Submit</md-button>
                    <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.haadmin_user_label">Cancel</md-button>

                </div>


            </form>

        </div>

    </div>

</md-content>



