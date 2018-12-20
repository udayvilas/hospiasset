<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding">
    <div layout="column">
        <h3 class="heading-stylerespond">Deployement Report</h3>
        <div id="exportthis">
            <div layout="row" layout-align="center center"  flex="90" style="margin-bottom:5px;">
                <div layout-align="center center" flex="100">
                    <h5 style="font-weight:700"><center>BIOMEDICAL EQUIPMENT DEPLOYEMNT FORMATE</center></h5>
                </div>
                <div layout-align="end end" flex="0">
                    <img style="float:right" src="<?php echo base_url();?>assets/images/carepdflogo.jpg">
                </div>
            </div>
            <center>
            <div layout="row" flex="80"  layout-align="center center" >

                <table  border="2" width="100%" class="dtable">
                    <tr>
                        <th width="200">Date</th>
                        <td></td>
                        <th width="200">Location</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th width="200">Department</th>
                        <td></td>
                        <th width="200">Time</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th width="200">Ref.Indent No.and Date:</th>
                        <td></td>
                        <th  width="200">Indented Item</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Name of the Equipment</th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th> OEM / Make Company</th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th>Model No.</th>
                        <td></td>
                        <th>S1.No.</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>List Of Accessories(With Si.No.s if any)
                        </th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th> Remarks / Comments of users </th>
                        <td  colspan="3"></td>

                    </tr>
                    <tr height="70 !important" valign="bottom">
                        <th colspan="2" height="70 !important">Handed Over By<br>(Name & Signature of BME)</th>
                        <th colspan="2" height="70 !important">Handed over to<br>(Name & Signature of the user)</th>
                    </tr>
                    <tr height="70 !important" valign="bottom">
                        <th colspan="2" height="70 !important">Name & Signature of the HOD</th>
                        <th colspan="2" height="70 !important">Name & Signature of the Hospital Administrator</th>
                    </tr>
                    <tr><th align="center" style="text-align:center"colspan="4">For Biomedical Use</th></tr>
                    <tr>
                        <th>Equp.Id(Allotted by BME)</th>
                        <td></td>
                        <th>Red.p.o. & Date:</th>
                        <td></td>
                    </tr>
                    <tr><th align="center" style="text-align:center"colspan="4">Contract Information</th></tr>
                    <tr>
                        <th>
                            Name,Address and Contact<br>No.of.the Supplier
                        </th>
                        <td colspan="3">
                            {{}}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name,Address and Contact<br>
                            No.of the service Provider
                        </th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th>
                           Ref.DC/Invoice No.with Dates:
                        </th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th>Short Shipments if any</th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th>List of accessories,which can<br>
                       Be Used by BME Dept.only
                        </th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th>Date of Installation:</th>
                        <td></td>
                        <th>Installed by(Service Engr)</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Warranty Start from:</th>
                        <td></td>
                        <th>Expires on</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>
                            Remarks / comments if any :
                        </th>
                        <td colspan="3"></td>
                    </tr>
                    <tr height="70 !important" valign="bottom">
                        <th  colspan="2">(Name & Signature of the BME)</th>
                        <th  colspan="2">(Signature of Bio-medical Dept.In-Charge)</th>
                    </tr>
                </table>

            </div>
            </center>
        </div>
        <center>
            <button ng-click="printPdf()" class="md-raised md-accent md-button md-ink-ripple">Print Pdf</button>
        </center>
</md-content>