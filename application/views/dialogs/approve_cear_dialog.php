<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="100" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Approve CEAR</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
                <form method="POST" name="approveCearForm" flex="95" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <h5 flex class="sub_heading-style-respond">Cear Basic Details</h5>
                <div layout="row">
                    <mdp-date-picker mdp-disabled="true" mdp-placeholder="Date*" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="approve_cear.esdate" >
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>CEAR Number</label>
                        <input ng-disabled="true" type="text" ng-model="approve_cear.cear_number" name="cear_number" aria-label="cear_number"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container  class="md-block" flex-gt-sm flex="20">
                        <label>Category</label>
                        <md-select ng-disabled="true" ng-model="approve_cear.category" name="Category">
                            <md-option ng-repeat="cear_category in cear_categorys"  ng-value="cear_category.CODE">
                                {{cear_category.NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Project Title</label>
                        <input ng-disabled="true" type="text" ng-model="approve_cear.prj_title" name="prj_title" aria-label="prj_title"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>Requesting Unit</label>
                        <input type="text" ng-disabled="true" name="req_unit" ng-model="approve_cear.branch_name" aria-label="req_unit">

                    </md-input-container>
                </div>
                <div style="margin-top:20px;"></div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Department</label>
                        <md-select ng-disabled="true" ng-model="approve_cear.req_dept" name="req_dept">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker mdp-disabled="true" mdp-placeholder=" Start Date*" class="md-block"  flex="15" mdp-format="DD-MM-YYYY" ng-model="approve_cear.edate" >
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker mdp-disabled="true" mdp-placeholder="Complete Date*" class="md-block"  flex="15" mdp-format="DD-MM-YYYY" ng-model="approve_cear.ecdate" >
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>Cost Centre to be Charged</label>
                        <input type="text" ng-disabled="true" ng-model="approve_cear.cost" name="cost" aria-label="cost"/>
                        <div ng-messages="approveCearForm.cost.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container  class="md-block" flex-gt-sm flex="15">
                        <label>Details Attaches </label>
                        <md-select ng-disabled="true" ng-model="approve_cear.cear_conformation" name="Details">
                            <md-option ng-repeat="cear_conformation in cear_conformations"  ng-value="cear_conformation">
                                {{cear_conformation}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <div style="margin-top:20px;"></div>
                    <div ng-show="approve_cear.cear_conformation=='YES'" layout="row" style="border: 0px solid #000" flex="100" layout-wrap>
                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Projected Profit & Loss Statement </span><span flex="5"></span><span><input ng-required="approve_cear.cear_conformation=='YES'" multiple name="ppls" type="file" file-model="ppls"/></span>
                        </div>

                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Projected Cash Flow Statement </span><span flex="5"></span><span><input ng-required="approve_cear.cear_conformation=='YES'" multiple type="file" file-model="pcfs" name="pcfs"/></span>
                        </div>

                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Funding Option and Impact on Balance Sheet </span><span flex="5"></span><span><input ng-required="approve_cear.cear_conformation=='YES'" multiple type="file" file-model="foaibs" name="foaibs"/></span>
                        </div>

                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Payback Period </span><span flex="5"></span><span><input ng-required="approve_cear.cear_conformation=='YES'" multiple type="file" file-model="pp" name="pp"/></span>
                        </div>

                        <div layout="row" flex="100">
                            <span layout="column" flex="30">Return on Investment/IRR </span><span flex="5"></span><span><input ng-required="approve_cear.cear_conformation=='YES'" multiple type="file" file-model="roiirr" name="roiirr"/></span><br>
                        </div>
                    </div>
                <h5 flex class="sub_heading-style-respond">Project / Other Details</h5>

                <div style="margin-top:20px;"></div>
                <div layout="row">
                    <div flex>
                        <label>Scope of the Project</label>
                        <md-input-container class="md-block">
                            <textarea ng-disabled="true" ng-model="approve_cear.scope_prj"></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div flex>
                        <label>Purpose & Justification</label>
                        <md-input-container class="md-block">
                            <textarea ng-disabled="true" ng-model="approve_cear.purpose_justification"></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div flex>
                        <label>Alternative Considered</label>
                        <md-input-container class="md-block">
                            <textarea ng-disabled="true"  ng-model="approve_cear.alernative_considered"></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div flex>
                        <label>Consequence of not Approving Expenditure</label>
                        <md-input-container class="md-block">
                            <textarea ng-disabled="true" ng-model="approve_cear.cnae"></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div flex>
                        <label>Effect on Operating Budget / EXPENCES</label>
                        <md-input-container class="md-block">
                            <textarea ng-disabled="true" ng-model="approve_cear.eobe"></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div flex>
                        <label>Equipment Purchase</label>
                        <md-input-container class="md-block">
                            <textarea ng-disabled="true" ng-model="approve_cear.equp_purcg"></textarea>
                        </md-input-container>
                    </div>
                </div>

                <div layout="row">
                    <div flex>
                        <label>Conclusion</label>
                        <md-input-container class="md-block">
                            <textarea ng-disabled="true"  ng-model="approve_cear.conclusion"></textarea>
                        </md-input-container>
                    </div>
                </div>

                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="ApproveupdateCear(approve_cear)" ng-disabled="approveCearForm.$invalid" aria-label="submit">Approve</md-button>
                        <md-button class="md-raised md-accent" ng-click="cancel()" aria-label="cancel">Cancel</md-button>
                    </center>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>