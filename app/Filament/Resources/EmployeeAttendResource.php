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
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Select::make('employee_id')
                ->options(Employee::all()->pluck('user.email', 'id'))
                ->searchable()
                ->label('Employee Email')   
                ->preload(),
                Radio::make('status_p_a')
                    ->label('Status(present or absent)')
                    ->boolean()
                    ->inline()
                    ->inlineLabel(false),
                DatePicker::make('date')
                ->timezone('Asia/Yangon')
                ->default(now())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No'),
                TextColumn::make('employee.name')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('status_p_a')
                    ->boolean()
                    ->label('Status'),
                TextColumn::make('date')
                    ->date('d-m-Y')
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
            'index' => Pages\ListEmployeeAttends::route('/'),
            'create' => Pages\CreateEmployeeAttend::route('/create'),
            'edit' => Pages\EditEmployeeAttend::route('/{record}/edit'),
        ];
    }
}
