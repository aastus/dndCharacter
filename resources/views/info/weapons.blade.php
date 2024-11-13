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
        .dataTables_filter input {
            padding: 10px;
            margin-left: 10px;
            font-size: 14px; /* Зменшений шрифт */
            color: #fff;
            background-color: #333;
            border: none; /* Відсутність рамки */
            border-radius: 3px; /* Злегка округлені кути */
            outline: none; /* Видалення синьої обводки */
        }
        .dataTables_filter label {
            color: #fff;
        }

        .dataTables_paginate .paginate_button {
            background-color: #e75e8d;
            color: white;
            border-radius: 5px;
            padding: 6px 12px;
            margin: 0 4px;
            font-weight: bold;
        }

        .dataTables_paginate .paginate_button:hover {
            background-color: #e75e8d;
            cursor: pointer;
            color: white;
        }

        .dataTables_paginate .paginate_button.current {
            background-color: #e75e8d;
            color: white;
        }

        .dataTables_paginate .previous, .dataTables_paginate .next {
            background-color: #FF66B2;
            border-radius: 5px;
            padding: 6px 12px;
            font-weight: bold;
        }

        .dataTables_paginate .previous:hover, .dataTables_paginate .next:hover {
            background-color: #e75e8d;
            color: white;
        }

        .dataTables_paginate .paginate_button:active {
            background-color: #e75e8d;
            color: white;
        }
        #weaponTable_length {
            visibility: hidden;
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
                                    <table id="weaponTable" class="table table-product" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Cost</th>
                                            <th>Damage</th>
                                            <th>Characteristic</th>
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


