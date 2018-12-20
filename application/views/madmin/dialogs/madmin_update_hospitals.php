<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Update organization</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*) </span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="UpdateHospitalForm" flex="100" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <h5 class="sub_heading-style-respond">Organization Details</h5>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Organization Name</label>
                        <input type="text" required ng-model="update_hospitals.org_name" ng-pattern="/^[a-zA-Z0-9 -]*$/" ng-maxlength="200" name="org_name" aria-label="org_name"/>
                        <div ng-messages="UpdateHospitalForm.org_name.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="UpdateHospitalForm.org_name.$error.maxlength">Your maxlength Exceeds</div>
							<div ng-show="UpdateHospitalForm.org_name.$error.pattern">must and should text or numbers</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Organisation Type *</label>
                        <md-select ng-model="update_hospitals.org_type" name="org_type" required  multiple aria-label="org_type">
                            <md-option ng-repeat="org_typ in org_types" ng-value="org_typ">
                                {{org_typ}}
                            </md-option>
                        </md-select>
						<div ng-messages="UpdateHospitalForm.org_type.$error">
                            <div ng-message="required">Required.</div>
							</div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Organisation Status *</label>
                        <md-select ng-model="update_hospitals.status" name="status" required  aria-label="status">
                            <md-option ng-repeat="user_statue in user_statues" ng-value="user_statue.ID">
                                {{user_statue.VALUE}}
                            </md-option>
                        </md-select>
						<div ng-messages="UpdateHospitalForm.status.$error">
                            <div ng-message="required">Required.</div>
							</div>
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="25"> 
						<label>ORG MODULE *</label>                     
						<md-select ng-model="update_hospitals.org_module" name="org_module" required   aria-label="org_module">  
							<md-option ng-repeat="org_mod in hamodules" ng-value="org_mod.MODULE_ID"> 
							{{org_mod.MODULE_NAME}}     
							</md-option>                       
						</md-select>		
						<div ng-messages="UpdateHospitalForm.org_module.$error">
							<div ng-message="required">Required.</div>							
						</div> 
					</md-input-container>	
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                   			<md-input-container class="md-block" flex-gt-sm flex="25">   
						<label>Organisation CODE *</label>   
						<input type="text" required ng-model="update_hospitals.org_code"  ng-change="update_hospitals.org_code=(update_hospitals.org_code | uppercase)" name="org_code" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" ng-maxlength="2" ng-minlength="2" aria-label="org_code"/>						<div ng-messages="UpdateHospitalForm.org_code.$error">                            
						<div ng-show="UpdateHospitalForm.org_code.$error.minlength">your limit not reached</div>	
						<div ng-show="UpdateHospitalForm.org_code.$error.maxlength">Your  length exceeds</div>	
						<div ng-show="UpdateHospitalForm.org_code.$error.pattern">only text </div>   
						<div ng-message="required">Required.</div>							
						</div>                    
					</md-input-container>			
                </div>

                <div layout="row">
                    <md-input-container  class="md-block" flex-gt-sm flex="30">
                        <label style="color:#000000 !important;">Contract Person</label>
                        <input type="text" ng-required="true" ng-model="update_hospitals.contact_person" ng-maxlength="50" ng-minlength="3" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" name="contact_person" aria-label="contact_person"/>
                    <div ng-messages="UpdateHospitalForm.contact_person.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="UpdateHospitalForm.contact_person.$error.pattern">your input is only text data</div>
							<div ng-show="UpdateHospitalForm.contact_person.$error.maxlength">Your input  maxlength 50 letters</div>
							<div ng-show="UpdateHospitalForm.contact_person.$error.minlength">your input minlength 3 letters </div>
                        </div>
					</md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Contact Number</label>
                        <input type="text"  required   ng-model="update_hospitals.contact_no"   ng-pattern="/^(\d)+$/"  name="contact_no" ng-maxlength="14" ng-minlength="8" aria-label="contact_no"/>
                      <!--<span ng-bind="uMessage" ng-style="{color:uColor}"></span>-->
					 <div ng-messages="UpdateHospitalForm.contact_no.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="UpdateHospitalForm.contact_no.$error.pattern">your input only numbers</div>
							<div ng-show="UpdateHospitalForm.contact_no.$error.maxlength">  maxlength is exceeds</div>
							<div ng-show="UpdateHospitalForm.contact_no.$error.minlength">your input minlength 8 numbers </div>
                        </div>
					</md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Email ID</label>
                        <input type="email" ng-required="true"  ng-model="update_hospitals.email_id" ng-change="checkhospitalemail(update_hospitals.email_id)" ng-maxlength="50" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/"  name="email_id" aria-label="email_id"/>
                    <!--<span ng-bind="EMessage" ng-style="{color:EColor}"></span>--->
					<div ng-messages="UpdateHospitalForm.email_id.$error">                      
					  <div ng-message="required">Required.</div>
					  <div ng-show="UpdateHospitalForm.email_id.$error.pattern">your format is not correct</div>
					 <div ng-show="UpdateHospitalForm.email_id.$error.maxlength">Your input  maxlength 14 numbers</div>
					 
					 </div>
					</md-input-container>

                </div>

                <div layout="row">
                    <md-input-container  class="md-block" flex-gt-sm flex="30">
                        <label style="color:#000000 !important;">No of Branches</label>
                        <input type="text"   ng-model="update_hospitals.no_of_branches" ng-pattern="/^(\d)+$/" ng-maxlength="5"  name="no_of_branches" aria-label="no_of_branches"/>
                      <div ng-messages="UpdateHospitalForm.no_of_branches.$error">                      
					  <div ng-message="required">Required.</div>
					 <div ng-show="UpdateHospitalForm.no_of_branches.$error.pattern">Type only numbers</div>
					 <div ng-show="UpdateHospitalForm.no_of_branches.$error.maxlength">maxlength is exceeds</div>
					  </div>
					</md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>No of Users</label>
                        <input type="text"  ng-model="update_hospitals.no_of_users"  ng-pattern="/^(\d)+$/" ng-maxlength="5"  name="no_of_users" aria-label="no_of_users"/>
                      <div ng-messages="UpdateHospitalForm.no_of_users.$error">                      
					  <div ng-message="required">Required.</div>
					 <div ng-show="UpdateHospitalForm.no_of_users.$error.pattern">Type only numbers</div>
					 <div ng-show="UpdateHospitalForm.no_of_users.$error.maxlength">maxlength is exceeds</div>
					  </div>  
					</md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>No of Equipments</label>
                        <input type="text"  ng-model="update_hospitals.no_of_equipments" ng-pattern="/^(\d)+$/" ng-maxlength="5"   name="no_of_equipments" aria-label="no_of_equipments"/>
                      <div ng-messages="UpdateHospitalForm.no_of_equipments.$error">                      
					  <div ng-message="required">Required.</div>
					 <div ng-show="UpdateHospitalForm.no_of_equipments.$error.pattern">Type only numbers</div>
					  <div ng-show="UpdateHospitalForm.no_of_equipments.$error.maxlength">maxlength is exceeds</div>
					  </div>
					</md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="100">
                        <label>Organisation Address</label>
                        <input type="text"  ng-model="update_hospitals.org_address" name="org_address" ng-maxlength="250" aria-label="org_address"/>
                        <div ng-messages="UpdateHospitalForm.org_address.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="UpdateHospitalForm.org_address.$error.maxlength">maxlength is exceeds</div>
                        </div>
                    </md-input-container>
                </div>
                
                <div layout="row">
				<mdp-date-picker   mdp-placeholder="Date of Expire *"  ng-model="update_hospitals.ex_date" required class="md-block" flex-gt-sm 	flex="20" 		mdp-format="YYYY-MM-DD" mdp-min-date="minDate">
					</mdp-date-picker>
				</div>
				<div>
				<md-checkbox aria-label="Select All" ng-true-value= "'y'" ng-false-value= "'n'"  ng-click="toggleAll2()" 	  ng-model="isAllSelected">
				<span ng-if="isChecked()">Un-</span>Select All
				</md-checkbox>

                <h5 class="sub_heading-style-respond">Features</h5>
                <div layout="row" layout-align="space-around" flex="100">
					<div ng-repeat="feature in existinglist" ng-model="features" flex="25">
                        <label>
                            <input type="checkbox" ng-model="feature.selected" ng-change="clicker2(feature);">
                            {{feature.MMENU_TITLE }}
                                </label>
                                <div  style="padding-left: 20px;width: 200px;height: 400px;overflow-y: auto;" layout="column">
                                    <div ng-repeat="subfeature in feature.subfeatures"  ng-model="feature.subfeatures">
                                        <label>
                                    <input type="checkbox"  ng-model="subfeature.selected"  ng-change="clicker3(subfeature);"  aria-label="Select All">
                                    {{subfeature.SMENU_TITLE}}
                                </label>
                                <div  style="padding-left: 20px;" layout="column">
                                    <div ng-repeat="subsubfeature in subfeature.subsubfeatures" ng-model="subfeature.subsubfeatures" aria-label="Select All">
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
				</div>
				
                <h5 class="sub_heading-style-respond">Other Contact Persons</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="start center">
                    <md-button ng-disabled="UpdateHospitalForm.$invalid" ng-click="addnewOrgContatcPerson($event)" class="md-raised md-primary">Add Contact Person</md-button>
                </div>
                <div flex layout="row" ng-if="!isEmpty(all_ocps)">
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
                                <button ng-click="EditnewOrgContatcPerson($event,all_ocp,$index)"  class="btn btn-xs btn-default" aria-label="Edit">
                                    <md-tooltip md-direction="top">Edit</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                                </button>
                                <button ng-click="removeOCP(all_ocp)"  class="btn btn-xs btn-default" aria-label="Edit">
                                    <md-tooltip md-direction="top">Delete</md-tooltip>
                                    <md-icon class="material-icons-new" style="color:#614DA4">highlight_off</md-icon>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateHospitals(update_hospitals)" ng-disabled="UpdateHospitalForm.$invalid" aria-label="submit">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3" ui-sref="home.mahospitals">Cancel</md-button>

                </div>
            </form>
        </div>
    </div>
</md-content>