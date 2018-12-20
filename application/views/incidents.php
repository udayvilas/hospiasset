<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Incident</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addIncidentForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container  class="md-block" flex-gt-sm flex="40">
                        <label>Department</label>
                        <md-select ng-model="add_incdent.departments" name="depts">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment ID</label>
                        <input type="equp_id" ng-disabled="add_incdent.departments==null" required ng-model="add_incdent.equp_id" ng-change="getDeviceDetailsByEID(add_incdent.departments,add_incdent.equp_id)" name="equp_id" aria-label="equp_id"/>
                        <div ng-messages="addIncidentForm.equp_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Name</label>
                        <input type="text"  ng-model="add_incdent.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        <div ng-messages="addIncidentForm.equp_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Model</label>
                        <input type="text"  ng-model="add_incdent.equp_model" name="equp_model" aria-label="response" ng-disabled="true"/>
                        <div ng-messages="addIncidentForm.equp_model.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Serial No</label>
                        <input type="text"  ng-model="add_incdent.eserial_no" name="eserial_no" aria-label="eserial_no" ng-disabled="true"/>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Contract Type</label>
                        <input type="text"  ng-model="add_incdent.ctype" name="ctype" aria-label="ctype" ng-disabled="true"/>
                        <div ng-messages="addIncidentForm.ctype.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Incident Type *</label>
                        <md-select name="roleid" required ng-model="add_incdent.itype" aria-label="itype">
                            <md-option  ng-value="itype.CODE" ng-repeat="itype in itypes">{{itype.ITYPE}}</md-option>
                        </md-select>
                        <div ng-messages="addIncidentForm.roleid.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Feedback</label>

                        <textarea ng-model="add_incdent.feedback" name="feedback" md-maxlength="350" rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="addIncidentForm.feedback.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <mdp-date-picker mdp-placeholder="Date" class="md-block" flex-gt-sm flex="40" mdp-format="DD/MM/YYYY" ng-model="add_incdent.current_date" mdp-min-date="minDate" ></mdp-date-picker>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <mdp-time-picker mdp-placeholder="Time" class="md-block" mdp-format="hh:mm A" flex-gt-sm flex="40" ng-model="add_incdent.current_time"></mdp-time-picker>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="addIncedent(add_incdent)" ng-disabled="addIncidentForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                    <center>
                        <md-button class="md-raised md-default" ui-sref="{{user_path}}" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>