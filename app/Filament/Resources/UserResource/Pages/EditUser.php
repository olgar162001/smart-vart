<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Pages\Actions;
use Filament\Facades\Filament;
use Filament\Pages\Actions\Action;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

//     public function edit(User $user)
// {
//     return Filament::editResource('User')
//         ->layout('edit')
//         ->context('user', $user);
// }
    
    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('send receipt')
            ->label('Send Receipt')
            ->url('/receipt/'.$this->record->id.'/mail'),
            Action::make('verify-email')
            ->label('Verify Email')->color('success')
            ->url('/verify_user_email/'.$this->record->id),
        ];
    }
}
