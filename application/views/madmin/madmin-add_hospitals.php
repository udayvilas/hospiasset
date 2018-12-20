<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add organization</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addHospitalForm" flex="100" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <h5 class="sub_heading-style-respond">Organization Details</h5>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Organisation Name</label>
                        <input type="text" required ng-model="add_hospitals.org_name" name="org_name" ng-pattern="/^[a-zA-Z0-9 -]*$/" ng-maxlength="200" aria-label="org_name"/>
                        <div ng-messages="addHospitalForm.org_name.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="addHospitalForm.org_name.$error.maxlength">Your maxlength Exceeds</div>
							<div ng-show="addHospitalForm.org_name.$error.pattern">must and should text or numbers</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Organisation Type *</label>
                        <md-select ng-model="add_hospitals.org_type" name="org_type" required  multiple aria-label="org_type">
                            <md-option ng-repeat="org_typ in horg_types" ng-value="org_typ.TYPE">
                                {{org_typ.TYPE}}
                            </md-option>
                        </md-select>
						<div ng-messages="addHospitalForm.org_type.$error">
                            <div ng-message="required">Required.</div>
							</div>
                    </md-input-container>
              		<div flex="10" hide-xs hide-sm><!-- Space --></div>
                       <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Organisation Code</label>
                        <input type="text" required ng-model="add_hospitals.org_code"  ng-change="add_hospitals.org_code=(add_hospitals.org_code | uppercase)" name="org_code" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" ng-maxlength="2" ng-minlength="2" aria-label="org_code"/>
                        <div ng-messages="addHospitalForm.org_code.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="addHospitalForm.org_code.$error.minlength">your limit not reached</div>
							<div ng-show="addHospitalForm.org_code.$error.maxlength">Your  length exceeds</div>
							<div ng-show="addHospitalForm.org_code.$error.pattern">only text </div>
                        </div>
                    </md-input-container>
					<div flex="10" hide-xs hide-sm><!---Space --></div>						
				<md-input-container class="md-block" flex-gt-sm flex="30">    
				<label>Organisation Module *</label>      
				<md-select ng-model="add_hospitals.org_module" name="org_module" required   aria-label="org_type">    
				<md-option ng-repeat="org_mod in hamodules" ng-value="org_mod.MODULE_ID">                   
				{{org_mod.MODULE_NAME}}         
				</md-option> 
				</md-select> 
                 <div ng-messages="addHospitalForm.org_module.$error">
                            <div ng-message="required">Required.</div>
							</div>				
				</md-input-container>      
				</div>               
				<div flex="5" hide-xs hide-sm><!-- Space --></div>
                <div layout="row">
				
                    <md-input-container  class="md-block" flex-gt-sm flex="30">
                        <label style="color:#000000 !important;">Contract Person</label>
                        <input type="text" required ng-model="add_hospitals.contact_person" name="contact_person" ng-maxlength="50" ng-minlength="3" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" aria-label="contact_person"/>
                       <div ng-messages="addHospitalForm.contact_person.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="addHospitalForm.contact_person.$error.pattern">your input is only text data</div>
							<div ng-show="addHospitalForm.contact_person.$error.maxlength">Your input  maxlength 50 letters</div>
							<div ng-show="addHospitalForm.contact_person.$error.minlength">your input minlength 3 letters </div>
                        </div>
					</md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<!-- ng-change="checkhospitalmobile(add_hospitals.contact_no)"-->
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Contact Number</label>
                        <input type="text" required  ng-change="user_check(add_hospitals.contact_no);" ng-model="add_hospitals.contact_no"  ng-pattern="/^(\d)+$/" name="contact_no" ng-maxlength="14" ng-minlength="8" aria-label="contact_no"/>
                        <span ng-bind="uMessage" ng-style="{color:uColor}"></span>              
	 				   <div ng-messages="addHospitalForm.contact_no.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="addHospitalForm.contact_no.$error.pattern">your input only numbers</div>
							<div ng-show="addHospitalForm.contact_no.$error.maxlength">  maxlength is exceeds</div>
							<div ng-show="addHospitalForm.contact_no.$error.minlength">your input minlength 8 numbers </div>
                            
						</div>
					</md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Email ID</label>
                        <input type="email" required ng-model="add_hospitals.email_id" ng-change="checkhospitalemail(add_hospitals.email_id)" name="email_id" ng-maxlength="50" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/"  aria-label="email_id"/>
                       <span ng-bind="EMessage" ng-style="{color:EColor}"></span>
					  <div ng-messages="addHospitalForm.email_id.$error">                      
					  <div ng-message="required">Required.</div>
					  <div ng-show="addHospitalForm.email_id.$error.pattern">your format is not correct</div>
					 <div ng-show="addHospitalForm.email_id.$error.maxlength">Your input  maxlength 14 numbers</div>
					 </div>
				   </md-input-container>
                     </div>
                <div layout="row">
                    <md-input-container  class="md-block" flex-gt-sm flex="30">
                        <label style="color:#000000 !important;">No of Branches</label>
                        <input type="text"   ng-model="add_hospitals.no_of_branches"   ng-pattern="/^(\d)+$/" ng-maxlength="5" name="no_of_branches" aria-label="no_of_branches"/>
                           <div ng-messages="addHospitalForm.no_of_branches.$error">                      
					  <div ng-message="required">Required.</div>
					 <div ng-show="addHospitalForm.no_of_branches.$error.pattern">Type only numbers</div>
					 <div ng-show="addHospitalForm.no_of_branches.$error.maxlength">maxlength is exceeds</div>
					  </div>
					 </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>No of Users</label>
                        <input type="text"  ng-model="add_hospitals.no_of_users"  ng-pattern="/^(\d)+$/" ng-maxlength="5" name="no_of_users" aria-label="no_of_users"/>
                     <div ng-messages="addHospitalForm.no_of_users.$error">                      
					  <div ng-message="required">Required.</div>
					 <div ng-show="addHospitalForm.no_of_users.$error.pattern">Type only numbers</div>
					 <div ng-show="addHospitalForm.no_of_users.$error.maxlength">maxlength is exceeds</div>
					  </div>  
					</md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>No of Equipments</label>
                        <input type="text"  ng-model="add_hospitals.no_of_equipments"  ng-pattern="/^(\d)+$/" ng-maxlength="5" name="no_of_equipments" aria-label="no_of_equipments"/>
                       <div ng-messages="addHospitalForm.no_of_equipments.$error">                      
					  <div ng-message="required">Required.</div>
					 <div ng-show="addHospitalForm.no_of_equipments.$error.pattern">Type only numbers</div>
					  <div ng-show="addHospitalForm.no_of_equipments.$error.maxlength">maxlength is exceeds</div>
					  </div>                   
				   </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Country </label>
                        <md-select ng-model="add_hospitals.country" name="country" ng-change="getStateDetailsByCountryID(add_hospitals.country); getCityDetailsByStateID(add_hospitals.country);add_hospitals.states='';add_hospitals.cities" required aria-label="country">
                            <md-option ng-repeat="country in countries" ng-value="country.COUNTRY_CODE">
                                {{country.COUNTRY_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>State </label>
                        <md-select ng-model="add_hospitals.states" ng-disabled="add_hospitals.country==null"  ng-change="getCityDetailsByStateID(add_hospitals.country,add_hospitals.states);add_hospitals.cities='';" name="states" required   aria-label="states">
                            <md-option ng-repeat="state in country_states" ng-value="state.STATE_CODE">{{state.STATE_NAME}}</md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>City </label>
                        <md-select ng-model="add_hospitals.cities" name="cities" required   aria-label="cities" ng-disabled="add_hospitals.states==null">
                            <md-option ng-repeat="city in state_cities" ng-value="city.CITY_CODE">
                                {{city.CITY_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="100">
                        <label>Organisation Address</label>
                        <input type="text"  ng-model="add_hospitals.org_address" name="org_address" ng-maxlength="250" aria-label="org_address"/>
                        <div ng-messages="addHospitalForm.org_address.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="addHospitalForm.org_address.$error.maxlength">maxlength is exceeds</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <!--<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Expire </label>
                        <input type="text"  required  ng-model="add_hospitals.expire" ng-pattern="/^[1-9]{1,3}$/" name="expire" aria-label="expire"/>
						<div ng-messages="addHospitalForm.expire.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="addHospitalForm.expire.$error.pattern">Your input is invalid</div>
                        </div>
				   </md-input-container>
                    <div flex="5" hide-xs hide-sm></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label> Date*</label>
                        <md-select ng-model="add_hospitals.days" name="days" required  aria-label="days">
                            <md-option ng-repeat="month in months" ng-value="month">
                                {{month}}
                            </md-option>
                        </md-select>
                    </md-input-container> -->
					<mdp-date-picker md-required="true"  mdp-placeholder="Date of Expire *" name="" required class="md-block" flex-gt-sm 	flex="20" 		mdp-format="YYYY-MM-DD" mdp-min-date="minDate" ng-model="add_hospitals.expire">
					</mdp-date-picker>					
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div class="md-block" flex-gt-sm flex="10">
                        <label>Logo*</label> <input type="file" filename-model="aoorg_logo_name"   /><!--<input type="file" img-upload ng-model="aoorg_logo_name" name="aoorg_logo_name" >--->
                     				<ul style="margin-top: 15px;">                
				<li ng-repeat="aoorg_logo_nam in aoorg_logo_name">{{aoorg_logo_nam.name}}</li>              
				</ul>             
                    </div>
                   <!-- <img ng-show="aoorg_logo_name" src="{{aoorg_logo}}" width="25" height="25">-->
					<div flex="5" hide-xs hide-sm></div>
					<md-checkbox aria-label="Select All" ng-true-value= "'y'" ng-false-value= "'n'"  ng-click="orgtoggleAll()" ng-model="isAllSelected">
								<span ng-if="isChecked()">Un-</span>Select All
				</md-checkbox>
                </div>
				<div class="justify-content-end">
				
				</div>
                <div layout="row" layout-align="space-around" flex="100">
						
					<div ng-repeat="feature in addfeatures"  ng-model="features" flex="25">
							<label>
								<input type="checkbox" ng-model="feature.selected" ng-change="orgclicker(feature);"  aria-label="Select All">
								{{feature.MMENU_TITLE}}
							</label>
                        <div  style="padding-left: 20px;width: 200px;height: 400px;overflow-y: auto;" layout="column" >
                            <div ng-if="subfeature.MMENU_ID==feature.MMENU_ID" ng-repeat="subfeature in feature.subfeatures" ng-model="feature.subfeatures" >
							<label>
								<input type="checkbox" ng-model="subfeature.selected" ng-change="orgclicker1(subfeature);" aria-label="Select All">
								{{subfeature.SMENU_TITLE}}
							</label>
                                <div   style="padding-left: 20px;" layout="column">
                                    <div ng-repeat="subsubfeature in subfeature.subsubfeatures"  ng-model="subfeature.subsubfeatures" aria-label="Select All">
                                       
										<label>
											<input type="checkbox" ng-model="subsubfeature.selected">
											{{subsubfeature.name}}
										</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="sub_heading-style-respond">Other Contact Persons</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
                    <md-button ng-click="addnewOrgContatcPerson($event)" class="md-raised md-primary">Add Contact Person</md-button>
                </div>
                <div flex layout="row">
                    <table class="md-api-table table table-bordered" ng-cloak style="width:100%;margin-bottom: 5px;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile No.</th>
                            <th>Email ID</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody ng-if="!isEmpty(all_ocps)">
                        <tr ng-repeat="all_ocp in all_ocps track by $index">
                            <td>{{all_ocp.contact_person}}</td>
                            <td>{{all_ocp.contact_person_no}}</td>
                            <td>{{all_ocp.cpemail}}</td>
                            <td style="text-align: center;">
                                <button ng-click="removeOCP(all_ocp)"  class="btn btn-xs btn-default" aria-label="Edit">
                                    <md-tooltip md-direction="top">Delete</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#614DA4">highlight_off</md-icon>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                        <tbody ng-else>
                        <tr>
                            <td colspan="4" style="text-align: center;">Click on Add Contact Person BUTTON to Add</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="addHospitals(add_hospitals)" ng-disabled="addHospitalForm.$invalid || uMessage || EMessage " aria-label="submit">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3" ui-sref="home.mahospitals">Cancel</md-button>

                </div>
            </form>
        </div>
    </div>
</md-content>