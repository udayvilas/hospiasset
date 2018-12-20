<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Users</h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
      <div  ng-hide="get_org_users_val==get_org_users_cnt" flex="100" flex-sm="50" flex-md="50">            <md-button ui-sref="home.hbhod_add_user" class="md-raised md-primary">Add User</md-button>        </div>        <div ng-show="get_org_users_val==get_org_users_cnt" flex="100" flex-sm="50" flex-md="50">            Your Organization reached maximum number of users, please contact HospiAsset Admin.        </div>
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
                   <td>{{user.ROLE_NAME}}</td>
                   <td>
                       <span ng-repeat="BRANCH in user.BRANCH_NAMES" aria-label="{{$index}}">
                        <b ng-show="$index>0">,</b> {{BRANCH}}</span></td>
                   <td>
                   <span>{{user.STATUS=='A' ? 'Active' : 'Inactive'}}</span>
                   </td>
                   <td>
                     <button ng-disabled="user.ROLE_CODE!=HBUSER" ng-click="editUser($event,user)" class="btn btn-xs btn-default" aria-label="Edit">
                     <md-tooltip ng-if="user.ROLE_CODE==HBUSER" md-direction="top">Edit</md-tooltip>
                         <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                     </button>
                   </td>
                  </tr>
                  <tr ng-if=users==null || users=='undefined'>
                  <td colspan="8" class="text-center">No Users Found Please Select A Branch!</td>
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
    </div>
</md-content>