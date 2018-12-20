<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Vendors</h3>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
        <md-button ng-if="Add_Vendor==Add" ui-sref="home.hbbme_add_vendor" class="md-raised md-primary">Add Vendor</md-button>
        <md-autocomplete flex="20" class="md-block" flex-gt-sm
                         md-no-cache="false"
                         md-selected-item="searched.VENDOR"
                         md-search-text="searchVname"
                         md-items="item in searchTextChange(searchVname)"
                         md-item-text="item.NAME"
                         md-min-length="0"
                         md-floating-label="Search Vendor name">
        <md-item-template>
        <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.NAME}}</span>
            </md-item-template>
        <!---<md-not-found>
                No Vendor Found
            </md-not-found>--->
        </md-autocomplete>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
        <md-input-container class="md-block" flex-gt-sm flex="10">
            <label>Vendor Type *</label>
            <md-select required ng-model="vendor_search.type" name="type" aria-label="type" multiple>
                <md-option ng-value="vdr_type.NAME" ng-repeat="vdr_type in vdr_types">{{vdr_type.NAME}}</md-option>
            </md-select>
        </md-input-container>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
        <md-autocomplete flex="20" class="md-block" flex-gt-sm
                         md-no-cache="false"
                         md-selected-item="searched.CONTACT_PERSON"
                         md-search-text="searchCPname"
                         md-items="item in searchTextChange(searchCPname,'cp')"
                         md-item-text="item.CP_NAME"
                         md-min-length="0"
                         md-floating-label="Search Contact Person name">
            <md-item-template>
                <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.CP_NAME}}</span>
            </md-item-template>
            <!---<md-not-found>
                No Contact Person Found
            </md-not-found>--->
        </md-autocomplete>
        <center>
            <md-button class="md-icon-button md-raised  md-primary" ng-click="loadVendorList(1)"  md-theme="default" aria-label="submit">
                <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
        </center>
    </div>
    <div layout="column" flex>
        <table class="md-api-table table table-bordered" style="width: 100%;">
            <thead>
            <tr>
                <th style="width:20%">{{vendor_label.NAME}}</th>
                <th style="width:12%">{{vendor_label.TYPE}}</th>
                <th style="width:12%">{{vendor_label.EMAIL_ID}}</th>
                <th style="width:11%">{{vendor_label.MOBILE_NO}}</th>
                <th style="width:12%">{{vendor_label.CP_NAME}}</th>
                <th style="width:12%">{{vendor_label.CP_NUMBER}}</th>
                <th style="width:12%">{{vendor_label.CP_EMAIL}}</th>
                <th style="width:11%">{{vendor_label.ACTION}}</th>
            </tr>
            </thead>
            <tbody ng-if="isObject(vendors)">
            <tr ng-repeat="vendor in vendors track by $index">
                <td>{{vendor.NAME}}</td>
                <td>{{vendor.TYPE}}</td>
                <td>{{vendor.EMAIL_ID}}</td>
                <td>{{vendor.MOBILE_NO}}</td>
                <td>{{vendor.CP_NAME}}</td>
                <td>{{vendor.CP_NUMBER}}</td>
                <td>{{vendor.CP_EMAIL}}</td>
                <td style="text-align: center;">
                    <button ng-disabled="Edit_Vendor!=Edit" ng-click="editVendor($event,vendor)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit Vendor</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
                    <button ng-disabled="Edit_Vendor!=Edit" ng-click="editVendorNew($event,vendor)" class="btn btn-xs btn-success" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit Contact Persons</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#FFFFFF">assignment_ind</md-icon>
                    </button>
                </td>
            </tr>
            </tbody>
            <tbody ng-if="!isObject(vendors)">
            <tr>
                <td colspan="8" class="text-center">{{vendors}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div flex layout="row" class="marginb-10">
        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                <md-tooltip md-direction="top">Total Records</md-tooltip>
                {{vendors.no_of_recs}}
            </md-button>
        </div>
        <div flex="20" hide-xs hide-sm><!-- Space --></div>
        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
            <cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="loadVendorList(paging.current)" , cl-align="end end" , cl-current-page="paging.current"></cl-paging>
        </div>
    </div>

</md-content>