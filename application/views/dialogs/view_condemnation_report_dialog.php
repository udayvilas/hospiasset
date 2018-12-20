<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock flex>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Condemnation Report Details</h4>
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
                            MEDICAL EQUIPMENT DISPOSAL REQUISITION REPORT</center></h5>
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
                            <td> {{condemnation_reports_pdf.date}}</td>
                            <th width="250">Time</th>
                            <td>{{condemnation_reports_pdf.time}}</td>
                        </tr>
                        <tr>
                            <th width="250">Department</th>
                            <td>{{condemnation_reports_pdf.department}}</td>
                            <th width="250">Branch</th>

                            <td>{{condemnation_reports_pdf.branchname}}</td>
                        </tr>
                        <tr>
                            <th width="250">From</th>
                            <td>HOSPITAL ADMINISTRATION</td>
                            <th width="250">TO</th>

                            <td>BIOMEDICAL ENGINEERING</td>
                        </tr>
                        <tr>
                            <th width="250"  >EQUIPMENT DESCRIPTION</th>
                            <td colspan="3">{{condemnation_reports_pdf.equp_name}}</td>
                        </tr>
                        <tr>

                            <th width="250" >EQUIPMENT ID</th>
                            <td colspan="1">{{condemnation_reports_pdf.EQUP_ID}}</td>
                            <th width="250" colspan="1">MODEL</th>
                            <td colspan="1">{{condemnation_reports_pdf.model}}</td>

                        </tr>
                        <tr>
                            <th width="250" colspan="1">MANUFACTURER</th>
                            <td colspan="1">{{condemnation_reports_pdf.comany_name}}</td>
                            <th width="250" colspan="1"> YR.OF.PURCHASE</th>
                            <td colspan="1">{{condemnation_reports_pdf.year_of_purchage}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1">SL.NO</th>
                            <td colspan="1">{{condemnation_reports_pdf.es_number}}</td>
                            <th width="250" colspan="1">EQPT.VALUE</th>
                            <td colspan="1">{{condemnation_reports_pdf.equp_val}}</td>
                        </tr>
                        <tr>
                            <td colspan="4">The above mentioned equipment is no longer needed in our department due to one or more of the following reasons</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                {{condemnation_reports_pdf.reasons | objtostring}}
                            </td>
                        </tr>
                       <tr>
                           <td colspan="4">To the best of our knowledge this equipment does not contain any bio-hazardous material ; nor does it contains any material that is inflammable ,infection,environmentally unsafe,toxic or radioactive.</td>
                       </tr>
                        <tr height="100" valign="top">
                            <td colspan="4">
                               Recommendation if any, on aspects related to hazards to ensure safe disposal.<br>{{condemnation_reports_pdf.FEEDBACK2}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">It is therefore requested to remove the above equipment from our department</td>
                        </tr>
                        <tr height="70 !important" valign="bottom">
                            <th  colspan="2">Head of the department</th>
                            <th  colspan="2" style="text-align:right;padding-right:15px">Chief Hospital Administrator</th>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align:right;padding-right:15px">
                                <span>BIOMEDICAL RECEIPT DATE & TIME:<br></span>
                                <span>EDR NO :<br></span>
                                <span>RECEIVED BY:<br></span>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="md-dialog-content" layout="column" id="exportthis" flex>
            <div layout="row" flex style="margin-bottom:5px;">
                <div layout-align="center center" flex="100">
                    <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                            BIOMEDICAL ENGINEERING DEPARTMENT<br>
                            MEDICAL EQUIPMENT CONDEMNATION CONFIRMATION NOTE</center></h5>
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
                            <td> {{condemnation_reports_pdf.date}}</td>
                            <th width="250">Time</th>
                            <td>{{condemnation_reports_pdf.time}}</td>
                        </tr>
                        <tr>
                            <th width="250">Department</th>
                            <td>{{condemnation_reports_pdf.department}}</td>
                            <th width="250">Branch</th>

                            <td>{{condemnation_reports_pdf.branchname}}</td>
                        </tr>
                        <tr>
                            <th width="250">CPY  </th>
                            <td>PURCHASE DEPT.</td>
                            <th width="250">REF.EDR No
                            </th>
                            <td></td>
                        </tr>
                        <tr>
                            <th width="250" >EQUIPMENT ID</th>
                            <td colspan="3">{{condemnation_reports_pdf.EQUP_ID}}</td>
                        </tr>

                        <tr>
                            <th width="250"  >EQUIPMENT DESCRIPTION</th>
                            <td colspan="3">{{condemnation_reports_pdf.equp_name}}</td>
                        </tr>
                        <tr>
                            <th width="250"  >MANUFACTURER</th>
                            <td colspan="3">{{condemnation_reports_pdf.comany_name}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1">MODEL</th>
                            <td colspan="3">{{condemnation_reports_pdf.model}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1">SL.NO</th>
                            <td colspan="3">{{condemnation_reports_pdf.es_number}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1"> YR.OF.PURCHASE</th>
                            <td colspan="3">{{condemnation_reports_pdf.year_of_purchage}}</td>
                        </tr>
                        <tr>
                            <th width="250" colspan="1">EQPT.VALUE</th>
                            <td colspan="3">{{condemnation_reports_pdf.equp_val}}</td>
                        </tr>
                      <tr>
                          <th width="250" colspan="1">REASONS(S)FOR CONDEMNATION</th>
                          <td colspan="3">{{condemnation_reports_pdf.reasons | objtostring}}</td>
                      </tr>

                       <tr>
                           <td colspan="4">
                               The above mentioned equipment is decommissioned and disposed of from your department with effect from
                           </td>
                       </tr>
                        <tr>
                           <td colspan="4"><b>* Note : This from must accompany replacement indent.</b></td>
                        </tr>

                        <tr height="90" valign="bottom">
                            <th colspan="4" style="padding-right:15px">
                                <span>Unit Head-Biomedical Engineering Dept:<br></span>
                                <span>Name :<br></span>
                                <span>Unit Name:<br></span>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <div class="md-dialog-content" layout="column" id="exportthis" flex>
            <div layout="row" flex style="margin-bottom:5px;">
                <div layout-align="center center" flex="100">
                    <h5 style="font-weight:700"><center>CARE HOSPITALS<br>
                            BIOMEDICAL ENGINEERING DEPARTMENT<br>
                             EQUIPMENT CONDEMNATION RECOMMENDATION</center></h5>
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
                            <td> {{condemnation_reports_pdf.date}}</td>
                            <th width="250">Time</th>
                            <td>{{condemnation_reports_pdf.time}}</td>
                        </tr>
                        <tr>
                            <th width="250">Department</th>
                            <td>{{condemnation_reports_pdf.department}}</td>
                            <th width="250">Branch</th>
                            <td>{{condemnation_reports_pdf.branchname}}</td>
                        </tr>
                        <tr height="100" valign="top">
                            <th width="250" style="text-align:right;">TO </th>
                            <td>
                                <b>UNIT FINANCE</b> <br>
                                UNIT STORES:<br>
                                UNIT HOD:<br>
                                UNIT CHA:<br>
                                UNIT MED DIR:<br>
                            </td>
                            <th width="250"  style="text-align:right;">COPIES
                            </th>
                            <td>
                                CORP BIOMEDICAL<br>
                                CORP FINANCE :<br>
                                CORP COO :<br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                The following Biomedical Equipments which is part of the Biomedical Asset List are no longer fit to be used, and need to be removed from the premises after due process.Broadly, the reason for condemnation falls within one or more of the following parameters mentioned below:
                                </td>
                            <tr>
                            <td colspan="4">
                                <span>Equipment is old</span><br>
                                <span>Technological or clinical obsolescence</span><br>
                                <span>Maintenance unviable</span><br>
                                <span>Spare parts no longer available</span><br>
                                <span>Worn out or damaged beyond economic repairs.</span><br>
                                <span>Equipment is unsafe to operate.(Clinical,electical or mechanical reasons)</span><br>
                    <span>Equipment is unreliable (output of the unit cannot be relied upon)</span><br>                <span>More cost-effective equipment or clinical service is available</span><br>
                                                                                                                       <span>Dangerous / hazardous to use</span><br>
                                                                                                                       <span>The equipment is being taken back against buy-back offer</span><br>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <table border="1" width="1025" style="margin:-2px -45px -2px -11px">
                                    <tr>
                                        <th width="20%">EQUIPMENT DESCRIPTION</th>
                                        <th width="30%">** EQUIP ID</th>
                                        <th width="10%">DEPT</th>
                                        <th width="20%">PURCHASE DETAILS</th>
                                        <th width="10%">VALUE</th>
                                        <th width="12px">DT OF INSTL</th>
                                    </tr>
                                    <tr>
                                        <td>{{condemnation_reports_pdf.equp_name}}</td>
                                        <td>{{condemnation_reports_pdf.EQUP_ID}}</td>
                                        <td>{{condemnation_reports_pdf.DEPT_ID}}</td>
                                        <td>{{condemnation_reports_pdf.year_of_purchage}}</td>
                                        <td>{{condemnation_reports_pdf.equp_val}}</td>
                                        <td>{{condemnation_reports_pdf.year_of_purchage}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                       <tr>
                           <td colspan="4">
                               Hazardous / polluting parts from the above equipment are segregated , handed over to waste management for safe disposal.
                           </td>
                       </tr>
                        <tr>
                           <td colspan="4">
                               Reusable parts /modules salvaged in spare part store.<br>
                               Other unusable parts can be disposed by one of the following methods
                           </td>
                       </tr>
                        <tr>
                            <th>Reusable parts</th>
                            <td colspan="1">{{condemnation_reports_pdf.reusableparts | objtostring}}<br></td>
                            <th>Expected Value</th>
                            <td>{{condemnation_reports_pdf.EXPECTED_COST}}</td>
                        </tr>
                      <tr>
                    <td colspan="4">It is therfore requested to remove the above equipment from the biomedical asset list as well as company fixed assets register </td>
                      </tr>

                        <tr height="100" valign="bottom">
                            <th colspan="1" style="padding-right:15px">
                                <span>Unit Head-Biomedical Engineering <br></span>
                                <span>Name :<br></span>
                                <span>Unit Name:<br></span>
                            </th>
                            <th colspan="2" style="text-align:center">
                                <span>Unit Head-Finance department:<br></span>
                                <span style="margin-left:-125px;text-align:left">Name :<br></span>
                                <span style="margin-left:-104px;text-align:left">Unit Name:<br></span>
                            </th>
                            <th colspan="1" style="text-align:right;padding-right:15px">
                                <span>General Manager &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>Biomedical Engineering</span>

                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </md-dialog-content>
</md-dialog>