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
                                        <h4>{{ __('Weapons') }}</h4>
                                    </div>
                                    <table id="myTable" class="table table-product" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Description') }}</th>
                                            <th>{{ __('Cost') }}</th>
                                            <th>{{ __('Damage') }}</th>
                                            <th>{{ __('Characteristic') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($weapons as $weapon)
                                            <tr>
                                                <td>{{ $weapon->name }}</td>
                                                <td>{{ $weapon->description }}</td>
                                                <td>{{ $weapon->cost }}</td>
                                                <td>{{ $weapon->damage }}</td>
                                                <td>{{ $weapon->characteristic ? $weapon->characteristic->name : 'N/A' }}</td>
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


