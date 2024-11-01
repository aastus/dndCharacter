<?php

namespace App\Filament\Resources\AlignmentResource\Pages;

use App\Filament\Resources\AlignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlignment extends EditRecord
{
    protected static string $resource = AlignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
