<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Indent Sactioned</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">

            <div flex layout="row" layout-align="center center">
                <md-input-container  class="md-block" flex-gt-sm flex="30">
                    <label>Indent Status</label>
                    <md-select ng-model="aindent_sactioned_status" name="indent_sactioned_status">
                        <md-option ng-repeat="indent_sactioned_status in indent_sactioned_statuss_new"  ng-value="indent_sactioned_status.value">
                            {{indent_sactioned_status.key}}
                        </md-option>
                    </md-select>
                </md-input-container>
            </div>
            <div ng-show="aindent_sactioned_status==indent_sactioned_statuss[0]" flex="100" layout="row" layout-align="center center">
                <form method="POST" name="editIndentSactionedForm" flex="100">
                    <div layout="row" layout-wrap>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Name</label>
                            <input type="text" ng-model="sactioned_indent_equipment.equp_name1" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Category</label>
                            <md-select ng-disabled="true" ng-model="sactioned_indent_equipment.cat1" name="cat" aria-label="cat">
                                <md-option ng-repeat="equp_cat in equp_cats" ng-value="equp_cat.ID">{{equp_cat.NAME}}</md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Department</label>
                            <input type="text" ng-disabled="true" ng-model="sactioned_indent_equipment.departments1" name="departments1" aria-label="departments1"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Quantity</label>
                            <input type="text" ng-disabled="true" ng-model="sactioned_indent_equipment.quantity1" name="quantity" aria-label="quantity"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Estimated Cost</label>
                            <input type="text"  ng-disabled="true" ng-model="sactioned_indent_equipment.estimated_cost1" name="estimated_cost" aria-label="equp_name"/>
                            <div ng-messages="editIndentSactionedForm.estimated_cost.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Approx revenu generation</label>
                            <textarea ng-model="sactioned_indent_equipment.app_revenu_gen" ng-disabled="true" name="app_revenu_gen1"  rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="editIndentSactionedForm.app_revenu_gen.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Budget Reference</label>
                            <textarea ng-disabled="true" ng-model="sactioned_indent_equipment.budget_refrence1" name="budget_refrence"  rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="editIndentSactionedForm.budget_refrence.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Reasons</label>
                            <textarea ng-disabled="true" ng-model="sactioned_indent_equipment.reasons1"  name="reasons1"></textarea>
                        </md-input-container>

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Company Name (OEM)</label>
                            <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="sactioned_indent_equipment.company_name" name="company_name" aria-label="company_name">
                                <md-select-header class="demo-select-header">
                                    <input ng-model="searchTerm" type="text" placeholder="Search Make" class="demo-header-searchbox md-text">
                                </md-select-header>
                                <md-optgroup label="oems">
                                    <md-option ng-repeat="oem in oems | filter:searchTerm" ng-value="oem.ID">{{oem.NAME}}</md-option>
                                </md-optgroup>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label style="color:#000000 !important;">Vendor *</label>
                            <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="sactioned_indent_equipment.vendor_name" ng-change="getContractVendorDetails(sactioned_indent_equipment.vendor_name)" name="vendor" aria-label="vendor">
                                <md-select-header class="demo-select-header">
                                    <input ng-model="searchTerm" type="text" placeholder="Search Vendor" class="demo-header-searchbox md-text">
                                </md-select-header>
                                <md-optgroup label="sprt_vendrs">
                                    <md-option ng-repeat="sprt_vendr in sprt_vendrs | filter:searchTerm" ng-value="sprt_vendr.ID">
                                        {{sprt_vendr.NAME}}
                                    </md-option>
                                </md-optgroup>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Toatal Cost</label>
                            <input type="text" only-digits="only-digits" ng-model="sactioned_indent_equipment.total_cost" name="total_cost" aria-label="total_cost"/>
                            <div ng-messages="editIndentSactionedForm.total_cost.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Invoice Number</label>
                            <input type="text"  ng-model="sactioned_indent_equipment.invoice_no" name="invoice_no" aria-label="invoice_no"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>PO No</label>
                            <input type="text" ng-model="sactioned_indent_equipment.po_no" name="po_no" aria-label="indent_type"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Feedback</label>
                            <textarea ng-model="sactioned_indent_equipment.feedback" name="feedback" rows="5" md-select-on-focus> </textarea>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <div layout="column">
                            <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="45">
                                Invoice Files :<input type="file" file-model="indent_invoice_files" multiple />
                            </div>
                            <ul style="margin-top: 15px;">
                                <li ng-repeat="indent_invoice_file in indent_invoice_files">{{indent_invoice_file.name}}</li>
                            </ul>
                        </div>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <div layout="column">
                            <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="45">
                                PO Files :<input type="file" file-model="indent_po_files" multiple />
                            </div>
                            <ul style="margin-top: 15px;">
                                <li ng-repeat="indent_po_file in indent_po_files">{{indent_po_file.name}}</li>
                            </ul>
                        </div>
                    </div>
                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="UpdateIndentSactionedlist(sactioned_indent_equipment,aindent_sactioned_status)" ng-disabled="editIndentSactionedForm.$invalid" aria-label="submit">Submit</md-button>
                        </center>
                    </div>
                </form>
            </div>
            <div ng-show="aindent_sactioned_status==indent_sactioned_statuss[1]" flex="100" layout="row" layout-align="center center">
                <form method="POST" name="editIndentDisSactionedForm" flex="100">
                    <div layout="row" layout-wrap>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Name</label>
                            <input type="text" ng-model="sactioned_indent_equipment.equp_name1" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Equipment Category</label>
                            <md-select ng-disabled="true" ng-model="sactioned_indent_equipment.cat1" name="cat" aria-label="cat">
                                <md-option ng-repeat="equp_cat in equp_cats" ng-value="equp_cat.ID">{{equp_cat.NAME}}</md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Department</label>
                            <input type="text" ng-disabled="true" ng-model="sactioned_indent_equipment.departments1" name="departments1" aria-label="departments1"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Quantity</label>
                            <input type="text" ng-disabled="true" ng-model="sactioned_indent_equipment.quantity1" name="quantity" aria-label="quantity"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Estimated Cost</label>
                            <input type="text"  ng-disabled="true" ng-model="sactioned_indent_equipment.estimated_cost1" name="estimated_cost" aria-label="equp_name"/>
                            <div ng-messages="editIndentSactionedForm.estimated_cost.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Approx revenu generation</label>
                            <textarea ng-model="sactioned_indent_equipment.app_revenu_gen" ng-disabled="true" name="app_revenu_gen1"  rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="editIndentSactionedForm.app_revenu_gen.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Budget Reference</label>
                            <textarea ng-disabled="true" ng-model="sactioned_indent_equipment.budget_refrence1" name="budget_refrence"  rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="editIndentSactionedForm.budget_refrence.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Reasons</label>
                            <textarea ng-disabled="true" ng-model="sactioned_indent_equipment.reasons1"  name="reasons1"></textarea>
                        </md-input-container>

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Company Name (OEM)</label>
                            <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="sactioned_indent_equipment.company_name" name="company_name" aria-label="company_name">
                                <md-select-header class="demo-select-header">
                                    <input ng-model="searchTerm" type="text" placeholder="Search Make" class="demo-header-searchbox md-text">
                                </md-select-header>
                                <md-optgroup label="oems">
                                    <md-option ng-repeat="oem in oems | filter:searchTerm" ng-value="oem.ID">{{oem.NAME}}</md-option>
                                </md-optgroup>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label style="color:#000000 !important;">Vendor *</label>
                            <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="sactioned_indent_equipment.vendor_name" ng-change="getContractVendorDetails(sactioned_indent_equipment.vendor_name)" name="vendor" aria-label="vendor">
                                <md-select-header class="demo-select-header">
                                    <input ng-model="searchTerm" type="text" placeholder="Search Vendor" class="demo-header-searchbox md-text">
                                </md-select-header>
                                <md-optgroup label="sprt_vendrs">
                                    <md-option ng-repeat="sprt_vendr in sprt_vendrs | filter:searchTerm" ng-value="sprt_vendr.ID">
                                        {{sprt_vendr.NAME}}
                                    </md-option>
                                </md-optgroup>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Toatal Cost</label>
                            <input type="text"  only-digits="only-digits" ng-model="sactioned_indent_equipment.total_cost" name="total_cost" aria-label="total_cost"/>
                            <div ng-messages="editIndentSactionedForm.total_cost.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Invoice Number</label>
                            <input type="text" ng-model="sactioned_indent_equipment.invoice_no" name="invoice_no" aria-label="invoice_no" only-digits="only-digits"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>PO No</label>
                            <input type="text" ng-model="sactioned_indent_equipment.po_no" name="po_no" aria-label="indent_type"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="45">
                            <label>Feedback</label>
                            <textarea ng-model="sactioned_indent_equipment.feedback" name="feedback" rows="5" md-select-on-focus> </textarea>
                        </md-input-container>
                    </div>
                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="UpdateIndentDisSactionedlist(sactioned_indent_equipment,aindent_sactioned_status)" ng-disabled="editIndentDisSactionedForm.$invalid" aria-label="submit">Submit</md-button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </md-dialog-content>
</md-dialog>