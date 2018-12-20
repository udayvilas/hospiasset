<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40">
	<md-toolbar>
		<div class="md-toolbar-tools">
			<h4>Pending PMS - Action</h4>
			<span flex></span>
			<md-button class="md-icon-button" ng-click="cancel()">
				<md-icon md-font-set="material-icons">clear</md-icon>
			</md-button>
		</div>
	</md-toolbar>
	<md-dialog-content flex layout-align="center center">
		<div class="md-dialog-content">
			<md-tabs md-dynamic-height md-border-bottom>
				<md-tab md-primary label="Complete">
					<!--Pms Complete -->
					<md-content>
						<form layout="column" name="selfcompletedpms" autocomplete="off" ng-cloak>
							<md-input-container class="md-block" flex-gt-sm>
								<label>Equipment Status</label>
								<input type="text" ng-disabled="true" ng-model="ticket_sts1[1]" name="STATUS" aria-label="STATUS"/>
							</md-input-container>
							<md-input-container class="md-block" flex-gt-sm>
								<label>Assigned To</label>
								<input type="text" ng-disabled="true" ng-model="user_name" aria-label="STATUS"/>
							</md-input-container>
							<md-input-container class="md-block" flex-gt-sm>
								<label>Remarks</label>
								<textarea ng-model="ppms_device_data.pmsassignremarks" rows="5" md-select-on-focus></textarea>
							</md-input-container>
							<div layout="column">
								<div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">
									<input type="file" file-model="pms_files" multiple />
								</div>
								<ul style="margin-top: 15px;">
									<li ng-repeat="pms_file in pms_files">{{pms_file.name}}</li>
								</ul>
							</div>
							<div layout="row" layout-align="center center">
								<input type="submit" value="Submit" class="md-raised md-accent md-button md-ink-ripple" ng-click="NotAssignPendingpms(ppms_device_data)" ng-disabled="isEmpty(pms_files)" aria-label="Assign" style="float:left"/>
								<div flex="2" hide-xs hide-sm>
									<!-- Space -->
								</div>
								<md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
							</div>
						</form>
					</md-content>
				</md-tab>
				<!-- Pending Pms Tab End -->
				<md-tab md-primary label="Assign">
					<!-- Assign Tab Begin -->
					<md-content>
						<form layout="column" name="PEndingpms" autocomplete="off" ng-cloak>
							<div layout="column">
								<md-input-container class="md-block" flex-gt-sm>
									<label>Equipment Status</label>
									<input type="text" ng-disabled="true" ng-model="ticket_sts1[1]" aria-label="STATUS"/>
								</md-input-container>
								<md-input-container class="md-block" flex-gt-sm flex="50" layout-align="center center">
									<label>Assign To</label>
									<md-select ng-model="ppms_device_data.assignto" required name="Assignto" >
										<md-option ng-repeat="bmehod in userdetails" ng-value="bmehod.USER_ID">{{bmehod.USER_NAME}}                                            
										</md-option>
									</md-select>
									<div class="md-errors-spacer"></div>
									<div ng-messages="PEndingpms.Assignto.$error" md-auto-hide="true">
										<div ng-message="required">Required</div>
									</div>
								</md-input-container>
								<md-input-container class="md-block" flex-gt-sm>
									<label>Remarks</label>
									<textarea ng-model="ppms_device_data.pmscompleteremarks" rows="5" md-select-on-focus></textarea>
								</md-input-container>
								<div layout="row" layout-align="center center">
									<input type="submit" value="Submit" class="md-raised md-accent md-button md-ink-ripple" ng-click="AssignPendingpms(ppms_device_data,ppms_device_data.assignto)" ng-disabled="PEndingpms.$invalid" aria-label="Assign" />
									<div flex="2" hide-xs hide-sm>
										<!-- Space -->
									</div>
									<md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>
								</div>
							</div>
						</form>
					</md-content>
				</md-tab>
				<!-- Assign Tab End -->
			</md-tabs>
		</div>
	</md-dialog-content>
</md-dialog>