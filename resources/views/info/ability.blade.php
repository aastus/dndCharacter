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
                                        <h4 class="m-0">{{ $ability->name }}</h4>
                                        <a class="btn mb-3 mt-2" style="background-color: rgba(236, 96, 144, 0.9); color: #FFFFFF; border-radius: 20px; padding: 2px 15px; text-decoration: none; display: inline-block;">
                                            {{ $ability->level ? __('Level') . ' ' . $ability->level : __('Order') }}
                                        </a>
                                    </div>

                                    <div class="align-self-center">
                                        <div class="featured-games header-text" style="padding:0px;">
                                            <p class="pb-3">{{ $ability->description }}</p>
                                            @if(count($ability->classes) > 0)
                                                <div class="proficiency-list">
                                                    <h5>{{__('Classes')}}:</h5>
                                                    @foreach($ability->classes as $class)
                                                        <a class="btn mr-1 mt-2" href="/class/{{$class->id}}" style="background-color: rgba(236, 96, 144, 0.9); color: #FFFFFF; border-radius: 20px; padding: 2px 15px; text-decoration: none; display: inline-block;">
                                                            {{ $class->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if(count($ability->races) > 0)
                                                <div class="proficiency-list">
                                                    <h5>{{__('Races')}}:</h5>
                                                    @foreach($ability->races as $race)
                                                        <a class="btn mr-1 mt-2" href="/race/{{$race->id}}" style="background-color: rgba(236, 96, 144, 0.9); color: #FFFFFF; border-radius: 20px; padding: 2px 15px; text-decoration: none; display: inline-block;">
                                                            {{ $race->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
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


