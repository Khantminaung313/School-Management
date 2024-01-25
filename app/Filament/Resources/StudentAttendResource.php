<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentAttendResource\Pages;
use App\Filament\Resources\StudentAttendResource\RelationManagers;
use App\Models\StudentAttend;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentAttendResource extends Resource
{
    protected static ?string $model = StudentAttend::class;

    // protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Student Attend';
    protected static ?string $navigationGroup = 'Class';

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
            'index' => Pages\ListStudentAttends::route('/'),
            'create' => Pages\CreateStudentAttend::route('/create'),
            'edit' => Pages\EditStudentAttend::route('/{record}/edit'),
        ];
    }
}
