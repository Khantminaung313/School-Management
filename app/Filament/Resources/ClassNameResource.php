<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassNameResource\Pages;
use App\Filament\Resources\ClassNameResource\RelationManagers;
use App\Models\ClassName;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Employee;
use App\Models\Subject;
use App\Filament\Resources\ClassNameResource\RelationManagers\SubjectsRelationManager;

class ClassNameResource extends Resource
{
    protected static ?string $model = ClassName::class;

    // protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationLabel = 'Class Detail';
    protected static ?string $navigationGroup = 'Class';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make("class")
                    ->tabs([
                        Tabs\Tab::make('Class info')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Class Name')
                                    ->required(),
                                Select::make('employee_id')
                                    ->label("Choose Teacher for This class")
                                    ->options(
                                        Employee::where("employee_type_id",2)
                                        ->get()
                                        ->pluck('name', 'id')
                                    )
                                    ->required()
                            ]),
                            Tabs\Tab::make('Class Fee')
                            ->schema([
                                TextInput::make('fees')
                                    ->label('Class Fee')
                                    ->required(),
                            ]),
                    ])
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name"),
                TextColumn::make('classTeacher.name')
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
            SubjectsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassNames::route('/'),
            'create' => Pages\CreateClassName::route('/create'),
            'edit' => Pages\EditClassName::route('/{record}/edit'),
        ];
    }
}
