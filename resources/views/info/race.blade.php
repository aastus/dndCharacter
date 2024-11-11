@extends('layouts.main')

@section('content')
    <style>.table {
            color: #ffffff;
        }

        .table th,
        .table td {
            color: #ffffff;
            padding: 12px;
        }
        .table {
            border-collapse: collapse;
            width: 100%;
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        .table tbody tr:last-child th {
            border-bottom: none;
        }

    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">

                    <!-- ***** Race Basic Info Start ***** -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-profile">
                                <div class="row">
                                    <div class="heading-section">
                                        <h4>{{ $race->name }}</h4>
                                    </div>

                                    <div class="col-lg-4">
                                        <img src="{{ $race->getFirstMediaUrl('images') ?: asset('assets/images/stream-05.jpg') }}" alt="" style="border-radius: 23px;">
                                    </div>
                                    <div class="col-lg-8 align-self-center">
                                        <div class="featured-games header-text" style="padding:0px;">

                                            <p>{{ $race->description }}</p>
                                            <h6 class ="mt-2">Suggested Names</h6><p>{{$race->suggested_names}}</p>
                                            <table class="table">
                                                <tr>
                                                    <th>Move Speed</th>
                                                    <td>{{ $race->move_speed }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Languages</th>
                                                    <td>@foreach($race->languages as $language)
                                                            {{ $language->name }},
                                                        @endforeach</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-8">
                            <div class="featured-games header-text">
                                <div class="heading-section">
                                    <h4><em>Abilities</em></h4>
                                </div>
                                <ul>
                                    @foreach($race->abilities as $ability)
                                        <h6>{{ $ability->name }} ({{ $ability->level }} lvl.)</h6>
                                        <p class="py-2 mb-4">{{ $ability->description }}</p>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="featured-games">
                                <div class="heading-section">
                                    <h4>Characteristics</h4>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Characteristic</th>
                                        <th>Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($race->characteristics as $characteristic)
                                        <tr>
                                            <td>{{ $characteristic->name }}</td>
                                            <td>{{ $characteristic->pivot->value }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($race->available_proficiency>0)
                            <div class="featured-games mt-4">
                                <div class="heading-section">
                                    <h4>Proficiencies</h4>
                                </div>
                                <p style="color:#fff;">
                                    Available {{ $race->available_proficiency }}: <br>
                                    @foreach($race->proficiencies as $ability)
                                        {{ $ability->name }},
                                    @endforeach
                                </p>
                            </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


