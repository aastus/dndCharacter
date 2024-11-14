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
                                        <h4>{{ __('Spells') }}</h4>
                                    </div>
                                    <table id="myTable" class="table table-product" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Level') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Classes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($spells as $spell)
                                            <tr>
                                                <td>{{ $spell->level }}</td>
                                                <td><a href="/spell/{{$spell->id}}">{{ $spell->name }}</a></td>
                                                <td>
                                                    @if ($spell->classes && $spell->classes->count() > 0)
                                                        @foreach ($spell->classes as $class)
                                                            <a href="/class/{{$class->id}}">
                                                                <span>{{ $class->name }}</span>
                                                            </a>
                                                            @if(!$loop->last), @endif
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

