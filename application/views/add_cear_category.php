<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Cear Category</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="addCearCategoryForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label> Cear Category Name</label>
                        <input type="text" required ng-model="cear_category.cear_category_name" name="cear_category_name" md-maxlength="50" aria-label="cear_category_name"/>
                        <div ng-messages="addCearCategoryForm.cear_category_name.$error">  
						<div ng-message="required">Required.</div>           
						<div ng-message="md-maxlength">Max limit is reached.</div>	
					    
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Cear Category Code</label>
                        <input type="text" required ng-model="cear_category.code"  ng-pattern  = "/^[a-zA-Z. ]*[a-zA-Z]$/" ng-change="cear_category.code = (cear_category.code | uppercase)" name="code" md-maxlength="3"   aria-label="code"/>
                        <div ng-messages="addCearCategoryForm.code.$error">                         
						<div ng-message="required">Required.</div>			
						<div ng-show="addCearCategoryForm.code.$error.pattern">Please Provide Text Only.</div>
						<div ng-message="md-maxlength">Max limit is reached.</div>							
                        </div>
                    </md-input-container>

                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addCearCategory(cear_category)" ng-disabled="addCearCategoryForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.cear_category">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>