<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components as Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static string | \UnitEnum | null $navigationGroup = 'Portfolio Assets';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Section::make()->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('icon')->maxLength(255)->helperText('Icon identifier (e.g., laravel, php, javascript)'),
                Forms\Components\Select::make('category')
                    ->options([
                        'Frontend' => 'Frontend',
                        'Backend' => 'Backend',
                        'DevOps' => 'DevOps',
                        'Design' => 'Design',
                        'Mobile' => 'Mobile',
                        'Other' => 'Other',
                    ])->required(),
                Forms\Components\TextInput::make('level')
                    ->numeric()->minValue(0)->maxValue(100)->default(0)
                    ->suffix('%'),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Frontend' => 'info',
                        'Backend' => 'success',
                        'DevOps' => 'warning',
                        'Design' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('level')->suffix('%')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
