<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock flex>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Indent Report Details</h4>
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
                           INDENT REPORT</center></h5>
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
                            <td>{{indent_reports_pdf.date}}</td>
                            <th width="250">Time</th>
                            <td>{{indent_reports_pdf.time}}</td>
                        </tr>
                        <tr>
                            <th width="250">Department</th>
                            <td>{{indent_reports_pdf.department}}</td>
                            <th width="250">Branch</th>
                            <td>{{indent_reports_pdf.branch_name}}</td>
                        </tr>
                        <tr>
                            <th>Equipment Name</th>
                            <td colspan="3">{{indent_reports_pdf.EQ_NAME}}</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td colspan="3">{{indent_reports_pdf.QTY}}</td>
                        </tr>
                        <tr>
                            <th>Equipment Category</th>
                            <td colspan="3">{{indent_reports_pdf.EQ_CAT}}</td>
                        </tr>
                        <tr>
                            <th> Brief Description</th>
                            <td colspan="3">{{indent_reports_pdf.DESCRP}}</td>
                        </tr>
                        <tr>
                            <th>Basic / Essential Features</th>
                            <td colspan="3">{{indent_reports_pdf.ESNTL_FEATURES}}</td>
                        </tr>
                        <tr>
                            <th>Optimal /Desirous Features</th>
                            <td colspan="3">{{indent_reports_pdf.OPTIMAL_FEATURES}}</td>
                        </tr>
                        <tr>
                            <th>Optimal /Luxurious Features</th>
                            <td colspan="3">{{indent_reports_pdf.OPTIONAL_FEATURES}}</td>
                        </tr>
                        <tr>
                            <th>Standard Accessories</th>
                            <td colspan="3">{{indent_reports_pdf.STNRD_ACCESSORIES}}</td>
                        </tr>
                        <tr>
                            <th>Optional Accessories</th>
                            <td colspan="3">{{indent_reports_pdf.OPTIONAL_ACCESSORIES}}</td>
                        </tr>
                        <tr>
                            <th>Contract Vendor </th>
                            <td colspan="3">{{indent_reports_pdf.EQ_CAT}}</td>
                        </tr>
                        <tr>
                            <th>Reasons </th>
                            <td colspan="3">{{indent_reports_pdf.EQ_CAT}}</td>
                        </tr>
                        <tr>
                            <th>Estimated Cost </th>
                            <td colspan="3">{{indent_reports_pdf.ESTIMATED_COST}}</td>
                        </tr>
                        <tr>
                            <th>Approx revenue generation</th>
                            <td colspan="3">{{indent_reports_pdf.REVENEW_GENERATION}}</td>
                        </tr>
                        <tr>
                            <th>Benefits with Desirous Features</th>
                            <td colspan="3">{{indent_reports_pdf.DESIROUS_REVENEW}}</td>
                        </tr>
                        <tr>
                            <th>Benefits with Luxurious Features</th>
                            <td colspan="3">{{indent_reports_pdf.LUXURY_REVENEW}}</td>
                        </tr>
                        <tr>
                            <th>Budget approved By</th>
                            <td colspan="3">{{indent_reports_pdf.BUDGET_APPROVED_BY}}</td>
                        </tr>
                        <tr>
                            <th>Budget reference</th>
                            <td colspan="3">{{indent_reports_pdf.BUDGET_REFF}}</td>
                        </tr>
                        <tr>
                            <th>Bio-Medical Receipt Date</th>
                            <td colspan="3">{{indent_reports_pdf.BUDGET_APPROVED_DATETIME}}</td>
                        </tr>
                        <tr>
                            <th>Quotes called for : (2 weeks)</th>
                            <td colspan="3">{{indent_reports_pdf.QUOTES}}</td>
                        </tr>
                        <tr>
                            <th>Evalution period :(4 weeks)</th>
                            <td colspan="3">{{indent_reports_pdf.EVALUATION_PEROID}}</td>
                        </tr>
                        <tr>
                            <th>PO Release Date</th>
                            <td colspan="3">{{indent_reports_pdf.PO_DATE}}</td>
                        </tr>
                        <tr height="70" valign="top">
                            <th>Remarks</th>
                            <td colspan="3">{{indent_reports_pdf.REMARKS}}</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                            *(<b>Add additional sheets whenever required</b>)
                                <br>
                                Note:Please take time odd to fill in this requisition carefully.Every effort will be made to procure the best equipment which meets your requirments add also fulfils the organisation's needs of quality,reliability and life-cycle cost.
                            </td>
                        </tr>
                        <tr height="70" valign="top">
                            <td>FORMATE NO : BMF19A<br>
                            <b>SIGNATURE</b><br>
                                <b>NAME</b><br>
                                <b>DESIGNATION</b><br>
                            </td>
                            <td style="text-align:center">
                                INDENTED BY<br>
                                {{indent_reports_pdf.Indented_By}}

                            </td>
                            <td style="text-align:center">
                                APPROVED BY<br>
                                {{indent_reports_pdf.Approved_by}}
                            </td>
                            <td style="text-align:center">
                                SACTIONED BY
                                {{indent_reports_pdf.Sanctioned_by}}
                            </td>
                        </tr>
                     </table>
                </div>
            </div>
        </div>

    </md-dialog-content>
</md-dialog>