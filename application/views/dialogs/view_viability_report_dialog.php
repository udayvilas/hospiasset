
<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock flex>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Viability Report Details</h4>
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
                           VIABILITY REPORT</center></h5>
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
                            <td>{{viabilty_reports_pdf.DATEOF_INSTALL}}</td>
                            <th width="250">Time</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th width="250">Department</th>
                            <td>{{viabilty_reports_pdf.department}}</td>
                            <th width="250">Branch</th>

                            <td>{{viabilty_reports_pdf.branchname}}</td>
                        </tr>
                        <tr>

                            <th width="250" colspan="2">EQUIPMENT ID</th>
                            <td colspan="2">{{viabilty_reports_pdf.E_ID}}</td>
                        </tr>
                        <tr>
                                <th width="250" colspan="2">COST OF EQUIPMENT</th>
                            <td colspan="2">{{viabilty_reports_pdf.E_COST}}</td>
                        </tr>
                        <tr>

                                <th width="250" colspan="2">COST OF CONSUMABLES<BR>
                                </th>
                            <td colspan="2">
                                <table border="1" style="margin-left:-11px;margin-top:-4px;margin-bottom:-4px;margin-right:-2px;">
                                    <tr>
                                        <th width="80">A.DISPOSABLE</th>
                                        <td width="180"></td>
                                        <th width="80">B.REUSABLE</th>
                                        <td width="200" colspan="2"></td>

                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                                <th width="200" colspan="2">IF DISPOSABLE COSTING
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>

                                <th width="250" colspan="2">NUMBER OF CASES DONE PER DAY
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>

                                <th width="250" colspan="2">CHARGES PER OPERATION/PROCEDURE
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                                <th width="250" colspan="2">NUMBER OF OPERATIONS PER YEAR
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                                <th width="250" colspan="2">REVENUE PER YEAR
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                                <th width="250" colspan="2">PROFIT OVER ONE YEAR
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>

                                <th width="250" colspan="2">PROFIT OVER THREE YEAR
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>

                            <th width="250" colspan="2">CODE OF OPERATION
                            </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                                <th width="250" colspan="2">JUSTIFICATION
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                                <th width="250" colspan="2">ADVANTAGES
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                                <th width="250" colspan="2">TECHNICAL SPECIFICATIONS OF THE EQUIPMENT BEING PURCHASED
                                </th>
                            <td colspan="2"></td>
                        </tr>
                        <tr height="70 !important" valign="bottom">
                            <td  colspan="2">USER DEPT HOD SIGNATURE</td>
                            <td  colspan="2" style="text-align:right;padding-right:15px">UNIT HEAD SIGNATURE</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </md-dialog-content>
</md-dialog>