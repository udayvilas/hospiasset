<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Equipment Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <div flex layout="row">
                <v-accordion class="vAccordion--default" flex>
                    <!-- add expanded attribute to open the section -->
                    <v-pane expanded>
                        <v-pane-header> Equipment Basic Details</v-pane-header>
                        <v-pane-content>
                            <table class="md-api-table table table-bordered">
                                <tr>
                                    <td width="25%">Equipment ID:</td><td  width="25%">{{depart_device_view.E_ID}}</td>
                                    <td  width="25%">Equipment Name:</td><td  width="25%">{{depart_device_view.E_NAME}}</td>
                                </tr>
                                <tr>
                                    <td>Accessories:</td><td>{{depart_device_view.ACCSSORIES}}</td>
                                    <td>Company Name:</td><td>{{depart_device_view.C_NAME}}</td>
                                </tr>
                                <tr>
                                    <td>Equipment Model:</td><td>{{depart_device_view.E_MODEL}}</td>
                                    <td>Serial Number:</td><td>{{depart_device_view.ES_NUMBER}}</td>
                                </tr>
                                <tr>
                                    <td>Manufacture Date:</td><td>{{depart_device_view.MF_DATE | date:'dd-MM-yyyy'}}</td>
                                    <td>Equipment Cost:</td><td>{{depart_device_view.E_COST}}</td>
                                </tr>
                                <tr>
                                    <td>Service Contact Person Name:</td><td>{{depart_device_view.S_CONTACT}}</td>
                                    <td>Service Contact Person Number:</td><td>{{depart_device_view.SCO_NUMBER}}</td>
                                </tr>
                                <tr>
                                    <td>PO NO:</td><td>{{depart_device_view.PONO}}</td>
                                    <td>PO Date:</td><td>{{depart_device_view.PDATE | date:'dd-MM-yyyy'}}</td>
                                </tr>
                                <tr>
                                    <td>Date of Install:</td><td>{{depart_device_view.DATEOF_INSTALL | date:'dd-MM-yyyy'}}</td>
                                    <td>Present Condition of Equipment:</td><td>{{depart_device_view.EQ_CONDATION}}</td>
                                </tr>
                                <tr>
                                    <td>Utilization:</td><td>{{depart_device_view.UTILIZATION}}</td>
                                    <td>Status:</td><td>{{depart_device_view.E_COND}}</td>
                                </tr>
                                <tr>
                                    <td>Equipment Class:</td><td>{{depart_device_view.EQ_CLASS}}</td>
                                    <td>Remarks:</td><td>{{depart_device_view.REMARKS}}</td>
                                </tr>
                                <tr>
                                    <td>Department:</td><td>{{depart_device_view.DEPT_ID}}</td>
                                    <td>Description:</td><td>{{depart_device_view.DESC_P}}</td>
                                </tr>
                            </table>
                        </v-pane-content>
                    </v-pane>

                    <v-pane>
                        <v-pane-header> Contract Information</v-pane-header>

                        <v-pane-content>
                            <table class="md-api-table table table-bordered">
                                <tr>
                                    <td>Contract Type:</td><td>{{depart_device_view.AMC_TYPE}}</td>
                                    <td>Contract Value:</td><td>{{depart_device_view.AMC_VALUE}}</td>
                                </tr>
                                <tr>
                                    <td>Contract From:</td><td>{{depart_device_view.C_FROM | date:'dd-MM-yyyy'}}</td>
                                    <td>Contract To:</td><td>{{depart_device_view.C_TO | date:'dd-MM-yyyy'}}</td>
                                </tr>
                            </table>
                        </v-pane-content>
                    </v-pane>

                    <v-pane>
                        <v-pane-header> BreakDowns Information</v-pane-header>

                        <v-pane-content>
                            <table class="md-api-table table table-bordered">
                                <tr>
                                    <td>BreakDown's Count:</td><td>{{depart_device_view.BD_COUNT}}</td>
                                    <td>Last BreakDown Date:</td><td>{{depart_device_view.LB_DATE}}</td>
                                </tr>
                                <tr>
                                    <td colspan="1">BreakDown's Cost</td><td colspan="3">{{depart_device_view.BD_COST}}</td>
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
    </md-dialog-content>
    <md-dialog-actions layout="row">
        <md-button class="md-primary" ng-click="cancel()">Close</md-button>
    </md-dialog-actions>
</md-dialog>