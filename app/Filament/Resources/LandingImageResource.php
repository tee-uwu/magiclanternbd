<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingImageResource\Pages;
use App\Models\LandingImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class LandingImageResource extends Resource
{
protected static ?string $model = LandingImage::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-photograph';
    protected static ?string $navigationGroup = 'Landing Page Settings';
    protected static ?string $navigationLabel = 'Landing Images';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('section')
                ->options(LandingImage::sections())
                ->required(),

            Forms\Components\FileUpload::make('image')
                ->image()
                ->disk('public')
                ->directory('landing-images')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section')
                    ->formatStateUsing(fn ($state) => LandingImage::sections()[$state] ?? $state)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLandingImages::route('/'),
            'create' => Pages\CreateLandingImage::route('/create'),
            'edit' => Pages\EditLandingImage::route('/{record}/edit'),
        ];
    }
}
