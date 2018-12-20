<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Graphs</h3>
    <div layout="column" flex>
        <div layout="row">
            <div flex="45">
                <p>CMS Graph</p>
                <canvas id="bar1" class="chart chart-bar"
                        chart-data="cmsdata" chart-labels="cmslabels" chart-colors="cmscolors"> chart-series="cmsseries"
                </canvas>
            </div>
            <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;	</div>
            <div flex="45">
                <p>Gatepass Graph</p>
           <canvas id="bar" class="chart chart-bar"
                    chart-data="gatepassdata" chart-labels="gatepasslabels" chart-colors="gatepasscolors"> chart-series="gatepassseries"
            </canvas>
        </div>
        </div>
            <div layout="row">
            <div flex="45">
                <p>Viability Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="vaibiltydata" chart-labels="vaibiltylabels" chart-colors="vaibiltycolors"> chart-series="vaibiltyseries"
                </canvas>
            </div>
                <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <div flex="45">
                    <p>Adverse Incidents Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="adversedata" chart-labels="adverselabels" chart-colors="adversecolors"> chart-series="adverseseries"
                </canvas>
            </div>
        </div>
        <div layout="row">
            <div flex="45">
                <p>Services Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="servicesdata" chart-labels="serviceslabels" chart-colors="servicescolors"> chart-series="servicesseries"
                </canvas>
            </div>
            <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <div flex="45">
                    <p>CallLog Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="calllogdata" chart-labels="callloglabels" chart-colors="calllogcolors"> chart-series="calllogseries"
                </canvas>
            </div>
        </div>
        <div layout="row">
            <div flex="45">
                <p>Deployement Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="deployementdata" chart-labels="deployementlabels" chart-colors="deployementcolors"> chart-series="deployementseries"
                </canvas>
            </div>
            <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <div flex="45">
                    <p>Redeployment Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="redeployementdata" chart-labels="redeployementlabels" chart-colors="redeployementcolors"> chart-series="redeployementseries"
                </canvas>
            </div>
        </div>
        <div layout="row">
            <div flex="45">
                <p>PMS Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="pmsdata" chart-labels="pmslabels" chart-colors="pmscolors"> chart-series="pmsseries"
                </canvas>
            </div>
            <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <div flex="45">
                    <p>QC Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="qcdata" chart-labels="qclabels" chart-colors="qccolors"> chart-series="qcseries"
                </canvas>
            </div>
        </div>
        <div layout="row">
            <div flex="45">
                <p>Indent Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="indentdata" chart-labels="indentlabels" chart-colors="indentcolors"> chart-series="indentseries"
                </canvas>
            </div>
            <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;	</div>
                <div flex="45">
                    <p>Cear Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="ceardata" chart-labels="cearlabels" chart-colors="cearcolors"> chart-series="cearseries"
                </canvas>
            </div>
        </div>
        <div layout="row">
            <div flex="45">
                <p>Condemnation Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="condemnationdata" chart-labels="condemnationlabels" chart-colors="condemnationcolors"> chart-series="condemnationseries"
                </canvas>
            </div>
            <div flex="10" hide-xs hide-sm>&nbsp;&nbsp;	</div>
     <div flex="45">
                <p>Transfer Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="transferdata" chart-labels="transferlabels" chart-colors="transfercolors"> chart-series="transferseries"
                </canvas>
            </div>

        </div>
        <div layout="row">
            <div flex="100">
                <p>Equipment Summary Graph</p>
                <canvas id="bar" class="chart chart-bar"
                        chart-data="equipmentsumarydata" chart-labels="equipmentsumarylabels" chart-colors="equipmentsumarycolors"> chart-series="equipmentsumaryseries"
                </canvas>
            </div>

            </div>
            <div layout="row">
                <div flex="100">
                    <p>Monthly Performance Graph</p>
                    <canvas id="bar" class="chart chart-bar"
                            chart-data="montlyperformancedata" chart-labels="montlyperformancelabels" chart-colors="montlyperformancecolors"> chart-series="equipmentsumaryseries"
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</md-content>