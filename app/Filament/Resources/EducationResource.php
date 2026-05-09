<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Models\Education;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components as Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-academic-cap';
    protected static string | \UnitEnum | null $navigationGroup = 'Portfolio Assets';
    protected static ?int $navigationSort = 5;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $pluralModelLabel = 'Education';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Section::make('Education Details')->schema([
                Forms\Components\TextInput::make('institution')->required()->maxLength(255),
                Forms\Components\TextInput::make('degree')->required()->maxLength(255),
                Forms\Components\TextInput::make('field_of_study')->maxLength(255),
                Forms\Components\TextInput::make('start_year')->numeric()->required()->minValue(1900)->maxValue(2100),
                Forms\Components\TextInput::make('end_year')->numeric()->minValue(1900)->maxValue(2100),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\RichEditor::make('description')->columnSpanFull(),
            ])->columns(2),

            Schemas\Section::make('English Version')->schema([
                Forms\Components\TextInput::make('degree_en')->label('Degree (EN)')->maxLength(255),
                Forms\Components\TextInput::make('field_of_study_en')->label('Field of Study (EN)')->maxLength(255),
                Forms\Components\RichEditor::make('description_en')->label('Description (EN)')->columnSpanFull(),
            ])->columns(2)->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('institution')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('degree')->searchable(),
                Tables\Columns\TextColumn::make('field_of_study'),
                Tables\Columns\TextColumn::make('start_year')->sortable(),
                Tables\Columns\TextColumn::make('end_year')->placeholder('Present'),
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
            'index' => Pages\ListEducation::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit' => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
