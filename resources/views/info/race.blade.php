@extends('layouts.main')

@section('content')
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
                                            <h6 class ="mt-2">{{ __('Suggested names') }}</h6><p>{{$race->suggested_names}}</p>
                                            <table class="table">
                                                <tr>
                                                    <th>{{ __('Move speed') }}</th>
                                                    <td>{{ $race->move_speed }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Languages') }}</th>
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
                                    <h4><em>{{ __('Abilities') }}</em></h4>
                                </div>
                                <ul>
                                    @foreach($race->abilities as $ability)
                                        <a href="/ability/{{$ability->id}}"><h6>{{ $ability->name }} ({{ $ability->level }} lvl.)</h6></a>
                                        <p class="py-2 mb-4">{{ $ability->description }}</p>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="featured-games mb-4">
                                <div class="heading-section">
                                    <h4>{{ __('Characteristics') }}</h4>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Characteristic') }}</th>
                                        <th>{{ __('Value') }}</th>
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
                                <div class="featured-games">
                                    <div class="heading-section">
                                        <h4>{{ __('Proficiencies') }}</h4>
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


