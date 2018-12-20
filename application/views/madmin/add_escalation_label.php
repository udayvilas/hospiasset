<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Add Escalation Label</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="EscalationLabel" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>MODULE NAME *</label>

                        <md-select ng-model="add_escalation_label.module_id" name="module_id"  required  aria-label="module_id">

                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">

                                {{hamodule.MODULE_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>



                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label> Name</label>

                        <input type="text" required ng-model="add_escalation_label.equp_type" name="equp_type" aria-label="equp_type"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>ESC TYPE</label>

                        <input type="text" required ng-model="add_escalation_label.esc_type" name="esc_type" aria-label="esc_type"/>

                        <div ng-messages="EscalationLabel.esc_type.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>ESC CAT</label>

                        <input type="text" required ng-model="add_escalation_label.esc_cat" name="esc_cat" aria-label="esc_cat"/>

                        <div ng-messages="EscalationLabel.esc_cat.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>
                </div>
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>L1</label>

                    <input type="text" required ng-model="add_escalation_label.l1" name="l1" aria-label="l1"/>

                    <div ng-messages="EscalationLabel.l1.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>L2</label>

                    <input type="text" required ng-model="add_escalation_label.l2" name="l2" aria-label="l2"/>

                    <div ng-messages="EscalationLabel.l1.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>
                <div flex="20" hide-xs hide-sm><!-- Space --></div>

                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>L3</label>

                    <input type="text" required ng-model="add_escalation_label.l3" name="l3" aria-label="l3"/>

                    <div ng-messages="EscalationLabel.l3.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>Action</label>

                    <input type="text" required ng-model="add_escalation_label.actions" name="actions" aria-label="actions"/>

                    <div ng-messages="EscalationLabel.actions.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>

                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="addEscalationLabels(add_escalation_label)"  aria-label="submit">Submit</md-button>
                   <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.haadmin_escalation_label">Cancel</md-button>




                </div>


            </form>

        </div>

    </div>

</md-content>



