<?php

namespace App\Filament\Resources\OpenTrades\Pages;

use App\Filament\Resources\OpenTrades\OpenTradeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOpenTrade extends EditRecord
{
    protected static string $resource = OpenTradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
