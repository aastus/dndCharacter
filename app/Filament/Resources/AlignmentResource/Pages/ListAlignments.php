<?php

namespace App\Filament\Resources\AlignmentResource\Pages;

use App\Filament\Resources\AlignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlignments extends ListRecords
{
    protected static string $resource = AlignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
