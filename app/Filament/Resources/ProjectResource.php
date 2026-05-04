<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components as Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string | \UnitEnum | null $navigationGroup = 'Portfolio Assets';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Section::make('Project Details')->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                Forms\Components\Select::make('category')
                    ->options([
                        'Web App' => 'Web App',
                        'Mobile' => 'Mobile',
                        'API' => 'API',
                        'CMS' => 'CMS',
                        'Dashboard' => 'Dashboard',
                        'Analytics' => 'Analytics',
                        'Other' => 'Other',
                    ])->required(),
                Forms\Components\Toggle::make('is_featured')->label('Featured Project'),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('projects')
                    ->imageEditor()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('description')->columnSpanFull(),
                Forms\Components\TagsInput::make('tech_stack')->separator(','),
                Forms\Components\TextInput::make('live_url')->url()->maxLength(255)->prefix('https://'),
                Forms\Components\TextInput::make('github_url')->url()->maxLength(255)->prefix('https://'),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            ])->columns(2),

            Schemas\Section::make('English Version')->schema([
                Forms\Components\TextInput::make('title_en')->label('Title (EN)')->maxLength(255),
                Forms\Components\RichEditor::make('description_en')->label('Description (EN)')->columnSpanFull(),
            ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->square()->size(60),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured')->label('Featured'),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
