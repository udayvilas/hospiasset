<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
	<div layout="column">
		<h3 class="heading-stylerespond">Add Contracts</h3>
		<span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
		<div flex layout="row" layout-align="center center">
			<form method="POST" name="addMcontractForm" flex="70" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
				<div layout="row">
					<md-input-container class="md-block" flex-gt-sm flex="40">
						<label>Select Branch *</label>
						<md-select ng-model="add_mlcontract.branch_id" name="branch_id" ng-required="add_mlcontract.branch_id !=''">
							<md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs" ng-if="branch.BRANCH_ID !='All'">                                {{branch.BRANCH_NAME}}                            </md-option>
						</md-select>
						<div ng-messages="addMcontractForm.branch_id.$error">
						<div ng-show="required">Required.</div>
						</div>
					</md-input-container>
					<div flex="20" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<!---<md-input-container class="md-block" flex-gt-sm flex="40" ><label>Contract Vendor *</label><md-select ng-model="add_mlcontract.vendor" ng-change="getVendorAndEquipmentsDtls(add_mlcontract.vendor,add_mlcontract.branch_id);getContractVendorDetails(add_mlcontract.vendor)" name="vendor" required aria-label="vendor" ng-disabled="add_mlcontract.branch_id ==''" ><md-option ng-repeat="sprt_vendr in sprt_vendrs" ng-value="sprt_vendr.ID">                                {{sprt_vendr.NAME}}                            </md-option></md-select></md-input-container>--->
					<md-autocomplete class="md-block" 
					flex-gt-sm flex="20"		
					ng-value="add_mlcontract.vendor==searched.ORG_ID"	
					md-no-cache="false"	
                    required
                    md-input-name="vendor"					
					md-selected-item="searched.ORG_ID"	
					md-search-text="searchORG_NAME"		
					md-items="item in searchTextChange(searchORG_NAME,'Vendor')"
					md-item-text="item.ORG_NAME"			
					md-selected-item-change="getContractVendorDetails(add_mlcontract.vendor)"		
					md-min-length="0"			
					md-floating-label="Search Vendor">
						<md-item-template>
							<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
						</md-item-template>
						<div ng-messages="addMcontractForm.vendor.$error">
						<div ng-message="required">Required.</div>
						</div>
						<md-not-found>
						NO Vendor Found		
						</md-not-found>
					</md-autocomplete>
					<span ng-value="add_mlcontract.vendor = searched.ORG_ID.ORG_ID" ></span>
					<div flex="20" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<!---<md-input-container class="md-block" flex-gt-sm flex="40"  ><label>Select Equipments *</label><md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" name="equps" required multiple ng-model="add_mlcontract.equps" aria-label="equps" ng-disabled="add_mlcontract.branch_id==null"><md-select-header class="demo-select-header"><input ng-model="searchTerm" type="text" placeholder="Search Equipments" class="demo-header-searchbox md-text"></md-select-header><md-optgroup label="equps"><md-option ng-value="contract_equp.EID" ng-repeat="contract_equp in contract_equps |              filter:searchTerm">{{contract_equp.EID}}</md-option></md-optgroup></md-select></md-input-container>---->
					<md-autocomplete  
					class="md-block" flex-gt-sm flex="25"  
					md-no-cache="true"	
					multiple
                    md-input-name="Eq.id"					
					ng-value="add_mlcontract.equps=searched.E_ID"   
					md-selected-item="searched.E_ID"    
					md-search-text="add_mlcontract.searchEid"    
					md-items="item in searchTextChange(add_mlcontract.searchEid,add_mlcontract.branch_id)"            
					md-item-text="add_mlcontract.equps = item.E_ID"       
					md-min-length="0"                         
					md-search-text-change="add_mlcontract.equps = ''"     
					md-selected-item-change="getDeviceDetailByEID(item)"       
					md-floating-label="Search Eq. id">
						<md-item-template>
							<span md-highlight-text="searchText"  md-highlight-flags="^i">{{item.E_ID}}</span>
						</md-item-template>
						<div ng-messages="addMcontractForm.Eq.id.$error">
						<div ng-message="required">Required.</div>
						</div>
						<md-not-found>                        
						No Equipment Match Found           
						</md-not-found>
					</md-autocomplete>
					<span ng-value="add_mlcontract.equps = searched.E_ID.E_ID" ></span>
				</div>
				<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
					<md-input-container class="md-block" flex-gt-sm flex="30">
						<label>Contact Number</label>
						<input type="text" ng-disabled="true" only-digits="only-digits" ng-model="add_mcontract.vendor_contact_no" name="vendor_contact_no" aria-label="vcontact_no"/>
					</md-input-container>
					<!--<md-input-container class="md-block" flex-gt-sm flex="25"  >
                        <label>Select Equipments *</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" name="equps" required multiple ng-model="add_mlcontract.equps" aria-label="equps" ng-disabled="add_mlcontract.branch_id==null">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Equipments" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="equps">
                                <md-option ng-value="contract_equp.EID" ng-repeat="contract_equp in contract_equps |
              filter:searchTerm">{{contract_equp.EID}}</md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>--->
					
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<md-input-container class="md-block"  flex-gt-sm flex="30">
						<label>Email ID</label>
						<input type="email" ng-disabled="true" ng-model="add_mcontract.vemail_id" name="vemail_id" aria-label="vemail_id"/>
					</md-input-container>
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
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
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<md-input-container class="md-block"  flex-gt-sm flex="30">
						<label>Contact Person Email ID</label>
						<input type="eamil" ng-disabled="true" ng-model="add_mcontract.vcontact_person_email_id" name="vcontact_person_email_id" aria-label="vcontact_person_email_id"/>
					</md-input-container>
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<md-input-container class="md-block"  flex-gt-sm flex="30">
						<label>Vendor Address</label>
						<textarea rows="5" ng-disabled="true" ng-model="add_mcontract.vendor_address" name="vendor_address" aria-label="vendor_address" md-select-on-focus></textarea>
					</md-input-container>
				</div>
				<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
					<md-input-container class="md-block" flex-gt-sm flex="30">
						<label>Contract Type *</label>
						<md-select ng-model="add_mlcontract.contract_type" name="contract_type" required aria-label="contract_type">
							<md-option ng-repeat="contract_type in contract_types" ng-value="contract_type.CTYPE">                                {{contract_type.CTYPE}}                            </md-option>
						</md-select>
					</md-input-container>
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<mdp-date-picker mdp-placeholder="Contract From *" class="md-block" flex-gt-sm flex="30" mdp-max-date="maxDate" mdp-format="DD-MM-YYYY" ng-model="add_mlcontract.contract_from_date" ></mdp-date-picker>
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<mdp-date-picker mdp-placeholder="Contract To *" class="md-block" flex-gt-sm mdp-format="DD-MM-YYYY" ng-model="add_mlcontract.contract_to_date" flex="30"  mdp-min-date="add_mlcontract.contract_from_date"></mdp-date-picker>
				</div>
				<div layout="row">
					<md-input-container class="md-block"  flex-gt-sm flex="30">
						<label>Contract Value</label>
						<input 
