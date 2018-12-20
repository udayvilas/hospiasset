<?php
foreach($users as $user)
{
        if($user[$this->users->ORG_BRANCH_ID]==NULL && $user[$this->users->ROLE_CODE]==HMADMIN)
        {
            $user_branches = explode(",",$coma_branches);
        }
        else if($user[$this->users->ORG_BRANCH_ID]!=NULL)
        {
            $user_branches = explode(",",$user[$this->users->ORG_BRANCH_ID]);
        }
        $mail_body='';
        foreach($user_branches as $user_branch)
        {
            if(array_key_exists($user_branch,$branches))
            {
                $mail_body.='<tr>
                        <td style="text-align: center;font-weight: bold;">
                        <table width="100%" cellpadding="2" cellspacing="0" style="border-collapse:collapse;color:#0C2238;font-size:14px;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><tr><td>'.$branches[$user_branch]['name'].'</td></tr></table></td>
                    </tr>
                    <tr>
                        <td valign="top" align="center" style="padding:10px 10px;font-size:0;background-color:#fff">
                            <table border="1" width="100%" cellpadding="2" cellspacing="0" style="border:1px solid #0073cf;border-collapse:collapse;color:#0C2238;font-size:14px;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">
                                <tr>
                                    <th width="40%">Tasks</th>
                                    <th width="20%">Total</th>
                                    <th width="20%">Pending</th>
                                    <th width="20%">Completed</th>
                                </tr>
                                <tr>
                                    <td style="padding-left:10px;">CMS</td>
                                    <td>'.$branches[$user_branch]['total_cms'].'</td>
                                    <td>'.$branches[$user_branch]['pending_cms'].'</td>
                                    <td>'.$branches[$user_branch]['completed_cms'].'</td>

                                </tr>
                                <tr>
                                    <td style="padding-left:10px;">PMS</td>
                                    <td>'.$branches[$user_branch]['total_pms'].'</td>
                                    <td>'.$branches[$user_branch]['pending_pms'].'</td>
                                    <td>'.$branches[$user_branch]['completed_pms'].'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:10px;">Calibration</td>
                                    <td>'.$branches[$user_branch]['total_qc'].'</td>
                                    <td>'.$branches[$user_branch]['pending_qc'].'</td>
                                    <td>'.$branches[$user_branch]['completed_qc'].'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:10px;">Adverse</td>
                                    <td>'.$branches[$user_branch]['total_adv'].'</td>
                                    <td>'.$branches[$user_branch]['pending_adv'].'</td>
                                    <td>'.$branches[$user_branch]['completed_adv'].'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:10px;">Rounds</td>
                                    <td>'.$branches[$user_branch]['total_rds'].'</td>
                                    <td>'.$branches[$user_branch]['pending_rds'].'</td>
                                    <td>'.$branches[$user_branch]['completed_rds'].'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:10px;">Transfers</td>
                                    <td>'.$branches[$user_branch]['total_trnsfers'].'</td>
                                    <td>'.$branches[$user_branch]['pending_trnsfers'].'</td>
                                    <td>'.$branches[$user_branch]['completed_trnsfers'].'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:10px;">Contracts</td>
                                    <td>'.$branches[$user_branch]['total_contrcts'].'</td>
                                    <td>'.$branches[$user_branch]['pending_contrcts'].'</td>
                                    <td>'.$branches[$user_branch]['completed_contracts'].'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:10px;">Condemnation</td>
                                    <td>'.$branches[$user_branch]['total_cods'].'</td>
                                    <td>'.$branches[$user_branch]['pending_cods'].'</td>
                                    <td>'.$branches[$user_branch]['completed_cods'].'</td>
                                </tr>
                            </table>
                        </td>
                    </tr>';
            }
        }
    $body='<html>
        <body>
            <table width="700px" border="0" cellpadding="0" cellspacing="0" align="center" style="min-width:700px;border:1px solid #614da4">
            <tbody>
            <tr>
                <td bgcolor="#f5f7f9" valign="middle" style="padding:25px;box-sizing:border-box">

                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tbody>
                        <tr>
                            <td valign="middle" align="center" style="padding:0px 0px" bgcolor="#614da4">

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">
                                <tbody>
                                <tr>
                                    <td align="center" style="margin-bottom:10px;padding:15px 5px 0;color:#d1d6da;text-align:center;font-size:11px;font-weight:bold">
                                        <p style="margin:0 0 10px 0;float:left">
                                            <img src="'.base_url().'assets/images/care_mainlogo.PNG" width="150px" height="100" style="display:inline-block" class="CToWUd">
                                        </p>
                                        <p style="margin:0 0 10px 0;float:right">
                                            <img src="'.base_url().'assets/images/ha_logo.PNG" width="150px" height="100" style="display:inline-block" class="CToWUd">
                                        </p>

                                    </td>
                                </tr>
                                    </tbody>
                             </table>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" align="center" style="border:0px solid #0073cf;padding:25px;box-sizing:border-box;font-size:0">
                                <p style="clear:both"></p>
                                <p style="margin:0;color:#404040;font-size:18px;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">Hi, <a style="color:#0073cf;text-decoration:none;text-align:left;margin-bottom:10px;">'.$user[$this->users->USER_NAME].'</a></p>

                                <table border="1" bgcolor="#fff" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #614da4">
                                    <tbody>'.$mail_body.'</tbody>
                                </table>

                            </td>
                        </tr>

                        <tr>
                            <td valign="middle" align="center" style="padding:0px 25px" bgcolor="#614da4">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">
                                    <tbody>
                                    <tr>
                                        <td valign="middle" align="center" style="padding:15px 0px" bgcolor="#614da4">

                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">
                                                <tbody>
                                                <tr>
                                                    <td align="center" style="padding:15px 0px 0px;color:#d1d6da;text-align:center;font-size:11px;font-weight:bold">&copy; 2017, Renown Analytics Pvt Ltd. All rights reserved.</td>
                                    </tr>
                                    </tbody>
                                    </table>
                                      </td>
                                    </tr>
                                    </tbody>
                                    </table>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
    </tbody>
        </table>
        </body>
        </html>';
    echo $body;
    /* $mail = new PHPMailer();
    // ---------- adjust these lines ---------------------------------------
    $mail->Username = 'hospiasset.renown@gmail.com'; // your GMail user name
    $mail->Password = "Renown@#123";
    $mail->SetFrom($mail->Username);
    $mail->AddAddress($user[$this->users->EMAIL_ID]); // recipients email
    $mail->FromName = "Care Hospiasset"; // readable name
    $mail->Subject = "Today's Equipments Summary.";
    $mail->Body    = $body;
    //-----------------------------------------------------------------------

    $mail->Host = "smtp.gmail.com"; // GMail
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->IsSMTP(); // use SMTP
    //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->From = $mail->Username;
    if(!$mail->Send())
        echo "Mailer Error: " . $mail->ErrorInfo;
    else
        echo "Message has been sent"; */
}
?>