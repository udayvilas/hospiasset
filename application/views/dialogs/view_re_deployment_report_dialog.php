<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock flex>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>ReDeployment Report Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()" style="color:#000 !important;">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-dialog-content flex="100">
        <div layout="row" layout-align="end end" flex="100">
            <button ng-click="printPdf()" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</button>
        </div>
        <div class="md-dialog-content" layout="column" id="exportthis" flex>
            <div layout="row" flex style="margin-bottom:5px;">
                <div layout-align="center center" flex="100">
                    <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                            BIOMEDICAL ENGINEERING DEPARTMENT<br>
                            REDEPLOYMENT REQUISITION FORMAT</center></h5>
                </div>
                <div layout-align="end end" flex="0">
                    <img style="float:right" src="<?php echo base_url();?>assets/images/carepdflogo.jpg">
                </div>
            </div>
            <div layout="row" layout-align="center center" flex="100">
                <div flex="100">
                    <table  border="2" width="100%" class="dtable">
                        <tr>
                            <th width="250">Date</th>
                            <td width="300">{{deployemnt_report_pdf.DATEOF_INSTALL}}</td>
                            <th width="250">Time</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th width="250">Department</th>
                            <td>{{deployemnt_report_pdf.department}}</td>
                            <th width="250">Branch</th>

                            <td>{{deployemnt_report_pdf.branchname}}</td>
                        </tr>
                        <tr align="right">
                            <td colspan="4" style="text-align:right;padding-right:10px;">Returnable/non-Returnable</td>
                        </tr>
                        <tr>
                            <th colspan="2">FM : The office of the CHA / Medical Director</th>
                            <th colspan="2"  style="text-align:right;padding-right:10px;">TO : Biomedical Engineering Department</th>
                        </tr>
                        <tr>
                            <tr>
                            <td colspan="4">Kindly shift the equipment for temporary / routine / urgent requirement as described below.I have  already got the consent of the departments concerned.(Inter hospital shifting will require the consent of both HA's and may be ordered only by the Medical Director.)</td>
                            </tr>
                        <tr>
                            <th>Desired to be done in</th>
                            <td></td>
                            <th>hrs./days or before</th>
                            <td>(date)</td>
                        </tr>
                        <tr>
                            <th>From (Location & Dept.)</th>
                            <td></td>
                            <th>Contact person & Name</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>to (Location & Dept.)</th>
                            <td></td>
                            <th>Contact person & Name</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Name & Description of the Equipment</th>
                            <td></td>
                            <th>Qty</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Expected Date of Return</th>
                            <td></td>
                            <th>Purpose of Shifting</th>
                            <td></td>
                        </tr>
                       <tr height="100 !important" valign="bottom" border="0">
                            <td colspan="4">
                        <div style="float:left; width:350px" >&nbsp;&nbsp;&nbsp;&nbsp;Name & Signature of the <br>
                            HA/Medical Director / MOD</div>
                                <div style="text-align:center;float:left;width:350px">
                                    Name & Signature of the HOD
                                    <br>Originating Department / HA
                                </div>
                                <div style="width:300px;float:right;text-align:right;padding-right:15px">
                                    Name & Signature of the HOD
                                    <br> User Department / HA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:center">(For Biomedical Use)</td>
                        </tr>
                        <tr>
                            <th> Requisition received date and time</th>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <th> Equipment ID</th>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <th> Details of the Equipment
                            <br>(EqID,Model & S.no.etc)</th>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <th>List of Accessories</th>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <th>
                                For BME (Engineers responsible)Names
                            </th>
                            <td></td>
                            <th>Gate pass (out/in)</th>
                            <td></td>
                        </tr>
                        <tr>
                           <th>Transfer Completed (Date & Time)</th>
                            <td></td>
                            <th>Gate pass (out/in)</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th> Equipment returned on (Date and Time)</th>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:center"> (Return Acknowledgement - In case it is on Returnable Basis)</td>
                        </tr>
                        <tr>
                            <th>Equipment Return Acknowledgement by (User Department) </th>
                            <td></td>
                            <th>Remarks</th>
                            <td></td>
                        </tr>
                        <tr height="70" valign="bottom">

                            <td colspan="4">
                                <div style="float:left"><b>Signature</b></div>
                                <div style="float:right;padding-right:15px;"><b>Date and Time</b></div>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="4"><b>Format NO : </b> BMF13A</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </md-dialog-content>
</md-dialog>