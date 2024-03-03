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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Expr\Cast\Double;

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
                ->options([
                    'january' => 'January',
                    'february' => 'February',
                    'march' => 'March',
                    'april' => 'April',
                    'may' => 'May',
                    'june' => 'June',
                    'july' => 'July',
                    'august' => 'August',
                    'september' => 'September',
                    'october' => 'October',
                    'november' => 'November',
                    'december' => 'December'
                ]),
                DatePicker::make('date_of_receive')
                ->label('receive_date')
                ->timezone('Asia/Yangon')
                ->default(now()),
                TextInput::make('bonus')
                ->numeric()
                ->prefix('MMK')
                ->label('Bonus'),
                TextInput::make('deduction')
                ->numeric()
                ->prefix('MMK')
                ->label('Deduction'),
                TextInput::make('paid')
                ->numeric()
                ->prefix('MMK')
                ->label('Paid')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')
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
                TextColumn::make('bonus')
                ->label('Bonus')
                ->suffix('.00')
                ->alignCenter(),
                TextColumn::make('deduction')
                ->suffix('.00')
                ->label('Deduction')
                ->alignCenter(),
                TextColumn::make('paid')
                ->label('Paid')
                ->alignCenter()
                ->suffix('.00')
            ])
            ->filters([
                //
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
