<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="inputs" layout-wrap>
    <div layout="column">
        <h3 class="heading-stylerespond">Edit Equipment</h3>
    <div class="md-whiteframe-2dp mylayout-padding" style="border-radius:5px;">
    <form name="editDevice" method="POST">
        <h5 flex class="sub_heading-style-respond">Equipment Basic Details</h5>
	<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
        <!--<md-input-container ng-if="user_general_asset==yesstate" class="md-block" flex-gt-sm flex="20">
            <label>General Equipment</label>
            <md-select ng-change="generalEqupChange(edit_device.general_asset)" ng-required="user_general_asset==yesstate" ng-model="edit_device.general_asset" name="cat" aria-label="cat">
                <md-option ng-repeat="general_asset in cnf_general_asset" ng-value="general_asset">{{general_asset}}</md-option>
            </md-select>
        </md-input-container>
        <div ng-if="user_general_asset==yesstate" flex="5" hide-xs hide-sm></div>-->
        <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Equipment ID</label>
            <input type="text" ng-model="edit_device.E_ID" name="E_ID" aria-label="E_ID" ng-readonly="true" ng-disabled="true"/>
            <input type="hidden" ng-model="edit_device.ID" name="ID" aria-label="ID">
        </md-input-container>
        <div flex="5" hide-xs hide-sm><!-- Space --></div>
        <!--<md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Department</label>
            <md-select required ng-model="edit_device.dept_id"  name="dept_id">
                <md-option ng-repeat="dept in depts" ng-value="dept.CODE">
                    {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                </md-option>
            </md-select>
        </md-input-container>-->
		<md-autocomplete flex="20" class="md-block" flex-gt-sm
						 ng-init="searched.CODE = (edit_device.dept_id != null) ? {'CODE': edit_device.dept_id,'USER_DEPT_NAME':edit_device.DEPT_NAME} : null"
						 md-no-cache="false"
						 md-input-name="department"
						 required
                         md-selected-item="searched.CODE"
                         md-search-text="edit_device.searchDepartment"
                         md-items="item in searchTextChange(edit_device.searchDepartment,'Department')"
                         md-item-text="item.USER_DEPT_NAME"
                         md-search-text-change="edit_device.dept_id = ''"
                         md-selected-item-change="edit_device.dept_id = item.CODE"
                         md-min-length="0"
                         md-floating-label="Search Department">
            <md-item-template>
                <span md-highlight-text="searchDepartment" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
            </md-item-template>
			<div ng-messages="editDevice.department.$error" ng-if="editDevice.department.$touched">
					<div ng-message="required">Required</div>
			</div>
            <md-not-found>
                No Department Found
            </md-not-found>
        </md-autocomplete>

    <!--</div>
	<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>-->
        <div flex="5" hide-xs hide-sm><!-- Space --></div>
		<md-input-container class="md-block" flex-gt-sm flex="20">
      <label>Equipment Name</label>
        <input type="text" required ng-model="edit_device.E_NAME" name="E_NAME" aria-label="E_NAME"/>
		<div ng-messages="editDevice.E_NAME.$error">
		<div ng-message="required">Required</div>
			</div>
      </md-input-container>

    <div flex="5" hide-xs hide-sm><!-- Space --></div>

    <!--<md-input-container class="md-block" flex-gt-sm flex="20">
        <label>Equipment Category</label>
        <md-select required ng-model="edit_device.E_CAT" name="E_CAT" aria-label="E_CAT">
            <md-option ng-repeat="equp_cat in equp_cats" ng-value="equp_cat.ID">{{equp_cat.NAME}}</md-option>
        </md-select>
    </md-input-container>-->
	<md-autocomplete flex="20" class="md-block" flex-gt-sm
						 required
						 md-input-name="equipmentcat"
                         md-no-cache="false"
						 ng-value="edit_device.E_CAT=searched.DID"
						 ng-init="searched.DID = {'DID':edit_device.C_NAME,'NAME1':edit_device.category}"
                         md-selected-item="searched.DID"
                         md-search-text="searchEcategory"
                         md-items="item in searchTextChange(searchEcategory,'Ecategory')"
                         md-item-text="edit_device.E_CAT = item.NAME1"
                         md-min-length="0"
                         md-floating-label="Search Equipment Category">
            <md-item-template>
                <span md-highlight-text="searchEcategory" md-highlight-flags="^i">{{item.NAME1}}</span>
            </md-item-template>
			<div ng-messages="editDevice.equipmentcat.$error" ng-if="editDevice.equipmentcat.$touched">
					<div ng-message="required">Required</div>
			</div>
            <md-not-found>
                No Equipment Category Found
            </md-not-found>
        </md-autocomplete>
		<span ng-value="edit_device.E_CAT = searched.DID.DID" ng-model="edit_device.E_CAT = searched.DID.DID"></span>

    <div flex="5" hide-xs hide-sm></div>

	<!--<md-input-container class="md-block" flex-gt-sm flex="20">
    <label>Company Name (OEM)</label>
    <md-select required ng-model="edit_device.C_NAME" name="C_NAME" aria-label="C_NAME">
        <md-option ng-repeat="oem in oems" ng-value="oem.ID">{{oem.NAME}}</md-option>
    </md-select>
    </md-input-container>-->
	 <md-autocomplete flex="20" class="md-block" flex-gt-sm
						 required
						 md-input-name="companyname"
                         md-no-cache="false"
						 ng-value="edit_device.C_NAME = searched.ID2"
						 ng-init="searched.ID2 = {'ID2': edit_device.C_NAME,'NAME':edit_device.cpname}"
                         md-selected-item="searched.ID2"
                         md-search-text="searchCompanyName"
                         md-items="item in searchTextChange(searchCompanyName,'Companyname')"
                         md-item-text="edit_device.C_NAME = item.NAME"
                         md-min-length="0"
                         md-floating-label="Search Company Name">
            <md-item-template>
                <span md-highlight-text="searchCompanyName" md-highlight-flags="^i">{{item.NAME}}</span>
            </md-item-template>
			<div ng-messages="editDevice.companyname.$error" ng-if="editDevice.companyname.$touched">
					<div ng-message="required">Required</div>
			</div>
            <md-not-found>
                No Company Found
            </md-not-found>
        </md-autocomplete>
		<span ng-value="edit_device.C_NAME = searched.ID2.ID2" ng-model="edit_device.C_NAME = searched.ID2.ID2"></span>

	<div flex="5" hide-xs hide-sm><!-- Space --></div>
	<md-input-container class="md-block" flex-gt-sm flex="20">
		<label>Equipment Model</label>
      <input type="text" required ng-model="edit_device.E_MODEL" name="E_MODEL" aria-label="E_MODEL"/>
	  <div ng-messages="editDevice.E_MODEL.$error">
			<div ng-message="required">Required</div>
	  </div>
    </md-input-container>
        <div flex="5" hide-xs hide-sm><!-- Space --></div>
	<!--</div>

	<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
    <md-input-container class="md-block" flex-gt-sm flex="20">
    <label>Serial Number</label>
      <input type="text" required ng-model="edit_device.ES_NUMBER" ng-change="check_serial_no(add_device.serial_number)" name="ES_NUMBER" aria-label="ES_NUMBER"/>
	  <span ng-bind="DMessage" ng-style="{color:DColor}"></span>
	  <div ng-messages="editDevice.ES_NUMBER.$error">
		<div ng-message="required">Required</div>
	  </div>
    </md-input-container>

	<div flex="5" hide-xs hide-sm><!-- Space --></div>

	<md-input-container class="md-block" flex-gt-sm flex="20">
    <label>Equipment Cost</label>
      <input  type="text" required  ng-pattern="/^(\d)+$/" ng-maxlength="5" ng-minlength="1" ng-model="edit_device.E_COST" name="E_COST" aria-label="E_COST"/>
	  <div ng-messages="editDevice.E_COST.$error">
			<div ng-message="required">Required.</div>
			<div ng-show="editDevice.E_COST.$error.pattern">your input only numbers</div>
			<div ng-show="editDevice.E_COST.$error.maxlength">Maxlength is exceeds</div>
			<!--<div ng-show="editDevice.E_COST.$error.minlength">Please enter atleast 1 number</div>--->
        </div>
    </md-input-container>

    <div flex="5" hide-xs hide-sm><!-- Space --></div>

    <md-input-container class="md-block"  flex-gt-sm flex="20">
        <label>Present Condition *</label>
        <md-select ng-model="edit_device.E_COND" name="E_COND" required aria-label="E_COND">
            <md-option ng-repeat="equp_cond in equp_conds" ng-value="equp_cond.EVAL">{{equp_cond.ECODE}}</md-option>
        </md-select>
		<div ng-messages="editDevice.E_COND.$error">
            <div ng-message="required">Required.</div>
        </div>
    </md-input-container>

    <div flex="5" hide-xs hide-sm><!-- Space --></div>

    <md-input-container class="md-block"  flex-gt-sm flex="20">
        <label>Utilization *</label>
        <md-select ng-model="edit_device.UTILIZATION" name="UTILIZATION" required aria-label="UTILIZATION">
            <md-option ng-repeat="util_value in util_values" ng-value="util_value.VALUE">
                {{util_value.NAME}}
            </md-option>
        </md-select>
		<div ng-messages="editDevice.UTILIZATION.$error">
            <div ng-message="required">Required.</div>
        </div>
    </md-input-container>

	<!--</div>
<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
        <div flex="5" hide-xs hide-sm><!-- Space --></div>
    <md-input-container class="md-block"  flex-gt-sm flex="20">
        <label>Equipment Class</label>
        <md-select ng-model="edit_device.EQ_CLASS" name="EQ_CLASS" required aria-label="EQ_CLASS">
            <md-option ng-repeat="equpclass in equpclasses" ng-value="equpclass">
                {{equpclass}}
            </md-option>
        </md-select>
		<div ng-messages="editDevice.EQ_CLASS.$error">
            <div ng-message="required">Required.</div>
        </div>
    </md-input-container>

    <div flex="5" hide-xs hide-sm><!-- Space --></div>

	<md-input-container class="md-block" flex-gt-sm flex="20">
    <label>Status *</label>
     <md-select ng-model="edit_device.EQ_CONDATION" name="EQ_CONDATION" required aria-label="EQ_CONDATION">
          <md-option ng-repeat="estate in estatuss" ng-value="estate.estatus">
            {{estate.estatus}}
          </md-option>
     </md-select>
	 <div ng-messages="editDevice.EQ_CONDATION.$error">
            <div ng-message="required">Required.</div>
        </div>
    </md-input-container>

    <div flex="5" hide-xs hide-sm><!-- Space --></div>
        <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Accessories</label>
            <input type="text" required ng-model="edit_device.ACCSSORIES" name="ACCSSORIES" aria-label="ACCSSORIES"/>
          <div ng-messages="editDevice.ACCSSORIES.$error">
                          
						
							<!--<div ng-show="AddDevice.critical_spares.$error.minlength">Please enter atleast 1 number</div>--->
                </div>       
	   </md-input-container>
    <div flex="5" hide-xs hide-sm><!-- Space --></div>

    <md-input-container class="md-block" flex-gt-sm flex="20">
        <label>Critical Spares</label>
        <input type="text"  ng-model="edit_device.CRITICAL_SPARES"  name="CRITICAL_SPARES" aria-label="CRITICAL_SPARES"/>
       <div ng-messages="editDevice.critical_spares.$error">
                            
							<!--<div ng-show="AddDevice.critical_spares.$error.minlength">Please enter atleast 1 number</div>--->
                </div>
	</md-input-container>
    <!--</div>

    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
        <div flex="5" hide-xs hide-sm><!-- Space --></div>
        <!--<md-input-container flex="20">
            <label>Equipment Type</label>
            <md-select required ng-model="edit_device.E_TYPE" name="E_TYPE">
                <md-option ng-repeat="cg_equp_type in cg_equp_types" ng-value="cg_equp_type.CODE">
                    {{cg_equp_type.TYPE}}
                </md-option>
            </md-select>
        </md-input-container>-->
		<md-autocomplete flex="20" class="md-block" flex-gt-sm
						required
						md-input-name="equipmenttype"
                        ng-value="edit_device.E_TYPE = searched.CODE2"  
						ng-init="searched.CODE2 = {'CODE2': edit_device.E_TYPE,'TYPE':edit_device.equp_type}"
						md-no-cache="false"
                        md-selected-item="searched.CODE2"
                        md-search-text="searchEquipmentType"
                        md-items="item in searchTextChange(searchEquipmentType,'EType')"
                        md-item-text="edit_device.E_TYPE = item.TYPE"
                        md-min-length="0"
                        md-clear-button="true"
                        md-floating-label="Search Equipment Type">
            <md-item-template>
                <span md-highlight-text="searchEquipmentType"  md-highlight-flags="^i">{{item.TYPE}}</span>
            </md-item-template>
			<div ng-messages="editDevice.equipmenttype.$error" ng-if="editDevice.equipmenttype.$touched">
					<div ng-message="required">Required</div>
			</div>
            <md-not-found>
                No Matches Found
            </md-not-found>
        </md-autocomplete>
		<span ng-value="edit_device.E_TYPE = searched.CODE2.CODE2" ng-model="edit_device.E_TYPE = searched.CODE2.CODE2"></span>

        <div flex="5" hide-xs hide-sm><!-- Space --></div>

        <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Physical Location</label>
            <input type="text" ng-model="edit_device.PHY_LOCATION" name="PHY_LOCATION" aria-label="PHY_LOCATION"/>
        </md-input-container>
        <div flex="5" hide-xs hide-sm><!-- Space --></div>
        <!--<md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Distributor *</label>
            <md-select ng-model="edit_device.DISTRIBUTOR" name="DISTRIBUTOR" required aria-label="DISTRIBUTOR">
               			  
				<md-optgroup label="{{data.category}}" ng-repeat="data in sprt_vendrs">
                    <md-option ng-repeat="sprt_vendr in data.list | filter:searchTerm" ng-value="sprt_vendr.ID">
                        {{sprt_vendr.NAME}}
                    </md-option>
                </md-optgroup> 
            </md-select>
        </md-input-container>-->
		<md-autocomplete class="md-block" flex-gt-sm flex="20"
							 md-input-name="distributor"
							 required
		                     ng-value="edit_device.DISTRIBUTOR=searched.ORG_ID1"
							 ng-init="searched.ORG_ID1 = {'ORG_ID1': edit_device.DISTRIBUTOR,'ORG_NAME1':edit_device.distributor}"
							 md-no-cache="false"
							 md-selected-item="searched.ORG_ID1"
							 md-search-text="searchORG_NAME1"
							 md-items="item in searchTextChange(searchORG_NAME1,'Distributor')"
							 md-item-text="edit_device.DISTRIBUTOR = item.ORG_NAME1"
							 md-min-length="0"
							 md-floating-label="Search Distributors">
				<md-item-template>
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME1}}</span>
				</md-item-template>
				<div ng-messages="editDevice.distributor.$error" ng-if="editDevice.distributor.$touched">
					<div ng-message="required">Required</div>
				</div>
				<md-not-found>
				   NO Distributor Found
				</md-not-found>
			</md-autocomplete>
			 <span ng-value="edit_device.DISTRIBUTOR = searched.ORG_ID1.ORG_ID1"
                          ng-model="edit_device.DISTRIBUTOR = searched.ORG_ID1.ORG_ID1"></span>
        <!--<div flex="5" hide-xs hide-sm></div>
        <md-input-container class="md-block" flex-gt-sm flex="20">
            <label>Hospital Asset Code</label>
            <input type="text" ng-model="edit_device.HOSPITAL_ASSET_CODE" name="HOSPITAL_ASSET_CODE" aria-label="HOSPITAL_ASSET_CODE"/>
        </md-input-container>-->
    <!--</div>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
        <div flex="5" hide-xs hide-sm><!-- Space --></div>
            <mdp-date-picker mdp-placeholder="Date of Install *" name="DATEOF_INSTALL" required mdp-max-date="maxDate" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="edit_device.DATEOF_INSTALL">
            </mdp-date-picker>
            <div flex="5" hide-xs hide-sm><!-- Space --></div>
            <!--<md-input-container class="md-block" flex-gt-sm flex="20">
                <label>Manufacture Date(MM-YYYY)</label>
                <input type="text" ng-pattern="/^([0-9]{2})-([0-9]{4})$/" ng-model="edit_device.MF_DATE" name="MF_DATE" aria-label="MF_DATE"/>
                <div ng-messages="editDevice.MF_DATE.$error">
                    <div ng-message="pattern">Valid Format(MM-YYYY)</div>
                </div>
            </md-input-container>--->
		<!--<mdp-date-picker  mdp-placeholder="Manufacture Date"  mdp-disabled="edit_device.DATEOF_INSTALL==null" ng-model="edit_device.MF_DATE"   name="manufature_date" required class="md-block" flex-gt-sm flex="20"   mdp-max-date="edit_device.DATEOF_INSTALL"></mdp-date-picker>-->
			<md-input-container class="md-block" flex-gt-sm flex="20">
                <label>Manufacture Date(MM-YYYY)</label>
                <input type="text"  ng-pattern="/^([0-9]{2})-([0-9]{4})$/" required ng-model="edit_device.MF_DATE" name="MF_DATE" aria-label="MF_DATE"/>
                <div ng-messages="editDevice.MF_DATE.$error">
                    <div ng-message="pattern">Valid Format(MM-YYYY)</div>
					<div ng-message="required">Required.</div>
                </div>
            </md-input-container>
            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <md-input-container class="md-block" flex-gt-sm flex="20">
                <label>End of Life(MM-YYYY)</label>
                <input type="text" ng-disabled="true" ng-model="edit_device.END_OF_LIFE" name="END_OF_LIFE" aria-label="END_OF_LIFE"/>
                <div ng-messages="editDevice.END_OF_LIFE.$error">
                    <div ng-message="pattern">Valid Format(MM-YYYY)</div>
                </div>
            </md-input-container>

            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <md-input-container class="md-block" flex-gt-sm flex="20">
                <label>End of Support(MM-YYYY)</label>
                <input type="text" ng-disabled="true" ng-model="edit_device.END_OF_SUPPORT" name="END_OF_SUPPORT" aria-label="END_OF_SUPPORT"/>
                <div ng-messages="editDevice.END_OF_SUPPORT.$error">
                    <div ng-message="pattern">Valid Format(MM-YYYY)</div>
                </div>
            </md-input-container>
    <!--</div>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
        <div flex="5" hide-xs hide-sm><!-- Space --></div>
        <md-input-container class="md-block"  flex-gt-sm flex="20">
            <label>Remarks</label>
            <textarea rows="5" ng-model="edit_device.REMARKS" name="REMARKS" aria-label="REMARKS" md-select-on-focus></textarea>
        </md-input-container>

        <div flex="5" hide-xs hide-sm><!-- Space --></div>

        <md-input-container class="md-block"  flex-gt-sm flex="20">
            <label>Description</label>
            <textarea rows="5" ng-model="edit_device.DESC_P" name="DESC_P" aria-label="DESC_P" md-select-on-focus></textarea>
        </md-input-container>
    </div>


        <h5 class="sub_heading-style-respond">AMC/CMC/Warranty Information:</h5>
        <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
            <md-input-container class="md-block" flex-gt-sm flex="20">
                <label>Contract Type *</label>
                <md-select ng-model="edit_device.AMC_TYPE" name="contract_type" required aria-label="contract_type">
                    <md-option ng-repeat="contract_type in contract_types" ng-value="contract_type.CTYPE">
                        {{contract_type.CTYPE}}
                    </md-option>
                </md-select>
            </md-input-container>

            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <md-input-container ng-if="edit_device.AMC_TYPE!='Biomedical'" class="md-block"  flex-gt-sm flex="20">
                <label>Contract Value</label>
                <input  only-digits="only-digits" type="text" ng-required="edit_device.AMC_TYPE=='Biomedical" ng-maxlength="5" ng-minlength="1" ng-model="edit_device.AMC_VALUE" name="AMC_VALUE" aria-label="contract_value"/>
				<div ng-messages="editDevice.AMC_VALUE.$error">
				<div ng-message="required">Required.</div>
					<div ng-show="editDevice.AMC_VALUE.$error.pattern">your input only numbers</div>
					<div ng-show="editDevice.AMC_VALUE.$error.maxlength">Please enter below  5 numbers</div>
					<div ng-show="editDevice.AMC_VALUE.$error.minlength">Please enter atleast 1 number</div>
			    </div>
            </md-input-container>

            <div flex="5" hide-xs hide-sm ><!-- Space --></div>

            <mdp-date-picker ng-if="edit_device.AMC_TYPE!='Biomedical'" mdp-placeholder="Contract From *" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" mdp-max-date="MaxDate" ng-model="edit_device.AMC_FROM" >
            </mdp-date-picker>

            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <mdp-date-picker ng-if="edit_device.AMC_TYPE!='Biomedical'" mdp-placeholder="Contract To *" class="md-block" flex-gt-sm mdp-format="DD-MM-YYYY" ng-model="edit_device.AMC_TO"  mdp-max-date="maxDate" mdp-disabled="edit_device.AMC_FROM==null" mdp-min-date="edit_device.AMC_FROM">
            </mdp-date-picker>
        </div>
        <div ng-if="edit_device.AMC_TYPE!='Biomedical'" layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
            <!--<md-input-container class="md-block" flex-gt-sm flex="20">
                <label style="color: #000000 !important;">Contract Vendor *</label>
                <md-select  ng-model="edit_device.VENDOR" ng-change="getContractVendorDetails(edit_device.VENDOR)" name="vendor" ng-required="edit_device.AMC_TYPE=='Biomedical" aria-label="vendor">
                    

               <md-optgroup label="{{data.category}}" ng-repeat="data in sprt_vendrs">
                    <md-option ng-repeat="sprt_vendr in data.list | filter:searchTerm" ng-value="sprt_vendr.ID">
                        {{sprt_vendr.NAME}}
                    </md-option>
                </md-optgroup>					
                </md-select>
            </md-input-container>-->
			<md-autocomplete class="md-block" flex-gt-sm flex="20"
		                     ng-value="edit_device.VENDOR==searched.ORG_ID"
							 ng-init="searched.ORG_ID = {'ORG_ID': edit_device.VENDOR,'ORG_NAME':edit_device.vendor}"
							 md-no-cache="false"
							 required
							 md-selected-item="searched.ORG_ID"
							 md-search-text="searchORG_NAME"
							 md-items="item in searchTextChange(searchORG_NAME)"
							 md-item-text="item.ORG_NAME"
							 md-selected-item-change="getContractVendorDetails(edit_device.VENDOR)"
							 md-min-length="0"
							 md-floating-label=" Vendor.id">
				<md-item-template>
					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
				</md-item-template>
				<md-not-found>
				   NO Vendor Found
				</md-not-found>
			</md-autocomplete>
           <span ng-value="edit_device.VENDOR = searched.ORG_ID.ORG_ID"
                          ng-model="edit_device.VENDOR = searched.ORG_ID.ORG_ID"></span>

            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <md-input-container class="md-block" flex-gt-sm flex="20">
                <label>Contact Number</label>
                <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="edit_device.vendor_contact_no" name="vendor_contact_no" aria-label="vcontact_no"/>
            </md-input-container>

            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <md-input-container class="md-block"  flex-gt-sm flex="20">
                <label>Email ID</label>
                <input type="email" ng-disabled="true" ng-model="edit_device.vemail_id" name="vemail_id" aria-label="vemail_id"/>
            </md-input-container>

            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <md-input-container class="md-block"  flex-gt-sm flex="20">
                <label>Contact Person</label>
                <input type="text" ng-disabled="true" ng-model="edit_device.vcontact_person" name="vcontact_person" aria-label="vcontact_person"/>
            </md-input-container>
        </div>

        <div ng-if="edit_device.AMC_TYPE!='Biomedical'" layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
            <md-input-container class="md-block"  flex-gt-sm flex="20">
                <label>Contact Person Number</label>
                <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="edit_device.vcontact_person_no" name="vcontact_person_no" aria-label="vcontact_person_no"/>
            </md-input-container>

            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <md-input-container class="md-block"  flex-gt-sm flex="20">
                <label>Contact Person Email ID</label>
                <input type="eamil" ng-disabled="true" ng-model="edit_device.vcontact_person_email_id" name="vcontact_person_email_id" aria-label="vcontact_person_email_id"/>
            </md-input-container>

            <div flex="5" hide-xs hide-sm><!-- Space --></div>

            <md-input-container class="md-block"  flex-gt-sm flex="45">
                <label>Vendor Address</label>
                <textarea rows="5" ng-disabled="true" ng-model="edit_device.vendor_address" name="vendor_address" aria-label="vendor_address" md-select-on-focus></textarea>
            </md-input-container>
        </div>
        <h5 class="sub_heading-style-respond">Equipment Purchase Details:</h5>
	<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
	<md-input-container class="md-block"  flex-gt-sm flex="20">
    <label>PO NO</label>
      <input type="text" ng-model="edit_device.PONO" name="PONO" aria-label="PONO"/>
    </md-input-container>
	<div flex="5" hide-xs hide-sm><!-- Space --></div>
    <mdp-date-picker mdp-placeholder="PO Date" name="PDATE"  class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="edit_device.PDATE">
    </mdp-date-picker>
        <div flex="5" hide-xs hide-sm><!-- Space --></div>
    <md-input-container class="md-block" flex-gt-sm flex="20">
        <label>GRN No.</label>
        <input type="text" ng-model="edit_device.GRN_VALUE" name="GRN_VALUE" aria-label="GRN_VALUE"/>
    </md-input-container>

    <div flex="5" hide-xs hide-sm><!-- Space --></div>

    <mdp-date-picker mdp-placeholder="GRN Date" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="edit_device.GRN_DATE">
    </mdp-date-picker>
