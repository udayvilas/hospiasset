<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Item Master Dialogs</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditItemMaster" flex="100" autocomplete="off">
                <div flex layout="column">
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>FIELD TYPE</label>
                        <input  type="text" ng-model="eitem_master.field_type"  name="field_type" >
                    </md-input-container>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>FIELD DESC</label>
                        <input  type="text" ng-model="eitem_master.field_desc" name="field_desc">
							</md-input-container>
							<div flex="5" hide-xs hide-sm><!-- Space --></div>
							<md-input-container class="md-block" flex-gt-sm >
                        <label>DBFIELD</label>
                         <input  type="text" ng-model="eitem_master.db_field" name="db_field">
                    </md-input-container>
					<md-in
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>MAX OPT</label>
                         <input  type="text" ng-model="eitem_master.MAX_OPT" name="max_opt">
                    </md-input-container>
						<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm >
                        <label>MANDATORY</label>
                         <input  type="text" ng-model="eitem_master.mandetory" name="mandetory"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
					<md-input-container class="md-block" flex-gt-sm 
                        <label>DISABLED</label>
                         <input  type="text" ng-model="eitem_master.disabled" name="disabled"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT1</label>
                         <input  type="text" ng-model="eitem_master.opt1" name="opt1"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT2</label>
                         <input  type="text" ng-model="eitem_master.opt2" name="opt2"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT3</label>
                         <input  type="text" ng-model="eitem_master.opt3" name="opt3"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT4</label>
                         <input  type="text" ng-model="eitem_master.opt4" name="opt4"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT5</label>
                         <input  type="text" ng-model="eitem_master.opt5" name="opt5"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT6</label>
                         <input  type="text" ng-model="eitem_master.opt6" name="opt6"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT7</label>
                         <input  type="text" ng-model="eitem_master.opt7" name="opt7"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT8</label>
                         <input  type="text" ng-model="eitem_master.opt8" name="opt8"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT9</label>
                         <input  type="text" ng-model="eitem_master.opt9" name="opt9"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT10</label>
                         <input  type="text" ng-model="eitem_master.opt10" name="opt10"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT11</label>
                         <input  type="text" ng-model="eitem_master.opt11" name="opt11"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT12</label>
                         <input  type="text" ng-model="eitem_master.opt12" name="opt12"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT13</label>
                         <input  type="text" ng-model="eitem_master.opt13" name="opt13"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT14</label>
                         <input  type="text" ng-model="eitem_master.opt14" name="opt14"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT15</label>
                         <input  type="text" ng-model="eitem_master.opt15" name="opt15"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT16</label>
                         <input  type="text" ng-model="eitem_master.opt16" name="opt16"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT17</label>
                         <input  type="text" ng-model="eitem_master.opt17" name="opt17"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT18</label>
                         <input  type="text" ng-model="eitem_master.opt18" name="opt18"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT19</label>
                         <input  type="text" ng-model="eitem_master.opt19" name="opt19"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT20</label>
                         <input  type="text" ng-model="eitem_master.opt20" name="opt20"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT21</label>
                         <input  type="text" ng-model="eitem_master.opt21" name="opt21"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT22</label>
                         <input  type="text" ng-model="eitem_master.opt22" name="opt22"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT23</label>
                         <input  type="text" ng-model="eitem_master.opt23" name="opt23"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT24</label>
                         <input  type="text" ng-model="eitem_master.opt24" name="opt24"  >
                    </md-input-container>
					<div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>OPT25</label>
                         <input  type="text" ng-model="eitem_master.opt25" name="opt25"  >
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">
                        <md-button class="md-raised md-accent" ng-click="updateitemmaster(eitem_master)" ng-disabled="EditEqupTypeForm.$invalid" aria-label="submit" style="float:left" >Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>