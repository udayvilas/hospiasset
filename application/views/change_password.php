<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Change Password</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="selfUpdatePasswordForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="column">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Current Password *</label>
                        <input type="password"  required ng-model="updatepswrd.currentpswrd" name="currentpswrd" aria-label="currentpswrd"/>
                        <div ng-messages="selfUpdatePasswordForm.currentpswrd.$error">
                            <div ng-message=="required">Required.</div>
                        </div>
                    </md-input-container>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>New Password *</label>
                        <input type="password"  required ng-model="updatepswrd.newpswrd" name="newpswrd" aria-label="newpswrd"/>
                        <div ng-messages="selfUpdatePasswordForm.newpswrd.$error">
                            <div ng-message=="required">Required.</div>
                        </div>
                    </md-input-container>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Reenter Password</label>
                        <input type="password" required ng-model="updatepswrd.reentered_newpswrd" confirm-pwd="updatepswrd.newpswrd" name="reentered_newpswrd" aria-label="reentered_newpswrd"/>
                        <div ng-messages="selfUpdatePasswordForm.reentered_newpswrd.$error">
                            <div ng-message=="required">Required.</div>
                            <div ng-message="password">Password Not Matched.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="updateMyPassword(updatepswrd)" ng-disabled="selfUpdatePasswordForm.$invalid" aria-label="submit">Submit</md-button>
                    <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.hbbme_today_calls">Cancel</md-button>

                </div>
            </form>
        </div>
    </div>
</md-content>