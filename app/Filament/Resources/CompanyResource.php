<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Region;
use App\Models\Company;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CompanyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CompanyResource\RelationManagers;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('region')
                // ->relationship('Region', 'name')
                ->options(Region::all()->pluck('name', 'name'))
                ->disablePlaceholderSelection(),
                Forms\Components\TextInput::make('address'),
                Forms\Components\Select::make('user_id')
                    ->multiple()
                    ->relationship('User', 'name')
                    ->options(User::all()->pluck('name', 'id'))
                    ->disablePlaceholderSelection(),   
                // Forms\Components\Select::make('User.name')->label('User')
                // ->options(User::all()->pluck('name', 'id'))
                // ->disablePlaceholderSelection(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('region'),
                TextColumn::make('address'),
                TextColumn::make('User.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return Company::withoutGlobalScope('UserScope')->where('id', '>', 0);
        // if($user->role_id == 3){
        //     return Company::where('reg_by_yana', 1);
        // }else{
        //     return Company::where('reg_by_yana', '>=', 0);
        // }
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\UserRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }    
}
