<?php

namespace App\Filament\Resources;

use App\Filament\Actions\TelegraphBot\RegisterWebhookAction;
use App\Filament\Resources\TelegraphBotResource\Pages;
use App\Models\TelegraphBot;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Override;

class TelegraphBotResource extends Resource
{
    protected static ?string $model = TelegraphBot::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    #[Override]
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('telegraph.fields.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('token')
                    ->label(__('telegraph.fields.token'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('telegram_user.fields.id')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('telegraph.fields.name')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                RegisterWebhookAction::make(),
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
            'index' => Pages\ListTelegraphBots::route('/'),
            'create' => Pages\CreateTelegraphBot::route('/create'),
            'edit' => Pages\EditTelegraphBot::route('/{record}/edit'),
        ];
    }
}
