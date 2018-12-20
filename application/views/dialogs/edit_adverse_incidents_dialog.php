<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Adverse Incidents Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">

        <div class="md-dialog-content">
            <form method="POST" name="EdirObsertDialog" flex="100" autocomplete="off">
                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm >
                        <label>Equipment Id </label>

                        <input type="text"  ng-model="edit_adv_ind.EQUP_ID" name="EQUP_ID" ng-disabled="true" aria-label="spares"/>
                        <div ng-messages="EdirObsertDialog.EQUP_ID.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm >
                        <label>Department </label>
                        <input type="text"  ng-model="edit_adv_ind.DEPT_ID" name="DEPT_ID"
                               ng-disabled="true" aria-label="dept"/>

                        <div ng-messages="EdirObsertDialog.DEPT_ID.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm >
                        <label>Incharchge Comment</label>
                        <textarea ng-model="edit_adv_ind.icomment" name="icomment" rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="EdirObsertDialog.icomment.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Observations</label>
                        <textarea ng-model="edit_adv_ind.observation" name="observation"  rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="EdirObsertDialog.observation.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Occurance Report</label>
                        <textarea ng-model="edit_adv_ind.report" name="report"  rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="EdirObsertDialog.report.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm >
                        <label>Spares *</label>
                        <input type="text"  ng-model="edit_adv_ind.spares" required name="spares" aria-label="spares"/>
                        <div ng-messages="EdirObsertDialog.spares.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Accessories*</label>
                        <input type="text"  ng-model="edit_adv_ind.accessories" required name="accessories" aria-label="accessories"/>

                        <div ng-messages="EdirObsertDialog.accessories.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Approximate Cost</label>
                        <input type="text"  ng-model="edit_adv_ind.acost" name="acost" aria-label="acost" only-digits="only-digits"/>
                        <div ng-messages="EdirObsertDialog.acost.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Total Cost</label>
                        <input type="text"  ng-model="edit_adv_ind.tcost" name="tcost" aria-label="tcost" only-digits="only-digits"/>
                        <div ng-messages="EdirObsertDialog.tcost.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div layout="row">
                    </md-input-container>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Action Taken</label>
                        <textarea required ng-model="edit_adv_ind.action_taken" name="action_taken" required rows="5" md-select-on-focus></textarea>
                         <div ng-messages="EdirObsertDialog.action_taken.$error">
                            <div ng-message="required">Required.</div>
                        </div>                   
				   </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="UpdateAdverseIncedents(edit_adv_ind)" ng-disabled="EdirObsertDialog.$invalid" aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>