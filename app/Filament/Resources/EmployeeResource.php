<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    // protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Manage Employees';
    protected static ?string $navigationGroup = 'Employees';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                Select::make('user_id')
                ->relationship(
                    name: 'user',
                    titleAttribute: 'email',
                    modifyQueryUsing:function(Builder $query) {                    
                        return $query->whereHas('roles', function($query) {
                            $query->where('name', 'employee');
                        })->whereDoesntHave('employee');
                    }
                )
                ->searchable()
                ->preload(),
                TextInput::make('phone')
                ->tel(),
                Select::make('employee_type_id')
                ->relationship(
                    name: 'employee_type',
                    titleAttribute: 'name'
                )
                ->preload()
                ->searchable(),
                DatePicker::make('join_date')
                ->native(false),
                TextInput::make('salary')
                ->numeric()
                ->prefix('$'),
                TextInput::make('father_name'),
                Select::make('gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other'
                ])
                ->required(),
                DatePicker::make('date_of_birth')
                ->native(false),
                TextInput::make('education')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->sortable(),
                TextColumn::make('user.email')
                ->label('Email')
                ->searchable()
                ->sortable(),
                TextColumn::make('father_name')
                ->searchable()
                ->sortable(),
                TextColumn::make('phone')
                ->searchable()
                ->sortable(),
                TextColumn::make('employee_type.name')
                ->label('Type')
                ->searchable()
                ->sortable(),
                TextColumn::make('join_date')
                ->label('Join Date')
                ->searchable()
                ->sortable(),
                TextColumn::make('salary')
                ->label('Salary (MMK)')
                ->searchable()
                ->sortable(),
                TextColumn::make('gender')
                ->searchable()
                ->sortable(),
                TextColumn::make('date_of_birth')
                ->searchable()
                ->sortable(),
                TextColumn::make('education')
                ->searchable(),
                

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
