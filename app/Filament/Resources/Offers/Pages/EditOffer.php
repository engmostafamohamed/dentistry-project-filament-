<?php

namespace App\Filament\Resources\Offers\Pages;

use App\Filament\Resources\Offers\OfferResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
class EditOffer extends EditRecord
{
    protected static string $resource = OfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

        protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['title']) && is_string($data['title'])) {
            $data['title'] = json_decode($data['title'], true);
        }

        if (isset($data['description']) && is_string($data['description'])) {
            $data['description'] = json_decode($data['description'], true);
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Get the uploaded file directly from the form state
        // This works even when the FileUpload field is hidden
        $uploadedImage = $this->form->getState()['image'] ?? null;

        if ($uploadedImage && is_object($uploadedImage)) {
            // New file uploaded — delete old and store new
            if ($this->record->image && Storage::disk('public')->exists($this->record->image)) {
                Storage::disk('public')->delete($this->record->image);
            }
            $data['image'] = $uploadedImage->store('services', 'public');

        } elseif (is_string($uploadedImage) && filled($uploadedImage)) {
            // Already a stored path string (existing image) — keep it
            $data['image'] = $uploadedImage;

        } else {
            // Nothing uploaded and no existing — preserve whatever is in DB
            $data['image'] = $this->record->image;
        }

        return $data;
    }

    // ── Remove current image from storage + database ─────────────────────────
    public function removeImage(): void
    {
        $record = $this->record;

        if ($record->image) {
            if (Storage::disk('public')->exists($record->image)) {
                Storage::disk('public')->delete($record->image);
            }
            $record->image = null;
            $record->save();
        }

        $this->refreshFormData(['image']);

        Notification::make()
            ->title('Image removed successfully.')
            ->success()
            ->send();
    }
}
