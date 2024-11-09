<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Персонаж PDF</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                             class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{ $character->name }}</h5>
                        <p class="text-muted mb-1">{{ $character->class->name ?? 'N/A' }}</p>
                        <p class="text-muted mb-4">{{ $character->background->name ?? 'Unknown' }}</p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <strong>Age</strong>
                                <p class="mb-0">{{ $character->age ?? 'N/A' }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <strong>Height</strong>
                                <p class="mb-0">{{ $character->height ?? 'N/A' }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <strong>Weight</strong>
                                <p class="mb-0">{{ $character->weight ?? 'N/A' }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <strong>Eye Color</strong>
                                <p class="mb-0">{{ $character->eye_color ?? 'N/A' }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <strong>Skin Color</strong>
                                <p class="mb-0">{{ $character->skin_color ?? 'N/A' }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <strong>Hair Color</strong>
                                <p class="mb-0">{{ $character->hair_color ?? 'N/A' }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Character Information</h5>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $character->character_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Class</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $character->class->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Race</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $character->race->name ?? 'Unknown' }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Alignment</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $character->alignment->name ?? 'None' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Character Traits</h5>
                        <p><strong>Traits:</strong> {{ $character->traits ?? 'None' }}</p>
                        <p><strong>Ideals:</strong> {{ $character->ideals ?? 'None' }}</p>
                        <p><strong>Bonds:</strong> {{ $character->bonds ?? 'None' }}</p>
                        <p><strong>Flaws:</strong> {{ $character->flaws ?? 'None' }}</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Character Stats</h5>
                        @foreach ($character->characteristics as $characteristic)
                            <p class="mb-1" style="font-size: .77rem;">
                                {{ $characteristic->name }}:
                                <span class="text-muted">{{ $characteristic->pivot->value }}</span>
                            </p>
                            <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar
                    @if($characteristic->pivot->value < 10) bg-danger
                    @elseif($characteristic->pivot->value == 10) bg-warning
                    @else bg-success @endif"
                                     role="progressbar"
                                     style="width: {{ ($characteristic->pivot->value / 20) * 100 }}%"
                                     aria-valuenow="{{ $characteristic->pivot->value }}"
                                     aria-valuemin="0"
                                     aria-valuemax="20">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Abilities</h5>
                        @foreach ($character->abilities as $ability)
                            <p>{{ $ability->name }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Spells</h5>
                        @foreach ($character->spells as $spell)
                            <p>{{ $spell->name }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Proficiencies</h5>
                        @foreach ($character->proficiencies as $proficiency)
                            <p>{{ $proficiency->name }} {{ $proficiency->pivot->specialize ? ' (Specialized)' : '' }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Inventory</h5>
                        <p>{{ $character->inventory ?? 'Empty' }}</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Goals</h5>
                        <p>{{ $character->goals ?? 'No goals' }}</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Notes</h5>
                        <p>{{ $character->notes ?? 'No notes' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
