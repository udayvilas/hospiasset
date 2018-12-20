<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock flex>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Cear Report Details</h4>
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
                            CEAR REPORT</center></h5>
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
                            <td>{{cear_reports_pdf.date}}</td>
                            <th width="250">Time</th>
                            <td>{{cear_reports_pdf.time}}</td>
                        </tr>
                        <tr>
                            <th width="250">Department</th>
                            <td>{{cear_reports_pdf.department}}</td>
                            <th width="250">Branch</th>
                            <td>{{cear_reports_pdf.branch_name}}</td>
                        </tr>
                        <tr>
                        <th>CEAR NUMBER</th>
                            <td>{{cear_reports_pdf.CEAR_ID}}</td>
                        <th>Project Number</th>
                            <td>{{cear_reports_pdf.PROJECT_ID}}</td>
                        </tr>
                        <tr>
                            <th>Project Title</th>
                            <td>{{cear_reports_pdf.TITLE}}</td>
                            <th>Category</th>
                            <td>{{category}}</td>
                        </tr>
                        <tr>
                            <th>Requesting Unit</th>
                            <td>{{cear_reports_pdf.REQ_UNIT}}</td>
                            <th>Requesting DEPT</th>
                            <td>{{cear_reports_pdf.REQ_DEPT}}</td>
                        </tr>
                        <tr>
                            <th>Scope of the Project</th>
                            <td colspan="3">{{cear_reports_pdf.SOP}}</td>
                        </tr>
                        <tr>
                            <th>Purpose & Justification</th>
                            <td colspan="3">{{cear_reports_pdf.PAJ}}</td>
                        </tr>
                        <tr>
                            <th>Alternatives Considered</th>
                            <td colspan="3">{{cear_reports_pdf.AC}}</td>
                        </tr>
                        <tr>
                            <th>Consequence of Not Approving Expenditure</th>
                            <td colspan="3">{{cear_reports_pdf.CONAE}}</td>
                        </tr>
                        <tr>
                            <th>Effect on Operating Budget / Experts</th>
                            <td colspan="3">{{cear_reports_pdf.EOOBE}}</td>
                        </tr>
                        <tr>
                            <th>Equipment Purchage</th>
                            <td colspan="3">{{cear_reports_pdf.EP}}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td colspan="1">{{cear_reports_pdf.DATE}}</td>
                            <th>Start Time</th>
                            <td colspan="1">{{cear_reports_pdf.CDATE}}</td>
                        </tr>
                        <tr valign="top">
                            <th>Finacial Justification</th>
                            <td colspan="3">
                                <span>Project Profit & Loss Statement</span><br>
                                <span>Project Cash Flow Statement</span><br>
                                <span>Finding Options and Impact on Balance Sheet</span><br>
                                <span>Payback Period</span><br>
                                <span>Return on Investment / IRR</span><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Details Finacial Attached </th>
                            <td colspan="3">{{cear_reports_pdf.DFATTACHED}}</td>

                        </tr>
                        <tr>
                            <th>Conclusion</th>
                            <td colspan="3">{{cear_reports_pdf.CONSLUSION}}</td>
                        </tr>
                        <tr>
                            <th>Cost Centered to be Charged</th>
                            <td colspan="3">{{cear_reports_pdf.COST}}</td>
                        </tr>
                        <tr>
                            <th>Cost Estimate</th>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="4"> <b>Authorization</b></td>
                        </tr>
                        <tr>

                            <th colspan="2">Bio Medical Manager</th>
                            <th>Signature</th>
                            <th>Date</th>
                        </tr>
                        <tr>
                            <th colspan="2">CHA</th>
                            <td></td>
                            <td></td>
                        </tr
                        <tr>
                            <th colspan="2">Medical Director</th>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2">FUNCTIONAL Head / COO</th>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2">CEO</th>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2">CMD</th>
                            <td></td>
                            <td></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

    </md-dialog-content>
</md-dialog>