</div>

<h5 class="sub_heading-style-respond">Maintenance Schedule:</h5>
<div layout-gt-xs="row">
    <md-input-container class="md-block"  flex-gt-sm flex="15">
        <label>PMS's (Per Year)</label>
     <md-select ng-model="edit_device.PMS_COUNT" ng-name="no_of_pms"  ng-disabled="edit_device.general_asset==yesstate">
      <md-option ng-repeat="pmscount in pmscounts"  ng-value="pmscount">
        {{pmscount}}
      </md-option>
    </md-select>
    </md-input-container>

 <div flex="5" hide-xs hide-sm><!-- Space --></div>

    <mdp-date-picker mdp-placeholder="Last PMS Date *"  class="md-block" flex-gt-sm flex="15" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="edit_device.PMS_DONE" mdp-disabled="edit_device.general_asset==yesstate">
    </mdp-date-picker>

 <div flex="5" hide-xs hide-sm><!-- Space --></div>

  	 <md-input-container class="md-block" flex-gt-sm flex="20">
    <label>No. of Calibrations</label>
     <md-select ng-model="edit_device.QC_COUNT" name="QC_COUNT"  ng-disabled="edit_device.general_asset==yesstate">
          <md-option ng-repeat="qcscount in qcscounts" ng-value="qcscount">
            {{qcscount}}
          </md-option>
     </md-select>
    </md-input-container>
    <div flex="5" hide-xs hide-sm><!-- Space --></div>
    <md-input-container class="md-block" flex-gt-sm flex="15">
        <label>Per Year/Month</label>
        <md-select ng-model="edit_device.QC_COUNT_TYPE" name="no_of_qcs_ym" ng-disabled="edit_device.general_asset==yesstate">
            <md-option ng-repeat="qcscount_ym in ['Year','Month']" ng-value="qcscount_ym">
                {{qcscount_ym}}
            </md-option>
        </md-select>
    </md-input-container>

 <div flex="5" hide-xs hide-sm><!-- Space --></div>

    <mdp-date-picker mdp-placeholder="Last Calibration" class="md-block" flex-gt-sm flex="15" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="edit_device.QC_DONE" mdp-disabled="edit_device.general_asset==yesstate">
    </mdp-date-picker>
