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
                                        <h4>{{ __('Backgrounds') }}</h4>
                                    </div>
                                    <div class="accordion" id="alignmentAccordion">
                                        @foreach($backgrounds as $index => $background)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $index }}">
                                                    <div class="accordion-header-link" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                                        {{ $background->name }}
                                                    </div>
                                                </h2>
                                                <div id="collapse{{ $index }}" class="accordion-collapse collapse @if($index === 0) show @endif" aria-labelledby="heading{{ $index }}" data-bs-parent="#alignmentAccordion">
                                                    <div class="accordion-body">
                                                        <p>{{ $background->description }}</p>
                                                        <div class="proficiency-list">
                                                            <h5>Proficiencies:</h5>
                                                                @foreach($background->proficiencies as $proficiency)
                                                                <a class="btn mr-1 mt-2" style="background-color: rgba(236, 96, 144, 0.9); color: #FFFFFF; border-radius: 20px; padding: 2px 15px; text-decoration: none; display: inline-block;">
                                                                    {{ $proficiency->name }}
                                                                </a>
                                                            @endforeach
                                                        </div>
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
