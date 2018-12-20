<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<md-content class="mylayout-padding" md-theme="hospiclr">
    <h3 class="heading-stylerespond">Monthly Performance Graphs</h3>  <div layout="row">        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;</div>        <md-button ui-sref="home.monthly_performance_report" class="md-raised md-primary">Back To Reports</md-button>            </div>
    <div layout="column" flex>
        <div layout="row">
            <div flex="40">
                <p>Non Scheduled Graph</p>
                <canvas id="bar" class="chart chart-bar" height="100"
                        chart-data="nonscheduleddata" chart-labels="nonscheduledlabels" chart-colors="nonscheduledcolors"> chart-series="nonscheduledseries"
                </canvas>
            </div>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
            <div flex="25">
                <p>A1-Response Time (RT)</p>
                <canvas id="bar" class="chart chart-bar" height="100"
                        chart-data="ResponseTimedata" chart-labels="ResponseTimelabels" chart-colors="ResponseTimecolors"> chart-series="ResponseTimeseries"
                </canvas>
            </div>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
            <div flex="25">
                <p>A2-Time To Repair-(TTR)</p>
                <canvas id="bar" class="chart chart-bar" height="100"
                        chart-data="TimeToRepairdata" chart-labels="TimeToRepairlabels" chart-colors="TimeToRepaircolors"> chart-series="TimeToRepaireries"
                </canvas>
            </div>
        </div>
        <div layout="row">
            <div flex="40">
                <p>Scheduled Graph</p>
                <canvas id="bar" class="chart chart-bar" height="100"
                        chart-data="scheduleddata" chart-labels="scheduledlabels" chart-colors="scheduledcolors"> chart-series="scheduledseries"
                </canvas>
            </div>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
            <div flex="45">
                <p>TOTAL TRAININGS SESSIONS</p>
                <canvas id="bar" class="chart chart-bar" height="120"
                        chart-data="trainingsessiondata" chart-labels="trainingsessionlabels" chart-colors="trainingsessioncolors"> chart-series="trainingsessionseries"
                </canvas>
            </div>
        </div>
        <div layout="row">
            <div flex="65">
                <p>RT / TTR -Cause Codes(CC)</p>
                <canvas id="bar" class="chart chart-bar" height="120"
                        chart-data="causecodedata" chart-labels="causecodelabels" chart-colors="causecodecolors"> chart-series="causecodeseries"
                </canvas>
            </div>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
            <div flex="30">
                <p>Reasons for delay(RT>60M & TTR>3D)</p>
                <canvas id="bar" class="chart chart-bar" height="120"
                        chart-data="rtTimeandttrdata" chart-labels="rtTimeandttrlabels" chart-colors="rtTimeandttrcolors"> chart-series="rtTimeandttrseries"
                </canvas>
            </div>
            </div>
        <div layout="row">
            <div flex="45">
                <p>Assets Count Graph</p>
                <canvas id="bar" class="chart chart-bar" height="120"
                        chart-data="assetscountdata" chart-labels="assetscountlabels" chart-colors="assetscountcolors"> chart-series="assetscountseries"
                </canvas>
            </div>

            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
            <div flex="50">
                <p>Assets Values Graph</p>
                <canvas id="bar" class="chart chart-bar" height="120"
                        chart-data="assetvaluesdata" chart-labels="assetvalueslabels" chart-colors="assetvaluescolors"> chart-series="assetvaluesseries"
                </canvas>
            </div>
        </div>

        <div layout="row">
            <div flex="50">
                <p>Man Power Graph</p>
                <canvas id="bar" class="chart chart-bar" height="160"
                        chart-data="manpowerdata" chart-labels="manpowerlabels" chart-colors="manpowercolors"> chart-series="manpowerseries"
                </canvas>
            </div>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
        </div>
        <div layout="row">
            <div flex="50">
                <p>EXPENSES COUNT Graph</p>
                <canvas id="bar" class="chart chart-bar" height="160"
                        chart-data="expensescountdata" chart-labels="expensescountlabels" chart-colors="expensescountcolors"> chart-series="expensescountseries"
                </canvas>
            </div>
            <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
            <div flex="50">
                <p> EXPENSES VALUE Graph</p>
                <canvas id="bar" class="chart chart-bar" height="160"
                        chart-data="expensesvaluedata" chart-labels="expensesvaluelabels" chart-colors="expensesvaluecolors"> chart-series="expensesvalueseries"
                </canvas>
            </div>
        </div>
    </div>
    <div layout="row">
        <div flex="50">
            <p>Activities Count Graph</p>
            <canvas id="bar" class="chart chart-bar" height="160"
                    chart-data="activitiescountdata" chart-labels="activitiescountlabels" chart-colors="activitiescountcolors"> chart-series="activitiescountseries"
            </canvas>
        </div>
        <div flex="5" hide-xs hide-sm>&nbsp;&nbsp;	</div>
        <div flex="45">
            <p> Activities Values Graph</p>
            <canvas id="bar" class="chart chart-bar" height="160"
                    chart-data="activitiesvaluesdata" chart-labels="activitiesvalueslabels" chart-colors="activitiesvaluescolors"> chart-series="activitiesvaluesseries"
            </canvas>
        </div>
    </div>
    <div layout="row">
        <div flex="100">
            <p>Contracts Graph</p>
            <canvas id="bar" class="chart chart-bar" height="160"
                    chart-data="contractsdata" chart-labels="contractslabels" chart-series="contractsseries">
            </canvas>
        </div>

    </div>
    <div layout="row">
        <div flex="100">
            <p>Engineers Productivity Graph</p>
            <canvas id="bar" class="chart chart-bar" height="120"
                    chart-data="Engineerproductivitydata" chart-labels="Engineerproductivitylabels" chart-series="Engineerproductivityseries" chart-colors="Engineerproductivitycolors">
            </canvas>
        </div>
    </div>
    <div layout="row">
        <div flex="100">
            <p>Nabh Readiness Graph</p>
            <canvas id="bar" class="chart chart-bar" height="120"
                    chart-data="nabhreadinessdata" chart-labels="nabhreadinesslabels" chart-series="nabhreadinessseries" chart-colors="nabhreadinesscolors">
            </canvas>
        </div>
    </div>
    </div>
</md-content>