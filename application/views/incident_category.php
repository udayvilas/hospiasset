<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="layout-padding" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Generate Call</h3>
        <div style="margin-top:10px;" flex layout="row" layout-align="center center">
            <form method="POST" name="GenerateCallForm" flex="60" flex-xs="100" class="md-whiteframe-3dp mylayout-padding" autocomplete="off">
                <div layout="row" layout-wrap flex>
                    <!--<div layout="row">-->
                    <md-input-container class="md-block" flex="30">
                        <label>Employee ID</label>
                        <input only-digits="only-digits" type="text" ng-disabled="true" ng-model="emp_no" name="emp_no" aria-label="emp_no"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex="30">
                        <label>Name</label>
                        <input type="text" ng-disabled="true" required ng-model="user_name" name="user_name" aria-label="user_name"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div class="md-block" style="margin-top:15px;" flex="25">
                        <a style="font-size: 12px;cursor: pointer" ng-click="getMyGeneratedCalls(emp_no)">My Calls</a>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div class="md-block"  flex="35">
                        <label>Raise Call By</label>
                        <input  type="radio" ng-model="raise_call" ng-change="
                                    (gen_call.device_id = '');
                                    (gen_call.sequp_model = '');
                                    (gen_call.sequp_name = '');
                                    (gen_call.ssrial_no= '');
                                    (gen_call.sphy_location='');
                                    (gen_call.eqp_id = '');
                                    (searched.EID = '');
                                    (gen_call.searchEid = '');" value="SR" raise_call />Serial No
                        <input  type="radio" ng-model="raise_call" ng-change="(gen_call.dept_id = '');
                                    (gen_call.device_id = '');
                                    (gen_call.sequp_model = '');
                                    (gen_call.sequp_name = '');
                                    (gen_call.ssrial_no= '');
                                    (gen_call.sphy_location='');
                                    (gen_call.eqp_id) = '';
                                    (searched.EID) = '';
                                    (gen_call.searchEid = '');" value="EID" raise_call />Equipment ID
                    </div>
                    <div flex="25" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container flex="45">
                        <label>Select Branch *</label>
                        <md-select ng-model="gen_call.branch_id" name="branch_id" aria-label="branch_id" ng-required="branch.BRANCH_ID !=''"
                                   required
								   ng-change="(gen_call.dept_id = '');
                                    (gen_call.device_id = '');
                                    (gen_call.sequp_model = '');
                                    (gen_call.sequp_name = '');
                                    (gen_call.ssrial_no= '');
                                    (gen_call.sphy_location='');
                                    (gen_call.eqp_id = '');
                                    (searched.EID = '');
                                    (gen_call.searchEid = '');
                                    ">
                            <md-option ng-repeat="branch in branchs" ng-value="branch.BRANCH_ID" ng-if="branch.BRANCH_ID !='All'">
                                {{branch.BRANCH_NAME}}
                            </md-option>
                        </md-select>
						<div ng-messages="GenerateCallForm.branch_id.$error">
						<div ng-message="required">Required.</div>
						</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container flex="45">
                        <label>Nature of Call</label>
                        <md-select required ng-model="gen_call.complaint" ng-change="getCallReasons(gen_call.complaint)" name="complaint">
                            <md-option ng-repeat="call_master in call_masters" ng-if="call_master.CODE =='IN'" ng-value="call_master.CODE">
                                {{call_master.NAME}}
                            </md-option>
                        </md-select>
						<div ng-messages="GenerateCallForm.complaint.$error">
						<div ng-message="required">Required.</div>
						</div>
                    </md-input-container>
                    <!--</div>
                    <div layout="row">-->
                    <!--<div flex="5" hide-xs hide-sm></div>-->
                    <md-input-container class="md-block" flex-gt-sm flex="45" >
                        <label>Type *</label>
                        <md-select ng-model="gen_call.type" name="type">
                            <md-option required ng-repeat="call_reason in call_reasons" ng-value="call_reason.CODE">
                                {{call_reason.COMPLANT_NAME}}
                            </md-option>
                        </md-select>
						<div ng-messages="GenerateCallForm.type.$error">
						<div ng-message="required">Required.</div>
						</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm></div>
					<md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Department</label>
                        <input type="text" ng-model="gen_call.dept_id" name="dept_id"  aria-label="dept_id"  ng-disabled="true"/>
                    </md-input-container>
					
                    <md-autocomplete  ng-if="raise_call == 'EID'"  class="md-block" flex-gt-sm flex="40"
                                      required
                                      md-no-cache="true"
									  md-input-name="EQID"
                                      md-selected-item="searched.EID"
                                      md-search-text="gen_call.searchEid"
                                      md-items="item in searchTextChange(gen_call.searchEid,gen_call.branch_id)"
                                      md-item-text="gen_call.device_id = item.E_ID"
                                      md-min-length="0"
                                      md-search-text-change="gen_call.device_id = ''"
                                      md-selected-item-change="getDeviceDetailByEID(item)"
                                      md-floating-label="Search Eq. id">
                        <md-item-template>
                            <span md-highlight-text="searchText"  md-highlight-flags="^i">{{item.E_ID}}</span>
                        </md-item-template>
                        <div ng-messages="GenerateCallForm.EQID.$error" ng-if="GenerateCallForm.EQID.$touched">
						<div ng-message="required">Required.</div>
						</div>
						<md-not-found>
                            No Equipment Match Found
                        </md-not-found>
						
                    </md-autocomplete>
					
                    
					
                    <md-autocomplete  ng-if="raise_call == 'SR'"  class="md-block" flex-gt-sm flex="45"
                                      md-no-cache="false"
									  required
									  md-item-name="serialno"
                                      md-selected-item="searched.SERIAL_NO"
                                      md-search-text="searchSerialno"
                                      md-items="item in searchTextChangeOne(searchSerialno,gen_call.branch_id)"
                                      md-item-text="gen_call.ssrial_no = item.ES_NUMBER"
                                      md-min-length="0"
									  md-search-text-change="gen_call.ssrial_no = ''"
                                      md-selected-item-change="getDeviceDetailBySerial(item)"
                                      md-floating-label="Search Serial No">
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ES_NUMBER}}</span>
                        </md-item-template>
						<div ng-messages="GenerateCallForm.serialno.$error" ng-if="GenerateCallForm.serialno.$touched">
						<div ng-message="required">Required.</div>
						</div>
                        <md-not-found>
                            No Serial Number Match Found
                        </md-not-found>
                    </md-autocomplete>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" ng-if="raise_call == 'SR'" flex-gt-sm flex="30">
                        <label>Equipment ID</label>
                        <input type="text" ng-model="gen_call.device_id" name="device_id" aria-label="device_id" ng-disabled="true"/>
                    </md-input-container>
                    <md-input-container class="md-block" ng-if="raise_call == 'EID'" flex-gt-sm flex="30">
                        <label>Equipment Serial No</label>
                        <input type="text"  ng-model="gen_call.ssrial_no" name="ssrial_no" aria-label="ssrial_no" ng-disabled="true"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ng-if="raise_call == 'SR' || raise_call == 'EID'" ></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Equipment Name</label>
                        <input type="text" ng-model="gen_call.sequp_name" name="sequp_name"   aria-label="sequp_name"  ng-disabled="true"/>
                    </md-input-container>
                    <!--</div>-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--<div layout="row" >-->
                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Equipment Model</label>
                        <input type="text" ng-model="gen_call.sequp_model" name="sequp_model" aria-label="sequp_model" ng-disabled="true"/>
                    </md-input-container>
					<div flex="5" hide-xs hide-sm ></div >
                    <!--</div>-->
                    <!--<div flex="5" hide-xs hide-sm flex-gt-sm flex="45"></div>-->
                    <!--<div layout="row">-->
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Physical Location</label>
                        <input type="text" ng-model="gen_call.sphy_location" name="sphy_location" aria-label="sphy_location" ng-disabled="true"/>
                    </md-input-container>
                   
                    
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Priority</label>
                        <md-select required ng-model="gen_call.priority" name="priority">
                            <md-option  ng-repeat="device_priority in device_priorities"  ng-value="device_priority.PID">
                                {{device_priority.PNAME}}
                            </md-option>
                        </md-select>
						<div ng-messages="GenerateCallForm.priority.$error">
                            <div ng-message="required">Required.</div>                           
                        </div>
                    </md-input-container>
                    <!--</div>-->
                    <!--<div flex layout="row">-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm  flex="45" ng-if="gen_call.complaint==nature_of_calls[3]">
                        <label>Reasons*</label>
                        <md-select ng-model="gen_call.condem_reasons" name="reasons" multiple>
                            <md-option ng-repeat="conreason in conreasons"  ng-value="conreason.CODE">
                                {{conreason.REQUEST_NAME}} ({{conreason.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ng-if="gen_call.complaint==nature_of_calls[3]"><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Remarks</label>
                        <input type="text" ng-model="gen_call.generationremarks" name="generationremarks" aria-label="generationremarks"/>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent"   ng-click="UserCallgenerate()" ng-disabled="GenerateCallForm.$invalid" aria-label="submit">Submit</md-button>
                         <!-- <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbbme_incident_call">Cancel</md-button>-->
                </div>
            </form>
        </div>
    </div>
</md-content>
</div>