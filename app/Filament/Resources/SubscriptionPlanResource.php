<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionPlanResource\Pages;
use App\Filament\Resources\SubscriptionPlanResource\RelationManagers;
use App\Models\SubscriptionPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class SubscriptionPlanResource extends Resource
{
    protected static ?string $model = SubscriptionPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?string $navigationGroup = 'Subscription Management';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Subscription Plan Data')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\TextInput::make('active_period_in_months')
                            ->required()
                            ->numeric(),
                        Forms\Components\Repeater::make('featuresDetail')
                            ->relationship('featureDetail')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Feature'),
                            ])

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')->fromTable()->withFilename(date('Y-m-d') . ' - export'),
                    ExcelExport::make('form')->fromForm()->withFilename(date('Y-m-d') . ' - export'),
                ])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->prefix('Rp')
                    ->sortable(),
                Tables\Columns\TextColumn::make('active_period_in_months')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make('table')->fromTable()->withFilename(date('Y-m-d') . ' - export'),
                        ExcelExport::make('form')->fromForm()->withFilename(date('Y-m-d') . ' - export'),
                    ])
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Movie Identity')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('price'),
                        TextEntry::make('active_period_in_months'),
                        TextEntry::make('featureDetail.name')->listWithLineBreaks()
                            ->bulleted(),
                    ])->columns(2),
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
            'index' => Pages\ListSubscriptionPlans::route('/'),
            'create' => Pages\CreateSubscriptionPlan::route('/create'),
            'edit' => Pages\EditSubscriptionPlan::route('/{record}/edit'),
        ];
    }
}
