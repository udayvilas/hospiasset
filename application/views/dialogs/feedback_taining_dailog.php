<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Training Feedback</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="TconductForm" flex="100"  autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Traning Type</label>
                        <input type="text" ng-model="fdbk_training_data.TR_TYPE"  ng-disabled="true">
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Trainer</label>
                        <input type="text" ng-model="fdbk_training_data.TR_BY" ng-disabled="true">
                    </md-input-container>
                </div>
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Traning Date</label>
                        <input type="text" ng-model="fdbk_training_data.TR_DATE"  ng-disabled="true">
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Training Time</label>
                        <input ng-model="fdbk_training_data.TR_TIME" ng-disabled="true">
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Trainees</label>
                        <input type="text" ng-model="fdbk_training_data.TR_TO" ng-disabled="true">
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Subject</label>
                        <textarea ng-model="fdbk_training_data.SUBJECT" rows="5" ng-disabled="true"                         md-select-on-focus>
                        </textarea>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Topic</label>
                        <input type="text" ng-model="fdbk_training_data.TOPIC">
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <!---<md-input-container class="md-block" flex-gt-sm>
                        <label>Make</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="fdbk_training_data.MAKE_OEM"  aria-label="company_name" required>
                            <md-select-header class="demo-select-header">
                                <input type="text" ng-model="searchTerm" placeholder="Search Make" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="oem1">
                            <md-option ng-repeat="oem in oems |
              filter:searchTerm" ng-value="oem.ID">{{oem.NAME}}</md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>--->															<md-autocomplete class="md-block" flex-gt-sm flex="20"		                     ng-value="fdbk_training_data.MAKE_OEM==searched.ORG_ID"							 md-no-cache="false"							 md-input-name="make"							 md-selected-item="searched.ORG_ID"							 md-search-text="searchORG_NAME"							 md-items="item in searchTextChange(searchORG_NAME,'Distributor')"							 md-item-text="item.ORG_NAME"							 md-min-length="0"							 md-floating-label="MAKE">				<md-item-template>					<span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>				</md-item-template>				<!--<div ng-messages=".distributor.$error" ng-if="AddDevice.distributor.$touched">					<div ng-message="required">Required</div>				</div>-->				<md-not-found>				   No Distributor Found				</md-not-found>			</md-autocomplete>           <span ng-value="fdbk_training_data.MAKE_OEM = searched.ORG_ID.ORG_ID" ></span>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Model</label>
                        <input type="text" ng-model="fdbk_training_data.EQ_MODEL">
                    </md-input-container>
                </div>
                <div layout="row">
                    <h5 flex class="sub_heading-style-respond">Program content:</h5>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Understand the Objectives of the training</label>
                        <md-select ng-model="fdbk_training_data.UNDRSTD_TRNG" aria-label="UNDRSTD_TRNG" required>
                            <md-option ng-repeat="UNDRSTD_TRNG in [5,4,3,2,1]" ng-value="UNDRSTD_TRNG">{{UNDRSTD_TRNG}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>The length of the training was appropriate to cover all topics</label>
                        <md-select ng-model="fdbk_training_data.TRNG_LNGTH"  aria-label="TRNG_LNGTH" required>
                            <md-option ng-repeat="TRNG_LNGTH in [5,4,3,2,1]" ng-value="TRNG_LNGTH">{{TRNG_LNGTH}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>The training provided with new information</label>
                        <md-select ng-model="fdbk_training_data.NEW_INFO_IN_TRNG"  aria-label="NEW_INFO_IN_TRNG" required>
                            <md-option ng-repeat="NEW_INFO_IN_TRNG in [5,4,3,2,1]" ng-value="NEW_INFO_IN_TRNG">{{NEW_INFO_IN_TRNG}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>On the job use of this training module was discussed</label>
                        <md-select ng-model="fdbk_training_data.ON_JOB_USE_OF_TRNG"  aria-label="ON_JOB_USE_OF_TRNG" required>
                            <md-option ng-repeat="ON_JOB_USE_OF_TRNG in [5,4,3,2,1]" ng-value="ON_JOB_USE_OF_TRNG">{{ON_JOB_USE_OF_TRNG}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>The examples put forward healped to understand the content</label>
                        <md-select ng-model="fdbk_training_data.EXAMPLES_HTLP_IN_TRNG"  aria-label="EXAMPLES_HTLP_IN_TRNG" required>
                            <md-option ng-repeat="EXAMPLES_HTLP_IN_TRNG in [5,4,3,2,1]" ng-value="EXAMPLES_HTLP_IN_TRNG">{{EXAMPLES_HTLP_IN_TRNG}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Usefulness in your current job</label>
                        <md-select ng-model="fdbk_training_data.USEFULNES_IN_CURENT_JOB"  aria-label="USEFULNES_IN_CURENT_JOB" required>
                            <md-option ng-repeat="USEFULNES_IN_CURENT_JOB in [5,4,3,2,1]" ng-value="USEFULNES_IN_CURENT_JOB">{{USEFULNES_IN_CURENT_JOB}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Did the trainer actively invite questions</label>
                        <md-select ng-model="fdbk_training_data.TRAINER_ACTIVNES"  aria-label="TRAINER_ACTIVNES" required>
                            <md-option ng-repeat="TRAINER_ACTIVNES in [5,4,3,2,1]" ng-value="TRAINER_ACTIVNES">{{TRAINER_ACTIVNES}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>The trainer was able to clarify all your doubts</label>
                        <md-select ng-model="fdbk_training_data.DOUBTS_CLARIFY_TRAINER"  aria-label="DOUBTS_CLARIFY_TRAINER" required>
                            <md-option ng-repeat="DOUBTS_CLARIFY_TRAINER in [5,4,3,2,1]" ng-value="DOUBTS_CLARIFY_TRAINER">{{DOUBTS_CLARIFY_TRAINER}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div flex layout="row" style="margin-top: 10px;">
                    <table flex class="md-api-table table table-bordered" border="1" styl="border-collapse:collapse;width:100%;text-align:center;">
                        <tr>
                            <td style="width: 20%">5-Strongly Agree</td>
                            <td style="width: 20%">4-Agree</td>
                            <td style="width: 20%">3-Neutral</td>
                            <td style="width: 20%">2-Disagree</td>
                            <td style="width: 20%">1-Strongly Disagree</td>
                        </tr>
                    </table>
                </div>
                <div layout="row">
                    <h5 flex class="sub_heading-style-respond">Program feedback:</h5>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>How would you rate your knowledge of this topic/subject prior to training?</label>
                        <md-select ng-model="fdbk_training_data.SUBJECT_FIT_TO_TRAIN" aria-label="SUBJECT_FIT_TO_TRAIN" required>
                            <md-option ng-repeat="SUBJECT_FIT_TO_TRAIN in feedback_counts" ng-value="SUBJECT_FIT_TO_TRAIN">{{SUBJECT_FIT_TO_TRAIN}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div layout="row">
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>How would you rate your knowledge of this topic/subject after training</label>
                        <md-select ng-model="fdbk_training_data.TRAINING_FEDBACK_RATING"  aria-label="TRAINING_FEDBACK_RATING" required>
                            <md-option ng-repeat="TRAINING_FEDBACK_RATING in feedback_counts" ng-value="TRAINING_FEDBACK_RATING">{{TRAINING_FEDBACK_RATING}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div flex layout="row" style="margin-top: 10px;">
                    <table flex class="md-api-table table table-bordered" border="1" styl="border-collapse:collapse;width:100%;text-align:center;">
                        <tr>
                            <td style="width: 10%">10-High</td>
                            <td style="width: 10%">9 </td>
                            <td style="width: 10%">8 </td>
                            <td style="width: 10%">7 </td>
                            <td style="width: 10%">6 </td>
                            <td style="width: 10%">5 </td>
                            <td style="width: 10%">4 </td>
                            <td style="width: 10%">3 </td>
                            <td style="width: 10%">2 </td>
                            <td style="width: 10%">1-Low</td>
                        </tr>
                    </table>
                </div>
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Suggestions and comments</label>
                    <textarea ng-model="fdbk_training_data.feedback" required rows="5" md-select-on-focus>
                    </textarea>
                    </md-input-container>
                </div>
                <div flex layout="row" layout-align="center center">

                        <md-button class="md-raised md-accent" ng-click="GiveTrainingFeedback(fdbk_training_data)" ng-disabled="TconductForm.$invalid" aria-label="submit">Submit</md-button>

                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>