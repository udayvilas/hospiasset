<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Departments </h3>
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="10" flex-sm="10" flex-md="10">
            <md-button ng-if="Add_Department==Add" ui-sref="home.add_departments" class="md-raised md-primary">Add New</md-button>
        </div> 		
		<div flex="33" flex-sm="30" flex-md="30">        
		<md-autocomplete class="md-block" flex-gt-sm 
		md-no-cache="false"                         
		md-selected-item="searched.value"                        
		md-search-text="searchText"                        
		md-items="item in searchDeptChange(searchText)"
         md-item-text="item.display"
		md-min-length="0" 	
		md-floating-label="Search Department?">            
		<md-item-template>                
		<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.display}}</span>            
		</md-item-template>            
		<md-not-found>           
		No Department Match Found           
		</md-not-found>        
		</md-autocomplete>       
		</div>        
		<div flex="10" flex-sm="10" flex-md="10">        
		<md-button class="md-icon-button md-raised md-accent" ng-click="getDepartmentByID(searched.value.value)"  md-theme="default" aria-label="submit">            <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>        </md-button>        
		</div>
    </div>

    <div layout="column" flex>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th>{{depart_labels.USER_DEPT_NAME}}</th>
                <th>{{depart_labels.CODE}}</th>
                <th>{{depart_labels.STATUS}}</th>
                <th>{{depart_labels.ACTION}}</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="depts!=null && depts!='undefined'" ng-repeat="dept in depts | orderBy:'USER_DEPT_NAME'">
                <td>{{dept.USER_DEPT_NAME}}</td>
                <td>{{dept.CODE}}</td>
                <td>{{dept.STATUS=='A' ? 'Active' : 'Inactive'}}</td>
                <td style="text-align: center;">
                    <button ng-disabled="Edit_Department!=Edit" ng-click="editDepartment($event,dept)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                </td>
            </tr>
            <tr ng-if=depts==null || depts=='undefined'>
                <td colspan="3" class="text-center">No Department Found</td>
            </tr>
            </tbody>
        </table>
    </div>
   <div flex layout="row" class="marginb-10" ng-if="depts!=null">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{depts.no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadDEpatmentsList(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>
</md-content>