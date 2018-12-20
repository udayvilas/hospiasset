<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding">

    <div layout="column">

        <h3 class="heading-stylerespond">ORG Masters</h3>

           <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        
		  <div flex="33" flex-sm="50" flex-md="50">
            
			<md-button   ui-sref="home.add_org_create_form" class="md-raised md-primary">Add New</md-button>
         </div>
		   
        </div>
		<div flex="20" >
          <md-input-container class="md-block" flex-gt-sm flex="20">                     
		  <label>Org Module</label>                   
		  <md-select ng-model="demog.MODULE_ID" name="module_id" ng-change="getorgtablemaster(demog.MODULE_ID)"
		  aria-label="MODULE_ID">           
		  <md-option ng-repeat="hamodule in module_table" ng-value="hamodule.TABLE_NAME">
		  {{hamodule.TABLE_DESC}}                          
		  </md-option>                        
		  </md-select>   
		  </md-input-container>
		  </div>
        <table class="md-api-table table table-bordered">

            <thead>

            <tr>
                <th>Module Name</th>

				<th>FIELD TYPE</th>
				
				<th>FIELD DESC</th>

               

            </tr>

            </thead>

            <tbody>

            <tr ng-repeat="master in master_table_data">
                <td>
                    {{master.EQ_NAME}}
                </td>

                <td>
                    {{master.DISTRIBUTER}}
                </td>

                <td>
                    {{master.EQ_MODEL}}
                </td>
               

                <td style="text-align: center;">
                    <button  ng-click="editformtable($event,master)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
					 <button  ng-click="viewitemmasterDetails($event,master)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">View</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">launch</md-icon>
                    </button>
                </td>

            </tr>
            

            </tbody>

            <tbody ng-else>

            <tr>

                <td style="text-align:center" colspan="6">No Rows Found</td>

            </tr>

            </tbody>

        </table>

    </div>

</md-content>

