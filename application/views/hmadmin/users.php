<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
	<div>
      <div  ng-hide="get_org_users_val==get_org_users_cnt" flex="50"  flex-sm="50" flex-md="50">
          <md-button  ui-sref="home.hmadmin_add_user" class="md-raised md-primary">Add User</md-button>
      </div>
        <div ng-show="get_org_users_val==get_org_users_cnt" flex-sm="50" flex-md="50">Your Organization reached maximum number of users, please contact HospiAsset Admin.</div>
      <div flex="50" flex-sm="50" flex-md="50" layout="column" layout-align="end end">
    	  <md-input-container style="margin: 9px 0;">
    	    <md-select placeholder="Choose Branch" name="allbranches" ng-change="branch_all_loading(user_branch)" required ng-model="user_branch">
          <md-optgroup label="Branches">
    	      <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs" ng-if="branch.BRANCH_ID !='All'">{{branch.BRANCH_NAME}}</md-option>
            </md-optgroup>
    	    </md-select>
        </md-input-container>
      </div>
	  </div>
   </div>

   <div layout="column" flex>
          <table class="md-api-table table table-bordered">
               <thead>
                  <tr>
                   <th>Name</th>
                   <th>Email-Id</th>
                   <th>Contact No.</th>
                   <th>Emp No.</th>
                   <th>Role</th>
                   <th>Level</th>
                   <th>Branch</th>
                   <th>Status</th>
                   <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <tr ng-if="users!=null && users!='undefined'" ng-repeat="user in users">
                   <td>{{user.USER_NAME}}</td>
                   <td>{{user.EMAIL_ID}}</td>
                   <td>{{user.MOBILE_NO}}</td>
                   <td>{{user.EMP_NO}}</td>
                   <td>{{user.ROLE_CODE}}</td>
                   <td>{{user.LEVEL}}</td>
                   <td>
                       <span ng-repeat="BRANCH in user.BRANCH_NAMES" aria-label="{{$index}}">
                        <b ng-show="$index>0">,</b> {{BRANCH}}</span></td>
                   <td>
                   <span>{{user.STATUS=='A' ? 'Active' : 'Inactive'}}</span>
                   </td>
                   <td>
                     <button ng-click="editUser($event,user)" class="btn btn-xs btn-default" aria-label="Edit">
                     <md-tooltip md-direction="top">Edit</md-tooltip>
                         <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                     </button>
                   </td>
                  </tr>
                  <tr ng-if=users==null || users=='undefined'>
                  <td colspan="9" class="text-center">No Users Found Please Select A Branch!</td>
                  </tr>
               </tbody>
          </table>
     </div>
    <div flex layout="row" class="marginb-10"  ng-if="users!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getBranchUsers(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
</md-content>
