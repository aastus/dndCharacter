<?php

namespace App\Filament\Resources\ProficiencyResource\Pages;

use App\Filament\Resources\ProficiencyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProficiencies extends ListRecords
{
    protected static string $resource = ProficiencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
