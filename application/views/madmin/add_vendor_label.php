<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Add Vendor  Label</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="Esctypelabel" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>MODULE NAME *</label>

                        <md-select ng-model="add_vendor_label.module_id" name="module_id"  required  aria-label="module_id">

                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">

                                {{hamodule.MODULE_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                       
					   
					   <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>ORG NAME *</label>

                        <md-select ng-model="add_vendor_label.org_id" name="org_id"  required  aria-label="org_id">

                            <md-option ng-repeat="hospital in hospitals" ng-value="hospital.ORG_ID">

                                {{hospital.ORG_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Vendor Name</label>

                        <input type="text" required ng-model="add_vendor_label.vendor_name" name="vendor_name" aria-label="vendor_name"/>

                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Type</label>

                        <input type="text" required ng-model="add_vendor_label.type" name="type" aria-label="type"/>

                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>


                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Email</label>

                        <input type="text" required ng-model="add_vendor_label.email" name="email" aria-label="email"/>

                    </md-input-container>

                    <!--<div flex="5" hide-xs hide-sm><!-- Space </div>--->
                </div>
                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>ContactNo</label>

                        <input type="text" required ng-model="add_vendor_label.contactno" name="contactno" aria-label="contactno"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Contact Person</label>

                        <input type="text" required ng-model="add_vendor_label.contactperson" name="contactperson" aria-label="contactperson"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>cpnumber</label>

                        <input type="text" required ng-model="add_vendor_label.cpnumber" name="cpnumber" aria-label="cpnumber"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>cpemail</label>

                        <input type="text" required ng-model="add_vendor_label.cpemail" name="cpemail" aria-label="cpemail"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
					
					<md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>action</label>

                        <input type="text" required ng-model="add_vendor_label.actions" name="actions" aria-label="actions"/>

                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>status</label>

                        <input type="text" required ng-model="add_vendor_label.status" name="status" aria-label="status"/>

                    </md-input-container>



                </div>


                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="addVendorlabel(add_vendor_label)"  aria-label="submit">Submit</md-button>
                    <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.haadmin_vendor_label">Cancel</md-button>

                </div>


            </form>

        </div>

    </div>

</md-content>



