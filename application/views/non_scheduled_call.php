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
                    <div class="md-block"  flex="40">
                        <label>Raise Call By</label>
                        <input  type="radio" ng-model="raise_call" ng-change="(gen_call.dept_id = '');
                                    (gen_call.device_id = '');
                                    (gen_call.sequp_model = '');
                                    (gen_call.sequp_name = '');
                                    (gen_call.ssrial_no= '');
                                    (gen_call.sphy_location='');
                                    (gen_call.eqp_id = '');
                                    (searched.EID = '');
                                    (gen_call.searchEid = '');
                                    " value="SR"/>Serial No
                        <input  type="radio" ng-model="raise_call" ng-change="(gen_call.dept_id = '');
                                    (gen_call.device_id = '');
                                    (gen_call.sequp_model = '');
                                    (gen_call.sequp_name = '');
                                    (gen_call.ssrial_no= '');
                                    (gen_call.sphy_location='');
                                    (gen_call.eqp_id = '');
                                    (searched.EID = '');
                                    (gen_call.searchEid = '');
                                    " value="EID"/>Equipment ID
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
                            <md-option ng-repeat="call_master in call_masters" ng-if="call_master.CODE=='NS'" ng-value="call_master.CODE">
                                {{call_master.NAME}}
                            </md-option>
                        </md-select>
						<div ng-messages="GenerateCallForm.complaint.$error">
						<div ng-message="required">Required.</div>
						</div>
                    </md-input-container>
                    <!--</div>
                    <div layout="row">-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--<md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Type *</label>
                        <md-select ng-model="gen_call.type" name="type">
                            <md-option ng-repeat="call_reason in call_reasons" ng-value="call_reason.CODE">
                                {{call_reason.COMPLANT_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>--->
                   
                    <md-autocomplete  ng-if="raise_call == 'EID'" class="md-block" flex-gt-sm flex="45"

                                      md-no-cache="true"
									  required
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
                            <!---<span ng-bind="DMessage" ng-style="{color:DColor}"></span>-->
						</md-item-template>
						
						<div ng-messages="GenerateCallForm.EQID.$error" ng-if="GenerateCallForm.EQID.$touched">
						<div ng-message="required">Required.</div>
						</div>
                        <md-not-found>
                            No Equipment Match Found
                        </md-not-found>
                    </md-autocomplete>
                    <md-autocomplete  ng-if="raise_call == 'SR'" class="md-block" flex-gt-sm flex="45"
                                      md-no-cache="false"
									  required
									  md-input-name="serialno"
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
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Department</label>
                        <input type="text" ng-model="gen_call.dept_id" name="dept_id"  aria-label="dept_id"  ng-disabled="true"/>
                    </md-input-container>
					<div flex="5" hide-xs hide-sm></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Equipment ID</label>
                        <input type="text" ng-model="gen_call.device_id" name="device_id" aria-label="device_id" ng-disabled="true"/>
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" ng-if="raise_call == 'EID'" flex-gt-sm flex="45">
                        <label>Equipment Serial No</label>
                        <input type="text"  ng-model="gen_call.ssrial_no" name="ssrial_no" aria-label="ssrial_no" ng-disabled="true"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ng-if="raise_call == 'SR' || raise_call == 'EID'"><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Equipment Name</label>
                        <input type="text" ng-model="gen_call.sequp_name" name="sequp_name"  aria-label="sequp_name"  ng-disabled="true"/>
                    </md-input-container>
                    <!--</div>-->
                    <div flex="5" hide-xs hide-sm flex-gt-sm></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Equipment Model</label>
                        <input type="text" ng-model="gen_call.sequp_model" name="sequp_model" aria-label="sequp_model" ng-disabled="true"/>
                    </md-input-container>
                    <!--</div>-->
                    <div flex="5" hide-xs hide-sm flex-gt-sm flex="45" ng-if="gen_call.type!=transfers[1]"><!-- Space --></div>
                    <!--<div layout="row">-->
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Physical Location</label>
                        <input type="text" ng-model="gen_call.sphy_location" name="sphy_location" aria-label="sphy_location" ng-disabled="true"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45" ng-if="gen_call.type==transfers[0]">
                        <label>New Physical Location</label>
                        <input ng-required="gen_call.type==transfers[0]" type="text" ng-model="gen_call.plocation" name="plocation" aria-label="plocation" required />
                        <div ng-messages="GenerateCallForm.ctype.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ng-if="gen_call.type==transfers[0]"><!-- Space --></div>
                    <md-input-container ng-if="gen_call.type==transfers[1]" class="md-block" flex-gt-sm flex="45">
                        <label>Transfer Type</label>
                        <md-select ng-required="gen_call.type==transfers[1]" ng-model="gen_call.ttype" name="ttype">
                            <md-option ng-repeat="transfer_type in transfer_types"  ng-value="transfer_type">
                                {{transfer_type}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <!--</div>-->
                    <!--<div layout="row">-->
                    <md-input-container ng-if="gen_call.type==transfers[0]" class="md-block" flex-gt-sm flex="45">
                        <label>Select New Department *</label>
                        <md-select md-on-open="loadAllDepartments(all)" ng-required="gen_call.complaint==nature_of_calls[0]" ng-model="gen_call.newdepts" name="depts">
                            <md-option ng-repeat="dept in all_depts" ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                        <div ng-messages="with_in_unitForm.roleid.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ng-if="gen_call.type==transfers[0]"></div>
                    <md-input-container ng-if="gen_call.type==transfers[1]" class="md-block" flex-gt-sm flex="45">
                        <label>Transfer to Branch<span ng-show="gen_call.type==transfers[1]"> *</span></label>
                        <md-select ng-required="gen_call.type==transfers[1]" md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="gen_call.from_eq_transfer_unit" name="from_eq_transfer" aria-label="from_eq_transfer">
                            <md-select-header class="demo-select-header">
                                <input type="text" ng-model="searchTerm" placeholder="Search Branch" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="equp_names2">
                                <md-option ng-disabled="branch.BRANCH_ID==gen_call.branch_id" ng-repeat="branch in branchs | filter:searchTerm" ng-value="branch.BRANCH_ID" ng-if="branch.BRANCH_ID != 'All'">
                                    {{branch.BRANCH_NAME}}</md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ng-if="gen_call.complaint==nature_of_calls[1] && gen_call.type==transfers[1]"></div>
                    <mdp-date-picker ng-if="gen_call.complaint==nature_of_calls[1] && gen_call.type==transfers[1] && gen_call.ttype==transfer_types[0]" mdp-placeholder="Expected return date" name="expect_return" ng-required="" class="md-block" flex-gt-sm flex="45" mdp-format="DD-MM-YYYY" ng-model="gen_call.expect_return" mdp-min-date="minDate">
                    </mdp-date-picker>
                    <!--</div>-->
                    <!--<div flex layout="row">-->
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Priority</label>
                        <md-select required ng-model="gen_call.priority" name="priority">
                            <md-option  ng-repeat="device_priority in device_priorities"  ng-value="device_priority.PID">
                                {{device_priority.PNAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <!--</div>-->
                    <!--<div flex layout="row">-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm  flex="45" >
                        <label>Reasons*</label>
                        <md-select ng-model="gen_call.reasons" name="reasons">
                            <md-option ng-repeat="conreason in non_reasons"  ng-value="conreason.REASON">
                                {{conreason.REASON}} 
                            </md-option>
                        </md-select>
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div flex="5" hide-xs hide-sm ng-if="gen_call.complaint==nature_of_calls[3]"><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Remarks</label>
                        <input type="text" ng-model="gen_call.generationremarks" name="generationremarks" aria-label="generationremarks"/>
                    </md-input-container>
                </div>
                <div ng-show="gen_call.type==transfers[1]" layout="row" layout-wrap flex>
                    <md-input-container>
                        <md-checkbox ng-checked="true" ng-click="TransferAndGatePass(gen_call,cms_and_gatepass)" aria-label="rtc_device_dtls.EID" class="md-accent" style="margin-bottom: 0px;">Generate Gate Pass
                        </md-checkbox>
                    </md-input-container>
                </div>
                <div ng-show="!isEmpty(cms_and_gatepass);gen_call.type==transfers[1]"  layout="row" layout-wrap flex>
                    <md-input-container  class="md-block" flex-gt-sm flex="45">
                        <label>Spares</label>
                        <md-select ng-model="gen_call.critical_spare" name="critical_spare" multiple>
                            <md-option ng-repeat="m_critical_spare in m_critical_spares"  ng-value="m_critical_spare.CODE" >
                                {{m_critical_spare.NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Spares Count</label>
                        <input type="text" ng-model="gen_call.spars_cnt" only-digits="only-digits"  ng-disabled="gen_call.critical_spare==null" name="spars_cnt" aria-label="spars_cnt"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                    <md-input-container  class="md-block" flex-gt-sm flex="45">
                        <label>Accessories</label>
                        <md-select ng-model="gen_call.accessories" name="accessorie" multiple>
                            <md-option ng-repeat="m_accessorie in m_accessories" ng-value="m_accessorie.CODE" >
                                {{m_accessorie.NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm ><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Accessories Count</label>
                        <input type="text" only-digits="only-digits"   ng-disabled="gen_call.accessories==null" ng-model="gen_call.accessories_cnt" name="accessories_cnt" aria-label="accessories_cnt"/>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent"   ng-click="UserCallgenerate()" ng-disabled="GenerateCallForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>
</div>