<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" layout-wrap>
    <div layout="column">
        <h3 class="heading-stylerespond">Search</h3>
	<form name="Search" method="post">
	<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center">
	    <md-input-container class="md-block" flex-gt-sm>
		    <label>Equipment ID</label>
	        <input type="search" ng-model="esearch.eqpid" name="seqpid" aria-label="seqpid"/>
   		</md-input-container>

	<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	(OR)</div>

       <md-input-container class="md-block" flex-gt-sm>
	    <label>Serial No</label>
	      <input type="search" ng-model="esearch.saccessoriesno" name="saccessoriesno" aria-label="saccessoriesno"/>
	    </md-input-container>

	<div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>

    	<md-input-container class="md-block"  flex-gt-sm>
    		<label>PO NO</label>
      		<input type="search" ng-model="esearch.spono" name="spono" aria-label="spono"/>
   		</md-input-container>
	</div>
        <center>
	<input type="submit" value="Submit" class="md-raised md-accent md-button md-ink-ripple" ng-click="equpSearch(esearch)" layout-align="center center" aria-label="submit" />
        </center>
	</form>

	<div ng-if="device_details.E_ID!='' && device_details.E_ID!=undefined" flex>
	<!-- add `multiple` attribute to allow multiple sections to open at once -->
	<v-accordion class="vAccordion--default">

	  <!-- add expanded attribute to open the section -->
	  <v-pane expanded>
	    <v-pane-header> Equipment Basic Details</v-pane-header>
	    <v-pane-content>
	      <table class="md-api-table table table-bordered">
              <tr>
               <td width="25%">Equipment ID:</td><td  width="25%">{{device_details.E_ID}}</td>
               <td  width="25%">Equipment Name:</td><td  width="25%">{{device_details.E_NAME}}</td>
              </tr>
              <tr>
               <td>Accessories:</td><td>{{device_details.ACCSSORIES}}</td>
               <td>Company Name:</td><td>{{device_details.C_NAME}}</td>
              </tr>
              <tr>
               <td>Equipment Model:</td><td>{{device_details.E_MODEL}}</td>
               <td>Serial Number:</td><td>{{device_details.ES_NUMBER}}</td>
              </tr>
              <tr>
               <td>Manufacture Date:</td><td>{{device_details.MF_DATE | date:'dd-MM-yyyy'}}</td>
               <td>Equipment Cost:</td><td>{{device_details.E_COST}}</td>
              </tr>
              <tr>
               <td>Service Contact Person Name:</td><td>{{device_details.S_CONTACT}}</td>
               <td>Service Contact Person Number:</td><td>{{device_details.SCO_NUMBER}}</td>
              </tr>
              <tr>
               <td>PO NO:</td><td>{{device_details.PONO}}</td>
               <td>PO Date:</td><td>{{device_details.PDATE | date:'dd-MM-yyyy'}}</td>
              </tr>
              <tr>
               <td>Date of Install:</td><td>{{device_details.DATEOF_INSTALL | date:'dd-MM-yyyy'}}</td>
               <td>Present Condition of Equipment:</td><td>{{device_details.EQ_CONDATION}}</td>
              </tr>
              <tr>
               <td>Utilization:</td><td>{{device_details.UTILIZATION}}</td>
               <td>Status:</td><td>{{device_details.E_COND}}</td>
              </tr>
              <tr>
               <td>Equipment Class:</td><td>{{device_details.EQ_CLASS}}</td>
               <td>Remarks:</td><td>{{device_details.REMARKS}}</td>
              </tr>
              <tr>
               <td>Department:</td><td>{{device_details.DEPT_ID}}</td>
               <td>Description:</td><td>{{device_details.DESC_P}}</td>
              </tr>
          </table>
	    </v-pane-content>
	  </v-pane>

	  <v-pane>
	    <v-pane-header> Contract Information</v-pane-header>

	    <v-pane-content>
	      <table class="md-api-table table table-bordered">
              <tr>
               <td>Contract Type:</td><td>{{device_details.AMC_TYPE}}</td>
               <td>Contract Value:</td><td>{{device_details.AMC_VALUE}}</td>
              </tr>
              <tr>
               <td>Contract From:</td><td>{{device_details.C_FROM | date:'dd-MM-yyyy'}}</td>
               <td>Contract To:</td><td>{{device_details.C_TO | date:'dd-MM-yyyy'}}</td>
              </tr>
          </table>
	    </v-pane-content>
	  </v-pane>

	  <v-pane>
	    <v-pane-header> BreakDowns Information</v-pane-header>

	    <v-pane-content>
	      <table class="md-api-table table table-bordered">
              <tr>
               <td>BreakDown's Count:</td><td>{{device_details.BD_COUNT}}</td>
               <td>Last BreakDown Date:</td><td>{{device_details.LB_DATE}}</td>
              </tr>
              <tr>
               <td colspan="1">BreakDown's Cost</td><td colspan="3">{{device_details.BD_COST}}</td>
              </tr>
          </table>
	    </v-pane-content>
	  </v-pane>

	  <v-pane>
	    <v-pane-header> Maintenance Schedule</v-pane-header>

	    <v-pane-content>
	      <table class="md-api-table table table-bordered">
              <tr>
               <td>No.of PMS's(Per Year):</td><td>{{search_device_dtls.PMS_COUNT}}</td>
               <td>Last PMS Date:</td><td>{{search_device_dtls.PMS_DONE | date:'dd-MM-yyyy'}}</td>
              </tr>
              <tr>
               <td>No.of QC's(Per Year):</td><td>{{search_device_dtls.QC_COUNT}}</td>
               <td>Last QC Date:</td><td>{{search_device_dtls.QC_DONE | date:'dd-MM-yyyy'}}</td>
              </tr>
          </table>
	    </v-pane-content>
	  </v-pane>

	  <v-pane>
	    <v-pane-header> Call Register</v-pane-header>

	    <v-pane-content>
	      <table class="md-api-table table table-bordered">
               <thead>
                  <tr>
                   <th>Call Date &amp; Time</th>
                   <th>Complaint</th>
                   <th>Person Name</th>
                   <th>Completed Date &amp; Time</th>
                   <th>DownTime</th>
                  </tr>
               </thead>
               <tbody>
                  <tr ng-if="cms_details.response=='success'" ng-repeat="ecms in cms_details">
                   <td>{{ecms.CDATE | date:'dd-MM-yyyy'}}</td>
                   <td>{{ecms.NATURE_OF_COMP}}</td>
                   <td>{{ecms.ATTENDED_BY_NAME}}</td>
                   <td>{{ecms.JOBCOMPLETED_DATE | date:'dd-MM-yyyy'}} {{ecms.JOBCOMPLETED_TIME}}</td>
                   <td>{{ecms.DOWN_TIME}}</td>
                  </tr>
                  <tr ng-if="cms_details.response=='empty'">
                  <td colspan="5" class="text-center">No Call Register Details Found!</td>
                  </tr>
               </tbody>
          </table>
	    </v-pane-content>
	  </v-pane>

	  <v-pane>
	    <v-pane-header> History</v-pane-header>

	    <v-pane-content>
	      <table class="md-api-table table table-bordered">
               <thead>
                  <tr>
                   <th>Original ID</th>
                   <th>Sub ID</th>
                   <th>Unit</th>
                   <th>Department</th>
                   <th>From</th>
                   <th>To</th>
                  </tr>
               </thead>
               <tbody>
                  <tr ng-if="device_history.response=='success'" ng-repeat="dhistory in device_history">
                   <td>{{dhistory.ORIGINAL_ID}}</td>
                   <td>{{dhistory.PRESENT_ID}}</td>
                   <td>{{dhistory.PRESENT_ID1}}</td>
                   <td>{{dhistory.PRESENT_ID2}}</td>
                   <td>{{dhistory.REC_TD}}</td>
                   <td>{{dhistory.RETUTN_TD}}</td>
                  </tr>
                  <tr ng-if="device_history.response=='empty'">
                  <td colspan="6" class="text-center">No History Details Found!</td>
                  </tr>
               </tbody>
          </table>
	    </v-pane-content>
	  </v-pane>

	</v-accordion>
	</div>
    </div>
</md-content>