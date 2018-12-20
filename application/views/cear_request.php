<?PHP defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">CEAR Request</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="CearRequestForm" flex="95" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <mdp-date-picker mdp-placeholder="Date*" class="md-block" flex-gt-sm flex="45" mdp-format="DD-MM-YYYY" ng-model="cear_request.date" >
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container  class="md-block" flex-gt-sm flex="45">
                        <label>Category </label>
                        <md-select ng-model="cear_request.category" name="Category">
                            <md-option ng-repeat="cear_category in cear_categorys"  ng-value="cear_category.CODE">
                                {{cear_category.NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="90">
                        <label>Project Title</label>
                        <input type="text"  required ng-model="cear_request.prj_title" name="prj_title" aria-label="prj_title"/>
                        <div ng-messages="CearRequestForm.prj_title.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="90">
                        <label>Requesting Unit</label>
                            <md-select name="req_unit" required ng-model="cear_request.req_unit" aria-label="req_unit">
                                <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs |
              filter:searchTerm">{{branch.BRANCH_NAME}}</md-option>
                            </md-select>
                        <div ng-messages="CearRequestForm.req_unit.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="90">
                        <label>Requesting Department</label>
                        <md-select required ng-model="cear_request.req_dept" name="req_dept" aria-label="req_dept">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                        <div ng-messages="CearRequestForm.req_dept.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div layout="row">
                    <div>
                        <label> SCOPE OF THE PROJECT</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.scope_prj" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div>
                        <label>PURPOSE & JUSTIFICATION</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.purpose_justification" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label> ALTERNATIVE CONSIDERD</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.alernative_considered" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div>
                        <label>CONSEQUENCE OF NOT APPROVING EXPENDITURE</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.cnae"  md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label> EFFECT ON OPERATING BUDGET / EXPENCES</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.eobe" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <div>
                        <label>EQUIPMENT PURCHASE</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="cear_request.equp_purcg"  md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>

                    <div layout="row" flex>
                        <md-input-container  class="md-block" flex-gt-sm flex="45">
                            <label>Details Attaches </label>
                            <md-select ng-model="cear_request.cear_conformation" name="Details">
                                <md-option ng-repeat="cear_conformation in cear_conformations"  ng-value="cear_conformation">
                                    {{cear_conformation}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <mdp-date-picker mdp-placeholder=" Start Date*" class="md-block"  flex="45" mdp-format="DD-MM-YYYY" ng-model="cear_request.sdate" >
                        </mdp-date-picker>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <mdp-date-picker mdp-placeholder="Complete Date*" class="md-block"  flex="45" mdp-format="DD-MM-YYYY" ng-model="cear_request.cdate" >
                        </mdp-date-picker>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="90">
                            <label>COST CENTRE TO BE CHARGED</label>
                            <input type="text"  required ng-model="cear_request.cost" name="amount" aria-label="amount"/>
                            <div ng-messages="CearRequestForm.amount.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                <div style="border: 1px solid #000" flex>
                <span> &nbsp; &nbsp;&nbsp;Projected Profit & Loss Statement</span><br>
                <span> &nbsp; &nbsp;&nbsp;Projected Cash Flow Statement</span><br>
                <span> &nbsp;&nbsp;&nbsp; Funding Option and Impact on Balance Sheet</span><br>
                <span> &nbsp;&nbsp;&nbsp; Payback Period</span><br>
                <span> &nbsp;&nbsp;&nbsp; Return on Investement /IRR</span><br>
                </div>
                <div layout="row">
                    <div>
                        <label>CONCLUSION</label>
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
    </div>
</md-content>