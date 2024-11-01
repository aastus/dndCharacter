<?php

namespace App\Filament\Resources\ProficiencyResource\Pages;

use App\Filament\Resources\ProficiencyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProficiency extends EditRecord
{
    protected static string $resource = ProficiencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
