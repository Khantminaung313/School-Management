<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyResource\Pages;
use App\Filament\Resources\FamilyResource\RelationManagers;
use App\Models\Family;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;

    // protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Family';
    protected static ?string $navigationGroup = 'Student';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('father_name')
                ->label('Father Name')
                ->nullable(),
                TextInput::make('mother_name')
                ->label('Mother Name')
                ->nullable(),
                TextInput::make('father_info')
                ->label('Father Information')->nullable(),
                TextInput::make('mother_info')
                ->label('Mother Information')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mother_name')
                ->label('Mother Name')
                ->searchable()
                ->sortable(),
                TextColumn::make('father_name')
                ->label('Father Name')
                ->searchable()
                ->sortable(),
                TextColumn::make('students.name')
                ->label('Student')
                ->listWithLineBreaks()
                ->searchable(),
                TextColumn::make('students.registration')
                ->label('Regist_No')
                ->listWithLineBreaks()
                ->searchable(),
                TextColumn::make('mother_info')
                ->label('Mother Information')->limit(10),
                TextColumn::make('father_info')
                ->label('Father Information')->limit(10),
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
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
