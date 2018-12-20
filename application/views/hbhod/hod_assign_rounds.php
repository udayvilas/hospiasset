<?php defined('BASEPATH') OR exit('No direct script access allowed');?>



<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>

    <div layout="column">

        <h3 class="heading-stylerespond">Rounds Assign</h3>

        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>

        <div flex layout="row" layout-align="center center">

            <form method="POST" name="RoundsassignForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div flex layout="row">

                  <md-input-container class="md-block" flex-gt-sm flex="30">

                       <label>Select Branch *</label>

                       <md-select ng-model="round_assign.branch_id" name="branch_id" aria-label="branch_id" ng-required="round_assign.branch_id !=''" ng-change="getHodBmes(round_assign.branch_id);">

                           <md-option ng-repeat="branch in branchs" ng-if="branch.BRANCH_ID !='All'" ng-value="branch.BRANCH_ID">
                               {{branch.BRANCH_NAME}}
                       </md-option>

                       </md-select>

                   </md-input-container>

                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30" ng-init="round_assign={status:rounds_status[0],current_date:myDate}">

                        <label>Type</label>

                        <md-select ng-required="user_role_code==HBHOD" ng-model="round_assign.status" name="status" ng-disabled="true">

                            <md-option ng-repeat="rstatus in rounds_status"  ng-value="rstatus">

                                <span style="text-transform:capitalize;">{{rstatus}}</span>

                            </md-option>

                        </md-select>

                        <div class="md-errors-spacer"></div>

                        <div ng-messages="RoundsassignForm.status.$error" md-auto-hide="true">

                            <div ng-message="required">Required</div>

                        </div>

                    </md-input-container>



                    <div flex="10" hide-xs hide-sm><!-- Space --></div>



                    <mdp-date-picker mdp-disabled="true" flex="30" mdp-placeholder="Date" class="md-block" flex-gt-sm mdp-format="DD-MM-YYYY" ng-model="round_assign.current_date" mdp-min-date="maxDate"> </mdp-date-picker>



                </div>





                <div layout="row">

                    <md-input-container class="md-block" flex-gt-sm flex="45">

                        <label>Assign to</label>

                        <md-select ng-model="round_assign.assign_to" name="assign_to" required name="assign_to">

                            <md-option ng-if="round_assign.assignfrom!=bmehod.USER_ID"   ng-repeat="bmehod in bmehods" ng-value="bmehod.USER_ID">

                                {{bmehod.USER_NAME}}

                            </md-option>

                            <md-option ng-value="user_id">

                                {{user_name}}

                            </md-option>

                        </md-select>

                        <div class="md-errors-spacer"></div>

                        <div ng-messages="RoundsassignForm.assign_to.$error" md-auto-hide="true">

                            <div ng-message="required">Required</div>

                        </div>

                    </md-input-container>

                    <div flex="10" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container  flex="45">

                        <label>Department</label>

                        <md-select multiple ng-model="round_assign.depts" required name="depts">

                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">

                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})

                            </md-option>

                        </md-select>

                    </md-input-container>

                </div>





                <div layout="row">

                   <!-- <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">
                        <input type="file" file-model="rounds_docs"  />

                    <ul style="margin-top: 15px;">
                        <li ng-repeat="rounds_doc in rounds_docs">{{rounds_doc.name}}</li>
                    </ul>
                    </div>
                    <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">
                        <input type="file" file-model="docs_rounds"  />
                        <ul style="margin-top: 15px;">
                            <li ng-repeat="docs_round in docs_rounds">{{docs_round.name}}</li>
                        </ul>
                    </div>--->


                    <!--<ul style="margin-top: 15px;">
                        <li ng-repeat="imag in image">{{image}}</li>
                    </ul>--->



                    <md-input-container   class="md-block" flex-gt-sm flex="45">

                        <label>Remarks</label>

                        <input  ng-model="round_assign.remarks">

                    </md-input-container>

                </div>

                <div flex layout="row" layout-align="center center">

                    <center>

                        <md-button class="md-raised md-accent" ng-click="RoundAssign(round_assign)" ng-disabled="RoundsassignForm.$invalid" aria-label="submit">Submit</md-button>

                    </center>

                    <center>

                        <md-button class="md-raised md-default" ui-sref="home.{{user_role_code | lowercase}}_rounds_complete" aria-label="cancel">Cancel</md-button>

                    </center>

                </div>

            </form>

        </div>

    </div>

</md-content>