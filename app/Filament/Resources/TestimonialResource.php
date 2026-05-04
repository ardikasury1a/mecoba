<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components as Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string | \UnitEnum | null $navigationGroup = 'Portfolio Assets';
    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Section::make('Testimonial Details')->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('position')->maxLength(255),
                Forms\Components\TextInput::make('company')->maxLength(255),
                Forms\Components\FileUpload::make('avatar')->image()->directory('testimonials')->imageEditor(),
                Forms\Components\Textarea::make('content')->required()->rows(4)->columnSpanFull(),
                Forms\Components\Select::make('rating')
                    ->options([1 => '⭐', 2 => '⭐⭐', 3 => '⭐⭐⭐', 4 => '⭐⭐⭐⭐', 5 => '⭐⭐⭐⭐⭐'])
                    ->default(5),
                Forms\Components\Toggle::make('is_active')->default(true),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            ])->columns(2),

            Schemas\Section::make('English Version')->schema([
                Forms\Components\Textarea::make('content_en')->label('Content (EN)')->rows(4)->columnSpanFull(),
            ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('company'),
                Tables\Columns\TextColumn::make('rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state)),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
