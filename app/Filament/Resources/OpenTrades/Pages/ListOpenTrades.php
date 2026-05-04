<?php

namespace App\Filament\Resources\OpenTrades\Pages;

use App\Filament\Resources\OpenTrades\OpenTradeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOpenTrades extends ListRecords
{
    protected static string $resource = OpenTradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
