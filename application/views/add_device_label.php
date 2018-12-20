<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="inputs" layout-wrap>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Device Label</h3>

        <div class="md-whiteframe-2dp mylayout-padding" style="border-radius:5px;">
            <form name="AddDeviceLabel" method="POST">
                <h5 flex class="sub_heading-style-respond">Organization Label Details:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Org Name</label>
                        <md-select ng-model="add_device_label.org_id" name="org_id"    aria-label="org_id">
                            <md-option ng-repeat="hospital in hospitals" ng-value="hospital.ORG_ID">
                                {{hospital.ORG_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Org Module</label>
                        <md-select ng-model="add_device_label.module_id" name="module_id"     aria-label="module_id">
                            <md-option ng-repeat="hamodule in hamodules" ng-value="hamodule.MODULE_ID">
                                {{hamodule.MODULE_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Table Name</label>
                        <md-select ng-model="add_device_label.table_id" name="table_id"    aria-label="table_id">
                            <md-option ng-repeat="table in table_names" ng-value="table.TABLE_NAME">
                                {{table.TABLE_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>

                <h5 flex class="sub_heading-style-respond">Device Label Details:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <input type="radio" name="enable" ng-model="type" ng-value="0" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable1</label>
                        <input type="text"  ng-model="add_device_label.label_1"  ng-disabled="type != 0" name="label_1" aria-label="label_1" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="1" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable2</label>
                        <input type="text"  ng-model="add_device_label.label_2" ng-disabled="type != 1" name="label_2" aria-label="label_2" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="2" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable3</label>
                        <input type="text"  ng-model="add_device_label.label_3" name="label_3"  ng-disabled="type != 2" aria-label="label_3" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="3" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable4</label>
                        <input type="text"  ng-model="add_device_label.label_4" name="label_4"  ng-disabled="type != 3" aria-label="label_4" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="4" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable5</label>
                        <input type="text"  ng-model="add_device_label.label_5" name="label_5" ng-disabled="type != 4" aria-label="label_5" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="5" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable6</label>
                        <input type="text"  ng-model="add_device_label.label_6" name="label_6" ng-disabled="type != 5" aria-label="label_6" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="6" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable7</label>
                        <input type="text"  ng-model="add_device_label.label_7" name="label_7" ng-disabled="type != 6" aria-label="label_7" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="7" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable8</label>
                        <input type="text"  ng-model="add_device_label.label_8" name="label_8" ng-disabled="type != 7" aria-label="label_8" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="8" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable9</label>
                        <input type="text"  ng-model="add_device_label.label_9" name="label_9"  ng-disabled="type != 8" aria-label="label_9" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="9" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable10</label>
                        <input type="text"  ng-model="add_device_label.label_10" name="label_10"  ng-disabled="type != 9" aria-label="label_10" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="10" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable11</label>
                        <input type="text"  ng-model="add_device_label.label_11" name="label_11" ng-disabled="type != 10" aria-label="label_11" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="11" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable12</label>
                        <input type="text"  ng-model="add_device_label.label_12" name="label_12"  ng-disabled="type != 11" aria-label="label_12" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="12" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable13</label>
                        <input type="text"  ng-model="add_device_label.label_13" name="label_13" ng-disabled="type != 12" aria-label="label_13" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="13" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable14</label>
                        <input type="text"  ng-model="add_device_label.label_14" ng-disabled="type != 13" name="label_14" aria-label="label_14" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="14" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable15</label>
                        <input type="text"  ng-model="add_device_label.label_15" name="label_15" ng-disabled="type != 14" aria-label="label_15" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="15" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable16</label>
                        <input type="text"  ng-model="add_device_label.label_16" name="label_16"  ng-disabled="type != 15" ng-disabled="type != 15" aria-label="label_16" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="16" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable17</label>
                        <input type="text"  ng-model="add_device_label.label_17" name="label_17" ng-disabled="type != 16" aria-label="label_17" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="17" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable18</label>
                        <input type="text"  ng-model="add_device_label.label_18" name="label_18" ng-disabled="type != 17" aria-label="label_18" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="18" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable19</label>
                        <input type="text"  ng-model="add_device_label.label_19" name="label_19" ng-disabled="type != 18" aria-label="label_19" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="19" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable20</label>
                        <input type="text"  ng-model="add_device_label.label_19" name="desc" ng-disabled="type != 19" aria-label="label_20" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <h5 class="sub_heading-style-respond">AMC/CMC/Warranty Information:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <input type="radio" name="enable" ng-model="type" ng-value="20" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Lable21</label>
                        <input type="text"  ng-model="add_device_label.label_21" name="label_21"  ng-disabled="type != 20" aria-label="label_21"  md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="21" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label22</label>
                        <input type="text"  ng-model="add_device_label.label_22" name="label_22"  ng-disabled="type != 21" aria-label="label_22"  md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="22" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label23</label>
                        <input type="text"  ng-model="add_device_label.label_23" name="label_23"  ng-disabled="type != 22" aria-label="label_23"  md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="23" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label24</label>
                        <input type="text"  ng-model="add_device_label.label_24" name="label_24"  ng-disabled="type != 23" aria-label="label_24"  md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="24" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label25</label>
                        <input type="text"  ng-model="add_device_label.label_25" name="label_25"  ng-disabled="type != 24" aria-label="label_25"  md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="25" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label26</label>
                        <input type="text"  ng-model="add_device_label.label_26" name="label_26"  ng-disabled="type != 25" aria-label="label_26"  md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="26" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label27</label>
                        <input type="text"  ng-model="add_device_label.label_27" name="label_27"  ng-disabled="type != 26" aria-label="label_27"  md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="27" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label28</label>
                        <input type="text"  ng-model="add_device_label.label_28" name="label_28"  ng-disabled="type != 27" aria-label="label_28"  md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>


                </div>
                <h5 class="sub_heading-style-respond">Equipment Purchase Details:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                    <input type="radio" name="enable" ng-model="type" ng-value="28" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label29</label>
                        <input type="text"  ng-model="add_device_label.label_29" name="label_29" ng-disabled="type != 28" aria-label="label_29" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="29" />
                    <md-input-container class="md-block" flex-gt-sm flex="20" >
                        <label>Label30</label>
                        <input type="text"  ng-model="add_device_label.label_30" name="label_30" aria-label="label_30" ng-disabled="type != 29" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="30" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label31</label>
                        <input type="text"  ng-model="add_device_label.label_31" name="label_31" aria-label="label_31"  ng-disabled="type != 30" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="31" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label32</label>
                        <input type="text"  ng-model="add_device_label.label_32" name="label_32" aria-label="label_32" ng-disabled="type != 31" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <h5 class="sub_heading-style-respond">Maintenance Schedule:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <input type="radio" name="enable" ng-model="type" ng-value="32" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label33</label>
                        <input type="text"  ng-model="add_device_label.label_33" name="label_33" aria-label="label_33" ng-disabled="type != 32" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="33" />
                        <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label34</label>
                        <input type="text"  ng-model="add_device_label.label_34" name="label_34" aria-label="label_34" ng-disabled="type != 33" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="34" />
                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>Label35</label>
                        <input type="text"  ng-model="add_device_label.label_35" name="label_35" aria-label="label_35" ng-disabled="type != 34" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="35" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label36</label>
                        <input type="text"  ng-model="add_device_label.label_36" name="label_36" aria-label="label_36" ng-disabled="type != 35" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="36" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label37</label>
                        <input type="text"  ng-model="add_device_label.label_37" name="label_37" aria-label="label_37" ng-disabled="type != 36" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="37" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label38</label>
                        <input type="text"  ng-model="add_device_label.label_38"  name="label_38" aria-label="label_38"  ng-disabled="type != 37" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="38" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label39</label>
                        <input type="text"  ng-model="add_device_label.label_39" name="label_39" aria-label="label_39" ng-disabled="type != 38" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="39" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label40</label>
                        <input type="text"  ng-model="add_device_label.label_40" name="label_40" aria-label="label_40"  ng-disabled="type != 38" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="40" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label41</label>
                        <input type="text"  ng-model="add_device_label.label_41" name="label_41" aria-label="label_41" ng-disabled="type != 40" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="41" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label42</label>
                        <input type="text"  ng-model="add_device_label.label_42" name="label_42" aria-label="label_42" ng-disabled="type != 41" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="42" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label43</label>
                        <input type="text"  ng-model="add_device_label.label_43" name="label_43" aria-label="label_43"  ng-disabled="type != 42" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="43" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label44</label>
                        <input type="text"  ng-model="add_device_label.label_44" name="label_44" aria-label="label_44"  ng-disabled="type != 43" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="44" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label45</label>
                        <input type="text"  ng-model="add_device_label.label_45" name="label_45" aria-label="label_45" ng-disabled="type != 44" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="45" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label46</label>
                        <input type="text"  ng-model="add_device_label.label_46" name="label_46" aria-label="label_46"  ng-disabled="type != 45" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="46" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label47</label>
                        <input type="text"  ng-model="add_device_label.label_47" name="label_47" aria-label="label_47"  ng-disabled="type != 46" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="47" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label48</label>
                        <input type="text"  ng-model="add_device_label.label_48" name="label_48" aria-label="label_48" ng-disabled="type != 47" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="48" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label49</label>
                        <input type="text"  ng-model="add_device_label.label_49" name="label_49" aria-label="label_49" ng-disabled="type != 48" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="49" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label50</label>
                        <input type="text"  ng-model="add_device_label.label_50" name="label_50" aria-label="label_50" ng-disabled="type != 49" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="50" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label51</label>
                        <input type="text"  ng-model="add_device_label.label_51" name="label_51" aria-label="label_51" ng-disabled="type != 50" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="51" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label52</label>
                        <input type="text"  ng-model="add_device_label.label_52" name="label_52" aria-label="label_52"  ng-disabled="type != 51" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="52" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label53</label>
                        <input type="text"  ng-model="add_device_label.label_53" name="label_53" aria-label="label_53" ng-disabled="type != 52" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="53" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label54</label>
                        <input type="text"  ng-model="add_device_label.label_54" name="label_54" aria-label="label_54" ng-disabled="type != 53"  md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="54" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label55</label>
                        <input type="text"  ng-model="add_device_label.label_55" name="label_55" aria-label="label_55" ng-disabled="type != 54" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="55" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label56</label>
                        <input type="text"  ng-model="add_device_label.label_56" name="label_56" aria-label="label_56"  ng-disabled="type != 55" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="56" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label57</label>
                        <input type="text"  ng-model="add_device_label.label_57" name="label_57" aria-label="label_57" ng-disabled="type != 56" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="57" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label58</label>
                        <input type="text"  ng-model="add_device_label.label_58" name="label_58" aria-label="label_58" ng-disabled="type != 57" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="58" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label59</label>
                        <input type="text"  ng-model="add_device_label.label_59" name="label_59" ng-disabled="type != 58" aria-label="label_59" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="59" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label60</label>
                        <input type="text"  ng-model="add_device_label.label_60" name="label_60" aria-label="label_60"  ng-disabled="type != 59" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="60" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label61</label>
                        <input type="text"  ng-model="add_device_label.label_61" name="label_61" aria-label="label_61" ng-disabled="type != 60" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="61" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label62</label>
                        <input type="text"  ng-model="add_device_label.label_62" name="label_62" aria-label="label_62" ng-disabled="type != 61" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="62" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label63</label>
                        <input type="text"  ng-model="add_device_label.label_63" name="label_63" aria-label="label_63" ng-disabled="type !=62" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="63" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label64</label>
                        <input type="text"  ng-model="add_device_label.label_64" name="label_64" aria-label="label_64" ng-disabled="type !=63" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="64" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label65</label>
                        <input type="text"  ng-model="add_device_label.label_65" name="label_65" aria-label="label_65" ng-disabled="type !=64" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="65" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label66</label>
                        <input type="text"  ng-model="add_device_label.label_66" name="label_66" aria-label="label_66" ng-disabled="type !=65" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="66" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label67</label>
                        <input type="text"  ng-model="add_device_label.label_67" name="label_67" aria-label="label_67" ng-disabled="type !=66" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="67" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label68</label>
                        <input type="text"  ng-model="add_device_label.label_68" name="label_68" aria-label="label_68" ng-disabled="type !=67"  md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="68" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label69</label>
                        <input type="text"  ng-model="add_device_label.label_69" name="label_69" aria-label="label_69" ng-disabled="type !=68" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="69" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label70</label>
                        <input type="text"  ng-model="add_device_label.label_70" name="label_70" aria-label="label_70" ng-disabled="type !=69" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="70" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label71</label>
                        <input type="text"  ng-model="add_device_label.label_71" name="label_71" aria-label="label_71"  ng-disabled="type !=70" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="71" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label72</label>
                        <input type="text"  ng-model="add_device_label.label_72" name="label_72" aria-label="label_72"  ng-disabled="type !=71" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="72" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label73</label>
                        <input type="text"  ng-model="add_device_label.label_73" name="label_73" aria-label="label_73" ng-disabled="type !=72" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="73" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label74</label>
                        <input type="text"  ng-model="add_device_label.label_74" name="label_74" aria-label="label_74" ng-disabled="type !=73" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="74" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label75</label>
                        <input type="text"  ng-model="add_device_label.label_75" name="label_75" aria-label="label_75" ng-disabled="type !=74" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="75" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label76</label>
                        <input type="text"  ng-model="add_device_label.label_76" name="label_76" aria-label="label_76" ng-disabled="type !=75" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="76" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label77</label>
                        <input type="text"  ng-model="add_device_label.label_77" name="label_77" aria-label="label_77" ng-disabled="type !=76" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="77" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label78</label>
                        <input type="text"  ng-model="add_device_label.label_78" name="label_78" aria-label="label_78" ng-disabled="type !=77" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="78" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label79</label>
                        <input type="text"  ng-model="add_device_label.label_79" name="label_79" aria-label="label_79"  ng-disabled="type !=78" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="79" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label80</label>
                        <input type="text"  ng-model="add_device_label.label_80" name="label_80" aria-label="label_80"  ng-disabled="type !=79" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="80" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label81</label>
                        <input type="text"  ng-model="add_device_label.label_81" name="label_81" aria-label="label_81" ng-disabled="type !=80" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="81" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label82</label>
                        <input type="text"  ng-model="add_device_label.label_82" name="label_82" aria-label="label_82" ng-disabled="type !=81" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="82" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label83</label>
                        <input type="text"  ng-model="add_device_label.label_83" name="label_83" aria-label="label_83" ng-disabled="type !=82" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="83" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label84</label>
                        <input type="text"  ng-model="add_device_label.label_84" name="label_84" ng-disabled="type !=83" aria-label="label_84" md-autofocus="autofocus" />
                    </md-input-container>

                    <input type="radio" name="enable" ng-model="type" ng-value="84" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label85</label>
                        <input type="text"  ng-model="add_device_label.label_85" name="label_85"   ng-disabled="type !=84" aria-label="label_85" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="85" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label86</label>
                        <input type="text"  ng-model="add_device_label.label_86" name="label_86" ng-disabled="type !=85" aria-label="label_86" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="86" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label87</label>
                        <input type="text"  ng-model="add_device_label.label_87" name="label_87" ng-disabled="type !=86" aria-label="label_87" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="87" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label88</label>
                        <input type="text"  ng-model="add_device_label.label_88" name="label_88" ng-disabled="type !=87" aria-label="label_88" md-autofocus="autofocus" />
                    </md-input-container>

                    <input type="radio" name="enable" ng-model="type" ng-value="88" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label89</label>
                        <input type="text"  ng-model="add_device_label.label_89" name="label_89" ng-disabled="type !=88" aria-label="label_89" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="89" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label90</label>
                        <input type="text"  ng-model="add_device_label.label_90" name="label_90"  ng-disabled="type !=89" aria-label="label_90" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="90" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label91</label>
                        <input type="text"  ng-model="add_device_label.label_91" name="label_91" ng-disabled="type !=90" aria-label="label_91" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="91" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label92</label>
                        <input type="text"  ng-model="add_device_label.label_92" name="label_92" ng-disabled="type !=91" aria-label="label_92" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="92" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label93</label>
                        <input type="text"  ng-model="add_device_label.label_93" name="label_93" ng-disabled="type !=92" aria-label="label_93" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="93" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label94</label>
                        <input type="text"  ng-model="add_device_label.label_94" name="label_94" ng-disabled="type !=93" aria-label="label_94" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="94" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label95</label>
                        <input type="text"  ng-model="add_device_label.label_95" name="label_95"  ng-disabled="type !=94" aria-label="label_95" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="95" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label96</label>
                        <input type="text"  ng-model="add_device_label.label_96" name="label_96"  ng-disabled="type !=95" aria-label="label_96" md-autofocus="autofocus" />
                    </md-input-container>
                    <input type="radio" name="enable" ng-model="type" ng-value="96" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label97</label>
                        <input type="text"  ng-model="add_device_label.label_97" name="label_97" ng-disabled="type !=96" aria-label="label_97" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="97" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label98</label>
                        <input type="text"  ng-model="add_device_label.label_98" name="label_98" ng-disabled="type !=97" aria-label="label_98" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="98" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label99</label>
                        <input type="text"  ng-model="add_device_label.label_99" name="label_99" ng-disabled="type !=98" aria-label="label_99" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <input type="radio" name="enable" ng-model="type" ng-value="99" />
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Label100</label>
                        <input type="text"  ng-model="add_device_label.label_100" name="label_100" ng-disabled="type !=99" aria-label="label_100" md-autofocus="autofocus" />
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>


                <div class="row" style="margin-top: 15px;">
                    <div flex layout="row" layout-align="center center">
                        <!--    <input type="submit" class="md-button md-raised md-accent" layout-align="center center" ng-disabled="AddDevice.$invalid" ng-click="SaveDevice(add_device,'save_device')" aria-label="button" value="Save">-->
                        <input type="submit" class="md-button md-raised md-accent"   layout-align="center center" ng-click="addDevicelabel(add_device_label)"  aria-label="buttonsd" value="Save">
                        <md-button class="md-raised md-default" aria-label="submit"  ui-sref="home.haadmin_device_label">Cancel</md-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</md-content>