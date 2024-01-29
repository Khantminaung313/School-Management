<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    // protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Students';
    protected static ?string $navigationGroup = 'Student';

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['registration'] = rand(11111,99999);
     
    //     return $data;
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('registration')
                    ->default(rand(111111,999999))
                    ->unique(),
                Section::make("Student's Image")
                    ->schema([
                        TextInput::make('user_id')
                            ->required(),
                        FileUpload::make('picture')
                            ->label("Choose Student Image")
                            ->image()
                            ->imageEditor()
                            ->imageEditorMode(2)
                            ->circleCropper(),
                    ]),
                Section::make("Student's Information")
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('phone')
                            ->required(),
                        TextInput::make('previous_school')
                            ->required(),
                        DatePicker::make('admission_date')
                            ->required(),
                        Textarea::make('address')
                            ->required(),
                    ])->columns(3),
                Section::make('Gender and Date of Birth')
                    ->schema([
                        DatePicker::make('date_of_birth')
                            ->required(),
                        Radio::make('gender')
                            ->label("Choose Student's Gender")
                            ->options([
                                'Male' => "male",
                                'Female' => "female",
                                'Others' => "other",
                            ])
                            ->inline()
                            ->required()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('picture')
                    ->circular(),
                TextColumn::make('registration')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('gender'),
                TextColumn::make('address'),
            ])
            ->filters([
                
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
