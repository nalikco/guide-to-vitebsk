<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $label = 'Пользователь';
    protected static ?string $pluralLabel = 'Пользователи';
    protected static ?string $navigationGroup = 'Пользователи';

    protected static ?string $navigationIcon = 'heroicon-o-star';

    #[\Override]
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('user.fields.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label(__('user.fields.email'))
                    ->required()
                    ->unique()
                    ->email()
                    ->maxLength(255),
                TextInput::make('password')
                    ->label(__('user.fields.password'))
                    ->password()
                    ->required()
                    ->confirmed()
                    ->minLength(8)
                    ->maxLength(255),
                TextInput::make('password_confirmation')
                    ->label(__('user.fields.password_confirmation'))
                    ->password()
                    ->required(),
            ]);
    }

    #[\Override]
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label(__('telegram_user.fields.id')),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->label(__('user.fields.email')),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label(__('user.fields.name')),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label(__('user.fields.created_at')),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    #[\Override]
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    #[\Override]
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
