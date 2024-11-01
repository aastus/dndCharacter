<?php

namespace App\Filament\Resources\BackgroundResource\Pages;

use App\Filament\Resources\BackgroundResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBackgrounds extends ListRecords
{
    protected static string $resource = BackgroundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
