<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class OrderResource extends Resource
{
    protected static bool $shouldRegisterNavigation = true;
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Orders Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('phone')
                ->required()
                ->maxLength(20),

            Forms\Components\Textarea::make('address')
                ->required()
                ->maxLength(500),

            Forms\Components\TextInput::make('product')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('color')
                ->label('Color')
                ->maxLength(255),

            Forms\Components\TextInput::make('quantity')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('delivery_area')
                ->options([
                    'inside' => 'Inside Dhaka',
                    'outside' => 'Outside Dhaka',
                ])
                ->required(),

            Forms\Components\TextInput::make('delivery_charge')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('total_price')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'cancelled' => 'Cancelled',
                ])
                ->default('pending')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')

            ->columns([

            Tables\Columns\TextColumn::make('name')
                ->label('Customer')
                ->searchable()
                ->weight('medium')
                ->sortable(),

            Tables\Columns\TextColumn::make('phone')
                ->copyable()
                ->color('gray'),

            Tables\Columns\TextColumn::make('product')
                ->limit(20)
                ->color('gray'),

            Tables\Columns\BadgeColumn::make('quantity')
                ->label('Qty')
                ->alignCenter()
                ->color('primary'),

            Tables\Columns\TextColumn::make('total_price')
                ->label('Total')
                ->money('BDT')
                ->weight('bold')
                ->color('success'),

            Tables\Columns\BadgeColumn::make('status')
                ->color(fn ($state) => match ($state) {
                    'pending' => 'warning',
                    'confirmed' => 'success',
                    'cancelled' => 'danger',
                }),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Date')
                ->since()
                ->color('gray'),
        ])

        ->actions([
            Tables\Actions\EditAction::make()
                ->iconButton(),

            Tables\Actions\DeleteAction::make()
                ->iconButton(),
        ])

        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}