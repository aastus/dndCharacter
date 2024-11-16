@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="live-stream" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="heading-section">
                                        <h4>{{ __('Races') }}</h4>
                                    </div>
                                    <div class="row">
                                        @foreach($races as $race)
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="item">
                                                    <div class="thumb">
                                                        <img src="{{ $race->getFirstMediaUrl('images') ?: asset('assets/images/stream-05.jpg') }}" alt="">
                                                    </div>
                                                    <div class="down-content">
                                                        <a href="{{ route('race.show', ['id' => $race->id]) }}">{{$race->name}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



