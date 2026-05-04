<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components as Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-circle';
    protected static string | \UnitEnum | null $navigationGroup = 'Portfolio Assets';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Section::make('Personal Information')
                ->schema([
                    Forms\Components\TextInput::make('name')->required()->maxLength(255),
                    Forms\Components\TextInput::make('tagline')->maxLength(255),
                    Forms\Components\FileUpload::make('avatar')
                        ->image()
                        ->directory('avatars')
                        ->imageEditor(),
                    Forms\Components\RichEditor::make('bio')->columnSpanFull(),
                ])->columns(2),

            Schemas\Section::make('English Version')
                ->schema([
                    Forms\Components\TextInput::make('name_en')->label('Name (EN)')->maxLength(255),
                    Forms\Components\TextInput::make('tagline_en')->label('Tagline (EN)')->maxLength(255),
                    Forms\Components\RichEditor::make('bio_en')->label('Bio (EN)')->columnSpanFull(),
                ])->columns(2)->collapsible(),

            Schemas\Section::make('Contact Information')
                ->schema([
                    Forms\Components\TextInput::make('email')->email()->maxLength(255),
                    Forms\Components\TextInput::make('phone')->tel()->maxLength(255),
                    Forms\Components\TextInput::make('address')->maxLength(255),
                ])->columns(3),

            Schemas\Section::make('Social Links')
                ->schema([
                    Forms\Components\TextInput::make('github_url')->url()->maxLength(255)->prefix('https://'),
                    Forms\Components\TextInput::make('linkedin_url')->url()->maxLength(255)->prefix('https://'),
                    Forms\Components\TextInput::make('instagram_url')->url()->maxLength(255)->prefix('https://'),
                    Forms\Components\TextInput::make('twitter_url')->url()->maxLength(255)->prefix('https://'),
                    Forms\Components\TextInput::make('website_url')->url()->maxLength(255)->prefix('https://'),
                    Forms\Components\TextInput::make('resume_url')->url()->maxLength(255)->prefix('https://'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('tagline')->limit(40),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->actions([
                Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
