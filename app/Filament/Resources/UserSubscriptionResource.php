<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserSubscriptionResource\Pages;
use App\Filament\Resources\UserSubscriptionResource\RelationManagers;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class UserSubscriptionResource extends Resource
{
    protected static ?string $model = UserSubscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    // ->relationship(name: 'user', titleAttribute: 'name')
                    ->searchable()
                    ->options(
                        fn (Get $get): Collection => User::query()
                            ->with('roles')
                            ->whereRelation('roles', 'name', 'user')
                            ->pluck('name', 'id')
                    )
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('subscription_plan_id')
                    ->relationship('subscriptionPlan', 'name')
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $subsPlan = SubscriptionPlan::find($state);
                        $set('price', $subsPlan->price);
                        $set('expired_date', Carbon::now()->addMonth($subsPlan->active_period_in_months));
                    })

                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\DateTimePicker::make('expired_date')->native(false),
                Forms\Components\Select::make('payment_status')
                    ->required()
                    ->options([
                        'paid' => 'Paid',
                        'pending' => 'Pending',
                    ])
                    ->default('paid'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportBulkAction::make()->exports([
                    ExcelExport::make('table')->fromTable()->withFilename(date('Y-m-d') . ' - export'),
                    ExcelExport::make('form')->fromForm()->withFilename(date('Y-m-d') . ' - export'),
                ])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subscriptionPlan.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->prefix('Rp')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expired_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'danger',
                    })
                    ->searchable(),
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
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('payment_status')
                    ->options([
                        'paid' => 'Paid',
                        'pending' => 'Pending',
                    ])
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Movie Identity')
                    ->schema([
                        TextEntry::make('user.name'),
                        TextEntry::make('subscriptionPlan.name'),
                        TextEntry::make('price'),
                        TextEntry::make('expired_date'),
                        TextEntry::make('payment_status')->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'paid' => 'success',
                                'pending' => 'danger',
                            }),
                    ])->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserSubscriptions::route('/'),
            'create' => Pages\CreateUserSubscription::route('/create'),
            // 'view' => Pages\ViewUserSubscription::route('/{record}'),
            'edit' => Pages\EditUserSubscription::route('/{record}/edit'),
        ];
    }
}
