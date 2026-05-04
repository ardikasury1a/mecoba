<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components as Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';
    protected static string | \UnitEnum | null $navigationGroup = 'Portfolio Assets';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Section::make('Experience Details')->schema([
                Forms\Components\TextInput::make('company')->required()->maxLength(255),
                Forms\Components\TextInput::make('position')->required()->maxLength(255),
                Forms\Components\RichEditor::make('description')->columnSpanFull(),
                Forms\Components\DatePicker::make('start_date')->required(),
                Forms\Components\DatePicker::make('end_date'),
                Forms\Components\Toggle::make('is_current')->label('Currently working here')
                    ->reactive()
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $state ? $set('end_date', null) : null),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            ])->columns(2),

            Schemas\Section::make('English Version')->schema([
                Forms\Components\TextInput::make('position_en')->label('Position (EN)')->maxLength(255),
                Forms\Components\RichEditor::make('description_en')->label('Description (EN)')->columnSpanFull(),
            ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('position')->searchable(),
                Tables\Columns\TextColumn::make('start_date')->date('M Y')->sortable(),
                Tables\Columns\TextColumn::make('end_date')->date('M Y')->placeholder('Present'),
                Tables\Columns\IconColumn::make('is_current')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
