<?php

namespace App\Filament\Resources\BackgroundResource\Pages;

use App\Filament\Resources\BackgroundResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBackground extends EditRecord
{
    protected static string $resource = BackgroundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
