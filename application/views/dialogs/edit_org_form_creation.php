<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Org Form Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
   <md-dialog-content flex layout-align="center center">
   <div class="md-dialog-content">
<form method="POST" name="EditDevice" flex="100"  autocomplete="off">   
<div ng-repeat="item in module_form">
<div><label>dgg</label></div>
	   <div class="clearfix" ng-if="item.FIELD_TYPE == 'S' && item.FIELD_ID=='100'"></div>
	 <h5  class="sub_heading-style-respond"  ng-if="item.FIELD_TYPE=='S' && item.FIELD_ID=='100'">{{item.FIELD_DESC}}</h5>
	 </div>
	  <div ng-repeat="item in module_form">
	 <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
	<div  ng-if="item.FIELD_TYPE =='T'">	
    <md-input-container>
					<label>{{item.FIELD_DESC}}</label>
					<input type="text" ng-model="demog[item.DB_FIELD]" ng-required="item.MANDETORY == 'Y'" />		
				</md-input-container>				
				</div>

</div>



</div>
  <div ng-repeat="item in module_form">
	   <div class="clearfix" ng-if="item.FIELD_TYPE == 'S' && item.FIELD_ID=='101'"></div>
	 <h5  class="sub_heading-style-respond"  ng-if="item.FIELD_TYPE=='S' && item.FIELD_ID=='101'">{{item.FIELD_DESC}}</h5>
	 </div>	
		<div class="row" style="margin-top: 15px;">
		<div flex layout="row" layout-align="center center">
		<input type="submit" class="md-button md-raised md-accent"  layout-align="center center"  ng-click="Update_device(demog)"   aria-label="buttonsd" value="Save">
		<md-button class="md-raised md-default" aria-label="submit" ng-click="equipment_clear();" ui-sref="home.view_devies">Cancel</md-button>
		</div>
	</div>
	</form>
	</div>
	    </md-dialog-content>
</md-dialog>





