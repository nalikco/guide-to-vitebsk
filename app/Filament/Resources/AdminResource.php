<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Override;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $label = 'Администратор';

    protected static ?string $pluralLabel = 'Администраторы';

    protected static ?string $navigationGroup = 'Пользователи';

    protected static ?string $navigationIcon = 'heroicon-o-star';

    #[Override]
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
                DatePicker::make('email_verified_at')
                    ->label(__('user.fields.email_verified_at'))
                    ->nullable(),
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

    #[Override]
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
                Tables\Columns\CheckboxColumn::make('email_verified_at')
                    ->sortable()
                    ->disabled()
                    ->label(__('user.fields.email_verified_at')),
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

    #[Override]
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    #[Override]
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
