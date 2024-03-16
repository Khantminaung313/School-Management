<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeAttendResource\Pages;
use App\Filament\Resources\EmployeeAttendResource\RelationManagers;
use App\Models\Employee;
use App\Models\EmployeeAttend;
use Attribute;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Carbon;
use App\Utilities\Attendent;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use App\Utilities\DayAndMonth;

class EmployeeAttendResource extends Resource
{
    protected static ?string $model = EmployeeAttend::class;

    // protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Employees Attend';
    protected static ?string $navigationGroup = 'Employees';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([                
                Section::make("attendent")
                ->schema([
                    Select::make('status')
                    ->options([
                        'present' => "Present",
                        'absent' => 'Absent',
                    ])
                    ->required(),

                    DatePicker::make('date')
                    ->timezone('Asia/Yangon')
                    ->default(now())
                    ->native(false)
                    ->required(),

                    Select::make('employee_id')
                    ->relationship(name: 'employee', titleAttribute: 'name')
                    ->searchable(["name", "email"])
                    ->preload()
                    ->required(),
                ])
            ]);
    }

    public function isTableSearchable(): bool
    {
        return true;
    }

    public static function table(Table $table): Table
    {
        $AttDate = new Attendent();
        // dd($AttDate->generateDatesToToday());

        return $table
            ->columns([
                TextColumn::make('employee.name')
                ->searchable(),
                TextColumn::make('date'),
                SelectColumn::make('status')
                ->options([
                    'present' => 'Present',
                    'absent' => 'Absent',
                ])
                ->rules(['required'])
            ])
            ->filters([
                SelectFilter::make('date')
                ->options($AttDate->generateDatesToToday())
                ->default(Carbon::now()->toDateString()),

                Filter::make('created_at')
                ->form([
                    Select::make('month')
                    ->options(DayAndMonth::generateMonthsPerYear()),
                    Select::make('year')
                    ->options([
                        2021 => "2021",
                        2022 => "2022",
                        2023 => "2023",
                        2024 => "2024",
                    ]),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['month'],
                            fn (Builder $query, $month): Builder => $query->whereMonth('date', $month),
                        )
                        ->when(
                            $data['year'],
                            fn (Builder $query, $year): Builder => $query->whereYear('date', $year),
                        );
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                BulkAction::make('hey man')
                ->requiresConfirmation()
                ->action(fn (Collection $records) => dd($records)),
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
            'index' => Pages\ListEmployeeAttends::route('/'),
            'create' => Pages\CreateEmployeeAttend::route('/create'),
            'edit' => Pages\EditEmployeeAttend::route('/{record}/edit'),
        ];
    }
}
