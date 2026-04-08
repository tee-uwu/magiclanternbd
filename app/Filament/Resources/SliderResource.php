<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\TextInput::make('title'),

        Forms\Components\FileUpload::make('image')
            ->image()
            ->disk('public')
            ->directory('sliders')
            ->required(),

        Forms\Components\TextInput::make('link'),

        Forms\Components\Toggle::make('is_active')
            ->default(true),

        Forms\Components\TextInput::make('sort_order')
            ->numeric()
            ->default(0),
    ]);
}

    public static function table(Table $table): Table
{
    return $table->columns([
        Tables\Columns\ImageColumn::make('image'),
        Tables\Columns\TextColumn::make('title'),
        Tables\Columns\TextColumn::make('sort_order'),
        Tables\Columns\IconColumn::make('is_active')->boolean(),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }    
}
