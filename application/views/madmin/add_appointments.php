<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Appointments</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addAppointmentForm" flex="80" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <h5 class="sub_heading-style-respond">Appointment Details</h5>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Orgnizarion </label>
                        <md-select  ng-model="add_appointment.apt_orgnizations" ng-change="getAptOrgContactPersonsByOrg(add_appointment.apt_orgnizations)" name="apt_orgnizations" required aria-label="apt_org_id">
                            <md-option ng-repeat="all_org in all_apt_orgs" ng-value="all_org.ORG_ID">
                                {{all_org.ORG_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker mdp-placeholder="Appiontment Date" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="add_appointment.apt_date">
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-time-picker mdp-placeholder="Appiontment Time" class="md-block" flex-gt-sm flex="20" mdp-format="hh:mm A" ng-model="add_appointment.apt_time">
                    </mdp-time-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Contact Person </label>
                        <md-select  ng-model="add_appointment.contract_person" name="contract_person" required aria-label="contract_person">
                            <md-option ng-repeat="cp in apt_org_cps.contact_persons" ng-value="cp.contact_person">
                        {{cp.contact_person}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Appointment Place</label>
                        <input type="text" required ng-model="add_appointment.apt_place" name="apt_place" aria-label="apt_place"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                     <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Contact Type</label>
                        <input type="text" required ng-model="add_appointment.apt_contract_type" name="apt_contract_type" aria-label="apt_contract_type"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Status</label>
                        <md-select ng-model="add_appointment.apt_status" name="contract_type" required aria-label="contract_type">
                            <md-option ng-repeat="apt_status in apt_statuss" ng-value="apt_status">
                                {{apt_status}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="100">
                        <label>Feedback</label>
                        <input type="text" spellcheck="true" ng-model="add_appointment.feedback" name="feedback" aria-label="feedback"/>
                        <div ng-messages="addAppointmentForm.feedback.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                        <md-button class="md-raised md-accent" ng-click="addAppointment(add_appointment)" ng-disabled="addAppointmentForm.$invalid" aria-label="submit">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3" ui-sref="home.appointment_hospitals">Cancel</md-button>

                </div>
            </form>
        </div>
    </div>
</md-content>