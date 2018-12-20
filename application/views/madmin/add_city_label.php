<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<md-content class="mylayout-padding" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Add City Label</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="Citylabel" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="30">

                        <label>MODULE NAME *</label>

                        <md-select ng-model="add_city_label.module_id" name="module_id"  required  aria-label="module_id">

                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">

                                {{hamodule.MODULE_NAME}}

                            </md-option>

                        </md-select>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>



                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label> Name</label>

                        <input type="text" required ng-model="add_city_label.city_name" name="city_name" aria-label="city_name"/>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Code</label>

                        <input type="text" required ng-model="add_city_label.city_code" name="city_code" aria-label="city_code"/>

                        <div ng-messages="Citylabel.city_code.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>

                    <div flex="20" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="40">

                        <label>Status</label>

                        <input type="text" required ng-model="add_city_label.status" name="status" aria-label="length"/>

                        <div ng-messages="Citylabel.status.$error">

                            <div ng-message="required">Required.</div>

                        </div>

                    </md-input-container>
                </div>
                <md-input-container class="md-block" flex-gt-sm flex="40">

                    <label>Action</label>

                    <input type="text" required ng-model="add_city_label.actions" name="actions" aria-label="actions"/>

                    <div ng-messages="Citylabel.actions.$error">

                        <div ng-message="required">Required.</div>

                    </div>

                </md-input-container>

                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="addCitiesLabels(add_city_label)"  aria-label="submit">Submit</md-button>
                    <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.haadmin_cities_label">Cancel</md-button>



                </div>


            </form>

        </div>

    </div>

</md-content>



