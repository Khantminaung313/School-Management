<?php

namespace App\Filament\Resources\StudentAttendResource\Pages;

use App\Filament\Resources\StudentAttendResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentAttends extends ListRecords
{
    protected static string $resource = StudentAttendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
