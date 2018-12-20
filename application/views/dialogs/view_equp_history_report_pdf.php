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
                            EQUIPMENT HISTORY REPORT</center></h5>
                </div>
                <div layout-align="end end" flex="0">
                    <img style="float:right" src="<?php echo base_url();?>assets/images/carepdflogo.jpg">
                </div>
            </div>
            <div layout="row" layout-align="center center" flex="100">
                <div flex="100">
                    <table border="2" width="100%" class="dtable">
                        <tr>
                            <th colspan="1">Unit</th>
                            <td colspan="2">{{equp_histrory_report_pdf.branchname}}</td>
                            <th colspan="1">Department</th>
                            <td colspan="2">{{equp_histrory_report_pdf.department}}</td>
                            <th colspan="1">Equipment Name</th>
                            <td colspan="3">{{equp_histrory_report_pdf.E_NAME}}</td>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:center">Equipment Details</th>
                            <th colspan="4" style="text-align:center">Services</th>
                            <th colspan="3" style="text-align:center">Accessories/Consumbles</th>
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="2"></td>
                            <td colspan="1">Date</td>
                            <td colspan="1">Down Time</td>
                            <td colspan="1">Carried by</td>
                            <td colspan="1">Remarks</td>
                            <td colspan="3">1)</td>
                        </tr>
                        <tr>
                            <th colspan="1">Equipment</th>
                            <td colspan="2">{{equp_histrory_report_pdf.E_NAME}}></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="3">2)</td>
                        </tr>
                        <tr>
                            <th colspan="1">Model</th>
                            <td colspan="2">{{equp_histrory_report_pdf.E_MODEL}}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="3">3)</td>
                        </tr>
                        <tr>
                            <td colspan="1">Sr.no</td>
                            <td colspan="2">{{equp_histrory_report_pdf.ES_NUMBER }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="4">3)</td>
                        </tr>
                        <tr>
                            <th colspan="1">Eq ID</th>
                            <td colspan="2">{{equp_histrory_report_pdf.E_ID }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="4">4)</td>
                        </tr>
                        <tr>
                            <th colspan="1">Manufacturer</th>
                            <td colspan="2">{{equp_histrory_report_pdf.MF_DATE }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="4">5)</td>
                        </tr>
                        <tr>
                            <th colspan="1">Dealer</th>
                            <td colspan="2">{{equp_histrory_report_pdf.DISTRIBUTOR }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                               <th  colspan="4" style="text-align:center">Consubles Replacement History</th>
                        </tr>
                        <tr>
                            <th colspan="1">Equp Cost</th>
                            <td colspan="2">{{equp_histrory_report_pdf.E_COST }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th colspan="1">Installed Dt</th>
                            <td colspan="2">{{equp_histrory_report_pdf.DATEOF_INSTALL }} </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th colspan="1">Equp Life</th>
                            <td colspan="2">{{equp_histrory_report_pdf.END_OF_LIFE }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>

                        </tr>
                        <tr>
                            <th colspan="1">Life Cycle Cost</th>
                            <td colspan="2"></td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>

                        </tr>
                        <tr>
                            <th colspan="1">User Dept</th>
                            <td colspan="2"> {{equp_histrory_report_pdf.END_OF_LIFE }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th colspan="1">Contract</th>
                            <td colspan="2"> {{equp_histrory_report_pdf.AMC_TYPE }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>

                        </tr>
                        <tr>
                            <th colspan="1">From</th>
                            <td colspan="2"> {{equp_histrory_report_pdf.C_FROM }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>

                        </tr>

                        <tr>
                            <th colspan="1">To</th>
                            <td colspan="2"> {{equp_histrory_report_pdf.C_TO }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th colspan="1">Contract Cost</th>
                            <td colspan="2"> {{equp_histrory_report_pdf.AMC_VALUE }}</td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th colspan="1">Serviced By</th>
                            <td colspan="2"></td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                             <th colspan="4" style="text-align:center">Spares Replacement</th>
                        </tr>
                        <tr>
                            <th colspan="1" rowspan="4">Servicing Company</th>
                            <td colspan="2" rowspan="4"></td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1">Date</td>
                            <td colspan="1">Cost</td>
                            <td colspan="2">Details</td>
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="1"></td>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>

                        </tr>
                        <tr>
                           <th colspan="4" style="text-align:center">PMS Scheduleds & Adherence History</th>
                            <td colspan="1"> </td>
                            <td colspan="1"> </td>
                            <td colspan="2"></td>

                        </tr>
                        <tr>
                           <th colspan="1">1st year</th>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                           <th colspan="1">phone</th>
                            <td colspan="2"></td>
                            <th colspan="1">2nd year</th>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                           <th colspan="1">Ser Eng</th>
                            <td colspan="2"></td>
                            <th colspan="1">3rd year</th>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                           <th colspan="1">Mobile</th>
                            <td colspan="2"></td>
                            <th colspan="1">4th year</th>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </md-dialog-content>
</md-dialog>