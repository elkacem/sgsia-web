@extends('layouts.auth')
@section('content')

    @php
        $satisfactionTypes = ["Satisfaisant", "Moyennement Satisfaisant","Non Satisfaisant"];
    @endphp
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title mb-4">Statistique des satisfactions ce mois</h4>

                                <div class="row text-center">
                                    <div class="col-6">
                                        <h5 class="mb-0">{{ number_format(count($monthPercents) > 0 ? array_sum($monthPercents) / count($monthPercents) : 0, 2) }}
                                            %</h5>
                                        <p class="text-muted text-truncate">Satisfaction</p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">{{number_format(count($monthPercents) > 0 ? (100 - array_sum($monthPercents) / count($monthPercents)) : 0, 2) }}
                                            %</h5>
                                        <p class="text-muted text-truncate">Non Satisfaction</p>
                                    </div>
                                    {{--                    <div class="col-4">--}}
                                    {{--                        <h5 class="mb-0">102030</h5>--}}
                                    {{--                        <p class="text-muted text-truncate">test</p>--}}
                                    {{--                    </div>--}}
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
                                    <div class="col-6">
                                        <h5 class="mb-0">{{ number_format(count($monthPercents) > 0 ? array_sum($monthPercents) / count($monthPercents) : 0, 2) }}
                                            %</h5>
                                        <p class="text-muted text-truncate">Moyenne de satisfaction</p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">{{ $standardDeviation }}</h5>
                                        <p class="text-muted text-truncate">La dispersion</p>
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
                                        <h5 class="mb-0">{{ number_format(((count($thisMonth) > 0 && array_sum($thisMonth) > 0 ? ($thisMonth[2] * 100) / array_sum($thisMonth) : 0) - (count($lastMonth) > 0 && array_sum($lastMonth) > 0 ? ($lastMonth[2] * 100) / array_sum($lastMonth) : 0)), 2) }}
                                            %</h5>
                                        <p class="text-muted text-truncate">Satisfaisant</p>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="mb-0">{{ number_format(((count($thisMonth) > 0 && array_sum($thisMonth) > 0 ? ($thisMonth[1] * 100) / array_sum($thisMonth) : 0) - (count($lastMonth) > 0 && array_sum($lastMonth) > 0 ? ($lastMonth[1] * 100) / array_sum($lastMonth) : 0)), 2) }}
                                            %</h5>
                                        <p class="text-muted text-truncate">Moyennement Satisfaisant</p>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="mb-0">{{ number_format(((count($thisMonth) > 0 && array_sum($thisMonth) > 0 ? ($thisMonth[0] * 100) / array_sum($thisMonth) : 0) - (count($lastMonth) > 0 && array_sum($lastMonth) > 0 ? ($lastMonth[0] * 100) / array_sum($lastMonth) : 0)), 2) }}
                                            %</h5>
                                        <p class="text-muted text-truncate">Non Satisfaisant</p>
                                    </div>
                                </div>

                                <canvas id="radar" height="300"></canvas>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div
                            class="page-title-box d-sm-flex align-items-center justify-content-between"
                        >
                            <h4 class="mb-sm-0">Tableaux de données</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Tableaux</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Tableaux de données
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">2 mois Sondages</h4>
                                {{--                                <p class="card-title-desc">--}}
                                {{--                                    The Buttons extension for DataTables provides a--}}
                                {{--                                    common set of options, API methods and styling--}}
                                {{--                                    to display buttons on a page that will interact--}}
                                {{--                                    with a DataTable. The core library provides the--}}
                                {{--                                    based framework upon which plug-ins can built.--}}
                                {{--                                </p>--}}

                                <table
                                    id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="
                                    border-collapse: collapse;
                                    border-spacing: 0;
                                    width: 100%;
                                "
                                >
                                    <thead>
                                    {{--                                    <tr>--}}
                                    {{--                                        <th>Questions</th>--}}
                                    {{--                                        <th>Satisfaisant</th>--}}
                                    {{--                                        <th>Moyennement</th>--}}
                                    {{--                                        <th>Non satisfaisant</th>--}}
                                    {{--                                        <th>Taux</th>--}}
                                    {{--                                        <th>Date</th>--}}

                                    {{--                                    </tr>--}}
                                    {{--                                    </thead>--}}
                                    {{--                                    <tbody>--}}
                                    {{--                                    @foreach ($report as $criteria => $values)--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <td>--}}
                                    {{--                                                --}}{{--                                                Propreté des places de stationnement--}}
                                    {{--                                                {{  $criteria }}--}}
                                    {{--                                            </td>--}}
                                    {{--                                            @foreach ($report[$criteria] as $month => $values)--}}
                                    {{--                                                --}}{{--                                                {{ $month  }}--}}
                                    {{--                                                @foreach($satisfactionTypes as $type)--}}

                                    {{--                                                    <td>--}}
                                    {{--                                                        {{ isset($report[$criteria][$month][$type]["count"])? $report[$criteria][$month][$type]["count"] : "0" }}--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                @endforeach--}}

                                    {{--                                                <td>--}}
                                    {{--                                                    {{ number_format(--}}
                                    {{--                                                    (($report[$criteria][$month]["Satisfaisant"]['count'] ?? 0) + ($report[$criteria][$month]["Moyennement Satisfaisant"]['count'] ?? 0)) * 100 /--}}
                                    {{--                                                    (($report[$criteria][$month]["Satisfaisant"]['count'] ?? 0) + ($report[$criteria][$month]["Moyennement Satisfaisant"]['count'] ?? 0)+ ($report[$criteria][$month]["Non Satisfaisant"]['count'] ?? 0))--}}

                                    {{--                                                ) }}%--}}
                                    {{--                                                </td>--}}
                                    {{--                                                <td>--}}
                                    {{--                                                    {{ \Carbon\Carbon::parse($month)->format('m/Y') }}--}}
                                    {{--                                                </td>--}}
                                    {{--                                            @endforeach--}}


                                    {{--                                        </tr>--}}

                                    {{--                                    @endforeach--}}


                                    <tr>
                                        <th>Questions</th>
                                        <th>Satisfaisant</th>
                                        <th>Moyennement</th>
                                        <th>Non satisfaisant</th>
                                        <th>Taux</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    {{--                                    @php--}}
                                    {{--                                        // Find all unique months in the report--}}
                                    {{--                                        $uniqueMonths = collect($report)->flatMap(function ($criteria) {--}}
                                    {{--                                            return array_keys($criteria);--}}
                                    {{--                                        })->unique()->toArray();--}}
                                    {{--                                    @endphp--}}

                                    {{--                                    --}}{{-- Loop through each unique month for all criteria --}}
                                    {{--                                    @foreach ($uniqueMonths as $uniqueMonth)--}}
                                    {{--                                        --}}{{-- Loop through each criterion --}}
                                    {{--                                        @foreach ($report as $criteria => $months)--}}
                                    {{--                                            @php--}}
                                    {{--                                                $hasDataForMonth = isset($months[$uniqueMonth]);--}}
                                    {{--                                            @endphp--}}

                                    {{--                                            --}}{{-- Display data for the specific month and criterion --}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td>--}}
                                    {{--                                                    {{ $criteria }}--}}
                                    {{--                                                </td>--}}

                                    {{--                                                @if ($hasDataForMonth)--}}
                                    {{--                                                    @foreach ($satisfactionTypes as $type)--}}
                                    {{--                                                        <td>--}}
                                    {{--                                                            {{ isset($months[$uniqueMonth][$type]["count"]) ? $months[$uniqueMonth][$type]["count"] : "0" }}--}}
                                    {{--                                                        </td>--}}
                                    {{--                                                    @endforeach--}}

                                    {{--                                                    <td>--}}
                                    {{--                                                        {{ number_format(--}}
                                    {{--                                                            ($denominator = ($report[$criteria][$month]["Satisfaisant"]['count'] ?? 0) + ($report[$criteria][$month]["Moyennement Satisfaisant"]['count'] ?? 0) + ($report[$criteria][$month]["Non Satisfaisant"]['count'] ?? 0)) !== 0 ?--}}
                                    {{--                                                            (($report[$criteria][$month]["Satisfaisant"]['count'] ?? 0) + ($report[$criteria][$month]["Moyennement Satisfaisant"]['count'] ?? 0)) * 100 / $denominator :--}}
                                    {{--                                                            0--}}
                                    {{--                                                        )}}%--}}

                                    {{--                                                    </td>--}}

                                    {{--                                                    --}}{{-- Display the month in a separate "Date" column for this criterion --}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        {{ \Carbon\Carbon::parse($uniqueMonth)->format('m/Y') }}--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                @else--}}
                                    {{--                                                    --}}{{-- Placeholder cells if the month is not set for the current criterion --}}
                                    {{--                                                    @foreach ($satisfactionTypes as $type)--}}
                                    {{--                                                        <td></td>--}}
                                    {{--                                                    @endforeach--}}
                                    {{--                                                    <td></td>--}}
                                    {{--                                                    <td></td>--}}
                                    {{--                                                @endif--}}
                                    {{--                                            </tr>--}}
                                    {{--                                        @endforeach--}}
                                    {{--                                    @endforeach--}}

                                    @foreach ($report as $criteria => $values)
                                        @foreach ($report[$criteria] as $month => $values)
                                            <tr>
                                                <td>
                                                    {{  $criteria }}
                                                </td>

                                                {{--                                        {{ $month  }}--}}
                                                @foreach($satisfactionTypes as $type)

                                                    <td>
                                                        {{ isset($report[$criteria][$month][$type]["count"])? $report[$criteria][$month][$type]["count"] : "0" }}
                                                    </td>
                                                @endforeach

                                                <td>
                                                    {{ number_format(
                                                        ($denominator = ($report[$criteria][$month]["Satisfaisant"]['count'] ?? 0) + ($report[$criteria][$month]["Moyennement Satisfaisant"]['count'] ?? 0) + ($report[$criteria][$month]["Non Satisfaisant"]['count'] ?? 0)) !== 0 ?
                                                        (($report[$criteria][$month]["Satisfaisant"]['count'] ?? 0) + ($report[$criteria][$month]["Moyennement Satisfaisant"]['count'] ?? 0)) * 100 / $denominator :
                                                        0
                                                    )}}%

                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($month)->format('m/Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>

@endsection

@section('charts')
    <script>
        !function (l) {
            "use strict";

            function r() {
            }

            r.prototype.respChart = function (r, o, e, a) {
                Chart.defaults.global.defaultFontColor = "#8791af", Chart.defaults.scale.gridLines.color = "rgba(166, 176, 207, 0.1)";
                var t = r.get(0).getContext("2d"),
                    n = l(r).parent();

                function i() {
                    r.attr("width", l(n).width());
                    switch (o) {
                        case "Line":
                            new Chart(t, {
                                type: "line",
                                data: e,
                                options: a
                            });
                            break;
                        case "Doughnut":
                            new Chart(t, {
                                type: "doughnut",
                                data: e,
                                options: a
                            });
                            break;
                        case "Pie":
                            new Chart(t, {
                                type: "pie",
                                data: e,
                                options: a
                            });
                            break;
                        case "Bar":
                            new Chart(t, {
                                type: "bar",
                                data: e,
                                options: a
                            });
                            break;
                        case "Radar":
                            new Chart(t, {
                                type: "radar",
                                data: e,
                                options: a
                            });
                            break;
                        case "PolarArea":
                            new Chart(t, {
                                data: e,
                                type: "polarArea",
                                options: a
                            })
                    }
                }

                l(window).resize(i), i()
            }, r.prototype.init = function () {
                {{--this.respChart(l("#lineChart"), "Line", {--}}
                    {{--    // labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],--}}
                    {{--    labels: {!! json_encode($criterias) !!},--}}
                    {{--    datasets: [{--}}
                    {{--        label: "Sales Analytics",--}}
                    {{--        fill: !0,--}}
                    {{--        lineTension: .5,--}}
                    {{--        backgroundColor: "rgba(85, 110, 230, 0.2)",--}}
                    {{--        borderColor: "#0f9cf3",--}}
                    {{--        borderCapStyle: "butt",--}}
                    {{--        borderDash: [],--}}
                    {{--        borderDashOffset: 0,--}}
                    {{--        borderJoinStyle: "miter",--}}
                    {{--        pointBorderColor: "#0f9cf3",--}}
                    {{--        pointBackgroundColor: "#fff",--}}
                    {{--        pointBorderWidth: 1,--}}
                    {{--        pointHoverRadius: 5,--}}
                    {{--        pointHoverBackgroundColor: "#0f9cf3",--}}
                    {{--        pointHoverBorderColor: "#fff",--}}
                    {{--        pointHoverBorderWidth: 2,--}}
                    {{--        pointRadius: 1,--}}
                    {{--        pointHitRadius: 10,--}}
                    {{--        data: [65, 59, 80, 81, 56, 55, 40, 55, 30, 80, 65, 59, 80, 81, 56, 55, 40, 55, 30, 80,30, 80]--}}
                    {{--    }, {--}}
                    {{--        label: "Monthly Earnings",--}}
                    {{--        fill: !0,--}}
                    {{--        lineTension: .5,--}}
                    {{--        backgroundColor: "rgba(252, 185, 44, 0.2)",--}}
                    {{--        borderColor: "#fcb92c",--}}
                    {{--        borderCapStyle: "butt",--}}
                    {{--        borderDash: [],--}}
                    {{--        borderDashOffset: 0,--}}
                    {{--        borderJoinStyle: "miter",--}}
                    {{--        pointBorderColor: "#fcb92c",--}}
                    {{--        pointBackgroundColor: "#fff",--}}
                    {{--        pointBorderWidth: 1,--}}
                    {{--        pointHoverRadius: 5,--}}
                    {{--        pointHoverBackgroundColor: "#fcb92c",--}}
                    {{--        pointHoverBorderColor: "#eef0f2",--}}
                    {{--        pointHoverBorderWidth: 2,--}}
                    {{--        pointRadius: 1,--}}
                    {{--        pointHitRadius: 10,--}}
                    {{--        data: [80, 23, 56, 65, 23, 35, 85, 25, 92, 36, 80, 23, 56, 65, 23, 35, 85, 25, 92, 36, 92, 36]--}}
                    {{--    }]--}}
                    {{--}, {--}}
                    {{--    scales: {--}}
                    {{--        yAxes: [{--}}
                    {{--            ticks: {--}}
                    {{--                max: 100,--}}
                    {{--                min: 20,--}}
                    {{--                stepSize: 10--}}
                    {{--            }--}}
                    {{--        }]--}}
                    {{--    }--}}
                    {{--});--}}
                    {{--this.respChart(l("#doughnut"), "Doughnut", {--}}
                    {{--    labels: ["Desktops", "Tablets"],--}}
                    {{--    datasets: [{--}}
                    {{--        data: [300, 210],--}}
                    {{--        backgroundColor: ["#0f9cf3", "#ebeff2"],--}}
                    {{--        hoverBackgroundColor: ["#0f9cf3", "#ebeff2"],--}}
                    {{--        hoverBorderColor: "#fff"--}}
                    {{--    }]--}}
                    {{--});--}}
                    {{--this.respChart(l("#pie"), "Pie", {--}}
                    {{--    labels: ["Desktops", "Tablets"],--}}
                    {{--    datasets: [{--}}
                    {{--        data: [300, 180],--}}
                    {{--        backgroundColor: ["#1cbb8c", "#ebeff2"],--}}
                    {{--        hoverBackgroundColor: ["#1cbb8c", "#ebeff2"],--}}
                    {{--        hoverBorderColor: "#fff"--}}
                    {{--    }]--}}
                    {{--});--}}

                    {{--this.respChart(l("#bar"), "Bar", {--}}
                    {{--    labels: ["January", "February", "March", "April", "May", "June", "July"],--}}
                    {{--    datasets: [{--}}
                    {{--        label: "Sales Analytics",--}}
                    {{--        backgroundColor: "rgba(28, 187, 140, 0.8)",--}}
                    {{--        borderColor: "rgba(28, 187, 140, 0.8)",--}}
                    {{--        borderWidth: 1,--}}
                    {{--        hoverBackgroundColor: "rgba(28, 187, 140, 0.9)",--}}
                    {{--        hoverBorderColor: "rgba(28, 187, 140, 0.9)",--}}
                    {{--        data: [65, 59, 81, 45, 56, 80, 50, 20]--}}
                    {{--    }]--}}
                    {{--}, {--}}
                    {{--    scales: {--}}
                    {{--        xAxes: [{--}}
                    {{--            barPercentage: .4--}}
                    {{--            barPercentage: .4--}}
                    {{--        }]--}}
                    {{--    }--}}
                    {{--});--}}
                    this.respChart(l("#radar"), "Radar", {
                    labels: ["Non Satisfaisant", "Moyennement Satisfaisant", "Satisfaisant"],
                    datasets: [{
                        label: "Mois passé",
                        backgroundColor: "rgba(252, 185, 44, 0.2)",
                        borderColor: "#fcb92c",
                        pointBackgroundColor: "#fcb92c",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#fcb92c",
                        data: {!! json_encode($lastMonth) !!},
                    }, {
                        label: "Mois courant",
                        backgroundColor: "rgba(84, 56, 220, 0.2)",
                        borderColor: "#0f9cf3",
                        pointBackgroundColor: "#0f9cf3",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#0f9cf3",
                        data: {!! json_encode($thisMonth) !!}
                    }]
                });

                {{--// New Bar Chart--}}
                {{--            const labelsBarChart = {!! json_encode($criterias) !!};--}}
                {{--            const dataBarChart = {--}}
                {{--                labels: labelsBarChart,--}}
                {{--                datasets: [--}}
                {{--                    {--}}
                {{--                        label: 'safits 1',--}}
                {{--                        data: {!! json_encode($satisfaisantCounts) !!},--}}
                {{--                        backgroundColor: "rgba(28, 187, 140, 0.8)",--}}
                {{--                        borderColor: "rgba(28, 187, 140, 0.8)",--}}
                {{--                    },--}}
                {{--                    {--}}
                {{--                        label: 'm satis 2',--}}
                {{--                        data: {!! json_encode($moyennementSatisfaisantCounts) !!},--}}
                {{--                        backgroundColor: "rgba(84, 56, 220, 0.2)",--}}
                {{--                        borderColor: "#0f9cf3",--}}
                {{--                    },--}}
                {{--                    {--}}
                {{--                        label: 'non satis 3', // Added Dataset 3--}}
                {{--                        data: {!! json_encode($nonSatisfaisantCounts) !!},--}}
                {{--                        backgroundColor: "rgba(255, 99, 132, 0.8)",--}}
                {{--                        borderColor: "rgba(255, 99, 132, 0.8)",--}}
                {{--                    }--}}
                {{--                ]--}}
                {{--            };--}}

                {{--            let delayedBarChart;--}}
                {{--            const configBarChart = {--}}
                {{--                type: 'bar',--}}
                {{--                data: dataBarChart,--}}
                {{--                options: {--}}
                {{--                    animation: {--}}
                {{--                        onComplete: () => {--}}
                {{--                            delayedBarChart = true;--}}
                {{--                        },--}}
                {{--                        delay: (context) => {--}}
                {{--                            let delay = 0;--}}
                {{--                            if (context.type === 'data' && context.mode === 'default' && !delayedBarChart) {--}}
                {{--                                delay = context.dataIndex * 300 + context.datasetIndex * 100;--}}
                {{--                            }--}}
                {{--                            return delay;--}}
                {{--                        },--}}
                {{--                    },--}}
                {{--                    scales: {--}}
                {{--                        x: {--}}
                {{--                            stacked: true,--}}
                {{--                        },--}}
                {{--                        y: {--}}
                {{--                            stacked: true--}}
                {{--                        }--}}
                {{--                    }--}}
                {{--                }--}}
                {{--            };--}}

                {{--            this.respChart(l("#barChartNew"), "Bar", dataBarChart, configBarChart);--}}


                // Add the new custom Line chart
                const lineChardata = {
                    labels: {!! json_encode($criterias) !!},
                    datasets: [
                        {
                            label: 'Satisfaisant',
                            data: {!! json_encode($satisfaisantCounts) !!},
                            backgroundColor: "rgba(28, 187, 140, 0.8)",
                            borderColor: "rgba(28, 187, 140, 0.8)",
                        },
                        {
                            label: 'Moyennement Satisfaisant',
                            data: {!! json_encode($moyennementSatisfaisantCounts) !!},
                            backgroundColor: "rgba(84, 56, 220, 0.2)",
                            borderColor: "#0f9cf3",
                        },
                        {
                            label: 'Non Satisfaisant', // Added Dataset 3
                            data: {!! json_encode($nonSatisfaisantCounts) !!},
                            backgroundColor: "rgba(255, 99, 132, 0.8)",
                            borderColor: "rgba(255, 99, 132, 0.8)",
                        }
                    ]

                };

                this.respChart(l("#barChartNew"), "Bar", lineChardata, {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Suggested Min and Max Settings'
                        }
                    },
                    scales: {
                        yAxes: [{
                            suggestedMin: 0,
                            suggestedMax: 50,
                        }]
                    }
                });

                {{--this.respChart(l("#polarArea"), "PolarArea", {--}}
                    {{--        datasets: [{--}}
                    {{--            data: {!! json_encode($monthPercents) !!},--}}
                    {{--            backgroundColor: ["#fcb92c", "#1cbb8c", "#f32f53", "#0f9cf3"],--}}
                    {{--            label: "My dataset",--}}
                    {{--            hoverBorderColor: "#fff"--}}
                    {{--        }],--}}
                    {{--        labels: {!! json_encode($criterias) !!}--}}
                    {{--    })--}}

                    this.respChart(l("#polarArea"), "PolarArea", {
                    datasets: [{
                        data: {!! json_encode($percents) !!},
                        backgroundColor: ["#186A3B", "#28B463", "#58D68D", "#D5F5E3", "#F5B7B1", "#F1948A", "#E74C3C", "#78281F"],
                        label: "My dataset",
                        hoverBorderColor: "#fff"
                    }],
                    labels: {!! json_encode($criteriaOfPercent) !!}
                })
            }, l.ChartJs = new r, l.ChartJs.Constructor = r
        }(window.jQuery),
            function () {
                "use strict";
                window.jQuery.ChartJs.init()
            }();
    </script>

@endsection






