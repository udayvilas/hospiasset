<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="70" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Edit Appointment Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="editAppointmentForm" autocomplete="off">
                <h5 class="sub_heading-style-respond">Appointment Details</h5>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Orgnizarion </label>
                        <md-select  ng-model="update_appointment.apt_orgnizations" ng-change="getAptOrgContactPersonsByOrg(update_appointment.apt_orgnizations)" name="apt_orgnizations" required aria-label="apt_org_id">
                            <md-option ng-repeat="all_org in all_apt_orgs" ng-value="all_org.ORG_ID">
                                {{all_org.ORG_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker mdp-placeholder="Appiontment Date" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="update_appointment.apt_date">
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-time-picker mdp-placeholder="Appiontment Time" class="md-block" flex-gt-sm flex="20" mdp-format="hh:mm A"  ng-model="update_appointment.apt_time">
                    </mdp-time-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Contact Person </label>
                        <md-select  ng-model="update_appointment.contact_person" name="contract_person" required aria-label="contract_person">
                            <md-option ng-repeat="cp in apt_org_cps.contact_persons" ng-value="cp.contact_person">
                                {{cp.contact_person}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Appointment Place</label>
                        <input type="text" required ng-model="update_appointment.apt_place" name="apt_place" aria-label="apt_place"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Contact Type</label>
                        <input type="text" required ng-model="update_appointment.apt_contract_type" name="apt_contract_type" aria-label="apt_contract_type"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Status </label>
                        <md-select ng-model="update_appointment.apt_status" name="apt_status" required aria-label="apt_status">
                            <md-option ng-repeat="apt_status in apt_statuss" ng-value="apt_status">
                                {{apt_status}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="100">
                        <label>Feedback</label>
                        <input type="text"  ng-model="update_appointment.feedback" name="feedback" aria-label="feedback"/>
                        <div ng-messages="editAppointmentForm.feedback.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="UpdateAppointment(update_appointment)" ng-disabled="editAppointmentForm.$invalid" aria-label="submit">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>