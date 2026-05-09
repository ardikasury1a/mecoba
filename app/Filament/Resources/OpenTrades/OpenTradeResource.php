<?php

namespace App\Filament\Resources\OpenTrades;

use App\Filament\Resources\OpenTrades\Pages\CreateOpenTrade;
use App\Filament\Resources\OpenTrades\Pages\EditOpenTrade;
use App\Filament\Resources\OpenTrades\Pages\ListOpenTrades;
use App\Filament\Resources\OpenTrades\Schemas\OpenTradeForm;
use App\Filament\Resources\OpenTrades\Tables\OpenTradesTable;
use App\Models\OpenTrade;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OpenTradeResource extends Resource
{
    protected static ?string $model = OpenTrade::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bolt';

    protected static string|\UnitEnum|null $navigationGroup = 'Trading';

    protected static ?string $navigationLabel = 'Running Trade';

    protected static ?string $modelLabel = 'Running Trade';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return OpenTradeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OpenTradesTable::configure($table);
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
            'index' => ListOpenTrades::route('/'),
            'create' => CreateOpenTrade::route('/create'),
            'edit' => EditOpenTrade::route('/{record}/edit'),
        ];
    }
}
