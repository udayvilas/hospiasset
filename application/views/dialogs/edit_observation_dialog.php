<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Observation Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <md-tabs md-dynamic-height md-border-bottom>
                <md-tab md-primary label="Complete"><!--Observations Complete -->
                    <md-content>
            <form method="POST" name="EdirObsertDialog" flex="100" autocomplete="off">
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap style="margin-top:15px;">
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Serial Number</label>
                        <input type="text" ng-model="edit_obser.serial_no" ng-disabled="true" aria-label="SERIAL NO"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Contract Type</label>
                        <input type="text" ng-model="edit_obser.contract_type" ng-disabled="true" aria-label="Contract Type"/>
                    </md-input-container>
                    <!--</div>-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container flex="50">
                        <label>Manufacturer</label>
                        <input type="text" ng-model="edit_obser.company_name" ng-disabled="true" aria-label="C_NAME"/>
                    </md-input-container>
                  </div>
                <div layout="row">
                    <md-input-container style="margin-top:15px;" class="md-block" flex-gt-sm>
                        <label>Equipment Name</label>
                        <input type="text" ng-model="edit_obser.eq_name" ng-disabled="true" aria-label="CALLER_ID"/>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Equipment ID</label>
                        <input type="text" ng-disabled="true" name="EID" ng-model="edit_obser.EQUP_ID" aria-label="EID"/>
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
                        <textarea ng-model="edit_obser.observation" name="observation"  rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="EdirObsertDialog.observation.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm >
                        <label>Incharge Comment</label>
                        <textarea ng-model="edit_obser.icomment" name="icomment" rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="EdirObsertDialog.icomment.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
            <div layout="row">
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Occurance Report</label>
                    <textarea ng-model="edit_obser.report" name="report" rows="5" md-select-on-focus> </textarea>
                    <div ng-messages="EdirObsertDialog.report.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                </div>
                <div layout="row">

                <md-input-container class="md-block" flex-gt-sm >
                    <label>Spares *</label>
              <!--      <md-select name="spares" required ng-model="edit_obser.spares" aria-label="spares">
                        <md-option ng-value="nullValue">Select Sparees</md-option>
                        <md-option  ng-value="m_critical_spare.CODE" ng-repeat="m_critical_spare in m_critical_spares">{{m_critical_spare.NAME}}</md-option>
                    </md-select>-->
                    <input type="text"  ng-model="edit_obser.spares" name="spares" aria-label="spares"/>
                    <div ng-messages="EdirObsertDialog.spares.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm >
                        <label>Accessories *</label>
                        <input type="text"  ng-model="edit_obser.accessories" name="accessories" aria-label="accessories"/>
                        <!--    <md-select name="roleid" required ng-model="edit_obser.accessories" aria-label="accessories">
                                <md-option  ng-value="m_accessorie.CODE" ng-repeat="m_accessorie in m_accessories">{{m_accessorie.NAME}}</md-option>
                            </md-select>-->
                        <div ng-messages="EdirObsertDialog.accessories.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
            </div>
                <div flex layout="row">


                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Approximate Cost</label>
                        <input type="text"  ng-model="edit_obser.acost" name="acost" aria-label="acost" only-digits="only-digits"/>
                        <div ng-messages="EdirObsertDialog.acost.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Total Cost</label>
                        <input type="text"  ng-model="edit_obser.tcost" name="tcost" aria-label="tcost" only-digits="only-digits"/>
                        <div ng-messages="EdirObsertDialog.tcost.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Remarks</label>
                        <textarea ng-model="edit_obser.observationscompleteremarks" rows="5" md-select-on-focus></textarea>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Nature of the Report*</label>
                        <md-select name="nreport" required ng-model="edit_obser.nreport" aria-label="nreport">
                            <md-option  ng-value="nreport" ng-repeat="nreport in nreports">{{nreport}}</md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Cause probability*</label>
                        <md-select name="nreport" required ng-model="edit_obser.cause_probability" aria-label="cause_probabilitys">
                            <md-option  ng-value="cause_probability" ng-repeat="cause_probability in cause_probabilitys">{{cause_probability}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm >
                        <label> Operator Name *</label>

                        <input type="text"  ng-model="edit_obser.operator_name" required name="operator_name" aria-label="operator_name"/>
                        <div ng-messages="EdirObsertDialog.operator_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm >
                        <label>Exp. Restoration time (days)</label>
                        <input type="number"  ng-model="edit_obser.eexp_Restorations" required name="eexp_Restorations" aria-label="eexp_Restorations"/>
                        <div ng-messages="EdirObsertDialog.eexp_Restorations.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Chief Engineer’s observations</label>
                        <textarea ng-model="edit_obser.ceobser" rows="5" md-select-on-focus></textarea>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Operator’s observations</label>
                        <textarea ng-model="edit_obser.ope_obser" rows="5" md-select-on-focus></textarea>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Conclusions</label>
                        <textarea ng-model="edit_obser.conclusion" rows="5" md-select-on-focus></textarea>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Action Tacken</label>
                        <textarea ng-model="edit_obser.action_taken" required rows="5" md-select-on-focus></textarea>
						 <div ng-messages="EdirObsertDialog.eexp_Restorations.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                        <md-button class="md-raised md-accent" ng-click="UpdateObservations(edit_obser)" ng-disabled="EdirObsertDialog.$invalid" aria-label="submit" style="float:left">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </md-content>
        </md-tab> <!-- Completed Tab End -->

                <md-tab md-primary label="Assign"><!-- Assign observations Tab Begin -->
                    <md-content>
                        <form layout="column" name="Observationassign" autocomplete="off" ng-cloak>
                            <div layout="column">
                                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap style="margin-top:15px;">
                                    <md-input-container class="md-block" flex-gt-sm flex="30">
                                        <label>Serial Number</label>
                                        <input type="text" ng-model="edit_obser.serial_no" ng-disabled="true" aria-label="SERIAL NO"/>
                                    </md-input-container>
                                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                                    <md-input-container class="md-block" flex-gt-sm flex="30" >
                                        <label>Contract Type</label>
                                    <input type="text" ng-model="edit_obser.contract_type" ng-disabled="true" aria-label="Contract Type"/>
                                    </md-input-container>
                                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                                    <md-input-container flex="30">
                                        <label>Manufacturer</label>
                                        <input type="text" ng-model="edit_obser.company_name" ng-disabled="true" aria-label="C_NAME"/>
                                    </md-input-container>
                                </div>
                                <md-input-container style="margin-top:15px;">
                                    <label>Equipment Name</label>
                                    <input type="text" ng-model="edit_obser.eq_name" ng-disabled="true" aria-label="CALLER_ID"/>
                                </md-input-container>

                                <md-input-container class="md-block" flex-gt-sm>
                                    <label>Equipment ID</label>
                                    <input type="text" ng-disabled="true" ng-model="edit_obser.EQUP_ID" aria-label="EID"/>
                                </md-input-container>

                                <md-input-container class="md-block" flex-gt-sm>
                                    <label>Equipment Status</label>
                                    <input type="text" ng-disabled="true" ng-model="ticket_sts1[1]" aria-label="STATUS"/>
                                </md-input-container>

                                <!--<md-input-container class="md-block" flex-gt-sm flex="50" layout-align="center center">
                                    <label>Assign To</label>
                                    <md-select ng-model="edit_obser.assignto" required name="Assignto" >
                                        <md-option ng-repeat="bmehod in bmehods" ng-value="bmehod.USER_ID">
                                            {{bmehod.USER_NAME}}
                                        </md-option>
                                    </md-select>
                                    <div class="md-errors-spacer"></div>
                                    <div ng-messages="Observationassign.Assignto.$error" md-auto-hide="true">
                                        <div ng-message="required">Required</div>
                                    </div>
                                </md-input-container>--->																							
								<div class="md-block"  flex="25">     
								<label>Assign Call To</label>           
								<input  type="radio" ng-model="assign_call" value="user"/>USER   
								<input  type="radio" ng-model="assign_call" value="vendor"/>VENDOR     
								</div>                          
								<md-autocomplete ng-if="assign_call == 'user'" class="md-block" flex-gt-sm flex="25"			
								ng-value="edit_obser.assignto==searched.USER_ID"  
								md-no-cache="true"		
                                md-input-name="user"
                                required								
								ng-change ="assign_call==user_id='';"     
								md-selected-item="searched.USER_ID"   
								md-search-text="searchUSER_NAME"     
								md-items="item in searchTextChange(searchUSER_NAME)"  
								md-item-text="item.USER_NAME"              
								md-min-length="0"                          
								md-floating-label=" User. id">            
								<md-item-template>                       
								<span md-highlight-text="searchText"  md-highlight-flags="^i">{{item.USER_NAME}}</span>                            
								<div ng-messages="Observationassign.user.$error">
								<div ng-message="required">Required.</div>
								</div>
								</md-item-template>       
								<md-not-found>         
								No User Found        
								</md-not-found>      
								</md-autocomplete>		
								<md-autocomplete ng-if="assign_call == 'vendor'"" class="md-block" 
								flex-gt-sm flex="25"					
								ng-value="edit_obser.assignto==searched.ORG_ID"
                                required								
                                md-input-name='vendor'								
								md-no-cache="true"				
								ng-change="assign_call == vendor = '';"   
								md-selected-item="searched.ORG_ID"  
								md-search-text="searchORG_NAME"   
								md-items="item in searchTextChange(searchORG_NAME,'up')"  
								md-item-text="item.ORG_NAME"       
								md-min-length="0"              
								md-floating-label="Vendor. id">      
								<md-item-template>             
								<span md-highlight-text="searchText"  md-highlight-flags="^i">{{item.ORG_NAME}}</span>                        
								<div ng-messages="Observationassign.vendor.$error">
								<div ng-message="required">Required.</div>
								</div>
								</md-item-template>                          
								
								<md-not-found>      
								No Vendor Found      
								</md-not-found>     
								</md-autocomplete>	
								<span ng-value="edit_obser.assignto = searched.ORG_ID.ORG_ID" ng-if="assign_call == 'vendor'" ></span>           
								<span ng-value="edit_obser.assignto = searched.USER_ID.USER_ID" ng-if="assign_call == 'user'" ></span>     								

                                <md-input-container class="md-block" flex-gt-sm>
                                    <label>Remarks</label>
                                    <textarea ng-model="edit_obser.observationsassignremarks" rows="5" md-select-on-focus></textarea>
                                </md-input-container>

                                <div layout="row" layout-align="center center">
                                    <input type="submit" value="Submit" class="md-raised md-accent md-button md-ink-ripple" ng-click="AssignObservations(edit_obser)" ng-disabled="Observationassign.$invalid" aria-label="Assign" />
                                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                                </div>
                            </div>
                        </form>
                    </md-content>
                </md-tab> <!-- Assign Tab End -->
        </md-tabs>
    </md-dialog-content>
</md-dialog>