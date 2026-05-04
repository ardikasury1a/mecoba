<?php
namespace App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource;
use Filament\Resources\Pages\ViewRecord;
class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Auto mark as read when viewed
        $this->record->update(['is_read' => true]);
        $data['is_read'] = true;
        return $data;
    }
}
