<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    body
    {
        font-size: 14px;
    }
</style>
<md-content class="mylayout-padding">
    <div layout-align="center center" flex="100">
        <button ng-click="newPdf()" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</button>
    </div>
    <div layout="row" id="exportthis" flex layout-align="center center">
    <div layout="column">
        <div layout="row" flex style="margin-bottom:5px;">
            <div layout-align="center center" flex="100">
                <h5 style="font-weight:700">
                <center>CARE HOSPITALS<br>
                BIOMEDICAL ENGINEERING DEPARTMENT<br>
                DEPLOYMENT FORMAT
                </center></h5>
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
                        <td>{{deployemnt_report_pdf.DATEOF_INSTALL}}</td>
                        <th width="250">Time</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th width="250">Department</th>
                        <td>{{deployemnt_report_pdf.department}}</td>
                        <th width="250">Branch</th>

                        <td>{{deployemnt_report_pdf.branchname}}</td>
                    </tr>
                    <tr>
                        <th width="250">Ref.Indent No.and Date</th>
                        <td></td>
                        <th  width="250">Indented Item</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Name of the Equipment</th>
                        <td colspan="3">{{deployemnt_report_pdf.E_NAME}} </td>
                    </tr>
                    <tr>
                        <th> OEM / Make Company</th>
                        <td colspan="3">{{deployemnt_report_pdf.C_NAME}} </td>
                    </tr>
                    <tr>
                        <th>Model No.</th>
                        <td>{{deployemnt_report_pdf.E_MODEL}}</td>
                        <th>S.No.</th>
                        <td>{{deployemnt_report_pdf.ES_NUMBER}}</td>
                    </tr>
                    <tr>
                        <th>List Of Accessories(With SI.No.s if any)
                        </th>
                        <td colspan="3"> {{deployemnt_report_pdf.ACCSSORIES}}</td>
                    </tr>
                    <tr>
                        <th> Remarks / Comments of Users </th>
                        <td  colspan="3"></td>

                    </tr>
                    <tr height="70 !important" valign="bottom">
                        <th colspan="2" height="70 !important"><span style="margin-left:30px;">Handed Over By</span><br>(Name & Signature of BME)</th>
                        <th colspan="2" height="70 !important" style="text-align:right;padding-right:15px" <span>Handed over to &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;</span><br>(Name & Signature of the User)</th>
                    </tr>
                    <tr height="70 !important" valign="bottom">
                        <th colspan="2" height="70 !important">Name & Signature of the HOD</th>
                        <th colspan="2" height="70 !important" style="text-align:right;padding-right:15px">Name & Signature of the Hospital Administrator</th>
                    </tr>
                    <tr><th align="center" style="text-align:center"colspan="4">For Biomedical Use</th></tr>
                    <tr>
                        <th>Equp.Id(Allotted by BME)</th>
                        <td>{{deployemnt_report_pdf.E_ID}}</td>
                        <th>Ref.P.O. & Date</th>
                        <td> {{deployemnt_report_pdf.PONO}}<br>{{deployemnt_report_pdf.PDATE}}</td>
                    </tr>
                    <tr><th align="center" style="text-align:center"colspan="4">Contract Information</th></tr>
                    <tr>
                        <th>
                            Supplier
                        </th>
                        <td colspan="3">
                            <table border="1" border="collapse" style="margin-left:-11px;margin-top:-2px;margin-bottom:-2px;margin-right:-2px;">
                                <tr>
                                    <th width="100">
                                        Name
                                    </th>
                                    <td width="400" >{{deployemnt_report_pdf.suppliername}}</td>
                                    <th width="100">Contact No</th>
                                    <td width="300">
                                        {{deployemnt_report_pdf.suppliercontact_no}}</td>
                                </tr>
                                <tr>
                                    <th  width="100">Address</th>
                                    <td  colspan="4" width="400"> {{deployemnt_report_pdf.supplieraddress}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            service Provider
                        </th>
                        <td colspan="3">
                            <table  border="1" style="margin-left:-11px;margin-top:-2px;margin-bottom:-2px;margin-right:-2px;">
                                <tr>
                                    <th width="100">Name</th>
                                    <td width="400">{{deployemnt_report_pdf.vendorname}}</td>
                                    <th width="100">Contact No </th>
                                    <td  width="300">  {{deployemnt_report_pdf.vendorcontact_no}} </td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td colspan="4">{{deployemnt_report_pdf.vendoraddress}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            DC No
                        </th>
                        <td colspan="3">
                            <table border="1" style="margin-left:-11px;margin-top:-2px;margin-bottom:-2px;margin-right:-2px;">
                                <tr>

                                    <td width="150">&nbsp;</td>
                                    <th width="50">Date</th>
                                    <td width="100">&nbsp;</td>
                                    <th width="120">Invoice No</th>
                                    <td width="150">&nbsp;</td>
                                    <th width="50">Date</th>


                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>Short Shipments if any</th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th>List of accessories,which can<br>
                            Be Used by BME Dept.only
                        </th>
                        <td colspan="3">
                            {{deployemnt_report_pdf.ACCSSORIES}}
                        </td>
                    </tr>
                    <tr>
                        <th>Date of Installation</th>
                        <td></td>
                        <th>Installed by(Service Engr)</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Warranty Start from</th>
                        <td></td>
                        <th>Expires on</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>
                            Remarks / Comments if any
                        </th>
                        <td colspan="3">{{deployemnt_report_pdf.REMARKS}}</td>
                    </tr>
                    <tr height="70 !important" valign="bottom">
                        <th  colspan="2">(Name & Signature of the BME)</th>
                        <th  colspan="2" style="text-align:right;padding-right:15px">(Signature of Bio-Medical Dept.In-Charge)</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
</md-content>