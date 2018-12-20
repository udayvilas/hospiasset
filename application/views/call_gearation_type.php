<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Select Call Category</h3>
        <div layout-gt-sm="row" layout-xs="column" layout-align="center center" layout-gt-xs="column" layout="row">
          <!--  <md-input-container flex="25">
                <label>Call Type</label>
                <md-select ng-model="cgsd.device_id" name="device_id">
                    <md-option >Select Call type</md-option>
                    <md-option ui-sref="home.incident">Incident</md-option>
                    <md-option ui-sref="home.hbbme_generate_call" >other</md-option>

                </md-select>
            </md-input-container>-->

            <md-menu class="md-raised md-primary">

                <button class="md-accent md-primary" ng-click="$mdOpenMenu($event)" aria-label="call type" style="width:140px;color:#000; background-color:#ffffff;border-bottom:1px solid #000">
                    Call Type
                </button>
                <md-menu-content width="3">
                    <md-menu-item>
                        <md-button ui-sref="home.incident" >Incedents</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.other_generate_call">Others</md-button>
                    </md-menu-item>
                </md-menu-content>
            </md-menu>

        </div>
    </div>
</md-content>