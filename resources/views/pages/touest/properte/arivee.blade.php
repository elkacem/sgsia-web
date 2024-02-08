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

                @include('pages.charts')

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
