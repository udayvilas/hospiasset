<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Enter Contact Person Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="OCPForm"  flex-xs="100"  autocomplete="off">
                <div layout="column" layout-wrap flex>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Contact Person</label>
                            <input type="text" required ng-model="add_ocp.contact_person" name="contact_person" aria-label="contact_person"/>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Contact Person Number</label>
                            <input type="text"  only-digits="only-digits" ng-model="add_ocp.contact_person_no" name="contact_person_no" aria-label="contact_person_no"/>
                        </md-input-container>
                    </div>

                    <div flex layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Contact Person Email</label>
                            <input type="email"  ng-model="add_ocp.cpemail" name="cpemail" aria-label="cpemail"/>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Contact Person Desgination</label>
                            <input type="text"  ng-model="add_ocp.cp_designation" name="cp_designation" aria-label="cp_designation"/>
                        </md-input-container>
                    </div>
                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="AptappendOCP()" ng-disabled="OCPForm.$invalid" aria-label="submit">Add</md-button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>