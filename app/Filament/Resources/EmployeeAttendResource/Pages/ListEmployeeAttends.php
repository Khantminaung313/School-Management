<?php

namespace App\Filament\Resources\EmployeeAttendResource\Pages;

use App\Filament\Resources\EmployeeAttendResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeAttends extends ListRecords
{
    protected static string $resource = EmployeeAttendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