</div>
        <!--<h5 class="sub_heading-style-respond">BreakDown Information:</h5>
        <div layout-gt-xs="row">
            <md-input-container class="md-block"  flex-gt-sm flex="30">
                <label>BreakDown Count</label>
                <input only-digits="only-digits" type="text" ng-model="edit_device.BD_COUNT" name="break_down_count" aria-label="break_down_count"/>
            </md-input-container>
            <div flex="5" hide-xs hide-sm></div>
            <md-input-container class="md-block" flex-gt-sm flex="30">
                <label>BreakDown Cost</label>
                <input only-digits="only-digits" type="text" ng-model="edit_device.BD_COST" name="break_down_cost" aria-label="break_down_cost"/>
            </md-input-container>

            <div flex="5" hide-xs hide-sm></div>
            <mdp-date-picker mdp-placeholder="Last Breakdown Date" class="md-block" flex-gt-sm flex="30" mdp-format="DD-MM-YYYY" ng-model="edit_device.LB_DATE">
            </mdp-date-picker>

        </div>-->
        <h5 class="sub_heading-style-respond">Upload Documents:</h5>
        <div layout-gt-xs="row">
            <div layout="column">
                <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">
                    <input type="file" file-model="device_manuals" multiple />(Upload Manuals Here)
                </div>
                <!--<ul>
                    <li ng-repeat="device_manual in device_manuals">{{device_manual.name}}</li>
                </ul>-->
            </div>

            <div layout="column">
                <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">
                    <input type="file" file-model="device_pos" multiple />(Upload POs Here)
                </div>
                <!--<ul>
                    <li ng-repeat="device_po in device_pos"></li>
                </ul>-->
            </div>

            <div layout="column">
                <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">
                    <input type="file" file-model="device_othr_files" multiple />(Other Documents)
                </div>
                <!--<ul>
                    <li ng-repeat="device_othr_file in device_othr_files"></li>
                </ul>-->
            </div>
        </div>
<div class="row">
    <center>
    <input type="submit" class="md-button md-raised md-accent" ng-disabled="editDevice.$invalid"  layout-align="center center" ng-click="updateDevice(edit_device)"  aria-label="button" value="Update">

    <md-button style="margin-top:20px;" class="md-raised md-accent" layout-align="center center" ng-click="gotoViewDevices()" aria-label="button" unsaved-warning-clear>Cancel</md-button>
</div>
	</form>
	</div>
    </div>
</md-content>