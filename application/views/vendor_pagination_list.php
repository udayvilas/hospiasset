<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        <div flex="30" flex-sm="50" flex-md="50">
            <md-button ui-sref="home.hbbme_add_vendor" class="md-raised md-primary">Add Vendor</md-button>
        </div>
    </div>
    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-align="center center" style="margin-top:10px;">

        <!--  <md-input-container class="md-block" flex-gt-sm flex="30">
              <label>Name</label>
              <input type="text" required ng-model="vendor_search.vendor_name" name="vendor_name" aria-label="vendor_name"/>
          </md-input-container>-->

        <md-autocomplete class="md-block" flex-gt-sm
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
            <md-not-found>
                No Vendor Found
            </md-not-found>
        </md-autocomplete>

        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
        <md-input-container class="md-block" flex-gt-sm flex="40">
            <label>Vendor Type *</label>
            <md-select required ng-model="vendor_search.type" name="type" aria-label="type" multiple>
                <md-option ng-value="vdr_type.NAME" ng-repeat="vdr_type in vdr_types">{{vdr_type.NAME}}</md-option>
            </md-select>
        </md-input-container>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;(OR)</div>
        <!--<md-input-container class="md-block" flex-gt-sm flex="40">
            <label>Contact Person</label>
            <input type="text"  ng-model="vendor_search.contact_person" name="contact_person" aria-label="contact_person"/>

        </md-input-container>-->

        <!--<md-autocomplete class="md-block" flex-gt-sm
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
            <md-not-found>
                No Contact Person Found
            </md-not-found>
        </md-autocomplete>-->
        <center>
            <md-button class="md-icon-button md-raised md-accent" ng-click="loadVendorList()"  md-theme="default" aria-label="submit">
                <ng-md-icon icon="search" style="fill:#fff" size="24"></ng-md-icon>
            </md-button>
        </center>
    </div>
    <div layout="column" flex>
        <h3>Vendor List</h3>
        <table class="md-api-table table table-bordered">
            <thead>
            <tr>
                <th style="width:12%">Name</th>
                <th style="width:12%">Vendor Type</th>
                <th style="width:15%">Vendor Email</th>
                <th style="width:12%">Contact No</th>
                <th style="width:12%">Contact Person</th>
                <th style="width:12%">CP Number</th>
                <th style="width:15%">CP Email</th>
                <th style="width:12%">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="vendors!=null && vendors!='undefined'" ng-repeat="vendor in vendors">
                <td>{{vendor.NAME}}</td>
                <td>{{vendor.TYPE}}</td>
                <td>{{vendor.EMAIL_ID}}</td>
                <td>{{vendor.MOBILE_NO}}</td>
                <td>{{vendor.CP_NAME}}</td>
                <td>{{vendor.CP_NUMBER}}</td>
                <td>{{vendor.CP_EMAIL}}</td>
                <td>
                    <md-button ng-click="editVendor($event,vendor)" class="md-icon-button md-primary" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon>mode_edit</md-icon>
                    </md-button>
                </td>
            </tr>
            <tr ng-if=vendors==null || vendors=='undefined'>
                <td colspan="8" class="text-center">No Vendors Found</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div ng-app="DemoApp" flex layout="column">
        <div flex ng-controller="MainController" layout="column">
            <section flex>
                <md-content layout-padding="">
                    <h1>Material Angular Paging demo</h1>
                    <div>Loaded data form Page <strong>{{currentPage}}</strong></div>

                </md-content>
            </section>

            <section layout="row" layout-padding="">

                <cl-paging flex cl-pages="paging.total" , cl-steps="6" , cl-page-changed="paging.onPageChanged()" , cl-align="center center" , cl-current-page="paging.current"></cl-paging>

            </section>

        </div>
    </div>

    var app = angular.module("DemoApp", ['ngMaterial', 'cl.paging']);
    app.controller("MainController", ['$scope', function($scope) {

    $scope.currentPage = 0;

    $scope.paging = {
    total: 100,
    current: 1,
    onPageChanged: loadPages,
    };

    function loadPages() {
    console.log('Current page is : ' + $scope.paging.current);

    // TODO : Load current page Data here

    $scope.currentPage = $scope.paging.current;
    }

    }]);
</md-content>