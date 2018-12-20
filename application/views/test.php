<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
<div class="container">
    <button class="btn btn-default" ng-click="getChecked()">click me!</button>
    <div class="row">
        <div class="col-lg-2">
            <ul>
                <!--<li ng-repeat="label in labels"> <input type="checkbox" ng-model="label.selected" ng-click="clicker(label)"> {{label.label}}
                    <ul>
                        <li ng-repeat="artist in label.artists">
                            <input type="checkbox" ng-model="artist.selected" > {{artist.artist}}
                        </li>
                    </ul>
                </li>-->
                <li ng-repeat="feature in features">
                    <input type="checkbox" ng-model="feature.selected" ng-click="clicker(feature)"> {{feature.MMENU_TITLE}}
                    <ul>
                        <li ng-repeat="subfeature in feature.subfeatures">
                            <input type="checkbox" ng-model="subfeature.selected" > {{subfeature.SMENU_TITLE}}
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
        <br/><br/><br/>
        <div class="col-lg-6">
            <div class="col-lg-3">
                Recurisive Checked labels/Artists Array JSON:
            </div>
            <div class="col-lg-3">
                <strong>{{recursiveChecked}}</strong>
            </div>
        </div>
        <br/><br/>
        <div class="col-lg-6">
            <div class="col-lg-3">
                Recurisive Checked labels/Artists Array List:
            </div>
            <div class="col-lg-3">
                <ul>
                    <li ng-repeat="i in recursiveChecked">{{$index}} - {{i.label}} - {{i.artist}}.</li>
                </ul>
            </div>
        </div>

    </div>
</div>
</md-content>

