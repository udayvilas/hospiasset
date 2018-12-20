<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>

<md-dialog aria-label="dialog-box" flex="50" ng-clock>

    <md-toolbar>

        <div class="md-toolbar-tools">

            <h4>Adverse Incident Approval</h4>

            <span flex></span>

            <md-button class="md-icon-button" ng-click="cancel()">

                <md-icon md-font-set="material-icons">clear</md-icon>

            </md-button>

        </div>

    </md-toolbar>



    <md-dialog-content flex layout-align="center center">

        <div class="md-dialog-content">

            <div flex layout="row" layout-align="center center">

                <md-input-container class="md-block" flex-gt-sm flex="30">

                    <label>Approval Status</label>

                    <md-select ng-model="aindent_status" name="indent_status">

                        <md-option ng-repeat="indent_status in indent_statuss_new" ng-value="indent_status.value">

                            {{indent_status.key}}

                        </md-option>

                    </md-select>
					<!--div ng-messages="EdirObsertDialog.cause_probability.$error">

                                <div ng-message="required">Required.</div>
                            </div>--->

                </md-input-container>

            </div>

            <div flex="100" layout="row" layout-align="center center">

                <form method="POST" name="EdirObsertDialog" flex="100" autocomplete="off">

                    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap style="margin-top:15px;">

                        <md-input-container class="md-block" flex-gt-sm flex="20">

                            <label>Serial Number</label>

                            <input type="text" ng-model="approve_adv_ind.serial_no" ng-disabled="true" aria-label="SERIAL NO"/>

                        </md-input-container>

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm flex="20">

                            <label>Contract Type</label>

                            <input type="text" ng-model="approve_adv_ind.contract_type" ng-disabled="true" aria-label="Contract Type"/>

                        </md-input-container>

                        <!--</div>-->

                        <div flex="5" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container flex="50">

                            <label>Manufacturer</label>

                            <input type="text" ng-model="approve_adv_ind.company_name" ng-disabled="true" aria-label="C_NAME"/>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container style="margin-top:15px;" class="md-block" flex-gt-sm>

                            <label>Equipment Name</label>

                            <input type="text" ng-model="approve_adv_ind.eq_name" ng-disabled="true" aria-label="CALLER_ID"/>

                        </md-input-container>

                        <div flex="10" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Equipment ID</label>

                            <input type="text" ng-disabled="true" name="EID" ng-model="user_org == approve_adv_ind.ORG_ID ? approve_adv_ind.EQUP_ID : approve_adv_ind.ASSIGN_ID" aria-label="EID"/>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Equipment Status</label>

                            <input type="text" ng-disabled="true" ng-model="ticket_sts1[1]" name="STATUS" aria-label="STATUS"/>

                        </md-input-container>

                        <div flex="10" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Assigned To</label>

                            <input type="text" ng-disabled="true" ng-model="user_name" aria-label="STATUS"/>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Observations</label>

                            <textarea ng-model="approve_adv_ind.observation" name="observation" rows="5" md-select-on-focus> </textarea>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm >

                            <label>Incharge Comment</label>

                            <textarea ng-model="approve_adv_ind.icomment" name="icomment" rows="5" md-select-on-focus> </textarea>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Occurrence Report</label>

                            <textarea ng-model="approve_adv_ind.report" name="report" rows="5" md-select-on-focus> </textarea>

                        </md-input-container>

                    </div>

                    <div layout="row">



                        <md-input-container class="md-block" flex-gt-sm >

                            <label>Spares</label>

                            <input type="text" ng-model="approve_adv_ind.spares" name="spares" aria-label="spares"/>

                        </md-input-container>

                        <div flex="10" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm >

                            <label>Accessories</label>

                            <input type="text"  ng-model="approve_adv_ind.accessories" name="accessories" aria-label="accessories"/>

                        </md-input-container>

                    </div>

                    <div flex layout="row">





                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Approximate Cost</label>

                            <input type="text" ng-model="approve_adv_ind.acost" name="acost" aria-label="acost" only-digits="only-digits"/>

                        </md-input-container>

                        <div flex="10" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Total Cost</label>

                            <input type="text"  ng-model="approve_adv_ind.tcost" name="tcost" aria-label="tcost" only-digits="only-digits"/>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Remarks</label>

                            <textarea ng-model="approve_adv_ind.observationscompleteremarks" rows="5" md-select-on-focus></textarea>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm flex="45">

                            <label>Nature of the Report*</label>

                            <md-select name="nreport" ng-model="approve_adv_ind.nreport"  required aria-label="nreport">

                                <md-option  ng-value="nreport" ng-repeat="nreport in nreports">{{nreport}}</md-option>

                            </md-select>
                            <div ng-messages="EdirObsertDialog.nreport.$error">

                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>

                        <div flex="10" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm flex="45">

                            <label>Cause probability*</label>

                            <md-select name="nreport" ng-model="approve_adv_ind.cause_probability" name="cause_probability" required aria-label="cause_probabilitys">

                                <md-option ng-value="cause_probability" ng-repeat="cause_probability in cause_probabilitys">{{cause_probability}}</md-option>

                            </md-select>
                            <div ng-messages="EdirObsertDialog.cause_probability.$error">

                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>

                    </div>
                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm >

                            <label> Operator Name </label>



                            <input type="text" ng-model="approve_adv_ind.operator_name" required name="operator_name" aria-label="operator_name"/>
                            <div ng-messages="EdirObsertDialog.operator_name.$error">

                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>

                        <div flex="10" hide-xs hide-sm><!-- Space --></div>

                        <md-input-container class="md-block" flex-gt-sm >

                            <label>Exp. Restoration time (days)</label>

                            <input type="number" ng-model="approve_adv_ind.eexp_Restorations" name="eexp_Restorations" aria-label="eexp_Restorations"/>

                            <div ng-messages="EdirObsertDialog.eexp_Restorations.$error">

                                <div ng-message="required">Required.</div>

                            </div>

                        </md-input-container>

                    </div>



                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Chief Engineer’s observations</label>

                            <textarea ng-model="approve_adv_ind.ceobser" rows="5" md-select-on-focus></textarea>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Operator’s observations</label>

                            <textarea ng-model="approve_adv_ind.ope_obser" rows="5" md-select-on-focus></textarea>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Conclusions</label>

                            <textarea ng-model="approve_adv_ind.conclusion" rows="5" md-select-on-focus></textarea>

                        </md-input-container>

                    </div>

                    <div layout="row">

                        <md-input-container class="md-block" flex-gt-sm>

                            <label>Action Tacken</label>

                            <textarea ng-model="approve_adv_ind.action_taken" rows="5"  name="action_taken" required md-select-on-focus></textarea>
                            <div ng-messages="EdirObsertDialog.action_taken.$error">

                                <div ng-message="required">Required.</div>

                        </md-input-container>

                    </div>

                    <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="UpdateAdverseIncedents(approve_adv_ind,aindent_status)" ng-disabled="EdirObsertDialog.$invalid" aria-label="submit" style="float:left">Submit</md-button>

                        <div flex="2" hide-xs hide-sm><!-- Space --></div>

                        <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>

                    </div>

                </form>

            </div>

        </div>

    </md-dialog-content>

</md-dialog>