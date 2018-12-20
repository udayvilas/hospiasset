<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="column">
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
         <div ng-show="Add_Branches==Add">
		 <div ng-hide="get_org_branch_cnt==get_org_branch_val" flex="33" flex-sm="50" flex-md="50">
            <md-button ui-sref="home.hmadmin_add_branch" class="md-raised md-primary">Add Branch</md-button>
        </div>
        <div ng-show="get_org_branch_cnt>=get_org_branch_val" flex="33" flex-sm="50" flex-md="50">
            Your Organization reached maximum number of branches, please contact HospiAsset Admin.
        </div>
		</div>
    </div>
    <div layout="column" flex>
       
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>{{branch_labels.BRANCH_NAME}}</th>
                <th>{{branch_labels.BRANCH_CODE}}</th>
                <th>{{branch_labels.USER_NAME}}</th>
                <th>{{branch_labels.BRANCH_ADDRESS}}</th>
                <th>{{branch_labels.ADDED_ON}}</th>
                <th>{{branch_labels.STATUS}}</th>
                <th>{{branch_labels.ACTION}}</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="branches_dtls!=null && branches_dtls!='undefined'" ng-repeat="branch_dtls in branches_dtls">
                <td>{{branch_dtls.BRANCH_NAME}}</td>
                <td>{{branch_dtls.BRANCH_CODE}}</td>
                <td>
                    <span ng-repeat="hod in branch_dtls.hod" aria-label="{{$index}}">
                        <b ng-show="$index>0">,</b> {{hod.USER_NAME}}</span>
                </td>
                <td>{{branch_dtls.BRANCH_ADDRESS}}</td>
                <td>{{branch_dtls.ADDED_ON}}</td>
                <td>
                    <span>{{branch_dtls.STATUS=='A' ? 'Active' : 'Inactive'}}</span>
                </td>
                <td>
                    <button ng-show="Edit_Branches==Edit" ng-click="editBranch($event,branch_dtls)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:deepskyblue">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if="branches_dtls==null || branches_dtls=='undefined'">
                <td colspan="8" class="text-center">No Branches Found..!</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</md-content>