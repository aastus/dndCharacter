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
            line-height: 1.8;
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

                    <!-- ***** Race Basic Info Start ***** -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-profile">
                                <div class="row">
                                    <div class="heading-section">
                                        <h4>Alignments</h4>
                                    </div>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($alignments as $alignment)
                                            <tr>
                                                <td>{{ $alignment->name }}</td>
                                                <td>{{ $alignment->description }}</td>
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


