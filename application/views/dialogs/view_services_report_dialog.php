<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock flex>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Services Report Details</h4>
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
                           Services REPORT</center></h5>
                </div>
                <div layout-align="end end" flex="0">
                    <img style="float:right" src="<?php echo base_url();?>assets/images/carepdflogo.jpg">
                </div>
            </div>
            <div layout="row" layout-align="center center" flex="100">
                <div flex="100">
                    <table   border="2" width="100%" class="dtable">
                        <tr>
                            <th colspan="1">EQUIPMENT NAME</th>
                            <td colspan="1">{{service_report_pdf.E_NAME}}</td>
                            <th colspan="1">EQUIPMENT ID</th>
                            <td  colspan="3">{{service_report_pdf.E_ID}}</td>
                            <th colspan="1">MAKE/MODEL</th>
                            <td colspan="1">{{service_report_pdf.E_MODEL}}</td>
                            <th colspan="1">SL.NO</th>
                            <td colspan="1">{{service_report_pdf.ES_NUMBER}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">EQUIPMENT Location</th>
                            <td colspan="1">{{service_report_pdf.PHY_LOCATION}}</td>
                            <th colspan="1">CALL DATE</th>
                            <td colspan="1">{{service_report_pdf.cdate}}</td>
                            <th colspan="1" >CALL TIME</th>
                            <td colspan="1">{{service_report_pdf.ctime}}</td>
                            <th colspan="1">JOB COMPLETED DATE</th>
                            <td colspan="1">{{service_report_pdf.JOBCOMPLETED_DATE}}</td>
                            <th colspan="1"> JOB COMPLETED TIME</th>
                            <td colspan="1">{{service_report_pdf.JOBCOMPLETED_TIME}}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Fault Reported</th>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <th colspan="2">Engers Observations</th>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <th colspan="2">Diagonasis</th>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <th colspan="2">Work Done</th>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <th colspan="2">Remarks</th>
                            <td colspan="5">{{service_report_pdf.REMARKS}}</td>
                            <td colspan="2">Work Hours</td>
                            <td width="40" colspan="1"></td>
                        </tr>
                        <tr>
                            <td colspan="7" width="800"></td>
                            <td colspan="2" width="300">Minutes</td>
                            <td width="40" colspan="1"></td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <table border="1" style="margin:-2px -2px -2px -11px">
                                    <tr>
                                        <td>NO</td>
                                        <th width="250" colspan="2">Material Used</th>
                                        <th width="250" colspan="2">Quality</th>
                                        <th  width="250"colspan="2">Document References</th>
                                        <td width="300"colspan="3">Job Completed</td>
                                        <td width="40" colspan="1"></td>
                                    </tr>
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td colspan="3">Job Pending</td>
                                        <td width="40" colspan="1"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td colspan="3">CMC</td>
                                        <td width="40" colspan="1"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td colspan="3">AMC</td>
                                        <td width="40" colspan="1"></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td colspan="3">No COntract</td>
                                        <td width="40" colspan="1"></td>
                                    </tr>

                                </table>
                        <tr>
                        <tr>
                            <th colspan="1">Dept in charge Signature</th>
                            <td colspan="3"></td>
                            <th colspan="1">Engineer Name</th>
                            <td colspan="2"></td>
                            <th colspan="1">Signature</th>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </md-dialog-content>
</md-dialog>