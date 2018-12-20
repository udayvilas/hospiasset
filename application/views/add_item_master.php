<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="inputs" layout-wrap>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Item Model</h3>

        <div class="md-whiteframe-2dp mylayout-padding" style="border-radius:5px;">
            <form name="AddDeviceLabel" method="POST">
                <h5 flex class="sub_heading-style-respond">Organization Label Details:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <!--<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Org Name</label>
                        <md-select ng-model="add_device_label.org_id" name="org_id"    aria-label="org_id">
                            <md-option ng-repeat="hospital in hospitals" ng-value="hospital.ORG_ID">
                                {{hospital.ORG_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>-->
                    <!--<div flex="5" hide-xs hide-sm><!-- Space --><!--</div>-->
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Org Module</label>
                        <md-select ng-model="add_item_master.module_id" name="module_id" aria-label="module_id">
                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">
                                {{hamodule.MODULE_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <!--<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Table Name</label>ng-change="gettablesbymodule(add_item_master.module_id)"
                        <md-select ng-model="add_item_master.table_id" name="table_id"    aria-label="table_id">
                            <md-option ng-repeat="table in module_table" ng-value="table.TBL_ID">
                                {{table.TABLE_DESC}}
                            </md-option>
                        </md-select>
                    </md-input-container>-->
                    
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Master table Names</label>
                        <md-select ng-model="add_item_master.master_table_id" name="master_table_id"    aria-label="master_table_id">
                            <md-option ng-repeat="master in mastertables" ng-value="master.MASTER_ID">
                                {{master.MASTER_TABLE_DESC}}
                            </md-option>
                        </md-select>
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>

                <h5 flex class="sub_heading-style-respond">Item Module details</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>FIELD TYPE</label>
                        <md-select ng-model="add_item_master.field_type" name="field_type" aria-label="field_type">
                            <md-option ng-repeat="datatype in datatypes" ng-value="datatype.DATA_TYPE_KEY">
                                {{datatype.DATA_TYPE_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
					<!--<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>FIELD TYPE</label>
                        <input type="text"  ng-model="add_item_master.field_type"   name="field_type" aria-label="field_type" md-autofocus="autofocus" />
                    </md-input-container>-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>FIELD DESC</label>
                        <input type="text"  ng-model="add_item_master.field_desc"  name="field_desc" aria-label="label_2" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>DBFIELD</label>
                        <input type="text"  ng-model="add_item_master.db_field" name="db_field"   aria-label="db_field" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>FIELDID</label>
                        <input type="text"  ng-model="add_item_master.field_id" name="field_id"   aria-label="field_id" md-autofocus="autofocus" />
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Mandatory</label>
                        <input type="text"  ng-model="add_item_master.mandatory" name="mandatory"   aria-label="mandatory" md-autofocus="autofocus" />
                    </md-input-container>
                     <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>DISABLED</label>
                        <input type="text"  ng-model="add_item_master.disabled" name="disabled"  aria-label="disabled" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>MAX_OPT</label>
                        <input type="text"  ng-model="add_item_master.max_opt" name="max_opt"  aria-label="max_opt" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT1</label>
                        <input type="text"  ng-model="add_item_master.opt1" name="opt1"  aria-label="opt1" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                   
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT2</label>
                        <input type="text"  ng-model="add_item_master.opt2" name="opt2" aria-label="opt2" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT3</label>
                        <input type="text"  ng-model="add_item_master.opt3" name="opt3"   aria-label="opt3" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT4</label>
                        <input type="text"  ng-model="add_item_master.opt4" name="opt4"   aria-label="opt4" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT5</label>
                        <input type="text"  ng-model="add_item_master.opt5" name="opt5"  aria-label="opt5" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT6</label>
                        <input type="text"  ng-model="add_item_master.opt6" name="opt6"   aria-label="opt6" md-autofocus="autofocus" />
                    </md-input-container>
                   <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT7</label>
                        <input type="text"  ng-model="add_item_master.opt7" name="opt7"  aria-label="opt7" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT8</label>
                        <input type="text"  ng-model="add_item_master.opt8"  name="opt8" aria-label="opt8" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                  
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT9</label>
                        <input type="text"  ng-model="add_item_master.opt9" name="opt9"  aria-label="opt9" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT10</label>
                        <input type="text"  ng-model="add_item_master.opt10" name="opt10"   aria-label="opt10" md-autofocus="autofocus" />
                    </md-input-container>
                   <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT11</label>
                        <input type="text"  ng-model="add_item_master.opt11" name="opt11"  aria-label="opt11" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT12</label>
                        <input type="text"  ng-model="add_item_master.opt12" name="opt12"  aria-label="opt12" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT13</label>
                        <input type="text"  ng-model="add_item_master.opt13" name="opt13"  aria-label="opt13" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                   
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT14</label>
                        <input type="text"  ng-model="add_item_master.opt14" name="opt14"  aria-label="opt14" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT15</label>
                        <input type="text"  ng-model="add_item_master.opt15" name="opt15"  aria-label="opt15" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT16</label>
                        <input type="text"  ng-model="add_item_master.opt16" name="opt16"  aria-label="opt16" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT17</label>
                        <input type="text"  ng-model="add_item_master.opt17" name="opt17"  aria-label="opt17" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT18</label>
                        <input type="text"  ng-model="add_item_master.opt18" name="opt18"  aria-label="opt18" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT19</label>
                        <input type="text"  ng-model="add_item_master.opt19" name="opt19"  aria-label="opt19" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT20</label>
                        <input type="text"  ng-model="add_item_master.opt20" name="opt20"  aria-label="opt20" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT21</label>
                        <input type="text"  ng-model="add_item_master.opt21" name="opt21"  aria-label="opt21" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT22</label>
                        <input type="text"  ng-model="add_item_master.opt22" name="opt22"  aria-label="opt22" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT23</label>
                        <input type="text"  ng-model="add_item_master.opt23" name="opt23"  aria-label="opt23" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT24</label>
                        <input type="text"  ng-model="add_item_master.opt24" name="opt24"  aria-label="opt24" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>OPT25</label>
                        <input type="text"  ng-model="add_item_master.opt25" name="opt25"  aria-label="opt25" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                
                    
               


                <div class="row" style="margin-top: 15px;">
                    <div flex layout="row" layout-align="center center">
                        <!--    <input type="submit" class="md-button md-raised md-accent" layout-align="center center" ng-disabled="AddDevice.$invalid" ng-click="SaveDevice(add_device,'save_device')" aria-label="button" value="Save">-->
                        <input type="submit" class="md-button md-raised md-accent"   layout-align="center center" ng-click="additemmaster(add_item_master)"  aria-label="buttonsd" value="Save">
                        <md-button class="md-raised md-default" aria-label="submit"  ui-sref="home.hadmin_item_master">Cancel</md-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</md-content>