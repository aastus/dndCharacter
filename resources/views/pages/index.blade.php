@extends('layouts.main')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

            <div class="main-banner">

                <video playsinline autoplay muted loop class="background-video">
                    <source src="{{asset("videos/video.mp4")}}" type="video/mp4">
                    Ваш браузер не підтримує відео тег.
                </video>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-text">
                            <h6>Dungeons & Dragons</h6>
                            <h4><em>Створи свого героя</em> <br> Поринь у світ пригод!</h4>
                            <div class="main-button">
                                <a href="browse.html">Створити</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="live-stream">
                <div class="col-lg-12">
                    <div class="heading-section">
                        <h4>{{ __('Races') }}</h4>
                    </div>
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
                    <div class="col-lg-12">
                        <div class="main-button">
                            <a href="{{route('races')}}">{{ __('Load More') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="live-stream">
                <div class="col-lg-12">
                    <div class="heading-section">
                        <h4>{{ __('Classes') }}</h4>
                    </div>
                </div>
                <div class="row">
                    @foreach($classes as $race)
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
                    <div class="col-lg-12">
                        <div class="main-button">
                            <a href="{{route('classes')}}">{{ __('Load More') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
