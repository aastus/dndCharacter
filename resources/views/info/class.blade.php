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
                                        <h4>{{ $class->name }} {{$class->is_magic ? '*:･ﾟ✧' : ''}}</h4>
                                    </div>

                                    <div class="col-lg-2">
                                        <img src="{{ $class->getFirstMediaUrl('images') ?: asset('assets/images/stream-05.jpg') }}" alt="" style="width:120px; border-radius: 23px;">
                                    </div>
                                    <div class="col-lg-10 align-self-center">
                                        <div class="featured-games header-text" style="padding:0px;">
                                            <p>{{ $class->description }}</p>
                                            <h6>{{__('HP')}}: {{ $class->hp_per_level }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-9">
                            @if(count($class->abilities))
                                <div class="featured-games header-text mb-4">
                                    <div class="heading-section">
                                        <h4><em>{{ __('Abilities') }}</em></h4>
                                    </div>
                                    <ul>
                                        @foreach($class->abilities as $ability)
                                            <a href="/ability/{{$ability->id}}"><h6>{{ $ability->name }} ({{ $ability->level }} lvl.)</h6></a>
                                            <p class="py-2 mb-4">{{ $ability->description }}</p>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(count($class->spells))
                                <div class="featured-games header-text">
                                    <div class="heading-section">
                                        <h4><em>{{ __('Spells') }}</em></h4>
                                    </div>
                                    <ul>
                                        @foreach($class->spells as $ability)
                                            <a href="/spell/{{$ability->id}}"><h6>{{ $ability->name }} ({{ $ability->level ? $ability->level . 'lvl.' : 'замовлення'}})</h6></a>
                                            <p class="py-2 mb-4">{{ $ability->description }}</p>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-3">
                            @if($class->available_proficiency>0)
                            <div class="featured-games">
                                <div class="heading-section">
                                    <h4>{{ __('Proficiencies') }}</h4>
                                </div>
                                <p style="color:#fff;">
                                    @foreach($class->proficiencies as $ability)
                                        {{ $ability->name }}<br>
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


