<?php

namespace App\Filament\Resources\EmployeeAttendResource\Pages;

use App\Filament\Resources\EmployeeAttendResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeAttend extends EditRecord
{
    protected static string $resource = EmployeeAttendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
