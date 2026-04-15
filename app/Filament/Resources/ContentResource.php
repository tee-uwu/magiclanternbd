<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentResource\Pages;
use App\Models\Content;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ContentResource extends Resource
{
    protected static bool $shouldRegisterNavigation = true;
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Site Settings';

    public static function form(Form $form): Form
{
    return $form->schema([

        Forms\Components\Select::make('key')
            ->options([
                'hero_title' => 'Hero Title',
                'hero_subtitle' => 'Hero Subtitle',
                'promo_text' => 'Promo Text',
                'news_ticker' => 'News Ticker (use | separate messages)',
                'best_seller_images' => 'Best Seller Images (comma-separated URLs)',
                'product_gallery' => 'Product Gallery Images (comma-separated URLs)',
                'extra_images' => 'Additional Landing Images (comma-separated URLs)',
                'phone' => 'Phone Number',
                'facebook_pixel' => 'Facebook Pixel ID',
                'google_analytics' => 'Google Analytics ID',
            ])
            ->required(),

        Forms\Components\Textarea::make('value')
            ->label('Value')
            ->required(),

    ]);
}

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('key')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('value')
                ->limit(50)
                ->wrap(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
