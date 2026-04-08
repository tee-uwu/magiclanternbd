<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ReviewResource extends Resource
{
    protected static bool $shouldRegisterNavigation = true;
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Customer Name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('place')
                ->label('Location (City)')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('text')
                ->label('Review Text')
                ->required()
                ->rows(4)
                ->maxLength(500),

            Forms\Components\Select::make('rating')
                ->label('Star Rating')
                ->options([
                    1 => '⭐ 1 Star',
                    2 => '⭐⭐ 2 Stars',
                    3 => '⭐⭐⭐ 3 Stars',
                    4 => '⭐⭐⭐⭐ 4 Stars',
                    5 => '⭐⭐⭐⭐⭐ 5 Stars',
                ])
                ->default(5)
                ->required(),

            Forms\Components\Toggle::make('is_published')
                ->label('Display on Website')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('place')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('text')->limit(50),
            Tables\Columns\TextColumn::make('rating')
                ->label('Rating')
                ->formatStateUsing(fn ($state) => '⭐ ' . $state),
            Tables\Columns\BadgeColumn::make('is_published')
                ->label('Status')
                ->colors([
                    'true' => 'success',
                    'false' => 'danger',
                ]),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])
        ->filters([
            Tables\Filters\TernaryFilter::make('is_published')
                ->label('Published'),
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
