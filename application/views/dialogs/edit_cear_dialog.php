<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="100" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>CEAR</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="editCearForm" flex="95" class="md-whiteframe-1dp mylayout-padding"autocomplete="off">
                <h5 flex class="sub_heading-style-respond">Cear Basic Details</h5>
                <div layout="row">
                    <mdp-date-picker mdp-placeholder="Date*" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="cear_edit.esdate" >
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>CEAR Number</label>
                        <input ng-disabled="true" type="text"  required ng-model="cear_edit.cear_number" name="cear_number" aria-label="cear_number"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container  class="md-block" flex-gt-sm flex="20">
                        <label>Category</label>
                        <md-select ng-model="cear_edit.category" name="Category">
                            <md-option ng-repeat="cear_category in cear_categorys"  ng-value="cear_category.CODE">
                                {{cear_category.NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Project Title</label>
                        <input type="text" required ng-model="cear_edit.prj_title" name="prj_title" aria-label="prj_title"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>Requesting Unit</label>
                        <input type="text" ng-disabled="true" name="req_unit" ng-model="cear_edit.req_unit" aria-label="req_unit">

                    </md-input-container>
                </div>
                <div style="margin-top:20px;"></div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Department</label>
                        <md-select ng-model="cear_edit.req_dept" name="req_dept">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
					<!--<md-autocomplete flex="20" class="md-block" flex-gt-sm				
					md-no-cache="true"  
                    required
                    md-input-name="department"					
					md-selected-item="searched.CODE"    
					md-search-text="cear_edit.searchDepartment"    
					md-items="item in searchTextChange(cear_edit.searchDepartment)"      
					md-item-text="item.USER_DEPT_NAME"       
					md-search-text-change="cear_edit.req_dept = ''"             
					md-min-length="0"                 
					md-floating-label="Department">    
					<md-item-template>        
					<span md-highlight-text="searchDepartment" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>  
					<div ng-messages="editCearForm.department.$error">
					<div ng-message="required">Required.</div>
					</div>
					</md-item-template>
					<md-not-found>          
					No Department Found     
					</md-not-found>    
					</md-autocomplete>
                    <span ng-value="cear_edit.req_dept == searched.CODE.CODE"></span>--->				
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker mdp-placeholder=" Start Date*" class="md-block"  flex="15" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="cear_edit.edate" >
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker mdp-placeholder="Complete Date*" class="md-block"  flex="15" mdp-format="DD-MM-YYYY"  mdp-min-date="cear_edit.edate" ng-model="cear_edit.ecdate" >
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>Cost Centre to be Charged</label>
                        <input type="text"  required ng-model="cear_edit.cost" name="cost" aria-label="cost"/>
                        <div ng-messages="editCearForm.cost.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container  class="md-block" flex-gt-sm flex="15">
                        <label>Details Attaches </label>
                        <md-select ng-model="cear_edit.cear_conformation" name="Details">
                            <md-option ng-repeat="cear_conformation in cear_conformations"  ng-value="cear_conformation">
                                {{cear_conformation}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <div style="margin-top:20px;"></div>
                    <div ng-show="cear_edit.cear_conformation=='YES'" layout="row" style="border: 0px solid #000" flex="100" layout-wrap>
                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Projected Profit & Loss Statement </span><span flex="5"></span><span><input ng-required="cear_edit.cear_conformation=='YES'" multiple name="ppls" type="file" file-model="ppls"/></span>
                        </div>

                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Projected Cash Flow Statement </span><span flex="5"></span><span><input ng-required="cear_edit.cear_conformation=='YES'" multiple type="file" file-model="pcfs" name="pcfs"/></span>
                        </div>

                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Funding Option and Impact on Balance Sheet </span><span flex="5"></span><span><input ng-required="cear_edit.cear_conformation=='YES'" multiple type="file" file-model="foaibs" name="foaibs"/></span>
                        </div>

                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Payback Period </span><span flex="5"></span><span><input ng-required="cear_edit.cear_conformation=='YES'" multiple type="file" file-model="pp" name="pp"/></span>
                        </div>

                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Return on Investment/IRR </span><span flex="5"></span><span><input ng-required="cear_edit.cear_conformation=='YES'" multiple type="file" file-model="roiirr" name="roiirr"/></span><br>
                        </div>
                    </div>
                <h5 flex class="sub_heading-style-respond">Project / Other Details</h5>

                <div style="margin-top:20px;"></div>
                <div layout="row">
                    <div>
                        <label>Scope of the Project</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_edit.scope_prj" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div>
                        <label>Purpose & Justification</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_edit.purpose_justification" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label>Alternative Considered</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_edit.alernative_considered" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div>
                        <label>Consequence of not Approving Expenditure</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_edit.cnae"  md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label>Effect on Operating Budget / EXPENCES</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_edit.eobe" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div>
                        <label>Equipment Purchase</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_edit.equp_purcg"  md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>

                <div layout="row" flex>

                </div>

                <div layout="row">
                    <div>
                        <label>Conclusion</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_edit.conclusion"  md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>

                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="updateCear(cear_edit)" ng-disabled="editCearForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>