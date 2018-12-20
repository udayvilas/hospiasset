<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding" md-theme="inputs" layout-wrap>

    <div layout="column">

        <h3 class="heading-stylerespond">Vendor Assign PMS Call</h3>

        <div class="md-whiteframe-2dp mylayout-padding" style="border-radius:5px;">

            <form name="vendorpmsassign" method="POST">

                <h5 flex class="sub_heading-style-respond">Assign Call</h5>

                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>User</label>
                        <md-select  ng-model="vendorpmsassign.user_id"  name="user_id" ng-click="loadUser()">
                            <md-option  ng-repeat="userdetail in userdetails" ng-value="userdetail.USER_ID">
                                {{userdetail.USER_NAME}}
                            </md-option>
                        </md-select>
                        <div ng-messages="vendorpmsassign.EQ_ID.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <div class="row">
                    <center>
                        <input type="submit" class="md-button md-raised md-accent" layout-align="center center" ng-disabled="transfervequipment.$invalid"  ng-click="generate_gate_pass($event,transfer_vequipment)" aria-label="button" value="Assign">
                        <md-button style="margin-top:20px;" class="md-raised md-accent" layout-align="center center" ng-click="gotoViewIndents()" aria-label="button" unsaved-warning-clear>Cancel</md-button>

                </div>

            </form>

        </div>

    </div>

</md-content>