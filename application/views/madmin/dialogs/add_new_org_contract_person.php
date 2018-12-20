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
                            <input type="text" required ng-model="add_ocp.contact_person" name="contact_person" ng-maxlength="50" ng-minlength="3" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" ng aria-label="contact_person"/>                            <div ng-messages="OCPForm.contact_person.$error">							<div ng-message="required">Required.</div>							<div ng-show="OCPForm.contact_person.$error.minlength"> minimum length 3</div>							<div ng-show="OCPForm.contact_person.$error.maxlength"> maxlength length 10</div>							<div ng-show="OCPForm.contact_person.$error.pattern"> invalid input</div>							</div>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Contact Person Number</label>
                            <input type="text"  only-digits="only-digits" ng-model="add_ocp.contact_person_no"  ng-maxlength="14" ng-minlength="8" ng-pattern="/^(\d)+$/" name="contact_person_no" aria-label="contact_person_no"/>                               <div ng-messages="OCPForm.contact_person_no.$error">							<div ng-message="required">Required.</div>							<div ng-show="OCPForm.contact_person_no.$error.minlength"> minimum length 8</div>							<div ng-show="OCPForm.contact_person_no.$error.maxlength"> maxlength length 14</div>							</div>
                        </md-input-container>
                    </div>

                    <div flex layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Contact Person Email</label>
                            <input type="email"  ng-model="add_ocp.cpemail" ng-maxlength="50" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" name="cpemail" aria-label="cpemail"/>                             <div ng-messages="OCPForm.cpemail.$error">                      					  <div ng-message="required">Required.</div>					  <div ng-show="OCPForm.cpemail.$error.pattern">your format is not correct</div>					 <div ng-show="OCPForm.cpemail.$error.maxlength">Your input  maxlength 14 numbers</div>					 					 </div>                    </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    </div>
                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="appendOCP()" ng-disabled="OCPForm.$invalid" aria-label="submit">Add</md-button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>