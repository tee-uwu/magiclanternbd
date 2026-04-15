<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ProductResource extends Resource
{
    protected static bool $shouldRegisterNavigation = true;
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Products Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->label('Product Description')
                ->rows(4),

            Forms\Components\FileUpload::make('image')
                ->label('Product Image')
                ->image()
                ->disk('public')
                ->directory('products')
                ->visibility('public'),

            Forms\Components\TextInput::make('price')
                ->label('Current Price (৳)')
                ->numeric()
                ->required()
                ->minValue(0),

            Forms\Components\TextInput::make('old_price')
                ->label('Original Price (৳)')
                ->numeric()
                ->minValue(0),

            Forms\Components\TextInput::make('discount')
                ->label('Discount (%)')
                ->numeric()
                ->minValue(0)
                ->maxValue(100),

            Forms\Components\Toggle::make('is_active')
                ->label('Show on Website')
                ->default(true),

            Forms\Components\TagsInput::make('colors')
                ->label('Available Colors')
                ->placeholder('Add colors (e.g., #f6d365, #fda085)')
                ->separator(','),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
    ->label('Image')
    ->disk('public') // 🔥 THIS IS THE FIX
    ->square()
    ->height(50)
    ->width(50),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->label('Price (৳)')->sortable(),
                Tables\Columns\TextColumn::make('old_price')->label('Old Price (৳)')->sortable(),
                Tables\Columns\TextColumn::make('discount')->label('Discount (%)')->sortable(),

                Tables\Columns\TextColumn::make('is_active')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'danger')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->label('Active Products')
                    ->query(fn ($query) => $query->where('is_active', true)),

                Tables\Filters\Filter::make('inactive')
                    ->label('Inactive Products')
                    ->query(fn ($query) => $query->where('is_active', false)),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
