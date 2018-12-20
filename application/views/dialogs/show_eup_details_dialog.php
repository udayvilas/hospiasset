<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock xmlns="http://www.w3.org/1999/html">
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
                <md-tabs flex md-dynamic-height md-border-bottom>
                    <md-tab flex md-primary label="Equipment Basic Details"><!-- Profile Begin -->
                        <md-content>
                            <table class="md-api-table table table-bordered" style="width:100%;">
                                <tr>
                                    <td colspan="2" width="50%">Equipment ID</td>
                                    <td colspan="2" width="50%">{{depart_device_view.E_ID}}</td>
                                </tr>
                                <tr>
                                    <td>Hospital Asset Code</td><td>{{depart_device_view.MF_DATE | date:'dd-MM-yyyy'}}</td>
                                    <td>Branch</td><td>{{depart_device_view.branch_name}}</td>
                                </tr>
                                <tr>
                                    <td width="25%">Equipment Name</td><td  width="25%">{{depart_device_view.E_NAME}}</td>
                                    <td width="25%">Equipment Category</td><td  width="25%">{{depart_device_view.category}}</td>
                                </tr>
                                <tr>
                                    <td>Company Name</td><td>{{depart_device_view.OEM}}</td>
                                    <td>Distributor</td><td>{{depart_device_view.DISTRIBUTION}}</td>
                                </tr>
                                <tr>
                                    <td>Serial Number</td><td>{{depart_device_view.ES_NUMBER}}</td>
                                    <td>Equipment Cost</td><td>{{depart_device_view.E_COST}}</td>
                                </tr>
                                <tr>
                                    <td>Present Condition</td><td>{{depart_device_view.eq_condition}}</td>
                                    <td>Utilization</td><td>{{depart_device_view.eq_util}}</td>
                                </tr>
                                <tr>
                                    <td>Department</td><td>{{depart_device_view.DEPT_ID}}</td>
                                    <td>Type</td><td>{{depart_device_view.equp_type}}</td>
                                </tr>
                                <tr>
                                    <td>Class</td><td>{{depart_device_view.EQ_CLASS}}</td>
                                    <td>Status</td><td>{{depart_device_view.EQ_CONDATION}}</td>
                                </tr>
                                <!--<tr>
                                    <td>Classification</td><td>{{depart_device_view.classification}}</td>
                                    
                                </tr>-->
                                <tr>
                                    <td>Accessories</td><td>{{depart_device_view.ACCSSORIES}}</td>
                                    <td>Critical Spares</td><td>{{depart_device_view.CRITICAL_SPARES}}</td>
                                </tr>
                                <tr>
                                    <td>GRN No.</td><td>{{depart_device_view.GRN_VALUE | date:'dd-MM-yyyy'}}</td>
                                    <td>GRN Date</td><td>{{depart_device_view.GRN_DATE | date:'dd-MM-yyyy'}}</td>
                                </tr>
                                <tr>
                                    <td>Date of Install</td><td>{{depart_device_view.DATEOF_INSTALL | date:'dd-MM-yyyy'}}</td>
                                    <td>Manufacture Date</td><td>{{depart_device_view.MF_DATE}}</td>
                                </tr>
                                <tr>
                                    <td>End of Life</td><td>{{depart_device_view.END_OF_LIFE | date:'dd-MM-yyyy'}}</td>
                                    <td>End of Support</td><td>{{depart_device_view.END_OF_SUPPORT | date:'dd-MM-yyyy'}}</td>
                                </tr>
                                <tr>
                                    <td>PO NO</td><td>{{depart_device_view.PONO}}</td>
                                    <td>PO Date</td><td>{{depart_device_view.PDATE | date:'dd-MM-yyyy'}}</td>
                                </tr>
                                <tr>
                                    <td>Physical Location</td><td>{{depart_device_view.PHY_LOCATION}}</td>
                                    <td>Description</td><td>{{depart_device_view.DESC_P}}</td>
                                </tr>
                                <tr>
                                    <td width="25%">Model</td><td>{{depart_device_view.E_MODEL}}</td>
									<td width="25%">Remarks</td><td>{{depart_device_view.REMARKS}}</td>
                                </tr>
                            </table>
                        </md-content>
                    </md-tab>

                <md-tab md-primary label="Contract Info"><!-- Profile Begin -->
                    <md-content flex>
                        <table class="md-api-table table table-bordered" style="width:100%;">
                            <thead>
                            <tr>
                                <th style="width:14%">Vendor</th>
                                <th style="width:8%">Contact No</th>
                                <th style="width:10%">Email ID</th>
                                <th style="width:16%">Contact Person(CP)</th>
                                <th style="width:8%">CP No.</th>
                                <th style="width:10%">CP Email</th>
                                <th style="width:10%">Type</th>
                                <th style="width:8%">Value</th>
                                <th style="width:8%">From</th>
                                <th style="width:8%">To</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="amc in depart_device_view.amcs">
                                <td>{{amc.cvendor.CP_NAME}}</td>
                                <td>{{amc.cvendor.CP_NUMBER}}</td>
                                <td>{{amc.cvendor.CP_EMAIL}}</td>
                                <td>{{amc.cvendor.contact_person.CP_NAME}}</td>
                                <td>{{amc.cvendor.contact_person_no.CP_NUMBER}}</td>
                                <td>{{amc.cvendor.cp_email.CP_EMAIL}}</td>
                                <td>{{amc.AMC_TYPE}}</td>
                                <td>{{amc.AMC_VALUE}}</td>
                                <td>{{amc.AMC_FROM}}</td>
                                <td>{{amc.AMC_TO}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </md-content>
                </md-tab>
                <!--<md-tab md-primary label="Breakdown Info">
                    <md-content flex>
                        <table class="md-api-table table table-bordered" style="width:100%;">
                            <thead>
                            <tr>
                                <th style="width:50%">Date</th>
                                <th style="width:50%">COST</th>
                            </tr>
                            </thead>
                            <tbody ng-if="!isEmpty(depart_device_view.brk_dwns)">
                            <tr ng-repeat="brk_dwns in depart_device_view.brk_dwns">
                                <td style="width:50%">{{brk_dwns.BD_DATETIME}}</td>
                                <td style="width:50%">{{brk_dwns.BD_COST}}</td>
                            </tr>
                            </tbody>
                            <tbody ng-if="isEmpty(depart_device_view.brk_dwns)">
                            <tr><td colspan="2" style="text-align:center;">No Records Found</td></tr>
                            </tbody>
                        </table>
                    </md-content>
                </md-tab>-->

                <md-tab md-primary label="Maintenance Schedule"><!-- Profile Begin -->
                    <md-content flex layout-align="center center">
                        <table class="md-api-table table table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width:10%">Type</th>
                                <th style="width:20%">ID</th>
                                <th style="width:20%">Done</th>
                                <th style="width:20%">Actual Done</th>
                                <th style="width:20%">Due Date</th>
                                <th style="width:20%">Cost</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="pms_data in depart_device_view.pms">
                                <td>PMS</td>
                                <td>{{pms_data.JOB_ID}}</td>
                                <td>{{pms_data.PMS_DONE  | date:'dd-MM-yyyy'}}</td>
                                <td>{{pms_data.PMS_ACTL_DONE  | date:'dd-MM-yyyy'}}</td>
                                <td>{{pms_data.PMS_DUE_DATE  | date:'dd-MM-yyyy'}}</td>
                                <td></td>
                            </tr>
                            <tr ng-if="qc_data.QC_COUNT!=0" ng-repeat="qc_data in depart_device_view.qc">
                                <td>QC</td>
                                <td>{{qc_data.JOB_ID}}</td>
                                <td>{{qc_data.QC_DONE  | date:'dd-MM-yyyy'}}</td>
                                <td>{{qc_data.QC_ACTL_DONE  | date:'dd-MM-yyyy'}}</td>
                                <td>{{qc_data.QC_DUE  | date:'dd-MM-yyyy'}}</td>
                                <td>{{qc_data.COST}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </md-content>
                </md-tab>

                <md-tab md-primary label="Call Register"><!-- Profile Begin -->
                    <md-content flex>
                            <table class="md-api-table table table-bordered" style="width:100%;">
                                <thead>
                                <tr>
                                    <th>Call Date</th>
                                    <th>Complaint</th>
                                    <th>Completed By</th>
                                    <th>Completed Date Time</th>
                                    <th>DownTime</th>
                                    <th>Cost</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="cms in depart_device_view.cms_data">
                                    <td>{{cms.CDATE | date:'dd-MM-yyyy'}}</td>
                                    <td>{{cms.NATURE_OF_COMP}}</td>
                                    <td>{{cms.ATTENDED_BY_NAME}}</td>
                                    <td>{{cms.JOBCOMPLETED_DATE | date:'dd-MM-yyyy'}} {{cms.JOBCOMPLETED_TIME}}</td>
                                    <td>{{cms.DOWN_TIME}} Day</td>
                                    <td>{{cms.Cost}}</td>
                                </tr>
                                </tbody>
                            </table>
                    </md-content>
                    </md-tab>

                    <md-tab md-primary label="Documents">
                    <md-content flex>
                            <div  style="width:100%;">
                                <ul ng-if="!isEmpty(depart_device_view.docs)" ng-repeat="doc in depart_device_view.docs track by $index">
                                    <li ng-if="$index>1"><a target="_blank" href="{{doc.href}}">{{doc.fname}}</a></li>
                                </ul>
                                <div ng-if="isEmpty(depart_device_view.docs)">
                                    <p>No Documents Found</p>
                                </div>
                            </div>
                    </md-content>
                    </md-tab>
                </md-tabs>
            </div>
        </div>
    </md-dialog-content>
    <md-dialog-actions layout="row">
        <md-button class="md-primary" ng-click="cancel()">Close</md-button>
    </md-dialog-actions>
</md-dialog>