ng-pattern="/^(\d)+$/" type="text" required md-maxlength="10" ng-model="add_mlcontract.contract_value" name="contract_value" aria-label="contract_value"/>
					<div ng-messages="addMcontractForm.contract_value.$error">
						<div ng-message="required">Required.</div>
						<div ng-show="addMcontractForm.contract_value.$error.maxlength">Max length is Exceeds.</div>
						</div>
					</md-input-container>
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<md-input-container class="md-block"  flex-gt-sm flex="65">
						<label>Remarks</label>
						<input  type="text" required ng-model="add_mlcontract.remarks" md-maxlength="250" name="remarks" aria-label="remarks"/>
					<div ng-messages="addMcontractForm.remarks.$error">
						<div ng-message="required">Required.</div>
					
						</div>
					</md-input-container>
				</div>
				<div flex layout="row" layout-align="center center">
					<center>
						<md-button class="md-raised md-accent" ng-click="addMultiContracts(add_mlcontract)" ng-disabled="addMcontractForm.$invalid" aria-label="submit">Submit</md-button>
					</center>
					<center>
						<md-button class="md-raised" aria-label="submit" ui-sref="home.maintain_contracts">Cancel</md-button>
					</center>
				</div>
			</form>
		</div>
		<!--<div flex layout="row" layout-align="center center"><div flex="70" layout="row" style="margin-top:10px;"><table class="md-api-table table table-bordered"><thead><tr><th>Eq. ID</th><th>Eq. Name</th><th>Vendor Name</th><th>Contract Type</th><th>Contract From</th><th>Contract To</th><th>Status</th></tr></thead><tbody><tr ng-if="device_contracts!=null" ng-repeat="device_contract in device_contracts"><td>{{device_contract.EID}}</td><td>{{device_contract.eq_name}}</td><td>{{device_contract.VENDOR_NAME}}</td><td>{{device_contract.AMC_TYPE}}</td><td><div ng-if="device_contract.AMC_FROM!=null && device_contract.AMC_FROM!='1970-01-01'">                            {{device_contract.AMC_FROM | date:"dd-MM-yyyy"}}                        </div><div ng-else>-</div></td><td><div ng-if="device_contract.AMC_TO!=null && device_contract.AMC_TO!='1970-01-01'">                            {{device_contract.AMC_TO | date:"dd-MM-yyyy"}}                        </div><div ng-else>-</div></td><td>{{device_contract.status}}</td></tr><tr ng-if="device_contracts==null"><td colspan="8" class="text-center">No Contracts Found</td></tr></tbody></table></div></div>-->
	</div>
</md-content>