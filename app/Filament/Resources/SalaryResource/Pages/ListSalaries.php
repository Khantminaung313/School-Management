<?php

namespace App\Filament\Resources\SalaryResource\Pages;

use App\Filament\Resources\SalaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use App\Utilities\EmployeeSalary;
use Filament\Forms\Components\Select;
use App\Utilities\Attendent;
use App\Utilities\DayAndMonth;
use App\Models\Salary;
use Filament\Notifications\Notification;


class ListSalaries extends ListRecords
{
    protected static string $resource = SalaryResource::class;

    protected function getHeaderActions(): array
    {
        $salaries = new EmployeeSalary();

        return [
            Actions\CreateAction::make(),
            Action::make('generate salary')
            ->form([
                Select::make('month')
                    ->label('Month')
                    ->options(DayAndMonth::generateMonthsPerYear())
                    ->required(),
                Select::make('year')
                    ->label('Year')
                    ->options([
                        2021 => "2021",
                        2022 => "2022",
                        2023 => "2023",
                        2024 => "2024",
                        2025 => "2025",
                    ])
                    ->required(),
            ])
            ->requiresConfirmation()
            ->action(function (array $data) use($salaries){
                $existedCount = Salary::filterByMonthYear($data['month'], $data['year'])->get()->count();
                if($existedCount == 0){
                    
                    $salaries->generateSalary($data['month'], $data['year']);
                    Notification::make()
                    ->title('Generate successfully')
                    ->color("success")
                    ->icon("heroicon-s-hand-thumb-up")
                    ->send();
                }else{
                    Notification::make()
                    ->title('Salaries for that timeline is existed')
                    ->icon("heroicon-s-hand-thumb-down")
                    ->color("danger")
                    ->send();
                }
            })
        ];
    }
}
