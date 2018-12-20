<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock flex>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>GatePass Report Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()" style="color:#000 !important;">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-dialog-content flex="100">
        <div layout="row" layout-align="end center" flex="100">
            <button ng-click="printPdf()" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</button>
        </div>
        <div class="md-dialog-content" layout="column" id="exportthis" flex>
            <div layout="row" flex style="margin-bottom:5px;">
                <div layout-align="center center" flex="100">
                    <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                            BIOMEDICAL ENGINEERING DEPARTMENT<br>
                            GATEPASS REPORT</center></h5>
                </div>
                <div layout-align="end end" flex="0">
                    <img style="float:right" src="<?php echo base_url();?>assets/images/carepdflogo.jpg">
                </div>
            </div>
            <div layout="row" layout-align="center center" flex="100">
                <div flex="100">
                    <table border="2" class="dtable" width="1050">
                        <tr>
                            <th width="20%">Hospital</th>
                            <td width="30%">Care Hospitals</td>
                            <th width="20%">Branch</th>
                            <td>{{gate_passs.branch_name}}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{gate_passs.date}}</td>
                            <th>Time</th>
                            <td>{{gate_passs.time}}</td>
                        </tr>
                        <tr>
                            <th>Dept</th>
                            <td>{{gate_passs.department}}</td>
                            <th>GRP No</th>
                            <td>{{gate_passs.GP_ID}}</td>
                        </tr>
                        <tr>
                            <th>Retanable Type</th>
                            <td>{{gate_passs.RETURN_TYPE}}</td>
                            <th>Return Due Dt</th>
                            <td>{{gate_passs.date}}</td>
                        </tr>
                        <tr>
                            <th>Accssories</th>
                            <td>{{gate_passs.ACCESSORIES}}</td>
                            <th>Spares</th>
                            <td>{{gate_passs.SPARES}}</td>
                        </tr>
                        <tr>
                            <th>Serial no</th>
                            <td>{{gate_passs.serial_no}}</td>
                            <th>Count</th>
                            <td>Spares : {{gate_passs.SPARES_CNT}},Accessories :{{gate_passs.SPARES_CNT}}</td>
                        </tr>
                        <tr>
                            <th>Note : </th>
                            <td colspan="3"></td>

                        </tr>
                        <tr height="70" valign="bottom">
                            <th>Security Supervisor</th>
                            <th colspan="2">Reciver</th>
                            <th>Signatory</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </md-dialog-content>
</md-dialog>