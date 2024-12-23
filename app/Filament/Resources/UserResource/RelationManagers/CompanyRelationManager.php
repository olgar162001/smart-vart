<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Region;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CompanyRelationManager extends RelationManager
{
    protected static string $relationship = 'companies';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        $url = url()->previous();

        // Testing Enviroment
        // if(substr($url, 32, 1) == '/') {
        //     $user_id = substr($url, 31, 1);
        // }else if(substr($url, 33, 1) == '/'){
        //     $user_id = substr($url, 31, 2); // Testing
        // }else if(substr($url, 34, 1) == '/'){
        //     $user_id = substr($url, 31, 3);
        // }else{
        //     $user_id = substr($url, 31, 4);
        // }

        // Production
        if(substr($url, 33, 1) == '/') {
            $user_id = substr($url, 32, 1);
        }else if(substr($url, 34, 1) == '/'){
            $user_id = substr($url, 32, 2); // Testing
            // $user_id = substr($url, 32, 1); Production
        }else if(substr($url, 35, 1) == '/'){
            $user_id = substr($url, 32, 3);
        }else{
            $user_id = substr($url, 32, 4);
        }
        
        
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address'),
                Forms\Components\Select::make('region')
                    ->options(Region::all()->pluck('name', 'name'))
                    ->default('Dar es salaam')
                    ->disablePlaceholderSelection(),
                    Forms\Components\TextInput::make('user_id')->label('User')
                    ->default($user_id)->disabled(),        
                    // Forms\Components\Select::make('User.name')->label('User')
                    // ->options(User::all()->pluck('name', 'id'))
                    // ->disablePlaceholderSelection(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('region'),
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
