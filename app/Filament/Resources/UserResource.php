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

    protected static ?string $label = 'Telegram пользователь';

    protected static ?string $pluralLabel = 'Telegram пользователи';

    protected static ?string $navigationGroup = 'Пользователи';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    #[\Override]
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('telegram_id')
                    ->label(__('telegram_user.fields.telegram_id'))
                    ->required()
                    ->numeric(),
                TextInput::make('first_name')
                    ->label(__('telegram_user.fields.first_name'))
                    ->string()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->label(__('telegram_user.fields.last_name'))
                    ->string()
                    ->maxLength(255),
                TextInput::make('username')
                    ->label(__('telegram_user.fields.username'))
                    ->string()
                    ->required()
                    ->maxLength(255),
                TextInput::make('language_code')
                    ->label(__('telegram_user.fields.language_code'))
                    ->string()
                    ->required()
                    ->minLength(2)
                    ->maxLength(2),
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
                Tables\Columns\TextColumn::make('telegram_id')
                    ->sortable()
                    ->label(__('telegram_user.fields.telegram_id')),
                Tables\Columns\TextColumn::make('first_name')
                    ->sortable()
                    ->label(__('telegram_user.fields.first_name')),
                Tables\Columns\TextColumn::make('last_name')
                    ->sortable()
                    ->label(__('telegram_user.fields.last_name')),
                Tables\Columns\TextColumn::make('username')
                    ->sortable()
                    ->label(__('telegram_user.fields.username')),
                Tables\Columns\TextColumn::make('language_code')
                    ->sortable()
                    ->label(__('telegram_user.fields.language_code')),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label(__('telegram_user.fields.created_at')),
            ])
            ->filters([
                //
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
