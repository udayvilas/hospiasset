<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Add Label</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="addEqupcondForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>MODULE NAME *</label>

                        <md-select ng-model="add_role_type.module_id" name="module_id"  required  aria-label="module_id">

                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">

                                {{hamodule.MODULE_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>



                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>ROLE TYPE</label>

                        <input type="text" required ng-model="add_role_type.role_type" name="role_type" aria-label="role_type"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>ROLE TYPE NAME</label>

                        <input type="text" required ng-model="add_role_type.role_name" name="role_name" aria-label="role_name"/>

                        <div ng-messages="add_role_type.role_name.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>




                </div>


                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="addroletype(add_role_type)"  aria-label="submit">Submit</md-button>

                   <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.haadmin_roles">Cancel</md-button>

                </div>


            </form>

        </div>

    </div>

</md-content>



