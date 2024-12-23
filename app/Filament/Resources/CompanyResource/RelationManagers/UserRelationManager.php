<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Company;
use Filament\Resources\Form;
use Illuminate\Http\Request;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class UserRelationManager extends RelationManager
{
    protected static string $relationship = 'User';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {

        $url = url()->previous();

        // Testing
        // if(substr($url, 36, 1) == '/'){
        //     $company_id = substr($url, 35, 1);
        // }else if(substr($url, 37, 1) == '/'){
        //     $company_id = substr($url, 35, 2);
        // }else if(substr($url, 38, 1) == '/'){
        //     $company_id = substr($url, 35, 3);
        // }else{
        //     $company_id = substr($url, 35, 4);
        // }

        // Production
        if(substr($url, 37, 1) == '/'){
            $company_id = substr($url, 36, 1);
        }else if(substr($url, 38, 1) == '/'){
            $company_id = substr($url, 36, 2);
        }else if(substr($url, 39, 1) == '/'){
            $company_id = substr($url, 36, 3);
        }else{
            $company_id = substr($url, 36, 4);
        }

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\DateTimePicker::make('email_verified_at')->default(now())->hiddenOn(['edit', 'create']),
                Forms\Components\TextInput::make('phone')->tel(),
                Forms\Components\TextInput::make('password')->password()->required()->hiddenOn('edit'),
                // Forms\Components\Select::make('role_id')->options(Role::all()->pluck('name', 'id'))->disablePlaceholderSelection(),
                Forms\Components\Select::make('has_paid')->options([
                        '1' => 'Paid',
                        '0' => 'Not Paid',
                    ])->disablePlaceholderSelection()->hiddenOn('create'),
                Forms\Components\Select::make('package_id')->label('Package')->options([
                        '1' => 'Basic',
                        '2' => 'Standard',
                        '3' => 'Pro', 
                        '4' => 'Premium',
                    ])->disablePlaceholderSelection()->hiddenOn('create'),
                    Forms\Components\Select::make('Role')->options([
                        '1' => 'Admin',
                        '2' => 'Auditor',
                    ])->disablePlaceholderSelection()->default('2'),
                    Forms\Components\Select::make('reg_by_yana')->options([
                        '1' => 'Yes',
                        '0' => 'No'
                    ])->disablePlaceholderSelection()->default('1'),
                    Forms\Components\Toggle::make('status')
                    ->onColor('success'),
                    Forms\Components\TextInput::make('current_company_id')->default($company_id)->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('status')->enum([
                    1 => 'Active',
                    0 => 'Inactive',
                ]),
                TextColumn::make('has_paid')->enum([
                    1 => 'Yes',
                    0 => 'No',
                ]),
                TextColumn::make('package_id')->label('Package')->enum([
                    1 => 'Basic',
                    2 => 'Standard',
                    3 => 'Pro',
                    4 => 'Premium',
                ]),
                TextColumn::make('Role')->enum([
                    "1" => 'Admin',
                    "2" => 'Auditor',
                ]),
                TextColumn::make('package_due_date')->date(),
                TextColumn::make('last_login_time'),
                TextColumn::make('last_login_ip'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
