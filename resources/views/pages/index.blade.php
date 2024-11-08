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
            <!-- ***** Featured Games Start ***** -->
{{--            <div class="row mt-5">--}}
{{--                <div class="col-lg-8">--}}
{{--                    <div class="featured-games header-text">--}}
{{--                        <div class="heading-section">--}}
{{--                            <h4><em>Common</em> Races</h4>--}}
{{--                        </div>--}}
{{--                        <div class="owl-features owl-carousel">--}}
{{--                            @foreach($races as $race)--}}
{{--                            <div class="item">--}}
{{--                                <div class="">--}}
{{--                                    <img class="w-100 h-100 img-cover" src="{{ $race->getFirstMediaUrl('images') ?: asset('assets/images/featured-01.jpg') }}" alt="">--}}
{{--                                    <div class="hover-effect">--}}
{{--                                        <h6>2.4K Streaming</h6>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <h4>CS-GO<br><span>249K Downloads</span></h4>--}}
{{--                                <ul>--}}
{{--                                    <li><i class="fa fa-star"></i> 4.8</li>--}}
{{--                                    <li><i class="fa fa-download"></i> 2.3M</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <div class="top-downloaded">--}}
{{--                        <div class="heading-section">--}}
{{--                            <h4><em>Top</em> Classes</h4>--}}
{{--                        </div>--}}
{{--                        <ul>--}}
{{--                            @foreach($classes as $class)--}}
{{--                            <li>--}}
{{--                                <img class="templatemo-item" src="{{ $race->getFirstMediaUrl('images') ?: asset('assets/images/game-01.jpg') }}" alt="">--}}
{{--                                <h4>{{$class->name}}</h4>--}}
{{--                                <h6>{{$class->hp_per_level}} HP</h6>--}}
{{--                                <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>--}}
{{--                                <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>--}}
{{--                                <div class="download">--}}
{{--                                    <a href="#"><i class="fa fa-download"></i></a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                        <div class="text-button">--}}
{{--                            <a href="profile.html">View All</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- ***** Featured Games End ***** -->
          <!-- ***** Most Popular Start ***** -->
{{--          <div class="most-popular">--}}
{{--            <div class="row">--}}
{{--              <div class="col-lg-12">--}}
{{--                <div class="heading-section">--}}
{{--                  <h4><em>Найбільш популярні</em> Раси</h4>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                  <div class="col-lg-3 col-sm-6">--}}
{{--                    <div class="item">--}}
{{--                      <img src="assets/images/popular-01.jpg" alt="">--}}
{{--                      <h4>Fortnite<br><span>Sandbox</span></h4>--}}
{{--                      <ul>--}}
{{--                        <li><i class="fa fa-star"></i> 4.8</li>--}}
{{--                        <li><i class="fa fa-download"></i> 2.3M</li>--}}
{{--                      </ul>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                  <div class="col-lg-12">--}}
{{--                    <div class="main-button">--}}
{{--                      <a href="browse.html">Discover Popular</a>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
          <!-- ***** Most Popular End ***** -->
            <div class="live-stream">
                <div class="col-lg-12">
                    <div class="heading-section">
                        <h4><em>Most Popular</em> Races</h4>
                    </div>
                </div>
                <div class="row">
                    @foreach($races as $race)
                    <div class="col-lg-3 col-sm-6">
                        <div class="item">
                            <div class="thumb">
                                <img src="{{ $race->getFirstMediaUrl('images') ?: asset('assets/images/stream-05.jpg') }}" alt="">
                                <div class="hover-effect">
                                    <div class="content">
                                        <div class="live">
                                            <a href="#">{{$race->name}}</a>
                                        </div>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                                            <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="down-content">
                                <h4>{{$race->name}}</h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="main-button">
                            <a href="streams.html">Load More Streams</a>
                        </div>
                    </div>
                </div>
            </div>
          <!-- ***** Gaming Library Start ***** -->
          <div class="gaming-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Your Gaming</em> Library</h4>
              </div>
              <div class="item">
                <ul>
                  <li><img src="assets/images/game-01.jpg" alt="" class="templatemo-item"></li>
                  <li><h4>Dota 2</h4><span>Sandbox</span></li>
                  <li><h4>Date Added</h4><span>24/08/2036</span></li>
                  <li><h4>Hours Played</h4><span>634 H 22 Mins</span></li>
                  <li><h4>Currently</h4><span>Downloaded</span></li>
                  <li><div class="main-border-button border-no-active"><a href="#">Donwloaded</a></div></li>
                </ul>
              </div>
              <div class="item">
                <ul>
                  <li><img src="assets/images/game-02.jpg" alt="" class="templatemo-item"></li>
                  <li><h4>Fortnite</h4><span>Sandbox</span></li>
                  <li><h4>Date Added</h4><span>22/06/2036</span></li>
                  <li><h4>Hours Played</h4><span>740 H 52 Mins</span></li>
                  <li><h4>Currently</h4><span>Downloaded</span></li>
                  <li><div class="main-border-button"><a href="#">Donwload</a></div></li>
                </ul>
              </div>
              <div class="item last-item">
                <ul>
                  <li><img src="assets/images/game-03.jpg" alt="" class="templatemo-item"></li>
                  <li><h4>CS-GO</h4><span>Sandbox</span></li>
                  <li><h4>Date Added</h4><span>21/04/2036</span></li>
                  <li><h4>Hours Played</h4><span>892 H 14 Mins</span></li>
                  <li><h4>Currently</h4><span>Downloaded</span></li>
                  <li><div class="main-border-button border-no-active"><a href="#">Donwloaded</a></div></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button">
                <a href="profile.html">View Your Library</a>
              </div>
            </div>
          </div>
          <!-- ***** Gaming Library End ***** -->
        </div>
      </div>
    </div>
  </div>
@endsection
