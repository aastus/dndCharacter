<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Персонаж PDF</title>

</head>
<body>
<section>
    <div class="container py-3">
        <table class="table my-2 w-100">
            <tbody>
            <tr>
                <td>
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 120px;">
                            <h5 class="my-2">{{ $character->character_name }}</h5>
                            <p class="text-muted mb-1">{{ $character->class->name ?? '-' }}</p>
                            <p class="text-muted mb-1">{{ $character->background->name ?? '-' }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2">Персонаж</h5>
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th scope="row">Гравець</th>
                                    <td>{{ $character->name }}</td>
                                    <th scope="row">lvl</th>
                                    <td>{{ $character->level }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Клас</th>
                                    <td>{{ $character->class->name ?? '-' }}</td>
                                    <th scope="row">ХП</th>
                                    <td>{{ $character->hit_points ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Раса</th>
                                    <td>{{ $character->race->name ?? 'Unknown' }}</td>
                                    <th scope="row">КЗ</th>
                                    <td>{{ $character->armor_type ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Світогляд</th>
                                    <td>{{ $character->alignment->name ?? 'None' }}</td>
                                    <th scope="row">Швид.</th>
                                    <td>{{ $character->race->move_speed + $character->plus_speed ?? 0 }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table mx-4 my-2 w-75">
                                <tbody>
                                <tr>
                                    <th scope="row">Вік</th>
                                    <td class="text-end">{{ $character->age ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Зріст</th>
                                    <td class="text-end">{{ $character->height ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Вага</th>
                                    <td class="text-end">{{ $character->weight ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Очі</th>
                                    <td class="text-end">{{ $character->eye_color ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Шкіра</th>
                                    <td class="text-end">{{ $character->skin_color ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Волосся</th>
                                    <td class="text-end">{{ $character->hair_color ?? '-' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="card">
                        <div class="card-body">
                            <h5>Загальне</h5>
                            <p><strong>Риси:</strong> {{ $character->traits ?? 'None' }}</p>
                            <p><strong>Ідеали:</strong> {{ $character->ideals ?? 'None' }}</p>
                            <p><strong>Прихильності:</strong> {{ $character->bonds ?? 'None' }}</p>
                            <p><strong>Слабкості:</strong> {{ $character->flaws ?? 'None' }}</p>
                            <p><strong>Цілі:</strong> {{ $character->goals ?? 'No goals' }}</p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="card">
                        <div class="card-body" style="width:300px">
                            <h5>Характеристики</h5>
                            <table class="w-100">
                                <tbody>
                                @foreach ($character->characteristics as $characteristic)
                                    @php
                                        $char_modifier = floor(($characteristic->pivot->value - 10) / 2);
                                        $saving = ($character->class->savingthrows->firstWhere('id', $characteristic->id) != null ? 2 : 0) + $char_modifier;
                                        $value = ($characteristic->pivot->value > 12 ? '+' : '') . $char_modifier;
                                        $sav_val = $saving == 0 ? '' : ('(Рят ' . ($saving > 0 ? '+' : '') . $saving . ')');
                                    @endphp
                                    <tr>
                                        <td style="width:25%">{{ $characteristic->name }}</td>
                                        <td style="width:25%" class="text-center text-muted">{{ $sav_val }}</td>
                                        <td style="width:25%" class="text-center">{{ $value }}</td>
                                        <td style="width:25%" class="text-end">{{ $characteristic->pivot->value }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="pb-3">
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar
                                                            @if($characteristic->pivot->value < 10) bg-danger
                                                            @elseif($characteristic->pivot->value < 14) bg-success
                                                            @else bg-warning @endif"
                                                     style="width: {{ ($characteristic->pivot->value / 20) * 100 }}%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5>Зброя</h5>
                            <table class="w-100">
                                <tbody>
                                @foreach($character->weapons ?? [] as $weapon)
                                    @php
                                        $value = floor(($character->characteristics->firstWhere('id', $weapon->characteristic->id)->pivot->value - 10) / 2);
                                        $text_color = $value > 0 ? 'text-success' : ($value < 0 ? 'text-warning' : '');
                                        $value = mb_substr($weapon->characteristic->name,0,3, "utf-8") . ') ' . ($value > 0 ? '+' . $value : $value);
                                    @endphp
                                    <tr>
                                        <td style="width:33%" class="{{$text_color}} text-bold">{{ $weapon->name }}</td>
                                        <td style="width:33%" class="{{$text_color}} text-center">({{ $value }} </td>
                                        <td style="width:33%" class="{{$text_color}} text-end">1d{{ $weapon->damage }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="card">
                        <div class="card-body">
                            <h5>Володіння</h5>
                            <table class="w-100">
                                <tbody>
                                @foreach ($proficiences as $prof)
                                    @php
                                        $char_modifier = floor(($character->characteristics->firstWhere('id', $prof->characteristic->id)->pivot->value - 10) / 2);
                                        $have = $character->proficiencies->firstWhere('id', $prof->id) != null;
                                        $back = $character->background->proficiencies->firstWhere('id', $prof->id) != null;
                                        $spec = $have ? $character->proficiencies->firstWhere('id', $prof->id)->pivot->specialize : 0;
                                        $text_color = $back || $have ? ($spec ? 'text-info' : 'text-warning') : '';
                                        $value = $char_modifier + (($have || $back) + $spec) * 2;
                                        $text_color = $text_color != '' ? $text_color : ($value > 0 ? 'text-success' : ($value < 0 ? 'text-danger' : ''));
                                        $value = $value > 0 ? '+' . $value : $value;
                                    @endphp
                                    <tr>
                                        <td style="width:33%" class="{{$text_color}} text-bold">{{ $prof->name }}</td>
                                        <td style="width:33%" class="{{$text_color}} text-center">{{ $prof->characteristic->name }}</td>
                                        <td style="width:33%" class="{{$text_color}} text-end">{{ $value }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="card" style="width:300px">
                        <div class="card-body ps-3">
                            <h5>Передісторія</h5>
                            <p>{{$character->prehistory ?? '-'}}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="card">
                        <div class="card-body">
                            <h5>Мови</h5>
                            <p>
                                @foreach($character->race->languages ?? [] as $lang)
                                    {{$lang->name}},
                                @endforeach
                                @foreach($character->languages ?? [] as $lang)
                                    {{$lang->name}},
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body ps-3">
                            <h5>Інвентар</h5>
                            <p>{{$character->inventory ?? '(Нічого)'}}</p>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="card mt-4 mx-2">
            <div class="card-body ps-3">
                <h5>Нотатки</h5>
                <p>{{$character->notes ?? '-'}}</p>
            </div>
        </div>

        <div class="mx-2 pt-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Вміння</h5>
                    @foreach ($character->class->abilities->sortBy('level') ?? [] as $ability)
                        <div class="card my-3">
                            <div class="card-body">
                                <h6>{{ $ability->name }}</h6>
                                <p>{{ $ability->description }}</p>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($character->race->abilities->sortBy('level') ?? [] as $ability)
                        <div class="card my-3">
                            <div class="card-body">
                                <h6>{{ $ability->name }}</h6>
                                <p>{{ $ability->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($character->spells)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Заклинання</h5>
                        @foreach($character->spells->sortBy('level') as $spell)
                            <div class="card my-3">
                                <div class="card-body">
                                    <h6>{{ $spell->name }} ({{ $spell->level == 0 ? 'заговір' : $spell->level . ' lvl' }})</h6>
                                    <p>{{ $spell->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

</body>
</html>
