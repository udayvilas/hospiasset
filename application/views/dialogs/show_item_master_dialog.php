<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="80" ng-clock xmlns="http://www.w3.org/1999/html">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Item Master Details</h4>
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
                    <md-tab flex md-primary label="Equipment Basic Details"><!-- Profile Begin -->
                        <md-content>
                            <table class="md-api-table table table-bordered" style="width:100%;">
                                <tr>
                                    <td colspan="2" width="50%">FIELD TYPE</td>
                                    <td colspan="2" width="50%">{{item_master_view.FIELD_TYPE}}</td>
                                </tr>
                                <tr>
                                    <td>FIELD DESC</td><td>{{item_master_view.FIELD_DESC}}</td>
                                    <td>QID</td><td>{{item_master_view.qid}}</td>
                                </tr>
                                <tr>
                                    <td width="25%">MAXOPTIONS</td><td  width="25%">{{item_master_view.MAX_OPT}}</td>
                                    <td width="25%">MANDATORY </td><td  width="25%">{{item_master_view.MANDETORY}}</td>
                                </tr>
                                <tr>
                                    <td>DISABLED</td><td>{{item_master_view.DISABLED}}</td>
                                    <td>OPT1</td><td>{{item_master_view.OPT1}}</td>
                                </tr>
                                <tr>
                                    <td>OPT2</td><td>{{item_master_view.OPT2}}</td>
                                    <td>OPT3</td><td>{{item_master_view.OPT3}}</td>
                                </tr>
                                <tr>
                                    <td>OPT2</td><td>{{item_master_view.OPT2}}</td>
                                    <td>OPT3</td><td>{{item_master_view.OPT3}}</td>
                                </tr>
                                <tr>
                                   <td>OPT4</td><td>{{item_master_view.OPT4}}</td>
                                    <td>OPT5</td><td>{{item_master_view.OPT5}}</td>
                                </tr>
                                <tr>
                                    <td>OPT6</td><td>{{item_master_view.OPT6}}</td>
                                    <td>OPT7</td><td>{{depart_device_view.OPT7}}</td>
                                </tr>
                                <!--<tr>
                                    <td>Classification</td><td>{{depart_device_view.classification}}</td>
                                    
                                </tr>-->
                                <tr>
                                    <td>OPT8</td><td>{{depart_device_view.OPT8}}</td>
                                    <td>OPT9</td><td>{{depart_device_view.OPT9}}</td>
                                </tr>
                                <tr>
                                    <td>OPT10</td><td>{{depart_device_view.OPT10}}</td>
                                    <td>OPT11</td><td>{{depart_device_view.OPT11}}</td>
                                </tr>
                                <tr>
                                    <td>OPT12</td><td>{{depart_device_view.OPT12}}</td>
                                    <td>OPT13</td><td>{{depart_device_view.OPT13}}</td>
                                </tr>
                                <tr>
                                   <td>OPT14</td><td>{{depart_device_view.OPT14}}</td>
                                    <td>OPT15</td><td>{{depart_device_view.OPT15}}</td>
                                </tr>
                                <tr>
                                    <td>OPT16</td><td>{{depart_device_view.OPT16}}</td>
                                    <td>OPT17</td><td>{{depart_device_view.OPT17}}</td>
                                </tr>
                                <tr>
                                   <td>OPT18</td><td>{{depart_device_view.OPT18}}</td>
                                    <td>OPT19</td><td>{{depart_device_view.OPT19}}</td>
                                </tr>
                                <tr>
                                    <td>OPT20</td><td>{{depart_device_view.OPT20}}</td>
                                   
                                </tr>
                            </table>
                        </md-content>
                    </md-tab>

                
                </md-tabs>
            </div>
        </div>
    </md-dialog-content>
    <md-dialog-actions layout="row">
        <md-button class="md-primary" ng-click="cancel()">Close</md-button>
    </md-dialog-actions>
</md-dialog>