<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="inputs" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Vendor</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center" >
            <form method="POST" name="addVendorForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
             <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Country </label>
                        <md-select ng-model="add_vendor.country" name="country" ng-change="getStateDetailsByCountryID(add_vendor.country); getCityDetailsByStateID(add_vendor.country);add_vendor.states=''" required aria-label="country">
                            <md-option ng-repeat="country in countries" ng-value="country.COUNTRY_CODE">
                                {{country.COUNTRY_NAME}}
                            </md-option>
                        </md-select>
						<div ng-messages="addVendorForm.country.$error">
						<div ng-message="required">Required.</div>
					     
						</div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>State *</label>
                        <md-select ng-model="add_vendor.states" ng-disabled="add_vendor.country==null"  ng-change="getCityDetailsByStateID(add_vendor.country,add_vendor.states);add_vendor.cities=''" "name="states" required   aria-label="states">
                            <md-option ng-repeat="state in country_states" ng-value="state.STATE_CODE">{{state.STATE_NAME}}</md-option>
                        </md-select>
						<div ng-messages="addVendorForm.states.$error">
						<div ng-message="required">Required.</div>
					     
						</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>City </label>
                        <md-select ng-model="add_vendor.cities" name="cities" required   aria-label="cities" ng-disabled="add_vendor.states==null">
                            <md-option ng-repeat="city in state_cities" ng-value="city.CITY_CODE">
                                {{city.CITY_NAME}}
                            </md-option>
                        </md-select>
						<div ng-messages="addVendorForm.cities.$error">
						<div ng-message="required">Required.</div>
					     
						</div>
                    </md-input-container>
                </div>         

			   <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Select Branch *</label>
                        <!--<md-select md-on-close="clearSearchTerm()"  required data-md-container-class="selectdemoSelectHeader" name="branchid" required multiple ng-model="add_vendor.branchid" aria-label="branchid">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Branch"  class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="branches">
                                <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs |
              filter:searchTerm">{{branch.BRANCH_NAME}}</md-option>
                            </md-optgroup>
                        </md-select>-->
						<md-select ng-model="add_vendor.branchid" aria-label="user_branch" multiple>
                        <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs" ng-if="branch.BRANCH_ID !='All'">
                            {{branch.BRANCH_NAME}}
                        </md-option>
                    </md-select>
						<div ng-messages="addVendorForm.branchid.$error">
						<div ng-message="required">Required.</div>
						</div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Name</label>
                        <input type="text" required ng-model="add_vendor.vendor_name" md-maxlength="200" name="vendor_name" aria-label="vendor_name"/>
                    <div ng-messages="addVendorForm.vendor_name.$error">
						<div ng-message="required">Required.</div>
						<div ng-message="md-maxlength">Max limit is reached.</div>
						</div>
					</md-input-container>
                  
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Vendor Type *</label>
                        <md-select required ng-model="add_vendor.type" name="type" aria-label="type" multiple>
                            <md-option ng-value="vdr_type.NAME" ng-repeat="vdr_type in vdr_types">{{vdr_type.NAME}}</md-option>
                        </md-select>
						<div ng-messages="addVendorForm.vendor_name.$error">
						<div ng-message="required">Required.</div>
					
						</div>
                    </md-input-container>
                </div>


                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Contact Number</label>
                        <input only-digits="only-digits"  md-maxlength="14" ng-minlength="8" required type="text" ng-change="checktheVendorexists(add_vendor.mbl_no)" ng-model="add_vendor.mbl_no" name="mbl_no" aria-label="mbl_no"/>
                        <span ng-show="vendorexists" class="mandatory-fileds" >Vendor Already Exists</span>
                       <div ng-messages="addVendorForm.mbl_no.$error">
					   <div ng-message="required">Required.</div>
					    
						 <div ng-message="md-maxlength">Max limit is reached.</div>
						  <div ng-message="minlength">Min limit is 8.</div>
						</div>
					</md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Email</label>
                        <input type="email"  ng-model="add_vendor.email" required md-maxlength="50" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" name="email" aria-label="email"/>
				<div ng-messages="addVendorForm.email.$error">
						<div ng-message="required">Required.</div>
					     <div ng-message="pattern">Please Provide Email Format</div>
						 <div ng-message="md-maxlength">Max limit is reached.</div>
						</div>
				</md-input-container>
				
                </div>
                  <!-- <div flex layout="row">
                    <md-input-container class="md-block" flex="100">
                        <label>Vendor Address</label>
                        <textarea ng-model="add_vendor.address" name="address" rows="5" md-select-on-focus></textarea>
                    </md-input-container>
                </div>--->
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="start center">
                    <md-button ng-disabled="addVendorForm.$invalid" ng-click="addnewContatcPerson($event)" class="md-raised md-primary">Add Contact Person</md-button>
                </div>
                <div flex layout="row" ng-if="!isEmpty(all_cps)">
                <table class="md-api-table table table-bordered" ng-cloak style="width:100%;margin-bottom: 5px;">
                    <thead>
                    <tr>
                        <th>Priority</th>
                        <th>Name</th>
                        <th>Mobile No.</th>
                        <th>Email ID</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody ng-if="!isEmpty(all_cps)">
                    <tr ng-repeat="all_cp in all_cps track by $index">
                        <td>{{all_cp.priority}}</td>
                        <td>{{all_cp.contact_person}}</td>
                        <td>{{all_cp.contact_person_no}}</td>
                        <td>{{all_cp.cpemail}}</td>
                        <td>{{all_cp.contact_person_address}}</td>
                        <td style="text-align: center;">
                            <button ng-click="removeCP(all_cp)"  class="btn btn-xs btn-default" aria-label="Edit">
                                <md-tooltip md-direction="top">Delete</md-tooltip>
                                <md-icon class="material-icons-new" style="color:#614DA4">highlight_off</md-icon>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>

                <!--<div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Contact Person</label>
                        <input type="text"  ng-model="add_vendor.contact_person" name="contact_person" aria-label="contact_person"/>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --/></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Contact Person Number</label>
                        <input only-digits="only-digits" type="text"  ng-model="add_vendor.contact_person_no" name="contact_person_no" aria-label="contact_person_no"/>
                    </md-input-container>
                </div>

                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Contact Person Email</label>
                        <input type="email"  ng-model="add_vendor.cpemail" name="cpemail" aria-label="cpemail"/>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --/></div>
                    <md-input-container class="md-block" flex="45">
                        <label>Contact Person Address</label>
                        <textarea ng-model="add_vendor.contact_person_address" name="cpaddress" rows="5" md-select-on-focus></textarea>
                    </md-input-container>
                </div>-->
             <!--   <div flex layout="row">

                <md-input-container class="md-block" flex="100">
                        <label>Address</label>
                        <input type="text" ng-model="add_vendor.address"  aria-label="address">
                        <div ng-messages="addVendorForm.address.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <span flex class="mandatory-fileds">Add Devices to Vendor</span>
                </div>-->
                <!-- <div flex layout="row">
                     <md-input-container class="md-block" flex-gt-sm flex="25">
                         <label>Equipment Types</label>
                         <md-select ng-model="add_vendor.vdevice_type" name="vdevice_type">
                             <md-option ng-repeat="cg_equp_type in cg_equp_types" ng-value="cg_equp_type.CODE">
                                 {{cg_equp_type.TYPE}}
                             </md-option>
                         </md-select>
                     </md-input-container>
                     <div flex="5" hide-xs hide-sm><!-- Space --/></div>
                     <md-input-container class="md-block" flex-gt-sm flex="25">
                         <label>Equipment Names</label>
                         <md-select ng-disabled="add_vendor.vdevice_type==null" md-on-open="GetDeviceNames(add_vendor.vdevice_type)" ng-model="add_vendor.vdevice_name" name="vdevice_type">
                             <md-option ng-repeat="equp_name in equp_names" ng-value="equp_name.ID">
                                 {{equp_name.NAME}}
                             </md-option>
                         </md-select>
                     </md-input-container>
                     <div flex="5" hide-xs hide-sm><!-- Space --/></div>
                     <md-input-container class="md-block" flex-gt-sm flex="25">
                         <label>Contract Types</label>
                         <md-select ng-disabled="add_vendor.vdevice_name==null" ng-model="add_vendor.vdevice_ctype" name="vdevice_type">
                             <md-option ng-repeat="contract_type in contract_types" ng-value="contract_type.CFORM">
                                 {{contract_type.CTYPE}}
                             </md-option>
                         </md-select>
                     </md-input-container>
                     <div flex="5" hide-xs hide-sm><!-- Space --/></div>
                     <md-button ng-disabled="add_vendor.vdevice_ctype==null" class="md-icon-button md-raised md-accent" ng-click="addVednorEquipments(add_vendor)"  md-theme="default" aria-label="add" style="margin-top:15px;">
                         <md-tooltip md-direction="top">Add</md-tooltip>
                         <ng-md-icon icon="playlist_add" style="fill:#fff" size="24"></ng-md-icon>
                     </md-button>
                 </div>
                 <div flex layout="row" layout-align="center center">
                     <table class="md-api-table table table-bordered">
                         <thead>
                         <tr>
                             <th>Equipment Type ID</th>
                             <th>Equipment Name ID</th>
                             <th>Equipment Type ID</th>
                             <th>Remove</th>
                         </tr>
                         </thead>
                         <tbody>
                         <tr ng-repeat="add_vendor_device in add_vendor.devices  track by $index">
                             <td>{{add_vendor_device.etype}}</td>
                             <td>{{add_vendor_device.ename}}</td>
                             <td>{{add_vendor_device.ectype}}</td>
                             <td><md-button class="md-icon-button my-md-icon-button md-accent" ng-click="removeVednorEquipment(add_vendor_device)" md-theme="default" aria-label="remove">
                                     <md-tooltip md-direction="top">Remove</md-tooltip>
                                     <ng-md-icon icon="remove_circle" size="24"></ng-md-icon>
                                 </md-button></td>
                         </tr>
                     </table>
                 </div>-->
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addVendor(add_vendor)" ng-disabled="addVendorForm.$invalid" aria-label="submit">Submit</md-button>
                          <md-button class="md-raised md-accent" ng-click="switchState('home.hbhod_vendors')" aria-label="cancel">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>