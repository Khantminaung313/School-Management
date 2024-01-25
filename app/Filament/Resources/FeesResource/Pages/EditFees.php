<?php

namespace App\Filament\Resources\FeesResource\Pages;

use App\Filament\Resources\FeesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFees extends EditRecord
{
    protected static string $resource = FeesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
