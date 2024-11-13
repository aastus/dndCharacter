@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-profile">
                                <div class="row">
                                    <div class="heading-section">
                                        <h4>Abilities</h4>
                                    </div>
                                    <table id="myTable" class="table table-product" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Name</th>
                                            <th>Classes</th>
                                            <th>Races</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($abilities as $ability)
                                            <tr>
                                                <td>{{ $ability->level }}</td>
                                                <td>{{ $ability->name }}</td>
                                                <td>
                                                    @if ($ability->classes && $ability->classes->count() > 0)
                                                        @foreach ($ability->classes as $class)
                                                            <span>{{ $class->name }}</span>@if(!$loop->last), @endif
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($ability->races && $ability->races->count() > 0)
                                                        @foreach ($ability->races as $race)
                                                            <span>{{ $race->name }}</span>@if(!$loop->last), @endif
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

