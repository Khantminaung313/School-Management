<?php

namespace App\Filament\Resources\FeesResource\Pages;

use App\Filament\Resources\FeesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFees extends ListRecords
{
    protected static string $resource = FeesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
