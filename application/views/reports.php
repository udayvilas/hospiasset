<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3 class="heading-stylerespond" style="margin-top:10px;">Reports</h3>

<md-content class="mylayout-padding" md-theme="hospiclr">
    <h5 class="sub_heading-style-respond" style="padding:2px;background-color:#4C9EF0">Equipment</h5>
    <div layout="row" flex>
        <div flex="25">
            <span style="text-align:center">Equipment Summary</span>
            <canvas id="pie" class="chart chart-pie" chart-data="equipmentsumarydata" chart-labels="equipmentsumarylabels" chart-colors="equipmentsumarycolors" chart-series="equipmentsumaryseries" style="margin-left:-80px;" ui-sref="home.requipment_summary">
            </canvas>
            <md-button ui-sref="home.requipment_summary" class="md-raised md-primary">View Report</md-button>
        </div>

        <div flex="25">
            <span  style="text-align:center">Equipment DownTime</span>
            <canvas id="pie" class="chart chart-pie"  chart-data="equipment_downtime_data" chart-labels="equipment_downtime_labels" chart-colors="equipment_downtime_colors" chart-series=" equipment_downtime_series" style="margin-left:-80px;">
            </canvas>
            <md-button ui-sref="home.equp_down_time" class="md-raised md-primary" >View Report</md-button>
        </div>
        <div flex="25">
            <span  style="text-align:center">Equipment History</span>
            <canvas id="pie" class="chart chart-pie"  chart-data="equipment_downtime_data" chart-labels="equipment_downtime_labels" chart-colors="equipment_downtime_colors" chart-series ="equipment_downtime_series" style="margin-left:-80px;">
            </canvas>
            <md-button ui-sref="home.equp_history_card" class="md-raised md-primary" >View Report</md-button>
        </div>
        <div flex="25">
            <span  style="text-align:center">Service</span>
            <canvas id="pie" class="chart chart-pie"  chart-data="servicegraphdata" chart-labels="servicegraphlabels" chart-series="servicegraphseries" style="margin-left:-80px;">
            </canvas>
            <md-button ui-sref="home.rservices" class="md-raised md-primary">View Report</md-button>
            </canvas
        </div>

    </div>
    </div>
    <h5 class="sub_heading-style-respond" style="padding:2px;background-color:#4C9EF0">Equipment1</h5>
    <div layout="row" flex>
        <div flex="25">
            <span  style="text-align:center">Viability</span>
            <canvas id="pie" class="chart chart-pie"  chart-data="viabiltygraphdata" chart-labels="viabiltygraphlabels" chart-series="viabiltygraphseries" style="margin-left:-80px;"> </canvas>
            <md-button ui-sref="home.rviability" class="md-raised md-primary">View Report</md-button>
        </div>
        <div flex="25">
            <span style="text-align:center">Indent </span>
            <canvas id="pie" class="chart chart-pie" chart-data="indentdata" chart-labels="indentlabels" chart-colors="indentcolors" chart-series="indentseries" style="margin-left:-80px;">
            </canvas>
            <md-button ui-sref="home.rindent" class="md-raised md-primary">View Report</md-button>
        </div>
        <div flex="25">
            <span style="text-align:center">Cear </span>
            <canvas id="pie" class="chart chart-pie" chart-data="ceardata" chart-labels="cearlabels" chart-colors="cearcolors" chart-series="cearseries" style="margin-left:-80px;">
            </canvas>
            <md-button ui-sref="home.rcear" class="md-raised md-primary">View Report</md-button>
        </div>
        <div flex="25">
            <span style="text-align:center">Gatepass </span>
            <canvas id="pie" class="chart chart-pie" chart-data="gatepassdata" chart-labels="gatepasslabels" chart-colors="gatepasscolors" chart-series="gatepassseries" style="margin-left:-80px;">
            </canvas>
            <md-button ui-sref="home.gatepass" class="md-raised md-primary">View Report</md-button>
        </div>
    </div>
    <h5 class="sub_heading-style-respond" style="padding:2px;background-color:#4C9EF0">Scheduled Calls</h5>
    <div layout="row" flex>
        <div flex="25">
            <span style="text-align:center">Call Log</span>
            <canvas id="pie" class="chart chart-pie"  chart-data="call_logsgraphdata" chart-labels="call_logsgraphlabels" chart-colors="call_logsgraphcolors" chart-series="call_logsgraphseries" style="margin-left:-80px;">  </canvas>
            <md-button ui-sref="home.call_log_reports" class="md-raised md-primary">View Report</md-button>
        </div>
        <div flex="25">
            <span  style="text-align:center">CMS Graph</span>
            <canvas id="pie" class="chart chart-pie" chart-data="cmsdata" chart-labels="cmslabels" chart-colors="cmscolors"  chart-series="cmsseries" style="margin-left:-80px;">
            </canvas>
            <md-button ui-sref="home.cms_report" class="md-raised md-primary" >View Report</md-button>
        </div>
        <div flex="25">
            <span  style="text-align:center">PMS </span>
            <canvas id="pie" class="chart chart-pie" chart-data="pmsgraphdata" chart-labels="pmsgraphlabels" chart-series="pmsgraphseries" style="margin-left:-80px;"></canvas>

            <md-button ui-sref="home.rpms" class="md-raised md-primary">View Report</md-button>
            </canvas>
        </div>
        <div flex="25">
            <span  style="text-align:center">Calibration Reports</span>
            <canvas id="pie" class="chart chart-pie" chart-data="qcgraphdata" chart-labels="qcgraphlabels" chart-series="qcgraphseries" style="margin-left:-80px;"> </canvas>
            <md-button ui-sref="home.rqc" class="md-raised md-primary">View Report</md-button>
            </canvas
        </div>
    </div></div>
    <h5 class="sub_heading-style-respond" style="padding:2px;background-color:#4C9EF0">Other Calls</h5>
    <div layout="row" flex>
        <div flex="25">
            <span  style="text-align:center">Adverse Incedents</span>
            <canvas id="pie" class="chart chart-pie" chart-data="adversegraphdata" chart-labels="adversegraphlabels" chart-colors="adversegraphcolors" chart-series="adversegraphseries" style="margin-left:-80px;">
            </canvas>
            <md-button ui-sref="home.radverse" class="md-raised md-primary">View Report</md-button>
            </canvas>
        </div>
        <div flex="25">
            <span style="text-align:center">Deployment</span>
            <canvas id="pie" class="chart chart-pie"  chart-data="deployementgraphdata" chart-labels="deployementgraphlabels" chart-series="deployementgraphseries" style="margin-left:-80px;">
            </canvas>
            <md-button ui-sref="home.deployment_report" class="md-raised md-primary">View Report</md-button>
        </div>
        <div flex="25">
            <span  style="text-align:center">Redeployment</span>
            <canvas id="pie" class="chart chart-pie"  chart-data="redeployementgraphdata" chart-labels="redeployementgraphlabels" chart-series="redeployementgraphseries" style="margin-left:-80px;"> </canvas>
            <md-button ui-sref="home.rredeployment" class="md-raised md-primary">View Report</md-button>
        </div>
        <div flex="25">
            <span style="text-align:center">Condemnation </span>
            <canvas id="pie" class="chart chart-pie"  chart-data="condemnationgraphdata" chart-labels="condemnationgraphlabels" chart-series="condemnationgraphseries" style="margin-left:-80px;"> </canvas>
            <md-button ui-sref="home.rcondemnation" class="md-raised md-primary">View Report</md-button>
        </div>
    </div>
        <h5 class="sub_heading-style-respond" style="padding:2px;background-color:#4C9EF0">Monthly Performance</h5>
    <div layout="row" flex>
        <div flex="25">
            <!--<span  style="text-align:center">Monthly Performance Report</span>-->
         <!--   <canvas id="pie" class="chart chart-pie" chart-data="adversegraphdata" chart-labels="adversegraphlabels" chart-colors="adversegraphcolors" chart-series="adversegraphseries" style="margin-left:-80px;">
            </canvas>-->
            <md-button ui-sref="home.monthly_performance_report" class="md-raised md-primary">MPR Report</md-button>

        </div>
        <div flex="25">
            <!-- <span  style="text-align:center">MPR Graphs</span>-->
            <!--   <canvas id="pie" class="chart chart-pie" chart-data="adversegraphdata" chart-labels="adversegraphlabels" chart-colors="adversegraphcolors" chart-series="adversegraphseries" style="margin-left:-80px;">
               </canvas>-->
            <md-button ui-sref="home.rnscreport" class="md-raised md-primary"> Non Sheduled Calls</md-button>

        </div>
        <div flex="25">
           <!-- <span  style="text-align:center">Graphs</span>-->
         <!--   <canvas id="pie" class="chart chart-pie" chart-data="adversegraphdata" chart-labels="adversegraphlabels" chart-colors="adversegraphcolors" chart-series="adversegraphseries" style="margin-left:-80px;">
            </canvas>-->
            <md-button ui-sref="home.graphs" class="md-raised md-primary">Graphs</md-button>

        </div>
        <div flex="25">
           <!-- <span  style="text-align:center">MPR Graphs</span>-->
         <!--   <canvas id="pie" class="chart chart-pie" chart-data="adversegraphdata" chart-labels="adversegraphlabels" chart-colors="adversegraphcolors" chart-series="adversegraphseries" style="margin-left:-80px;">
            </canvas>-->
            <!--<md-button ui-sref="home.monthly_performance_graph" class="md-raised md-primary"> MPR Graphs</md-button>-->

        </div>


    </div> </div>


</md-content>