<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="70" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Country Labels List</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditLabelslist" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Module Name</label>
                        <input  type="text" ng-model="label_data.module_id" ng-disabled="true" name="module_id" >  
                    </md-input-container>
					 <div flex="5" hide-xs hide-sm><!-- Space --></div>
					   <md-input-container class="md-block" flex-gt-sm>
                        <label>ORG Name</label>
                        <input  type="text" ng-model="label_data.org_name" ng-disabled="true" name="org_name" >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
					 <md-input-container class="md-block" flex-gt-sm>
                        <label>Table Name</label>
                        <input  type="text" ng-model="label_data.table_name" ng-disabled="true" name="table_name" >    
                    </md-input-container>
                </div>
                
			<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
               <input type="radio" name="enable" ng-model="type" ng-value="0"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 1</label>
                    <input  type="text" ng-model="label_data.LABEL_1"   ng-disabled="type != 0" name="label_1" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="1"  />
                <md-input-container class="md-block" flex-gt-sm flex="20"> 
                    <label>Label 2</label>
                    <input  type="text" ng-model="label_data.LABEL_2"  ng-disabled="type != 1"  name="label_2">
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="2"  />
                <md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 3</label>
                    <input  type="text" ng-model="label_data.LABEL_3"  ng-disabled="type != 2"  name="label_3" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="3"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 4</label>
                    <input  type="text" ng-model="label_data.LABEL_4" ng-disabled="type != 3"   name="label_4" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="4"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 5</label>
                    <input  type="text" ng-model="label_data.LABEL_5"   ng-disabled="type != 4" name="label_5" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="5"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 6</label>
                    <input  type="text" ng-model="label_data.LABEL_6" ng-disabled="type != 5" name="label_6" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="6"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 7</label>
                    <input  type="text" ng-model="label_data.LABEL_7" ng-disabled="type != 6"  name="label_7" >
                </md-input-container>
                
				<input type="radio" name="enable" ng-model="type" ng-value="7"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 8</label>
                    <input  type="text" ng-model="label_data.LABEL_8"  ng-disabled="type != 7" name="label_8" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="8"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 9</label>
                    <input  type="text" ng-model="label_data.LABEL_9"  ng-disabled="type != 8" name="label_9" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="9"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 10</label>
                    <input  type="text" ng-model="label_data.LABEL_10"  ng-disabled="type != 9" name="label_10" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
		        <input type="radio" name="enable" ng-model="type" ng-value="10"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 11</label>
                    <input  type="text" ng-model="label_data.LABEL_11" ng-disabled="type != 10"  name="label_11" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="11"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 12</label>
                    <input  type="text" ng-model="label_data.LABEL_12"  ng-disabled="type != 11" name="label_12" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="12"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 13</label>
                    <input  type="text" ng-model="label_data.LABEL_13" ng-disabled="type != 12"  name="label_13" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="13"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 14</label>
                    <input  type="text" ng-model="label_data.LABEL_14" ng-disabled="type != 13"  name="label_14" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="14"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 15</label>
                    <input  type="text" ng-model="label_data.LABEL_15" ng-disabled="type != 14"  name="label_15" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="15"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 16</label>
                    <input  type="text" ng-model="label_data.LABEL_16" ng-disabled="type != 15"  name="label_16" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="16"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 17</label>
                    <input  type="text" ng-model="label_data.LABEL_17" ng-disabled="type != 16" name="label_17" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="17"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 18</label>
                    <input  type="text" ng-model="label_data.LABEL_18" ng-disabled="type != 17"  name="label_18" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="18"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 19</label>
                    <input  type="text" ng-model="label_data.LABEL_19"  ng-disabled="type != 18" name="label_19" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="19"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 20</label>
                    <input  type="text" ng-model="label_data.LABEL_20" ng-disabled="type != 19" name="label_20" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="20"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 21</label>
                    <input  type="text" ng-model="label_data.LABEL_21" ng-disabled="type != 20" name="label_21" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="21"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 22</label>
                    <input  type="text" ng-model="label_data.LABEL_22"  ng-disabled="type != 21" name="label_22" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="22"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 23</label>
                    <input  type="text" ng-model="label_data.LABEL_23"  ng-disabled="type != 22" name="label_23" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="23"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 24</label>
                    <input  type="text" ng-model="label_data.LABEL_24"  ng-disabled="type != 23" name="label_25" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="24"  />
				<md-input-container class="md-block" flex-gt-sm>
                    <label>Label 25</label>
                    <input  type="text" ng-model="label_data.LABEL_25"   ng-disabled="type != 24" name="label_25" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="25"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 26</label>
                    <input  type="text" ng-model="label_data.LABEL_26" ng-disabled="type != 25" name="label_26" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="26"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 27</label>
                    <input  type="text" ng-model="label_data.LABEL_27"  ng-disabled="type != 26"  name="label_27" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="27"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 28</label>
                    <input  type="text" ng-model="label_data.LABEL_28" ng-disabled="type != 27" name="label_28" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="28"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 29</label>
                    <input  type="text" ng-model="label_data.LABEL_29" ng-disabled="type != 28"  name="label_29" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="29"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 30</label>
                    <input  type="text" ng-model="label_data.LABEL_30" ng-disabled="type != 29"  name="label_30" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="30"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 31</label>
                    <input  type="text" ng-model="label_data.LABEL_31"  ng-disabled="type != 30" name="label_31" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="31"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 32</label>
                    <input  type="text" ng-model="label_data.LABEL_32" ng-disabled="type != 31"  name="label_32" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="32"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 33</label>
                    <input  type="text" ng-model="label_data.LABEL_33" ng-disabled="type != 32" name="label_33" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="33"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 34</label>
                    <input  type="text" ng-model="label_data.LABEL_34" ng-disabled="type != 33" name="label_34" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="34"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 35</label>
                    <input  type="text" ng-model="label_data.LABEL_35"  ng-disabled="type != 34" name="label_35" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="35"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 36</label>
                    <input  type="text" ng-model="label_data.LABEL_36" ng-disabled="type != 35"  name="label_36" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="36"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 37</label>
                    <input  type="text" ng-model="label_data.LABEL_37" ng-disabled="type != 36" name="label_37" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="37"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 38</label>
                    <input  type="text" ng-model="label_data.LABEL_38" ng-disabled="type != 37"  name="label_38" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="38"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 39</label>
                    <input  type="text" ng-model="label_data.LABEL_39" ng-disabled="type != 38"  name="label_39" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="39"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 40</label>
                    <input  type="text" ng-model="label_data.LABEL_40" ng-disabled="type != 39" name="label_40" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="40"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 41</label>
                    <input  type="text" ng-model="label_data.LABEL_41" ng-disabled="type != 40"  name="label_41" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="41"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 42</label>
                    <input  type="text" ng-model="label_data.LABEL_42" ng-disabled="type != 41"  name="label_42" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="42"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 43</label>
                    <input  type="text" ng-model="label_data.LABEL_43" ng-disabled="type != 42"  name="label_43" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="43"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 44</label>
                    <input  type="text" ng-model="label_data.LABEL_44" ng-disabled="type != 43"  name="label_44" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="44"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 45</label>
                    <input  type="text" ng-model="label_data.LABEL_45"  ng-disabled="type != 44" name="label_45" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="45"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 46</label>
                    <input  type="text" ng-model="label_data.LABEL_46"  ng-disabled="type != 45"  name="label_46" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="46"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 47</label>
                    <input  type="text" ng-model="label_data.LABEL_47" ng-disabled="type != 46"  name="label_47" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="47"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 48</label>
                    <input  type="text" ng-model="label_data.LABEL_48" ng-disabled="type != 47"  name="label_48" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="48"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 49</label>
                    <input  type="text" ng-model="label_data.LABEL_49" ng-disabled="type != 48"  name="label_49" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="49"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 50</label>
                    <input  type="text" ng-model="label_data.LABEL_50" ng-disabled="type != 49"   name="label_50" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="50"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 51</label>
                    <input  type="text" ng-model="label_data.LABEL_51"  ng-disabled="type != 50" name="label_51" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="51"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 52</label>
                    <input  type="text" ng-model="label_data.LABEL_52" ng-disabled="type != 51" name="label_52" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="52"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 53</label>
                    <input  type="text" ng-model="label_data.LABEL_53"  ng-disabled="type != 52" name="label_53" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="53"  />
				<md-input-container class="md-block" flex-gt-sm flex="20" >
                    <label>Label 54</label>
                    <input  type="text" ng-model="label_data.LABEL_54" ng-disabled="type != 53"  name="label_54" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="54"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 55</label>
                    <input  type="text" ng-model="label_data.LABEL_55" ng-disabled="type != 54"  name="label_55" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="55"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 56</label>
                    <input  type="text" ng-model="label_data.LABEL_56"  ng-disabled="type != 55"  name="label_56" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="56"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 57</label>
                    <input  type="text" ng-model="label_data.LABEL_57"  ng-disabled="type != 56" name="label_57" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="57"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 58</label>
                    <input  type="text" ng-model="label_data.LABEL_58"  ng-disabled="type != 57" name="label_58" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="58"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 59</label>
                    <input  type="text" ng-model="label_data.LABEL_59" ng-disabled="type != 58"  name="label_59" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="59"  />
				<md-input-container class="md-block" flex-gt-sm flex="20" > 
                    <label>Label 60</label>
                    <input  type="text" ng-model="label_data.LABEL_60" ng-disabled="type != 59" name="label_60" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="60"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 61</label>
                    <input  type="text" ng-model="label_data.LABEL_61"  ng-disabled="type != 60" name="label_61" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="61"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 62</label>
                    <input  type="text" ng-model="label_data.LABEL_62" ng-disabled="type != 61"  name="label_62" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="62"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 63</label>
                    <input  type="text" ng-model="label_data.LABEL_63" ng-disabled="type != 62"  name="label_63" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="63"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 64</label>
                    <input  type="text" ng-model="label_data.LABEL_64"  ng-disabled="type != 63" name="label_64" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="64"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 65</label>
                    <input  type="text" ng-model="label_data.LABEL_65"  ng-disabled="type != 64" name="label_65" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="65"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 66</label>
                    <input  type="text" ng-model="label_data.LABEL_66" ng-disabled="type != 65"  name="label_66" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="66"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 67</label>
                    <input  type="text" ng-model="label_data.LABEL_67"  ng-disabled="type != 66" name="label_67" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="67"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 68</label>
                    <input  type="text" ng-model="label_data.LABEL_68" ng-disabled="type != 67"   name="label_68" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="68"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 69</label>
                    <input  type="text" ng-model="label_data.LABEL_69"  ng-disabled="type != 68" name="label_69" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="69"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 70</label>
                    <input  type="text" ng-model="label_data.LABEL_70" ng-disabled="type != 69"  name="label_70" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="70"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 71</label>
                    <input  type="text" ng-model="label_data.LABEL_71" ng-disabled="type != 70"  name="label_71" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="71"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 72</label>
                    <input  type="text" ng-model="label_data.LABEL_72" ng-disabled="type != 71" name="label_72" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="72"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 73</label>
                    <input  type="text" ng-model="label_data.LABEL_73"  ng-disabled="type != 72" name="label_73" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="73"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 74</label>
                    <input  type="text" ng-model="label_data.LABEL_74" ng-disabled="type != 73" name="label_74" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="74"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 75</label>
                    <input  type="text" ng-model="label_data.LABEL_75" ng-disabled="type != 74" name="label_75" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="75"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 76</label>
                    <input  type="text" ng-model="label_data.LABEL_76" ng-disabled="type != 75"  name="label_76" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="76"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 77</label>
                    <input  type="text" ng-model="label_data.LABEL_77" ng-disabled="type != 76"  name="label_77" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="77"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 78</label>
                    <input  type="text" ng-model="label_data.LABEL_78"  ng-disabled="type != 77" name="label_78" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="78"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 79</label>
                    <input  type="text" ng-model="label_data.LABEL_79"  ng-disabled="type != 78" name="label_79" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="79"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 80</label>
                    <input  type="text" ng-model="label_data.LABEL_80"  ng-disabled="type != 79" name="label_80" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="80"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 81</label>
                    <input  type="text" ng-model="label_data.LABEL_81" ng-disabled="type != 80" name="label_81" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="81"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 82</label>
                    <input  type="text" ng-model="label_data.LABEL_82" ng-disabled="type != 81"  name="label_82" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="82"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 83</label>
                    <input  type="text" ng-model="label_data.LABEL_83"  ng-disabled="type != 82" name="label_83" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="83"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 84</label>
                    <input  type="text" ng-model="label_data.LABEL_84" ng-disabled="type != 83"  name="label_84" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="84"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 85</label>
                    <input  type="text" ng-model="label_data.LABEL_85"  ng-disabled="type != 84" name="label_85" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="85"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 86</label>
                    <input  type="text" ng-model="label_data.LABEL_86" ng-disabled="type != 85"  name="label_86" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="86"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 87</label>
                    <input  type="text" ng-model="label_data.LABEL_87" ng-disabled="type != 86"  name="label_87" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="87"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 88</label>
                    <input  type="text" ng-model="label_data.LABEL_88" ng-disabled="type != 87"  name="label_88" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="88"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 89</label>
                    <input  type="text" ng-model="label_data.LABEL_89"  ng-disabled="type != 88" name="label_89" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="89"  />
			   <md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 90</label>
                    <input  type="text" ng-model="label_data.LABEL_90"   ng-disabled="type != 89"   name="label_90" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="90"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 91</label>
                    <input  type="text" ng-model="label_data.LABEL_91"  ng-disabled="type != 90" name="label_91" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="91"  />
				<md-input-container class="md-block" flex-gt-sm>
                    <label>Label 92</label>
                    <input  type="text" ng-model="label_data.LABEL_92"  ng-disabled="type != 91" name="label_92" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="92"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 93</label>
                    <input  type="text" ng-model="label_data.LABEL_93" ng-disabled="type != 92"  name="label_93" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="93"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 94</label>
                    <input  type="text" ng-model="label_data.LABEL_94"  ng-disabled="type != 93" name="label_94" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="94"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 95</label>
                    <input  type="text" ng-model="label_data.LABEL_95" ng-disabled="type != 94"  name="label_95" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="95"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 96</label>
                    <input  type="text" ng-model="label_data.LABEL_96" ng-disabled="type != 95"  name="label_96" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="96"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 97</label>
                    <input  type="text" ng-model="label_data.LABEL_97" ng-disabled="type != 96"  name="label_97" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="97"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 98</label>
                    <input  type="text" ng-model="label_data.LABEL_98" ng-disabled="type != 97"  name="label_98" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="98"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 99</label>
                    <input  type="text" ng-model="label_data.LABEL_99" ng-disabled="type != 98"  name="label_99" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				<input type="radio" name="enable" ng-model="type" ng-value="99"  />
				<md-input-container class="md-block" flex-gt-sm flex="20">
                    <label>Label 100</label>
                    <input  type="text" ng-model="label_data.LABEL_100" ng-disabled="type != 99"  name="label_100" >
                </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
				</div>
				
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Action</label>
                    <input  type="text" ng-model="ecountry.actions"  name="actions" >
                    
                </md-input-container>
                <div flex layout="row" layout-align="center center">
                    <md-button class="md-raised md-accent" ng-click="UpdateLabelslist(label_data)" ng-disabled="EditLabelslist.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>