<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalaryResource\Pages;
use App\Filament\Resources\SalaryResource\RelationManagers;
use App\Models\Employee;
use App\Models\Salary;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Expr\Cast\Double;
use Filament\Tables\Actions\Action;
use App\Utilities\EmployeeSalary;
use App\Utilities\DayAndMonth;
use Illuminate\Support\Carbon;


class SalaryResource extends Resource
{
    protected static ?string $model = Salary::class;

    // protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Salary';
    protected static ?string $navigationGroup = 'Employees';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('employee_id')
                ->label('Employee Email')
                ->options(Employee::all()->pluck('user.email', 'id'))
                ->searchable()
                ->preload(),
                Select::make('month')
                ->label('Month')
                ->options(DayAndMonth::generateMonthsPerYear()),
                Select::make('year')
                ->options([
                    2021 => "2021",
                    2022 => "2022",
                    2023 => "2023",
                    2024 => "2024",
                ]),
                DatePicker::make('date_of_receive')
                ->label('receive_date')
                ->timezone('Asia/Yangon')
                ->default(now()),
                TextInput::make('bonus')
                ->numeric()
                ->prefix('MMK')
                ->label('Bonus'),
                TextInput::make('allowances')
                ->numeric()
                ->prefix('MMK')
                ->label('Allowances'),
                TextInput::make('deduction')
                ->numeric()
                ->prefix('MMK')
                ->label('Deduction'),
                TextInput::make('paid')
                ->numeric()
                ->prefix('MMK')
                ->label('Paid'),
                Select::make('is_received')
                ->options([
                    false => 'Pending',
                    true => 'Received',
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        $defaultMonth = DayAndMonth::valueArray()[Carbon::now()->subMonth()->month -1];
        $defaultYear = Carbon::now()->year;

        return $table
            ->columns([
                TextColumn::make('employee.name')
                ->searchable()
                ->sortable(),
                TextColumn::make('year')
                ->searchable()
                ->sortable(),
                TextColumn::make('month')
                ->label('Month')
                ->formatStateUsing(fn (string $state): string => ucwords($state))
                ->searchable()
                ->sortable(),
                TextColumn::make('date_of_receive')
                ->label('Received Date')
                ->date('d-m-Y'),
                TextColumn::make('basic_salary')
                ->label('Basic Salary')
                ->suffix('.00')
                ->alignRight(),
                TextColumn::make('bonus')
                ->label('Bonus')
                ->suffix('.00')
                ->alignRight(),
                TextColumn::make('allowances')
                ->label('Allowances')
                ->alignRight()
                ->suffix('.00'),
                TextColumn::make('deduction')
                ->suffix('.00')
                ->label('Deduction')
                ->alignRight(),
                TextColumn::make('paid')
                ->label('Paid')
                ->alignRight()
                ->suffix('.00'),
                SelectColumn::make('is_received')
                ->options([
                    false => 'Pending',
                    true => 'Received',
                ])
                ->afterStateUpdated(function ($record, $state) {
                    EmployeeSalary::updateReceivedDate($record, $state);
                })
                ->rules(['required'])
            ])
            ->filters([
                SelectFilter::make('month')
                    ->label('Month')
                    ->options(DayAndMonth::generateMonthsPerYear())
                    ->default($defaultMonth),

                SelectFilter::make('year')
                    ->label('Year')
                    ->options([
                        2021 => "2021",
                        2022 => "2022",
                        2023 => "2023",
                        2024 => "2024",
                        2025 => "2025",
                    ])
                    ->default($defaultYear),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalaries::route('/'),
            'create' => Pages\CreateSalary::route('/create'),
            'edit' => Pages\EditSalary::route('/{record}/edit'),
        ];
    }
}
