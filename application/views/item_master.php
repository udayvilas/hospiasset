<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<md-content class="mylayout-padding">

    <div layout="column">

        <h3 class="heading-stylerespond">Item Masters</h3>

           <div layout="row" layout-md="row" flex-gt-sm="row" layout-xs="column" class="widget-container">
        
		  <div flex="33" flex-sm="50" flex-md="50">
            
			<md-button   ui-sref="home.hadmin_add_item_master" class="md-raised md-primary">Add New</md-button>
         </div>
		   
        </div>

        <table class="md-api-table table table-bordered">

            <thead>

            <tr>
                <th>Module Name</th>

				<th>FIELD TYPE</th>
				
				<th>FIELD DESC</th>

                <th>STATUS</th>

                <th>Action</th>


            </tr>

            </thead>

            <tbody>

            <tr ng-repeat="label in item_masters">
                <td>
                    {{label.MODULE_ID}}
                </td>

                <td>
                    {{label.FIELD_TYPE}}
                </td>

                <td>
                    {{label.FIELD_DESC}}
                </td>
               <td>
                   {{label.ACTION}}
               </td>

                <td style="text-align: center;">
                    <button  ng-click="edit_item_master($event,label)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">mode_edit</md-icon>
                    </button>
					 <button  ng-click="viewitemmasterDetails($event,label)" class="btn btn-xs btn-default" aria-label="Edit">
                        <md-tooltip md-direction="top">View</md-tooltip>
                        <md-icon class="material-icons-new" style="color:#614DA4">launch</md-icon>
                    </button>
                </td>

            </tr>
            </tr>
			<tr>
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

