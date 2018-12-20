<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding" md-theme="inputs" layout-wrap>

    <div layout="column">

        <h3 class="heading-stylerespond">Transfer Equipment</h3>

        <div class="md-whiteframe-2dp mylayout-padding" style="border-radius:5px;">

            <form name="transfervequipment" method="POST">

                <h5 flex class="sub_heading-style-respond">Equipment Basic Details</h5>

                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>

                    <!--<md-input-container class="md-block" flex-gt-sm flex="20">

                        <label>Equipment Name</label>

                        <input type="text" required ng-model="transfer_vequipment.E_NAME" name="E_NAME" aria-label="E_NAME"/>

                    </md-input-container>

                    <div flex="5" hide-xs hide-sm></div>-->

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Equipment ID</label>
                        <md-select  ng-model="transfer_vequipment.EQ_ID"  name="EQ_ID" ng-click="loadEquipments(transfer_vequipment)">
                            <md-option  ng-repeat="equipment in equipments" ng-value="equipment.E_ID">
                                {{equipment.E_ID}}
                            </md-option>
                        </md-select>
                        <div ng-messages="transfervequipment.EQ_ID.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <div class="row">
                    <center>

                        <!--<input type="submit" class="md-button md-raised md-accent" layout-align="center center" ng-click="transferEquipment(transfer_vequipment)" aria-label="button" value="Transfer">-->
                        <input type="submit" class="md-button md-raised md-accent" layout-align="center center" ng-disabled="transfervequipment.$invalid"  ng-click="generate_gate_pass($event,transfer_vequipment)" aria-label="button" value="Generate Gate Pass">
                        <md-button style="margin-top:20px;" class="md-raised md-accent" layout-align="center center" ng-click="gotoViewIndents()" aria-label="button" unsaved-warning-clear>Cancel</md-button>

                </div>

            </form>

        </div>

    </div>

</md-content>