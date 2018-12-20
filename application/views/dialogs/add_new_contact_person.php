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
            <form method="POST" name="CPForm"  flex-xs="100"  autocomplete="off">
                <div layout="column" layout-wrap flex>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Contact Person</label>
                            <input type="text" required ng-model="add_cp.contact_person" md-maxlength="200" name="contact_person" aria-label="contact_person"/>                               <div ng-messages="CPForm.contact_person.$error">						<div ng-message="required">Required.</div>						<div ng-message="md-maxlength">Max limit is reached.</div>					     						</div>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Contact Person Number</label>
                            <input type="text" only-digits="only-digits" md-maxlength="14" ng-minlength="8" ng-model="add_cp.contact_person_no" name="contact_person_no" aria-label="contact_person_no"/>                             <div ng-messages="CPForm.contact_person_no.$error">						<div ng-message="required">Required.</div>					      <div ng-message="md-maxlength">Max limit is reached.</div>						  <div ng-message="minlength">Min limit is 8.</div>						</div>
                        </md-input-container>
                    </div>

                    <div flex layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Contact Person Email</label>
                            <input type="email"  ng-model="add_cp.cpemail" required name="cpemail" aria-label="cpemail"/>                           <div ng-messages="CPForm.cpemail.$error">						<div ng-message="required">Required.</div>					     						</div>
                        </md-input-container>
                        <div flex="10" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex="45">
                            <label>Priority *</label>
                            <md-select required ng-model="add_cp.priority" name="priority" aria-label="priority">
                                <md-option ng-repeat="equpclass in equpclasses"  ng-value="equpclass">
                                    {{equpclass}}
                                </md-option>
                            </md-select>                             <div ng-messages="CPForm.priority.$error">						<div ng-message="required">Required.</div>					     						</div>
                        </md-input-container>
                    </div>
                    <div flex layout="row">
                        <md-input-container class="md-block" flex="100">
                            <label>Contact Person Address</label>
                            <!---<textarea ng-model="add_cp.contact_person_address" name="cpaddress" rows="5"></textarea>--->                              <input type="text" ng-model="add_cp.contact_person_address" name="cpaddress" md-maxlength="250">
                              <div ng-messages="CPForm.contact_person_address.$error">							 <div ng-message="md-maxlength">Max limit is reached.</div>					     						</div>						</md-input-container>
                    </div>

                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="appendCP()" ng-disabled="CPForm.$invalid" aria-label="submit">Add</md-button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>