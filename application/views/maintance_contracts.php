<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="hospiclr">
	<div layout="column">
		<h3 class="heading-stylerespond">Contracts</h3>
		<!--<div layout="row" layout-align="right"><span style="text-decoration: underline;color:red;font-size: 12px;" ng-click="ShowHide()">Advanced Options({{isvisiblevalue}})</span></div>-->
		<div layout="row" layout-align="space-around center" style="border-bottom:1px solid #DDD;margin-bottom: 8px;" class="reveal-animation">
			<!--<div ng-click="loadMaintanceContracts(0,null)" flex="10" class="widget margin-4" style="background-color:#283593;cursor: pointer;" layout="column"><div class="card-margin-4" layout-align="center center" layout="row"><span class="fff-color">{{m_contracts_cnt[0]}}</span></div><div flex layout="row" layout-align="center center"><span class="fff-color">All</span></div></div>-->
			<div ng-click="loadMaintanceContracts(0,expires[4].code)" flex="10" class="widget margin-4" style="background-color:#981919;cursor: pointer;" layout="column">
				<div class="card-margin-4" layout-align="center center" layout="row">
					<span class="fff-color">{{m_contracts_cnt.expired}}</span>
				</div>
				<div flex layout="row" layout-align="center center">
					<span class="fff-color">Expired</span>
				</div>
			</div>
			<div ng-click="loadMaintanceContracts(0,expires[0].code)" flex="10" class="widget margin-4" style="background-color:#ff5e00;cursor: pointer;" layout="column">
				<div class="card-margin-4" layout-align="center center" layout="row">
					<span class="fff-color">{{m_contracts_cnt.d15}}</span>
				</div>
				<div flex layout="row" layout-align="center center">
					<span class="fff-color">15 days to Expiry</span>
				</div>
			</div>
			<div ng-click="loadMaintanceContracts(0,expires[1].code)" flex="10" class="widget margin-4" style="background-color:#d2d219;cursor: pointer;" layout="column">
				<div class="card-margin-4" layout-align="center center" layout="row">
					<span class="fff-color">{{m_contracts_cnt.d30}}</span>
				</div>
				<div flex layout="row" layout-align="center center">
					<span class="fff-color">1 Month to Expiry</span>
				</div>
			</div>
			<div ng-click="loadMaintanceContracts(0,expires[2].code)" flex="10" class="widget margin-4" style="background-color:#497349;cursor: pointer;" layout="column">
				<div class="card-margin-4" layout-align="center center" layout="row">
					<span class="fff-color">{{m_contracts_cnt.d90}}</span>
				</div>
				<div flex layout="row" layout-align="center center">
					<span class="fff-color">3 Months to Expiry</span>
				</div>
			</div>
			<div ng-click="loadMaintanceContracts(0,expires[3].code)" flex="10" class="widget margin-4" style="background-color:darkgreen;cursor: pointer;" layout="column">
				<div class="card-margin-4" layout-align="center center" layout="row">
					<span class="fff-color">{{m_contracts_cnt.d180}}</span>
				</div>
				<div flex layout="row" layout-align="center center">
					<span class="fff-color">6 Months to Expiry</span>
				</div>
			</div>
		</div>
		<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
			<mdp-date-picker mdp-placeholder="Contract Expiry From" class="md-block" flex-gt-sm flex="15" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="mcontract.fromdate"></mdp-date-picker>
			<div flex="5" hide-xs hide-sm>
				<!-- Space -->
			</div>
			<mdp-date-picker mdp-disabled="mcontract.fromdate==''" mdp-placeholder="Contract Expiry To" class="md-block" flex-gt-sm flex="15"  mdp-max-date="maxDate" mdp-format="DD-MM-YYYY" ng-model="mcontract.todate" mdp-min-date="mcontract.fromdate" ></mdp-date-picker>
			<div flex="5" hide-xs hide-sm>
				<!-- Space -->
			</div>
			<!--<md-input-container class="md-block" flex-gt-sm flex="15"><label>Expiry Within *</label><md-select ng-model="mcontract.expiry_in" name="expiry_in" aria-label="expiry_in"><md-option ng-value="nullValue">                        Select                    </md-option><md-option ng-repeat="expire in expires" ng-value="expire.code">                        {{expire.value}}                    </md-option></md-select></md-input-container>-->
			<!---<md-autocomplete flex="20" class="md-block" flex-gt-sm                             md-no-cache="false"                             md-selected-item="searched.VENDOR"                             md-search-text="searchVname"                             md-items="item in searchTextChange(searchVname,'vendor')"                             md-item-text="item.NAME"                             md-min-length="0"                             md-floating-label="Search Vendor name"><md-item-template><span md-highlight-text="searchText" md-highlight-flags="^i">{{item.NAME}}</span></md-item-template><md-not-found>                    No Vendor Found                </md-not-found></md-autocomplete>---->
			<md-autocomplete class="md-block" flex-gt-sm flex="20"		       
			md-no-cache="true"						
			md-selected-item="searched.ORG_ID1"		
			md-search-text="searchORG_NAME1"				
			md-items="item in searchTextChange(searchORG_NAME1,'vendor1')"		
			md-item-text="item.ORG_NAME1"
			md-search-text-change="searchTextChange(searchORG_NAME1,'vendor1')"
			md-min-length="0"							
			md-floating-label=" Search Vendor name">
				<md-item-template>
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME1}}</span>
				</md-item-template>
				<md-not-found>				
				NO Vendor Found			
				</md-not-found>
			</md-autocomplete>
			<span ng-value="mcontract.vendor1 = searched.ORG_ID1.ORG_ID1" ></span>
			<div flex="5" hide-xs hide-sm>
				<!-- Space -->
			</div>
			<md-autocomplete class="md-block" flex-gt-sm flex="25"      
			md-no-cache="false"                     
			md-selected-item="searched.EID"        
			md-search-text="searchEid"           
			md-items="item in searchTextChange(searchEid)"          
			md-item-text="item.E_ID"                          
			md-min-length="0"                   
			md-floating-label="Search Eq. id">
				<md-item-template>
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.E_ID}}</span>
				</md-item-template>
				<md-not-found>               
				No Equipment Match Found    
				</md-not-found>
			</md-autocomplete>
			<div flex="5" hide-xs hide-sm >
				<!-- Space -->
			</div>
			<md-input-container class="md-block" flex-gt-sm flex="15">
				<label>Contract Type *</label>
				<md-select ng-model="mcontract.contract_type" name="contract_type" aria-label="contract_type">
					<!--<md-option ng-value="nullValue">                        {{allValue}}                    </md-option>--->
					<md-option ng-repeat="contract_type in contract_types" ng-value="contract_type.CTYPE">                        {{contract_type.CTYPE}}                    </md-option>
				</md-select>
			</md-input-container>
			<div flex="1" hide-xs hide-sm flex="15">
				<!-- Space --><!-- ng-if="can_add_contract==yesstate"   ng-if="can_add_contract==yesstate"  ng-if="can_renew_contract==yesstate" --->
			</div>
			<md-button class="md-icon-button md-raised md-primary" ng-click="loadMaintanceContracts()"  md-theme="default" aria-label="submit">
				<ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
			</md-button>
		</div>
		<div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column">
			<div layout="column">
				<md-button ng-if="Add_Contracts='Add'"  ui-sref="home.add_maintain_contracts" class="md-raised md-primary">Add New</md-button>
			</div>
			<div layout="column">
				<md-button  ng-if="Add_Contracts='Add'" ui-sref="home.add_multiple_contracts" class="md-raised md-primary">Add Multiple</md-button>
			</div>
		</div>
		<div layout="row" flex>
			<table class="md-api-table table table-bordered">
				<thead>
					<tr>
						<th style="width: 15%">Eq. ID</th>
						<th style="width: 17%">Eq. Name</th>
						<th style="width: 10%">Serial.No</th>
						<th style="width: 11%">Vendor Name</th>
						<th style="width: 10%">Contract Type</th>
						<th style="width: 8%">Contract From</th>
						<th style="width: 8%">Contract To</th>
						<th style="width: 8%">Status</th>
						<th style="width: 8%">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-if="m_contracts!=null && m_contracts!='undefined'" ng-repeat="m_contract in m_contracts">
						<td>{{m_contract.EID}}</td>
						<td>{{m_contract.eq_name}}</td>
						<td>{{m_contract.serial_no}}</td>
						<td>{{m_contract.VENDOR_NAME}}</td>
						<td>{{m_contract.AMC_TYPE}}</td>
						<td>
							<div ng-if="m_contract.AMC_FROM!=null && m_contract.AMC_FROM!='1970-01-01'">                            {{m_contract.AMC_FROM | date:"dd-MM-yyyy"}}                        </div>
							<div ng-else>-</div>
						</td>
						<td>
							<div ng-if="m_contract.AMC_TO!=null && m_contract.AMC_TO!='1970-01-01'">                            {{m_contract.AMC_TO | date:"dd-MM-yyyy"}}                        </div>
							<div ng-else>-</div>
						</td>
						<td>{{m_contract.status}}</td>
						<td style="text-align: center;">
							<button  ng-disabled="Edit_Contracts!='Edit'" ng-click="editMContracts($event,m_contract)"  class="btn btn-xs btn-default" aria-label="Edit">
								<md-tooltip md-direction="top">Edit</md-tooltip>
								<md-icon class="material-icons-new" style="color: #614da4;">mode_edit</md-icon>
							</button>
							<button ng-disabled="Renew_Contracts!='Renew'" ng-click="editRenuvalType($event,m_contract)" class="btn btn-xs btn-default" aria-label="Edit">
								<md-tooltip md-direction="top">Renewal Type</md-tooltip>
								<md-icon class="material-icons-new" style="color: rgb(68,138,255);">settings_backup_restore</md-icon>
							</button>
						</td>
					</tr>
					<tr ng-if=m_contracts==null || m_contracts==undefined>
						<td colspan="8" class="text-center">No Contracts Found</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div flex layout="row" class="marginb-10"  ng-if="m_contracts!=null">
			<div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
				<md-button class="md-icon-button md-primary md-raised" aria-label="Total">
					<md-tooltip md-direction="top">Total Records</md-tooltip>                    {{no_of_recs}}                
				</md-button>
			</div>
			<div flex="20" hide-xs hide-sm>
				<!-- Space -->
			</div>
			<div flex-xs="100" flex="60" layout="column" layout-align="end end">
				<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadMaintanceContracts(paging.current,mcontract.expiry_in)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
			</div>
		</div>
	</div>
</md-content>