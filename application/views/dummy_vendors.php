<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <div flex>
        <mdt-table paginated-rows="{isEnabled: true, rowsPerPageValues: [5,10,20,100,300,500]}"
        <mdt-header-row>
            <mdt-column align-rule="left">Name</mdt-column>
            <mdt-column align-rule="left">Vendor Type</mdt-column>
            <mdt-column align-rule="left">Email Id</mdt-column>
            <mdt-column align-rule="left">Contact No</mdt-column>
            <mdt-column align-rule="left">Contact Person</mdt-column>
            <mdt-column align-rule="left">CP Number</mdt-column>
            <mdt-column align-rule="left">CP Email Id</mdt-column>
            <mdt-column align-rule="left">Action</mdt-column>
        </mdt-header-row>

            <mdt-row ng-repeat="vendor in vendors track by $index">
                <!--<mdt-cell
                    editable-field="smallEditDialog"
                    editable-field-max-length="25">{{nutrition.name}}</mdt-cell>-->
                <mdt-cell>{{vendor.NAME}}</mdt-cell>
                <mdt-cell>{{vendor.TYPE}}</mdt-cell>
                <mdt-cell>{{vendor.EMAIL_ID}}</mdt-cell>
                <mdt-cell>{{vendor.MOBILE_NO}}</mdt-cell>
                <mdt-cell>{{vendor.CP_NAME}}</mdt-cell>
                <mdt-cell>{{vendor.CP_NUMBER}}</mdt-cell>
                <mdt-cell>{{vendor.CP_EMAIL}}</mdt-cell>
                <mdt-cell
                    editable-field="editVendor($event,vendor)"
                    editable-field-max-length="25">{{vendor.NAME}}</mdt-cell>
            </mdt-row>

        </mdt-table>

    </div>

</md-content>