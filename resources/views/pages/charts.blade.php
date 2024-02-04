<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Statistique des satisfactions ce mois</h4>

                <div class="row text-center">
                    <div class="col-4">
                        <h5 class="mb-0">86541</h5>
                        <p class="text-muted text-truncate">test</p>
                    </div>
                    <div class="col-4">
                        <h5 class="mb-0">2541</h5>
                        <p class="text-muted text-truncate">test</p>
                    </div>
                    <div class="col-4">
                        <h5 class="mb-0">102030</h5>
                        <p class="text-muted text-truncate">test</p>
                    </div>
                </div>

                <canvas id="barChartNew" height="300"></canvas>

            </div>
        </div>
    </div> <!-- end col -->

{{--    <div class="col-lg-6">--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}

{{--                <h4 class="card-title mb-4">Bar Chart</h4>--}}

{{--                <div class="row text-center">--}}
{{--                    <div class="col-4">--}}
{{--                        <h5 class="mb-0">2541</h5>--}}
{{--                        <p class="text-muted text-truncate">Activated</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <h5 class="mb-0">84845</h5>--}}
{{--                        <p class="text-muted text-truncate">Pending</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <h5 class="mb-0">12001</h5>--}}
{{--                        <p class="text-muted text-truncate">Deactivated</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <canvas id="bar" height="300"></canvas>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div> <!-- end col -->--}}
</div> <!-- end row -->


{{--<div class="row">--}}
{{--    <div class="col-lg-6">--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}

{{--                <h4 class="card-title mb-4">Pie Chart</h4>--}}

{{--                <div class="row text-center">--}}
{{--                    <div class="col-4">--}}
{{--                        <h5 class="mb-0">2536</h5>--}}
{{--                        <p class="text-muted text-truncate">Activated</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <h5 class="mb-0">69421</h5>--}}
{{--                        <p class="text-muted text-truncate">Pending</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <h5 class="mb-0">89854</h5>--}}
{{--                        <p class="text-muted text-truncate">Deactivated</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <canvas id="pie" height="260"></canvas>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div> <!-- end col -->--}}


{{--    <div class="col-lg-6">--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}

{{--                <h4 class="card-title mb-4">Donut Chart</h4>--}}

{{--                <div class="row text-center">--}}
{{--                    <div class="col-4">--}}
{{--                        <h5 class="mb-0">9595</h5>--}}
{{--                        <p class="text-muted text-truncate">Activated</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <h5 class="mb-0">36524</h5>--}}
{{--                        <p class="text-muted text-truncate">Pending</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <h5 class="mb-0">62541</h5>--}}
{{--                        <p class="text-muted text-truncate">Deactivated</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <canvas id="doughnut" height="260"></canvas>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div> <!-- end col -->--}}
{{--</div> <!-- end row -->--}}

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Taux maximal et minimal de satisfaction des passagers</h4>

                <div class="row text-center">
                    <div class="col-4">
                        <h5 class="mb-0">4852</h5>
                        <p class="text-muted text-truncate">test</p>
                    </div>
                    <div class="col-4">
                        <h5 class="mb-0">3652</h5>
                        <p class="text-muted text-truncate">test</p>
                    </div>
                    <div class="col-4">
                        <h5 class="mb-0">85412</h5>
                        <p class="text-muted text-truncate">test</p>
                    </div>
                </div>

                <canvas id="polarArea" height="300"></canvas>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Satisfaction par rapport au mois précédent</h4>
                <div class="row text-center">
                    <div class="col-4">
                        <h5 class="mb-0">{{ number_format(($thisMonth[2] * 100) / array_sum($thisMonth) - ($lastMonth[2] * 100) / array_sum($lastMonth), 2) }} %</h5>
                        <p class="text-muted text-truncate">Satisfaisant</p>
                    </div>
                    <div class="col-4">
                        <h5 class="mb-0">{{ number_format(($thisMonth[1] * 100) / array_sum($thisMonth) - ($lastMonth[1] * 100) / array_sum($lastMonth), 2) }} %</h5>
                        <p class="text-muted text-truncate">Moyennement Satisfaisant</p>
                    </div>
                    <div class="col-4">
                        <h5 class="mb-0">{{ number_format(($thisMonth[0] * 100) / array_sum($thisMonth) - ($lastMonth[0] * 100) / array_sum($lastMonth), 2) }} %</h5>
                        <p class="text-muted text-truncate">Non Satisfaisant</p>
                    </div>
                </div>

                <canvas id="radar" height="300"></canvas>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->



