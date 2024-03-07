<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeesResource\Pages;
use App\Filament\Resources\FeesResource\RelationManagers;
use App\Models\Fees;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeesResource extends Resource
{
    protected static ?string $model = Fees::class;

    // protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Fees';
    protected static ?string $navigationGroup = 'Class';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('class_id')
                ->relationship(
                name: "class",
                titleAttribute: 'name'
                ),
                Select::make('student_id')
                ->relationship(
                    name: 'student',
                    titleAttribute: 'email',
                    modifyQueryUsing: function(Builder $query) {
                        $query
                        ->whereHas('roles', function ($query) {
                            $query->where('name', 'student');
                        })
                        ->whereDoesntHave('student');}
                )
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
            'index' => Pages\ListFees::route('/'),
            'create' => Pages\CreateFees::route('/create'),
            'edit' => Pages\EditFees::route('/{record}/edit'),
        ];
    }
}
