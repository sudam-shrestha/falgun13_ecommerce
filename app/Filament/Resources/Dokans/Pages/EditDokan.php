<?php

namespace App\Filament\Resources\Dokans\Pages;

use App\Filament\Resources\Dokans\DokanResource;
use App\Mail\DokanCredentail;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Override;

class EditDokan extends EditRecord
{
    protected static string $resource = DokanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    #[Override]
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $oldStatus = $this->record->status ?? null;
        $newStatus = $data['status'] ?? null;

        // Only trigger when status is changing from anything → approved
        if ($oldStatus !== 'approved' && $newStatus === 'approved') {
            $plainPassword = rand(10000, 99999);

            $data['password'] = Hash::make($plainPassword);

            // Send email with plain password
            Mail::to($data['email'])
                ->send(new DokanCredentail($data, $plainPassword));
        }

        return parent::mutateFormDataBeforeSave($data);
    }
}
