@extends('layouts.auth')
@section('content')

    @php
        $satisfactionTypes = ["Satisfaisant", "Moyennement Satisfaisant","Non Satisfaisant"];
    @endphp
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div
                            class="page-title-box d-sm-flex align-items-center justify-content-between"
                        >
                            <h4 class="mb-sm-0">Data Tables</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Tables</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Data Tables
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->




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
                        <h5 class="mb-0">{{ number_format(count($monthPercents) > 0 ? array_sum($monthPercents) / count($monthPercents) : 0, 2) }} %</h5>
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



                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Buttons Example</h4>
                                <p class="card-title-desc">
                                    The Buttons extension for DataTables provides a
                                    common set of options, API methods and styling
                                    to display buttons on a page that will interact
                                    with a DataTable. The core library provides the
                                    based framework upon which plug-ins can built.
                                </p>

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

                                    @php
                                        // Find all unique months in the report
                                        $uniqueMonths = collect($report)->flatMap(function ($criteria) {
                                            return array_keys($criteria);
                                        })->unique()->toArray();
                                    @endphp

                                    {{-- Loop through each unique month for all criteria --}}
                                    @foreach ($uniqueMonths as $uniqueMonth)
                                        {{-- Loop through each criterion --}}
                                        @foreach ($report as $criteria => $months)
                                            @php
                                                $hasDataForMonth = isset($months[$uniqueMonth]);
                                            @endphp

                                            {{-- Display data for the specific month and criterion --}}
                                            <tr>
                                                <td>
                                                    {{ $criteria }}
                                                </td>

                                                @if ($hasDataForMonth)
                                                    @foreach ($satisfactionTypes as $type)
                                                        <td>
                                                            {{ isset($months[$uniqueMonth][$type]["count"]) ? $months[$uniqueMonth][$type]["count"] : "0" }}
                                                        </td>
                                                    @endforeach

                                                    <td>
                                                        {{ number_format(
                                                            (($months[$uniqueMonth]["Satisfaisant"]['count'] ?? 0) + ($months[$uniqueMonth]["Moyennement Satisfaisant"]['count'] ?? 0)) * 100 /
                                                            (($months[$uniqueMonth]["Satisfaisant"]['count'] ?? 0) + ($months[$uniqueMonth]["Moyennement Satisfaisant"]['count'] ?? 0) + ($months[$uniqueMonth]["Non Satisfaisant"]['count'] ?? 0))
                                                        ) }}%
                                                    </td>

                                                    {{-- Display the month in a separate "Date" column for this criterion --}}
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($uniqueMonth)->format('m/Y') }}
                                                    </td>
                                                @else
                                                    {{-- Placeholder cells if the month is not set for the current criterion --}}
                                                    @foreach ($satisfactionTypes as $type)
                                                        <td></td>
                                                    @endforeach
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach

                                    {{--                                    <tr>--}}
                                    {{--                                        <td>Garrett Winters</td>--}}
                                    {{--                                        <td>Accountant</td>--}}
                                    {{--                                        <td>Tokyo</td>--}}
                                    {{--                                        <td>63</td>--}}
                                    {{--                                        <td>2011/07/25</td>--}}
                                    {{--                                        <td>$170,750</td>--}}
                                    {{--                                    </tr>--}}

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

        @endsection
    </div>






