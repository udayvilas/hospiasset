<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock xmlns="http://www.w3.org/1999/html">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Equipment Depreciation Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <div flex layout="row">
                <md-tabs flex md-dynamic-height md-border-bottom>
                    <md-tab flex md-primary label="Equipment Depreciation Details"><!-- Profile Begin -->
                        <md-content>
                            <table class="md-api-table table table-bordered" style="width:100%;">

                                <tr>
                                    <td width="25%">Equipment ID</td><td  width="25%">{{depreciation_view.E_ID}}</td>
                                    <td width="25%">Depreciation Percentage</td><td  width="25%">{{depreciation_view.depreciation_percentage}}%</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">1st Year({{depreciation_view.f_year1 * 1}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.first_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">2nd Year({{(depreciation_view.f_year1 * 1) + 1}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.second_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">3rd Year({{(depreciation_view.f_year1 * 1) + 2}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.third_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">4th Year({{(depreciation_view.f_year1 * 1) + 3}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.fourth_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">5th Year({{(depreciation_view.f_year1 * 1) + 4}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.fifth_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">6th Year({{(depreciation_view.f_year1 * 1) + 5}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.sixth_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">7th Year({{(depreciation_view.f_year1 * 1) + 6}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.seventh_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">8th Year({{(depreciation_view.f_year1 * 1) + 7}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.eigth_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">9th Year({{(depreciation_view.f_year1 * 1) + 8}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.ninth_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">10th Year({{(depreciation_view.f_year1 * 1) + 9}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.tenth_year}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">11th Year({{(depreciation_view.f_year1 * 1) + 10}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year11}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">12th Year({{(depreciation_view.f_year1 * 1) + 11}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year12}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">13th Year({{(depreciation_view.f_year1 * 1) + 12}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year13}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">14th Year({{(depreciation_view.f_year1 * 1) + 13}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year14}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">15th Year({{(depreciation_view.f_year1 * 1) + 14}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year15}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">16th Year({{(depreciation_view.f_year1 * 1) + 15}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year16}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">17th Year({{(depreciation_view.f_year1 * 1) + 16}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year17}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">18th Year({{(depreciation_view.f_year1 * 1) + 17}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year18}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">19th Year({{(depreciation_view.f_year1 * 1) + 18}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year19}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">20th Year({{(depreciation_view.f_year1 * 1) + 19}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year20}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">21st Year({{(depreciation_view.f_year1 * 1) + 20}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year21}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">22nd Year({{(depreciation_view.f_year1 * 1) + 21}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year22}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">23rd Year({{(depreciation_view.f_year1 * 1) + 22}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year23}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">24thYear({{(depreciation_view.f_year1 * 1) + 23}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year24}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="50%">25th Year({{(depreciation_view.f_year1 * 1) + 24}})</td>
                                    <td colspan="2" width="50%">{{depreciation_view.year25}}</td>
                                </tr>

                            </table>
                        </md-content>
                    </md-tab>


            </div>
        </div>
    </md-dialog-content>
    <md-dialog-actions layout="row">
        <md-button class="md-primary" ng-click="cancel()">Close</md-button>
    </md-dialog-actions>
</md-dialog>