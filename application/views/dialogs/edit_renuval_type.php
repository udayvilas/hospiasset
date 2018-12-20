<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock xmlns="http://www.w3.org/1999/html">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Contract Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-dialog-content  flex="100" >
        <div class="md-dialog-content">
            <div  flex="100" >
                    <md-radio-group layout="row" ng-model="r_m_contract.svendor" layout-align="center center">
                        <span>  Contract Renewal</span> &nbsp; &nbsp; &nbsp;
                        <md-radio-button value="YES" class="md-primary">Same Vendor</md-radio-button>
                        <md-radio-button value="NO" class="md-primary">Other Vendor</md-radio-button>
                    </md-radio-group>

                <div ng-show="mcontract_r_divs.samevendordiv"  flex="100">
                    <form method="POST" name="editRMcontractForm" flex="100" autocomplete="off">
                        <div layout="row" style="margin-top:20px;">
                            <md-input-container class="md-block"  flex-gt-sm flex="45">
                                <label>Equipment ID</label>
                                <input type="text" ng-model="add_r_mcontract.EID" name="equp_id" aria-label="equp_id" ng-disabled="true" />
                            </md-input-container>

                            <div flex="10" hide-xs hide-sm><!-- Space --></div>
                            <!--<md-input-container class="md-block" flex-gt-sm flex="45">
                                <label>Contract Vendor *</label>
                                <md-select disabled ng-model="add_r_mcontract.vendor" name="vendor" required aria-label="vendor">
                                    <md-option ng-repeat="sprt_vendr in sprt_vendrs" ng-value="sprt_vendr.ID">
                                        {{sprt_vendr.NAME}}
                                    </md-option>
                                </md-select>
                            </md-input-container>-->
							<md-autocomplete class="md-block" flex-gt-sm flex="30"
		                     ng-value="add_r_mcontract.vendor == searched.ORG_ID"
							 md-no-cache="true"
							 md-selected-item="searched.ORG_ID"
							md-search-text="searchORG_NAME"
							 md-items="item in searchTextChange(searchORG_NAME,'vendor')"
							 md-item-text="item.ORG_NAME"
							 md-min-length="0"
							 md-search-text-change
							 md-floating-label=" Vendor.id">
				<md-item-template>
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
				</md-item-template>
				<md-not-found>
				   NO Vendor Found
				</md-not-found>
			</md-autocomplete>
           <span ng-value="add_r_mcontract.vendor = searched.ORG_ID.ORG_ID" ng-model="add_r_mcontract.vendor = searched.ORG_ID.ORG_ID"></span>
                        </div>
                        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                            <md-input-container class="md-block" flex-gt-sm flex="30">
                                <label>Contact Number</label>
                                <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="add_r_mcontract.vendor_contact_no" name="vendor_contact_no" aria-label="vcontact_no"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Email ID</label>
                                <input type="email" ng-disabled="true" ng-model="edit_mcontract1.vemail_id" name="vemail_id" aria-label="vemail_id"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Contact Person</label>
                                <input type="text" ng-disabled="true" ng-model="edit_mcontract.vcontact_person" name="vcontact_person" aria-label="vcontact_person"/>
                            </md-input-container>
                        </div>

                        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Contact Person Number</label>
                                <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="add_r_mcontract.vcontact_person_no" name="vcontact_person_no" aria-label="vcontact_person_no"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Contact Person Email ID</label>
                                <input type="eamil" ng-disabled="true" ng-model="add_r_mcontract.vcontact_person_email_id" name="vcontact_person_email_id" aria-label="vcontact_person_email_id"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Vendor Address</label>
                                <textarea rows="5" ng-disabled="true" ng-model="add_r_mcontract.vendor_address" name="vendor_address" aria-label="vendor_address" md-select-on-focus></textarea>
                            </md-input-container>
                        </div>

                        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                            <md-input-container class="md-block" flex-gt-sm flex="30">
                                <label>Contract Type *</label>
                                <md-select ng-model="add_r_mcontract.contract_type" name="contract_type" required aria-label="contract_type">
                                    <md-option ng-repeat="contract_type in contract_types" ng-value="contract_type.CTYPE">
                                        {{contract_type.CTYPE}}
                                    </md-option>
                                </md-select>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <mdp-date-picker mdp-placeholder="Contract From *" class="md-block" flex-gt-sm flex="30" mdp-min-date="maxDate" mdp-format="DD-MM-YYYY" ng-model="add_r_mcontract.contract_from_date" >
                            </mdp-date-picker>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <mdp-date-picker mdp-placeholder="Contract To *" class="md-block" flex-gt-sm mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="add_r_mcontract.contract_to_date" flex="30" mdp-min-date="add_r_mcontract.contract_from_date">
                            </mdp-date-picker>
                        </div>

                        <div layout="row">
                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Contract Value</label>
                                <input only-digits="only-digits" type="text" required ng-model="add_r_mcontract.contract_value" name="contract_value" aria-label="contract_value"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="65">
                                <label>Remarks</label>
                                <input  type="text" required ng-model="add_r_mcontract.remarks" name="remarks" aria-label="remarks"/>
                            </md-input-container>
                        </div>
                        <div flex layout="row" layout-align="center center">

                                <md-button class="md-raised md-accent" ng-click="AddMRContractVendor(add_r_mcontract)" ng-disabled="editRMcontractForm.$invalid" aria-label="submit" style="float:left" >Renewall</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                        </div>
                    </form>

                </div>

                <div ng-show="mcontract_r_divs.othervendordiv" layout-align="center center">
                    <form method="POST" name="addMcontractForm" flex="100" class="" autocomplete="off">
                        <div layout="row">
                         <md-input-container class="md-block"  flex-gt-sm flex="45">
                                <label>Equipment ID</label>
                                <input type="text" ng-model="add_mcontract.equp_id" name="equp_id" aria-label="equp_id" ng-disabled="true"/>
                            </md-input-container>
                            <div flex="10" hide-xs hide-sm><!-- Space --></div>
                            <!--<md-input-container class="md-block" flex-gt-sm flex="45">
                                <label>Contract Vendor *</label>
                                <md-select ng-model="add_mcontract.vendor" ng-change="getContractVendorDetails(add_mcontract.vendor)" name="vendor" required aria-label="vendor">
                                    <md-option ng-repeat="sprt_vendr in sprt_vendrs" ng-value="sprt_vendr.ID">
                                        {{sprt_vendr.NAME}}
                                    </md-option>
                                </md-select>
                            </md-input-container>-->
							<md-autocomplete class="md-block" flex-gt-sm flex="30"
		                     ng-value="add_mcontract.vendor == searched.ORG_ID"
							 md-no-cache="true"
							 md-selected-item="searched.ORG_ID"
							md-search-text="searchORG_NAME"
							 md-items="item in searchTextChange(searchORG_NAME,'vendor')"
							 md-item-text="item.ORG_NAME"
							  md-selected-item-change="getContractVendorDetails(add_mcontract.vendor)"
							 md-min-length="0"
							 md-floating-label=" Vendor.id">
				<md-item-template>
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
				</md-item-template>
				<md-not-found>
				   NO Vendor Found
				</md-not-found>
			</md-autocomplete>
           <span ng-value="add_mcontract.vendor = searched.ORG_ID.ORG_ID">
                        </div>
                        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                            <md-input-container class="md-block" flex-gt-sm flex="30">
                                <label>Contact Number</label>
                                <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="add_mcontract.vendor_contact_no" name="vendor_contact_no" aria-label="vcontact_no"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Email ID</label>
                                <input type="email" ng-disabled="true" ng-model="add_mcontract.vemail_id" name="vemail_id" aria-label="vemail_id"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Contact Person</label>
                                <input type="text" ng-disabled="true" ng-model="add_mcontract.vcontact_person" name="vcontact_person" aria-label="vcontact_person"/>
                            </md-input-container>
                        </div>

                        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Contact Person Number</label>
                                <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="add_mcontract.vcontact_person_no" name="vcontact_person_no" aria-label="vcontact_person_no"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Contact Person Email ID</label>
                                <input type="eamil" ng-disabled="true" ng-model="add_mcontract.vcontact_person_email_id" name="vcontact_person_email_id" aria-label="vcontact_person_email_id"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Vendor Address</label>
                                <textarea rows="5" ng-disabled="true" ng-model="add_mcontract.vendor_address" name="vendor_address" aria-label="vendor_address" md-select-on-focus></textarea>
                            </md-input-container>
                        </div>

                        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                            <md-input-container class="md-block" flex-gt-sm flex="30">
                                <label>Contract Type *</label>
                                <md-select ng-model="add_mcontract.contract_type" name="contract_type" required aria-label="contract_type">
                                    <md-option ng-repeat="contract_type in contract_types" ng-value="contract_type.CTYPE">
                                        {{contract_type.CTYPE}}
                                    </md-option>
                                </md-select>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <mdp-date-picker mdp-placeholder="Contract From *" class="md-block" flex-gt-sm flex="30" mdp-max-date="maxDate" mdp-format="DD-MM-YYYY" ng-model="add_mcontract.contract_from_date" >
                            </mdp-date-picker>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <mdp-date-picker mdp-placeholder="Contract To *" class="md-block" flex-gt-sm mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="add_mcontract.contract_to_date" flex="30" mdp-min-date="add_mcontract.contract_from_date">
                            </mdp-date-picker>
                        </div>

                        <div layout="row">
                            <md-input-container class="md-block"  flex-gt-sm flex="30">
                                <label>Contract Value</label>
                                <input only-digits="only-digits" type="text" required ng-model="add_mcontract.contract_value" name="contract_value" aria-label="contract_value"/>
                            </md-input-container>

                            <div flex="5" hide-xs hide-sm><!-- Space --></div>

                            <md-input-container class="md-block"  flex-gt-sm flex="65">
                                <label>Remarks</label>
                                <input  type="text" required ng-model="add_mcontract.remarks" name="remarks" aria-label="remarks"/>
                            </md-input-container>
                        </div>
                        <div flex layout="row" layout-align="center center">
                                <md-button class="md-raised md-accent" ng-click="addMContractsOV(add_mcontract)" ng-disabled="addMcontractForm.$invalid" aria-label="submit" style="float:left">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                        </div>
                    </form>
                </div>
                </center>
            </div>
            </div>
    </md-dialog-content>
</md-dialog>