@extends('layouts.main')

@section('content')
    <style>
        .table {
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-profile">
                                <div class="row">
                                    <div class="heading-section">
                                        <h4>{{ $class->name }} {{$class->is_magic ? '*:･ﾟ✧' : ''}}</h4>
                                    </div>


                                    <div class="col-lg-4">
                                        <img src="{{ $class->getFirstMediaUrl('images') ?: asset('assets/images/stream-05.jpg') }}" alt="" style="border-radius: 23px;">
                                    </div>
                                    <div class="col-lg-8 align-self-center">
                                        <div class="featured-games header-text" style="padding:0px;">

                                            <p>{{ $class->description }}</p>
                                            <h6>HP per level: {{ $class->hp_per_level }}</h6>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-8">
                            @if(count($class->abilities))
                                <div class="featured-games header-text">
                                    <div class="heading-section">
                                        <h4><em>Abilities</em></h4>
                                    </div>
                                    <ul>
                                        @foreach($class->abilities as $ability)
                                            <h6>{{ $ability->name }} ({{ $ability->level }} lvl.)</h6>
                                            <p class="py-2 mb-4">{{ $ability->description }}</p>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(count($class->spells))
                                <div class="featured-games header-text mt-4">
                                    <div class="heading-section">
                                        <h4><em>Spells</em></h4>
                                    </div>
                                    <ul>
                                        @foreach($class->spells as $ability)
                                            <h6>{{ $ability->name }} ({{ $ability->level ? $ability->level . 'lvl.' : 'замовлення'}})</h6>
                                            <p class="py-2 mb-4">{{ $ability->description }}</p>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            @if($class->available_proficiency>0)
                            <div class="featured-games">
                                <div class="heading-section">
                                    <h4>Proficiencies</h4>
                                </div>
                                <p style="color:#fff;">
                                    @foreach($class->proficiencies as $ability)
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


