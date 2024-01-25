<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeAttendResource\Pages;
use App\Filament\Resources\EmployeeAttendResource\RelationManagers;
use App\Models\EmployeeAttend;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
