<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Transfer Request</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
            <div flex layout="row" layout-align="center center">
                <md-input-container  class="md-block" flex-gt-sm flex="20">
                    <label>Transfers</label>
                    <md-select ng-model="unit_type" name="transfer">
                        <md-option ng-repeat="transfer in transfers"  ng-value="transfer">
                            {{transfer}}
                        </md-option>
                    </md-select>
                </md-input-container>
            </div>
            <div ng-if="unit_type==transfers[0]" flex layout="row" layout-align="center center">
            <form method="POST" name="with_in_unitForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row" >
                    <md-input-container  class="md-block" flex-gt-sm flex="40">
                        <label>Department</label>
                        <md-select ng-model="with_in_unit.departments" name="depts">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment ID</label>
                        <input type="equp_id" ng-disabled="with_in_unit.departments==null" required ng-model="with_in_unit.equp_id" ng-change="getDeviceDetailsByEID(with_in_unit.departments,with_in_unit.equp_id)" name="equp_id" aria-label="equp_id"/>
                        <div ng-messages="with_in_unitForm.equp_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Name</label>
                        <input type="text"  ng-model="with_in_unit.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        <div ng-messages="with_in_unitForm.equp_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Model</label>
                        <input type="text"  ng-model="with_in_unit.equp_model" name="equp_model" aria-label="response" ng-disabled="true"/>
                        <div ng-messages="with_in_unitForm.equp_model.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Serial No</label>
                        <input type="text"  ng-model="with_in_unit.srial_no" name="eserial_no" aria-label="eserial_no" ng-disabled="true"/>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment PO No</label>
                        <input type="text"  ng-model="with_in_unit.pono" name="po_no" aria-label="po_no" ng-disabled="true"/>
                    </md-input-container>
                </div>
                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Contract Type</label>
                        <input type="text"  ng-model="with_in_unit.ctype" name="ctype" aria-label="ctype" ng-disabled="true"/>
                        <div ng-messages="with_in_unitForm.ctype.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Select New Department *</label>
                        <md-select ng-model="with_in_unit.newdepts" name="depts" md-on-open="loadDepartments()" >
                            <md-option ng-repeat="dept in depts" ng-if="dept.CODE!=with_in_unit.departments" ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                        <div ng-messages="with_in_unitForm.roleid.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Physical Location</label>
                        <input type="text"  ng-model="with_in_unit.plocation" name="plocation" aria-label="plocation" required />
                        <div ng-messages="with_in_unitForm.ctype.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Reasons</label>
                        <textarea ng-model="with_in_unit.reasons" name="reasons" md-maxlength="350" rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="with_in_unitForm.reasons.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="tranferWithinUnit(with_in_unit,unit_type)" ng-disabled="with_in_unitForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
            </div>
            <div ng-if="unit_type==transfers[1]" flex layout="row" layout-align="center center">
                <form method="POST" name="otherUnitRequestForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                    <div layout="row">
                        <!--       <md-autocomplete class="md-block" flex-gt-sm
                                                md-no-cache="false"
                                                md-selected-item="searched.ENAME"
                                                md-search-text="searchEname"
                                                md-items="item in searchTextChange(searchEname,'ename')"
                                                md-item-text="item.E_NAME"
                                                md-min-length="0"
                                                md-floating-label="Search Equipment name">
                                   <md-item-template>
                       <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_NAME}}</span>
                                   </md-item-template>
                                   <md-not-found>
                                       No Equipment Name Found
                                   </md-not-found>
                               </md-autocomplete>-->
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Equipment Name</label>
                            <input type="text"  ng-model="other_request.equp_name" name="equp_name" aria-label="equp_name"/>
                            <div ng-messages="otherUnitRequestForm.equp_name.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="40">
                            <label>Department</label>
                            <md-select ng-model="other_request.departments" name="depts">
                                <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>

                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex="40">
                            <label>Physical Location</label>
                            <input type="text"  ng-model="other_request.plocation" name="plocation" aria-label="plocation" />
                            <div ng-messages="otherUnitRequestForm.ctype.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="40">
                            <label>Transfer Type</label>
                            <md-select ng-model="other_request.ttype" name="ttype">
                                <md-option ng-repeat="transfer_type in transfer_types"  ng-value="transfer_type">
                                    {{transfer_type}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>

                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Reasons</label>
                            <textarea required ng-model="other_request.reasons" name="reasons" md-maxlength="350" rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="otherUnitRequestForm.reasons.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>

                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="OtherUnitRequest(other_request,unit_type)" ng-disabled="otherUnitRequestForm.$invalid" aria-label="submit">Submit</md-button>
                        </center>
                    </div>
                </form>
            </div>
    </div>
</md-content>