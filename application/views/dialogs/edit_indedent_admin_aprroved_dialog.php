<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock
	xmlns="http://www.w3.org/1999/html">
	<md-toolbar>
		<div class="md-toolbar-tools">
			<h4>Equipment Details</h4>
			<span flex></span>
			<md-button class="md-icon-button" ng-click="cancel()">
				<md-icon md-font-set="material-icons">clear</md-icon>
			</md-button>
		</div>
	</md-toolbar>
	<md-dialog-content flex layout-align="center center">
		<div class="md-dialog-content">
			<div flex layout="row">
				<md-tabs flex md-dynamic-height md-border-bottom>
					<md-tab flex md-primary label="Transfer">
						<!-- Profile Begin -->
						<md-content>
							<md-input-container class="md-block" flex-gt-sm flex="30">
								<label>Indent Status</label>
								<md-select ng-model="aindent_status" name="indent_status">
									<md-option ng-repeat="indent_status in indent_statuss_new" ng-value="indent_status.value">                                        {{indent_status.key}}                                    </md-option>
								</md-select>
							</md-input-container>
							<div ng-show="aindent_status==indent_statuss[0]" flex="100" layout="row" layout-align="center center">
								<form method="POST" name="editIndentApprovedForm" flex="100">
									<div layout="row" layout-wrap>
										<md-input-container class="md-block" flex-gt-sm flex="45">
											<label>Branch*</label>
											<md-select required ng-model="update_indent_equipment.branch_id" name="branch_id">
												<md-option ng-repeat="branch in branches"  ng-value="branch.BRANCH_ID" ng-if="branch.BRANCH_ID != 'All'" ng-disabled="branch.BRANCH_ID == get_user_branch.userbranch_id">                                                        {{branch.BRANCH_NAME}}                                                    </md-option>
											</md-select>
											<div ng-messages="editIndentApprovedForm.branch_id.$error">
												<div ng-message="required">Required.</div>
											</div>
										</md-input-container>
										<div flex="5" hide-xs hide-sm></div>
										<md-input-container class="md-block" flex-gt-sm flex="45">
											<label>Equipment Category</label>
											<md-select ng-disabled="true" ng-model="update_indent_equipment.cat1" name="cat" aria-label="cat">
												<md-option ng-repeat="equp_cat in equp_cats" ng-value="equp_cat.ID">{{equp_cat.NAME}}</md-option>
											</md-select>
										</md-input-container>
										<div flex="5" hide-xs hide-sm></div>
										<md-input-container class="md-block" flex-gt-sm flex="45">
											<label>Department</label>
											<md-select ng-disabled="true"  ng-model="update_indent_equipment.departments1" name="depts">
												<md-option ng-repeat="dept in depts"  ng-value="dept.CODE">                                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                                                </md-option>
											</md-select>
										</md-input-container>
										<div flex="5" hide-xs hide-sm></div>
										<md-input-container class="md-block" flex-gt-sm flex="45">
											<label>Quantity</label>
											<input type="text" required ng-disabled="true" ng-model="update_indent_equipment.quantity1" name="quantity" aria-label="quantity"/>
											<div ng-messages="editIndentApprovedForm.quantity.$error">
												<div ng-message="required">Required.</div>
											</div>
										</md-input-container>
										<!--</div><div layout="row">-->
										<div flex="5" hide-xs hide-sm></div>
										<md-input-container class="md-block" flex-gt-sm flex="45">
											<label>Company Name (OEM)</label>
											<md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="update_indent_equipment.company_name" name="company_name" aria-label="company_name">
												<md-select-header class="demo-select-header">
													<input ng-model="searchTerm" type="text" placeholder="Search Make" class="demo-header-searchbox md-text">
													</md-select-header>
													<md-optgroup label="oems">
														<md-option ng-repeat="oem in oems | filter:searchTerm" ng-value="oem.ID">{{oem.NAME}}</md-option>
													</md-optgroup>
												</md-select>
										</md-input-container>
										<div flex="5" hide-xs hide-sm></div>
										<md-input-container class="md-block" flex-gt-sm flex="45">
											<label>Estimated Cost</label>
											<input type="text" required ng-disabled="true" ng-model="update_indent_equipment.estimated_cost1" name="estimated_cost" aria-label="equp_name"/>
										</md-input-container>
										<div flex="5" hide-xs hide-sm></div>
										<md-input-container class="md-block" flex-gt-sm flex="45">
											<label>Approx revenue generation</label>
											<input type="text" ng-model="update_indent_equipment.app_revenu_gen" ng-disabled="true" name="app_revenu_gen1" aria-label="app_revenu_gen1">
										</md-input-container>
										<div flex="5" hide-xs hide-sm></div>
										<md-input-container ng-show="user_role_code==HMADMIN" class="md-block" flex-gt-sm flex="45">
											<label>Budget Reference</label>
											<input type="text" ng-disabled="true"   ng-model="update_indent_equipment.budget_refrence1" name="budget_refrence"  aria-label="budget_refrence">
										</md-input-container>
										<div flex="5" hide-xs hide-sm></div>
										<md-autocomplete class="md-block" flex-gt-sm flex="25"
										  required 
											md-input-name="equipmentorg"
											ng-value="update_indent_equipment.VENDOR_ID==searched.ORG_ID'"
											ng-init="searched.ORG_ID = {'ORG_ID': update_indent_equipment.VENDOR_ID,'ORG_NAME':update_indent_equipment.vendor_name}"
											md-no-cache="false"
											md-selected-item="searched.ORG_ID"
											md-search-text="searchORG_NAME"
											md-items="item in searchTextChange(searchORG_NAME)"
											md-item-text="item.ORG_NAME"
											md-min-length="0"
											md-floating-label="Search Contract Vendor">
											<md-item-template>
												<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
											</md-item-template>
											<div ng-messages="editIndentRequestForm.equipmentorg.$error" ng-if="editIndentRequestForm.equipmentorg.$touched">
												<div ng-message="required">Required</div>
											</div>
										</md-autocomplete>
													<span ng-value="update_indent_equipment.vendor_name = searched.ORG_ID.ORG_ID" ></span>
													<!--</div><div layout="row">-->
													<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm>
														<!-- Space -->
													</div>
													<md-input-container ng-disabled="true" class="md-block" flex-gt-sm flex="45">
														<label>Reasons</label>
														<textarea  ng-model="update_indent_equipment.reasons1" name="reasons1" ng-disabled="true"></textarea>
													</md-input-container>
													<!--</div>-->
													<!--</div><div layout="row">-->
													<div flex="5" hide-xs hide-sm>
														<!-- Space -->
													</div>
													<md-input-container class="md-block" flex-gt-sm flex="45">
														<label>Feedback</label>
														<textarea ng-model="update_indent_equipment.feedback" required  name="feedback" rows="5" md-select-on-focus></textarea>
														<div ng-messages="editIndentApprovedForm.feedback.$error">
															<div ng-message="required">Required.</div>
														</div>
													</md-input-container>
												</div>
												<div flex layout="row" layout-align="center center">
													<center>
														<md-button class="md-raised md-accent" ng-click="UpdateVendorIndentApprovedlist(update_indent_equipment,aindent_status)" ng-disabled="editIndentApprovedForm.$invalid" aria-label="submit">Submit</md-button>
													</center>
												</div>
											</form>
							</div>
										<div ng-show="aindent_status==indent_statuss[1]" flex="100" layout="row" layout-align="center center">
											<form method="POST" name="editIndentDisapprovedForm" flex="100" autocomplete="off">
												<div layout="row" layout-wrap>
													<md-input-container class="md-block" flex-gt-sm flex="45">
														<label>Equipment Name</label>
														<input type="text" ng-disabled="true" required ng-model="update_indent_equipment.equp_name1" name="equp_name" aria-label="equp_name"/>
														<div ng-messages="editIndentDisapprovedForm.equp_name.$error">
															<div ng-message="required">Required.</div>
														</div>
													</md-input-container>
													<div flex="5" hide-xs hide-sm>
														<!-- Space -->
													</div>
													<md-input-container class="md-block" flex-gt-sm flex="45">
														<label>Equipment Category</label>
														<md-select ng-disabled="true" ng-model="update_indent_equipment.cat1" name="cat" aria-label="cat">
															<md-option ng-repeat="equp_cat in equp_cats" ng-value="equp_cat.ID">{{equp_cat.NAME}}</md-option>
														</md-select>
													</md-input-container>
													<div flex="5" hide-xs hide-sm>
														<!-- Space -->
													</div>
													<md-input-container  class="md-block" flex-gt-sm flex="45">
														<label>Department</label>
														<md-select  ng-disabled="true" ng-model="update_indent_equipment.departments1" name="depts">
															<md-option ng-repeat="dept in depts"  ng-value="dept.CODE">                                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                                                </md-option>
														</md-select>
													</md-input-container>
													<div flex="5" hide-xs hide-sm>
														<!-- Space -->
													</div>
													<md-input-container class="md-block" flex-gt-sm flex="45">
														<label>Quantity</label>
														<input type="text" ng-disabled="true" required ng-model="update_indent_equipment.quantity1" name="quantity" aria-label="quantity"/>
														<div ng-messages="editIndentDisapprovedForm.quantity.$error">
															<div ng-message="required">Required.</div>
														</div>
													</md-input-container>
													<!--</div><div layout="row">-->
													<div flex="5" hide-xs hide-sm>
														<!-- Space -->
													</div>
													<md-input-container class="md-block" flex-gt-sm flex="45">
														<label>Company Name (OEM)</label>
														<md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="update_indent_equipment.company_name" name="company_name" aria-label="company_name">
															<md-select-header class="demo-select-header">
																<input ng-model="searchTerm" type="text" placeholder="Search Make" class="demo-header-searchbox md-text">
																</md-select-header>
																<md-optgroup label="oems">
																	<md-option ng-repeat="oem in oems | filter:searchTerm" ng-value="oem.ID">{{oem.NAME}}</md-option>
																</md-optgroup>
															</md-select>
														</md-input-container>
														<div flex="5" hide-xs hide-sm>
															<!-- Space -->
														</div>
														<!--<md-input-container class="md-block" flex-gt-sm flex="45"><label>Vendor</label><md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="update_indent_equipment.vendor_name" name="vendor_name" aria-label="vendor_name"><md-select-header class="demo-select-header"><input ng-model="searchTerm" type="text" placeholder="Search Make" class="demo-header-searchbox md-text"></md-select-header><md-optgroup label="oems"><md-option ng-repeat="sprt_vendr in sprt_vendrs | filter:searchTerm" ng-value="sprt_vendr.ID">{{sprt_vendr.NAME}}</md-option></md-optgroup></md-select></md-input-container>--->
														<md-autocomplete class="md-block" flex-gt-sm flex="25"
									                  required 
									                md-input-name="equipmentorg"
                                                    ng-value="update_indent_equipment.vendor_name==searched.ORG_ID"'
									                ng-init="searched.ORG_ID = {'ORG_ID': update_indent_equipment.VENDOR,'ORG_NAME':update_indent_equipment.VENDOR_NAME}"
                                                    md-no-cache="false"
                                                    md-selected-item="searched.ORG_ID"
                                                    md-search-text="searchORG_NAME"
                                                    md-items="item in searchTextChange(searchORG_NAME)"
                                                    md-item-text="item.ORG_NAME"
                                                    md-min-length="0"
                                                    md-floating-label="Search Contract Vendor">
															<md-item-template>
																<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
															</md-item-template>
															<div ng-messages="editIndentRequestForm.equipmentorg.$error" ng-if="editIndentRequestForm.equipmentorg.$touched">
																<div ng-message="required">Required</div>
															</div>
															<!--<md-not-found>
                            NO Vendor Found
                        </md-not-found>--->
														</md-autocomplete>
														<span ng-value="update_indent_equipment.vendor_name = searched.ORG_ID.ORG_ID" ng-model="update_indent_equipment.vendor_name = searched.ORG_NAME.ORG_NAME" ></span>
														<div flex="5" hide-xs hide-sm>
															<!-- Space -->
														</div>
														<md-input-container class="md-block" flex-gt-sm flex="45">
															<label>Estimated Cost</label>
															<input type="text"  ng-disabled="true" ng-model="update_indent_equipment.estimated_cost1" name="estimated_cost" aria-label="equp_name"/>
														</md-input-container>
														<div flex="5" hide-xs hide-sm>
															<!-- Space -->
														</div>
														<md-input-container class="md-block" flex-gt-sm flex="45">
															<label>Approx revenue generation</label>
															<input ng-model="update_indent_equipment.app_revenu_gen1" name="app_revenu_gen" rows="5" aria-label="app_revenu_gen" ng-disabled="true">
															</md-input-container>
															<div flex="5" hide-xs hide-sm>
																<!-- Space -->
															</div>
															<md-input-container ng-disabled="true" ng-show="user_role_code==HMADMIN" class="md-block" flex-gt-sm flex="45">
																<label>Budget Refrence</label>
																<input ng-model="update_indent_equipment.budget_refrence1" name="budget_refrence" aria-label="budget_refrence">
																</md-input-container>
																<!--</div><div layout="row">-->
																<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm>
																	<!-- Space -->
																</div>
																<md-input-container class="md-block" flex-gt-sm flex="45">
																	<label>Reasons</label>
																	<input ng-model="update_indent_equipment.reasons1" ng-disabled="true" name="reasons1" aria-label="reasons1">
																	</md-input-container>
																	<!--</div><div layout="row">-->
																	<div flex="5" hide-xs hide-sm>
																		<!-- Space -->
																	</div>
																	<md-input-container class="md-block" flex-gt-sm flex="45">
																		<label>Feedback</label>
																		<textarea ng-model="update_indent_equipment.feedback"  name="feedback" rows="5" md-select-on-focus></textarea>
																	</md-input-container>
																</div>
																<div flex layout="row" layout-align="center center">
																	<center>
																		<md-button class="md-raised md-accent" ng-click="UpdateIndentDisApprovedlist(update_indent_equipment,aindent_status)" ng-disabled="editIndentDisapprovedForm.$invalid" aria-label="submit">Submit</md-button>
																	</center>
																</div>
															</form>
														</div>
													</md-content>
					</md-tab>
												<md-tab md-primary label="Assign">
													<md-content flex>
														<div flex layout="row" layout-align="center center">
															<form method="POST" name="indentRequestForm" flex="100" class="md-whiteframe-1dp mylayout-padding">
																<div flex layout="row" layout-align="center center">
																	<md-input-container  class="md-block" flex-gt-sm flex="20">
																		<label>Select Branch * </label>
																		<md-select ng-disabled="true" ng-model="update_indent_equipment.BRANCH_ID" name="branch_id" ng-required="indent_equipment.branch_id != ''">
																			<md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branches"  ng-if="branch.BRANCH_ID !='All'">                                                    {{branch.BRANCH_NAME}}                                                </md-option>
																		</md-select>
																	</md-input-container>
																	<div flex="10" hide-xs hide-sm>
																		<!-- Space -->
																	</div>
																	<md-input-container class="md-block" flex-gt-sm flex="20">
																		<label>Indent Request For</label>
																		<md-select ng-disabled="true" ng-model="update_indent_equipment.INDENT_TYPE" name="indent_request">
																			<md-option ng-repeat="indent_request in indent_requests"  ng-value="indent_request">                                                    {{indent_request}}                                                </md-option>
																		</md-select>
																	</md-input-container>
																</div>
																<h5 flex class="sub_heading-style-respond">{{aindent_request}} Basic Details</h5>
																<div layout="row">
																	<md-input-container class="md-block" flex-gt-sm flex="25" >
																		<label>Equipment Name</label>
																		<input type="text" ng-required="indent_requests[0]==aindent_request" required ng-model="update_indent_equipment.equp_name1" name="equp_name" aria-label="equp_name"/>
																		<div ng-messages="indentRequestForm.equp_name.$error">
																			<div ng-message="required">Required.</div>
																		</div>
																	</md-input-container>
																	<div flex="10" ng-show="indent_requests[0]==aindent_request" hide-xs hide-sm>
																		<!-- Space -->
																	</div>
																	<div ng-show="indent_requests[1]==aindent_request" flex="25">
																		<md-input-container class="md-block" flex-gt-sm>
																			<label>Spares</label>
																			<md-select ng-model="update_indent_equipment.SPARES" name="critical_spare">
																				<md-option ng-repeat="m_critical_spare in m_critical_spares"  ng-value="m_critical_spare.CODE">                                                        {{m_critical_spare.NAME}}                                                    </md-option>
																			</md-select>
																		</md-input-container>
																	</div>
																	<div flex="10" ng-show="indent_requests[1]==aindent_request" hide-xs hide-sm>
																		<!-- Space -->
																	</div>
																	<div ng-show="indent_requests[2]==aindent_request" flex="20">
																		<md-input-container class="md-block" flex-gt-sm>
																			<label>Accessories</label>
																			<md-select ng-model="update_indent_equipment.ACCESSORIES" name="accessorie">
																				<md-option ng-repeat="m_accessorie in m_accessories"  ng-value="m_accessorie.CODE">                                                        {{m_accessorie.NAME}}                                                    </md-option>
																			</md-select>
																		</md-input-container>
																	</div>
																	<div flex="10" ng-show="indent_requests[2]==aindent_request" hide-xs hide-sm>
																		<!-- Space -->
																	</div>
																	<md-input-container ng-show="indent_requests[0]==aindent_request" class="md-block" flex-gt-sm flex="20">
																		<label>Equipment Category</label>
																		<md-select ng-required="indent_requests[2]==aindent_request" ng-model="update_indent_equipment.cat" name="cat" aria-label="cat">
																			<md-option ng-repeat="equp_cat in equp_cats" ng-value="equp_cat.ID">{{equp_cat.NAME}}</md-option>
																		</md-select>
																	</md-input-container>
																	<div flex="10" ng-show="indent_requests[0]==aindent_request" hide-xs hide-sm>
																		<!-- Space -->
																	</div>
																	<md-input-container class="md-block" flex-gt-sm flex="20">
																		<label>Department</label>
																		<md-select ng-required="indent_requests[0]==aindent_request" ng-model="update_indent_equipment.departments1" name="depts">
																			<md-option ng-repeat="dept in depts"  ng-value="dept.CODE">                                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                                                </md-option>
																		</md-select>
																	</md-input-container>
																	<div flex="10" hide-xs hide-sm>
																		<!-- Space -->
																	</div>
																	<md-input-container class="md-block" flex-gt-sm flex="20">
																		<label>Quantity</label>
																		<input type="text" required ng-model="update_indent_equipment.quantity1" name="quantity" aria-label="quantity"/>
																		<div ng-messages="indentRequestForm.quantity.$error">
																			<div ng-message="required">Required.</div>
																		</div>
																	</md-input-container>
																</div>
																<h5 flex class="sub_heading-style-respond">Vendor/Comapny Details</h5>
																<div layout="row">
																	<md-input-container class="md-block" flex-gt-sm flex="25">
																		<label>Company Name (OEM)</label>
																		<md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="update_indent_equipment.company_name" name="company_name" aria-label="company_name">
																			<md-select-header class="demo-select-header">
																				<input ng-model="searchTerm" type="text" placeholder="Search Make" class="demo-header-searchbox md-text">
																				</md-select-header>
																				<md-optgroup label="oems">
																					<md-option ng-repeat="oem in oems | filter:searchTerm" ng-value="oem.ID">{{oem.NAME}}</md-option>
																				</md-optgroup>
																			</md-select>
																		</md-input-container>
																		<div flex="5" hide-xs hide-sm>
																			<!-- Space -->
																		</div>
																		<!--<md-input-container class="md-block" flex-gt-sm flex="20"><label>Contract Vendor *</label><md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="update_indent_equipment.VENDOR_ID" ng-change="getContractVendorDetails(indent_equipment.vendor_name)" name="vendor" aria-label="vendor"><md-select-header class="demo-select-header"><input ng-model="searchTerm" type="text" placeholder="Search Vendor" class="demo-header-searchbox md-text"></md-select-header><md-optgroup label="{{data.category}}" ng-repeat="data in vendors"><md-option ng-repeat="sprt_vendr in data.list | filter:searchTerm" ng-value=".ID">                                                        {{sprt_vendr.NAME}}                                                    </md-option></md-optgroup></md-select></md-input-container>--->
																		<md-autocomplete class="md-block" flex-gt-sm flex="25"
									                  required 
									                md-input-name="equipmentorg"
                                                    ng-value="update_indent_equipment.vendor_name==searched.ORG_ID"'
									                ng-init="searched.ORG_ID = {'ORG_ID': update_indent_equipment.vendor_name,'ORG_NAME':update_indent_equipment.vendor_name}"
                                                    md-no-cache="false"
                                                    md-selected-item="searched.ORG_ID"
                                                    md-search-text="searchORG_NAME"
                                                    md-items="item in searchTextChange(searchORG_NAME)"
                                                    md-item-text="item.ORG_NAME"
                                                    md-min-length="0"
                                                    md-floating-label="Search Contract Vendor">
																			<md-item-template>
																				<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
																			</md-item-template>
																			<div ng-messages="editIndentRequestForm.equipmentorg.$error" ng-if="editIndentRequestForm.equipmentorg.$touched">
																				<div ng-message="required">Required</div>
																			</div>
																			<!--<md-not-found>
                            NO Vendor Found
                        </md-not-found>--->
																		</md-autocomplete>
																		<span ng-value="update_indent_equipment.vendor_name = searched.ORG_ID.ORG_ID" ng-model="update_indent_equipment.vendor_name = searched.ORG_NAME.ORG_NAME" ></span>
																		<div flex="5" hide-xs hide-sm></div>
																		<md-input-container class="md-block" flex-gt-sm>
																			<label>Estimated Cost</label>
																			<input type="text" required ng-model="update_indent_equipment.estimated_cost1" name="estimated_cost" only-digits="only-digits" aria-label="equp_name"/>
																			<div ng-messages="indentRequestForm.estimated_cost.$error">
																				<div ng-message="required">Required.</div>
																			</div>
																		</md-input-container>
																		<div flex="5" hide-xs hide-sm>
																			<!-- Space -->
																		</div>
																	</div>
																	<div layout="row">
																		<md-input-container class="md-block" flex-gt-sm>
																			<label>Approx Revenue Generation</label>
																			<input type="text" ng-model="update_indent_equipment.REVENEW_GENERATION" name="app_revenu_gen" only-digits="only-digits" />
																			<div ng-messages="indentRequestForm.app_revenu_gen.$error">
																				<div ng-message="required">Required.</div>
																			</div>
																		</md-input-container>
																		<div flex="5" hide-xs hide-sm>
																			<!-- Space -->
																		</div>
																		<mdp-date-picker  ng-show="user_role_code==HMADMIN" mdp-placeholder="Budget Approved By*" flex-gt-sm flex="48" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="update_indent_equipment.approved_by"></mdp-date-picker>
																		<div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm>
																			<!-- Space -->
																		</div>
																		<mdp-date-picker mdp-placeholder="Bio-Medical Receipt Date*" flex-gt-sm flex="47" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="update_indent_equipment.biomedical_receipt_date" ></mdp-date-picker>
																	</div>
																	<h5 flex class="sub_heading-style-respond">Features/Description</h5>
																	<div layout="row">
																		<div>
																			<label> Brief Description</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.DESCRP" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																		<div flex="5" hide-xs hide-sm>
																			<!-- Space -->
																		</div>
																		<div>
																			<label>Basic / Essential Features</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.ESNTL_FEATURES" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																	</div>
																	<div layout="row">
																		<div>
																			<label>Optimal /Desirous Features</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.OPTIMAL_FEATURES" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																		<div flex="5" hide-xs hide-sm>
																			<!-- Space -->
																		</div>
																		<div>
																			<label>Optimal /Luxurious Features</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.OPTIONAL_FEATURES" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																	</div>
																	<div layout="row">
																		<div>
																			<label>Standard Accessories</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.STNRD_ACCESSORIES" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																		<div flex="5" hide-xs hide-sm>
																			<!-- Space -->
																		</div>
																		<div>
																			<label>Optional Accessories</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.OPTIONAL_ACCESSORIES" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																	</div>
																	<div layout="row">
																		<div>
																			<label>Benefits with Desirous Features</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.DESIROUS_REVENEW" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																		<div flex="5" hide-xs hide-sm>
																			<!-- Space -->
																		</div>
																		<div>
																			<label>Benefits with Luxurious Features</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.LUXURY_REVENEW" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																	</div>
																	<div layout="row">
																		<div>
																			<label>Reasons</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.reasons1" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																		<div flex="5" hide-xs hide-sm>
																			<!-- Space -->
																		</div>
																		<div>
																			<label>Remarks</label>
																			<md-input-container class="md-block">
																				<textarea ck-editor ng-model="update_indent_equipment.remarks1" md-select-on-focus=""></textarea>
																			</md-input-container>
																		</div>
																	</div>
																	<div flex layout="row" layout-align="center center">
																		<center>
																			<md-button class="md-raised md-accent" ng-click="addIndentEquipments(update_indent_equipment,aindent_request)" aria-label="submit">Submit</md-button>
																		</center>
																	</div>
																</form>
															</div>
														</md-content>
													</md-tab>
												</md-tabs>
											</div>
										</div>
		</md-dialog-content>
	<md-dialog-actions layout="row">
		<md-button class="md-primary" ng-click="cancel()">Close</md-button>
	</md-dialog-actions>
</md-dialog>