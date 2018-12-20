<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content layout="column" class="mylayout-padding" ng-cloak>
    <h3 class="heading-stylerespond">Send Emails</h3>
    <!--<div layout="row" >
        <md-button ui-sref="home.condemnation_request" class="md-raised md-primary">Request</md-button>
    </div>-->
    <div layout="row">
        <table width="700px" border="0" cellpadding="0" cellspacing="0" align="center" style="min-width:700px">
            <tbody>
            <tr>
                <td bgcolor="#f5f7f9" valign="middle" style="padding:25px;box-sizing:border-box">

                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tbody>
                        <tr>
                            <td valign="middle" align="center" style="padding:0px 0px" bgcolor="#614da4">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">
                                    <tbody><!--<tr>
                                        <td align="center" style="margin-bottom:10px;padding:15px 5px 0;color:#d1d6da;text-align:center;font-size:11px;font-weight:bold">
                                            <p style="margin:0 0 10px 0;float:left">
                                                <img src="<?php /*echo base_url()*/?>assets/images/care_mainlogo.PNG" width="150px" height="100" style="display:inline-block" class="CToWUd">
                                            </p>
                                            <p style="margin:0 0 10px 0;float:right">
                                                <img src="<?php /*echo base_url()*/?>assets/images/ha_logo.PNG" width="150px" height="100" style="display:inline-block" class="CToWUd">
                                            </p>

                                        </td>
                                    </tr>-->
                                    <tr>
                                        <td> <h3 style="margin:0 0 10px 0;text-align:center;color:#ffffff">HospiAsset</h3></td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>

                    <tr>
                    <td valign="top" align="center" style="border:0px solid #0073cf;padding:35px;box-sizing:border-box;font-size:0">
                                <p style="clear:both"></p>
                                <p style="margin:0;color:#404040;font-size:18px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">Hi, <a style="color:#0073cf;text-decoration:none">This is the Send Email</a></p>

                                <table bgcolor="#fff" width="600" cellpadding="0" cellspacing="0">
                                    <tbody>

                                    <tr>
                                        <td valign="top" align="center" style="padding:20px 25px;font-size:0;background-color:#fff">
                                            <table class="md-api-table table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Branch Name</th>
                                                    <th>Total Calls</th>
                                                    <th>Pending Calls</th>
                                                    <th>Completed Calls </th>

                                                </tr>
                                                </thead>
                                                <tbody ng-if="mail_details!=null">
                                                <tr ng-repeat="mail_detail in mail_details">
                                                    <td>{{mail_detail.name}}</td>
                                                    <td>{{mail_details.total_cms}}</td>
                                                    <td>{{mail_details.pending_cms}}</td>
                                                    <td>{{mail_details.completed_cms}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <p style="margin:30px 0 10px;text-align:left;color:#7d8389;font-size:16px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">Renown Analytics IT Solutions is keen into project development and implementations with expertise in Statistical Analysis, Advanced Analytics, Business Intelligence, Application Development, Application Maintenance Service, Web Development, Infrastructure, Engineering, Bio-Informatics, and Logistics & Health Care based applications and other IT enables services.Renown Analytics IT Solutions is keen into project development and implementations with expertise in Statistical Analysis, Advanced Analytics, Business Intelligence, Application Development, Application Maintenance Service, Web Development, Infrastructure, Engineering, Bio-Informatics, and Logistics & Health Care based applications and other IT enables services.</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>

                        <tr>
                            <td valign="middle" align="center" style="padding:0px 25px" bgcolor="#614da4">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">
                                    <tbody>
                                    <tr>
                                        <td valign="middle" align="center" style="padding:15px 0px" bgcolor="#614da4">

                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">
                                                <tbody><tr>
                                                    <td align="center" style="padding:15px 0px 0;color:#d1d6da;text-align:center;font-size:11px;font-weight:bold">© 2017, Renown Analytics Pvt Ltd. All rights reserved.</td>
                                                </tr>
                                                </tbody></table>
                                        </td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</md-content>