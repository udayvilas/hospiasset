<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="100" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>CEAR Request</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="CearRequestForm" flex="100" class="md-whiteframe-1dp mylayout-padding" autocomplete="off" enctype="multipart/form-data">
                <h5 flex class="sub_heading-style-respond">Indent Basic Details</h5>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="10">
                        <label>Indent Id</label>
                        <input type="text"  ng-disabled="true" ng-model="cear_request.indent_id" name="indent_id" aria-label="indent_id"/>
                        <div ng-messages="CearRequestForm.indent_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>Equipment Name</label>
                        <input type="text"  ng-disabled="true" ng-model="cear_request.equp_name" name="equp_name" aria-label="equp_name"/>
                        <div ng-messages="CearRequestForm.equp_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>Equipment Category</label>
                        <input type="text" ng-disabled="true" ng-model="cear_request.cat" name="cat" aria-label="cat">
                            <!---<md-option ng-repeat="equp_cat in equp_cats" ng-value="equp_cat.ID">{{equp_cat.NAME}}</md-option>
                        </md-select>--->
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container  class="md-block" flex-gt-sm flex="20">
                        <label>Department</label>
                        <input type="text"  ng-disabled="true" ng-model="cear_request.departments" name="depts" aria-label="depts"/>
                            <!---<md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>--->
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>Branch</label>
                        <input type="text"  ng-disabled="true" ng-model="cear_request.branch" name="branch" aria-label="branch"/>
                        <div ng-messages="CearRequestForm.branch.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <h5 flex class="sub_heading-style-respond">CEAR Basic Details</h5>
                <div layout="row" flex>
                    <mdp-date-picker mdp-placeholder="Date*" class="md-block" flex-gt-sm flex="20"  mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="cear_request.date">
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
						<md-input-container  class="md-block" flex-gt-sm flex="20">
                        <label>Cear Category</label>
                        <md-select ng-model="cear_request.cear_category" name="Category">
                            <md-option ng-repeat="cear_category in cear_categorys"  ng-value="cear_category.CODE">
                                {{cear_category.NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
				   <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Project Title</label>
                        <input type="text"  required ng-model="cear_request.prj_title" name="prj_title" aria-label="prj_title"/>
                        <div ng-messages="CearRequestForm.prj_title.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Requesting Unit</label>
                        <md-select name="req_unit" required ng-model="cear_request.BRANCH_NAME" aria-label="req_unit">
                            <md-option ng-if="branch.BRANCH_ID !='All'" ng-value="branch.BRANCH_ID" ng-repeat="branch in branches">{{branch.BRANCH_NAME}} </md-option>
                        </md-select>
                        <div ng-messages="CearRequestForm.req_unit.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--<md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>Requesting Department</label>
                        <!---<md-select required ng-model="cear_request.req_dept" name="req_dept" aria-label="req_dept">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>--->                 
						<md-autocomplete flex="20" class="md-block" flex-gt-sm    
						ng-value="cear_request.department=searched.CODE"		
						required				
						md-input-name="department"	
						md-no-cache="false"      
						md-selected-item="searched.CODE"     
						md-search-text="searchDepartment"     
						md-items="item in searchTextChange(searchDepartment,'Department')"  
						md-item-text="item.USER_DEPT_NAME"           
						md-min-length="0"                     
						md-floating-label="Department">      
						<md-item-template>              
						<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>  
						</md-item-template>		
						<div ng-messages="CearRequestForm.department.$error" ng-if="CearRequestForm.department.$touched">	
						<div ng-message="required">Required</div>		
						</div>        
						<md-not-found>           
						No Department Found          
						</md-not-found>       
						</md-autocomplete>	
						<span ng-value="cear_request.department = searched.CODE.CODE" ></span>
                   </div>						
                <div layout="row" flex>
                    <mdp-date-picker mdp-placeholder=" Start Date*" class="md-block"  flex="20" mdp-format="DD-MM-YYYY" mdp-max-date="maxDate" ng-model="cear_request.sdate" >
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker mdp-placeholder="Complete Date*" class="md-block"  flex="20" mdp-format="DD-MM-YYYY" mdp-min-date="cear_request.sdate" ng-model="cear_request.cdate" >
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Cost Centre to be Charged</label>
                        <input type="text" only-digits="only-digits" ng-model="cear_request.cost" name="amount" aria-label="amount"/>
                        <div ng-messages="CearRequestForm.amount.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container  class="md-block" flex-gt-sm flex="20">
                        <label>Details Attachments</label>
                        <md-select ng-model="cear_request.cear_conformation" name="Details">
                            <md-option ng-repeat="cear_conformation in cear_conformations"  ng-value="cear_conformation">
                                {{cear_conformation}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div ng-show="cear_request.cear_conformation=='YES'" layout="row" style="border: 0px solid #000" flex="100" layout-wrap>
                    <div layout="row" flex="100">
                    <span layout="column" flex="30">Projected Profit & Loss Statement</span><span flex="5"></span><span><input ng-required="cear_request.cear_conformation=='YES'" multiple name="ppls" type="file" file-model="ppls"/></span>
                    </div>

                    <div layout="row" flex="100">
                    <span layout="column" flex="30">Projected Cash Flow Statement</span><span flex="5"></span><span><input ng-required="cear_request.cear_conformation=='YES'" multiple type="file" file-model="pcfs" name="pcfs"/></span>
                    </div>

                    <div layout="row" flex="100">
                    <span layout="column" flex="30">Funding Option and Impact on Balance Sheet</span><span flex="5"></span><span><input ng-required="cear_request.cear_conformation=='YES'" multiple type="file" file-model="foaibs" name="foaibs"/></span>
                    </div>

                    <div layout="row" flex="100">
                    <span layout="column" flex="30">Payback Period</span><span flex="5"></span><span><input ng-required="cear_request.cear_conformation=='YES'" multiple type="file" file-model="pp" name="pp"/></span>
                    </div>

                    <div layout="row" flex="100">
                    <span layout="column" flex="30">Return on Investment/IRR</span><span flex="5"></span><span><input ng-required="cear_request.cear_conformation=='YES'" multiple type="file" file-model="roiirr" name="roiirr"/></span><br>
                    </div>
                </div>

                <h5 flex class="sub_heading-style-respond">Project/Other Details</h5>
                <div layout="row">
                    <div>
                        <label>Scope of the Project</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.scope_prj" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div>
                        <label>Purpose & Justification</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.purpose_justification" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label>Alternative Considered</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.alernative_considered" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div>
                        <label>Consequence of Not Approving Expenditure</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.cnae"  md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label>Effect on Operating Budget/Expenses</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.eobe" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div>
                        <label>Equipment Purchase</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.equp_purcg"  md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>


                <div layout="row">
                    <div>
                        <label>Conclusion</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.conclusion"  md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>

                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="addCear(cear_request)" ng-disabled="CearRequestForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>


         </div>
    </md-dialog-content>
</md-dialog>