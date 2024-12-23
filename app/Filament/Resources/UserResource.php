<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Role;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Doctrine\DBAL\Query\QueryBuilder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use App\Filament\Resources\UserResource\RelationManagers;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\FileUpload::make('profile_pic'),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('email_verified_at')->disabled(),
                Forms\Components\TextInput::make('phone')->tel(),
                Forms\Components\TextInput::make('password')->password()->required()->hiddenOn('edit'),
                // Forms\Components\Select::make('role_id')->options(Role::all()->pluck('name', 'id'))->disablePlaceholderSelection(),               
                Forms\Components\Select::make('has_paid')->options([
                    '1' => 'Paid',
                    '0' => 'Not Paid',
                ])->default(0)->disablePlaceholderSelection(),
                Forms\Components\Select::make('package_id')->label('Package')->options([
                    '1' => 'Basic',
                    '2' => 'Standard',
                    '3' => 'Pro', 
                    '4' => 'Premium',
                ])->disablePlaceholderSelection()->disabled(),
                // Forms\Components\Select::make('current_company_id')->label('Current Company')->relationship('company', 'name')->disablePlaceholderSelection(),
                Forms\Components\Select::make('reg_by_yana')->options([
                    '1' => 'Yes',
                    '0' => 'No',
                ])->disablePlaceholderSelection()->default('1'),
                Forms\Components\Select::make('Role')->options([
                    1 => 'Admin',
                    2 => 'Auditor',
                ])->disablePlaceholderSelection(),
                Forms\Components\Toggle::make('status')
                ->onColor('success'),
                // Forms\Components\FileUpload::make('company_pic'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ImageColumn::make('profile_pic')->label('Profile Pic')
                // ->defaultImageUrl(url('assets/images/user-icon.png')),
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('email_verified_at'),
                BadgeableColumn::make('name')
                ->badges([
                    Badge::make('status')->label('Active')
                    ->color('success')
                    ->visible(fn ($record): bool => $record->status ?? false),
                    Badge::make('has_paid')->label('Paid')
                    ->color('success')
                    ->visible(fn ($record): bool => $record->has_paid ?? false),
                ]),
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
                TextColumn::make('reg_by_yana')->label('Reg By Yana')->enum([
                    1 => 'Yes',
                    0 => 'No',
                ]),
                TextColumn::make('Role')->enum([
                    1 => 'Admin',
                    2 => 'Auditor',
                ]),
                TextColumn::make('package_due_date')->date(),
                TextColumn::make('last_login_time'),
                TextColumn::make('last_login_ip'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = User::find(auth()->id());
        if($user->role_id == 3){
            return User::where('reg_by_yana', 1);
        }else{
            return User::where('reg_by_yana', '>=', 0);
        }
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\CompanyRelationManager::class,
            // RelationManagers\PackageRelationManager::class,
        ];
    }
    
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
