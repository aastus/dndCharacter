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
                                        <h4>{{ __('Abilities') }}</h4>
                                    </div>
                                    <table id="myTable" class="table table-product" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Level') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Classes') }}</th>
                                            <th>{{ __('Races') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($abilities as $ability)
                                            <tr>
                                                <td>{{ $ability->level }}</td>
                                                <td><a href="/ability/{{$ability->id}}">{{ $ability->name }}</a></td>
                                                <td>
                                                    @if ($ability->classes && $ability->classes->count() > 0)
                                                        @foreach ($ability->classes as $class)
                                                            <a href="/class/{{$class->id}}"><span>{{ $class->name }}</span></a>@if(!$loop->last), @endif
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($ability->races && $ability->races->count() > 0)
                                                        @foreach ($ability->races as $race)
                                                            <a href="/race/{{$race->id}}"><span>{{ $race->name }}</span>@if(!$loop->last)</a>, @endif
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

