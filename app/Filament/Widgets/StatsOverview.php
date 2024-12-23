<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Filament\Resources\UserResource;
use App\Models\Company;
use App\Traits\FilterByUser;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $id = auth()->id();
        $user = User::find($id);

        if($user->role_id == 3) {
            $users = User::where('reg_by_yana', 1)->get();
            $companies = Company::withoutGlobalScope('UserScope')->get();
        }else{
            $users = User::all();
            $companies = Company::withoutGlobalScope('UserScope')->get();
        }

        return [
            Card::make('Number Of Users', count($users))
            ->chart([7, 10, 21, 14, 17, 28, 6, 12])
            ->color('success'),
            // Card::make('Number Of Companies', count($companies)),
            Card::make('Month', date('F')),
        ];
    }
}
