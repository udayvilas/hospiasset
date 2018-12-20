<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
    <h3 class="heading-stylerespond">Add Device Name</h3>
    <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
    <div flex layout="row" layout-align="center center">
        <form method="POST" name="addEquipmentName" flex="40" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
            <div flex layout="column">
                <md-input-container class="md-block" flex-gt-sm>
                    <label>{{dtypes_label.NAME}}</label>
                    <input type="text" required ng-model="add_equp_name.ename" name="ename" md-maxlength="50"  aria-label="ename"/>                         <div ng-messages="addEquipmentName.ename.$error">                            <div ng-message="required">Required.</div>                              <div ng-message="md-maxlength">Max limit is reached.</div>                                                      </div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>{{dtypes_label.CODE}}</label>
                    <input type="text" required ng-model="add_equp_name.ecode" ng-pattern= "/^[a-zA-Z. ]*[a-zA-Z]$/"  name="ecode" md-maxlength="3"  ng-change="add_equp_name.ecode = (add_equp_name.ecode | uppercase)" aria-label="ecode"/>                      <div ng-messages="addEquipmentName.ecode.$error">                            <div ng-message="required">Required.</div>                              <div ng-message="md-maxlength">Max limit is reached.</div>							   <div ng-show="addEquipmentName.ecode.$error.pattern">Please Provide Text Only.</div>							                                                         </div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>{{dtypes_label.priority}}*</label>
                    <md-select required ng-model="add_equp_name.priority" name="priority">
                        <md-option ng-repeat="device_priority in device_priorities"  ng-value="device_priority.PID">
                            {{device_priority.PNAME}}
                        </md-option>
                    </md-select>                    <div ng-messages="addEquipmentName.priority.$error">                            <div ng-message="required">Required.</div>                             							                                                         </div>                      
                </md-input-container>
            </div>
            <div flex layout="row" layout-align="center center">
               
                    <md-button class="md-raised md-accent" ng-click="addEupName(add_equp_name)" ng-disabled="addEquipmentName.$invalid" aria-label="submit">Submit</md-button>
                    <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbbme_equipment_names">Cancel</md-button>
            </div>
        </form>
    </div>
    </div>
</md-content>