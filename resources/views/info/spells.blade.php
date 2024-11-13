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
                                        <h4>Spells</h4>
                                    </div>
                                    <table id="myTable" class="table table-product" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Name</th>
                                            <th>Classes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($spells as $spell)
                                            <tr>
                                                <td>{{ $spell->level }}</td>
                                                <td>{{ $spell->name }}</td>
                                                <td>
                                                    @if ($spell->classes && $spell->classes->count() > 0)
                                                        @foreach ($spell->classes as $class)
                                                            <span>{{ $class->name }}</span>@if(!$loop->last), @endif
                                                        @endforeach
                                                    @else
                                                        N/A
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

