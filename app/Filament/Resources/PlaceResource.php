<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaceResource\Pages;
use App\Models\Place;
use App\Models\Upload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;
    protected static ?string $label = 'Место';
    protected static ?string $pluralLabel = 'Места';
    protected static ?string $navigationGroup = 'Места';

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    #[\Override]
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bot_id')
                    ->relationship(name: 'bot', titleAttribute: 'name')
                    ->label(__('place.fields.bot'))
                    ->native(false)
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('category_id')
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->label(__('place.fields.category'))
                    ->native(false)
                    ->searchable()
                    ->required()
                    ->preload()
                    ->createOptionForm([
                        Select::make('parent_id')
                            ->relationship(name: 'parent', titleAttribute: 'name')
                            ->label(__('place.category.fields.parent'))
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label(__('place.category.fields.name'))
                                    ->required()
                                    ->string()
                                    ->maxLength(255),
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->label(__('place.category.fields.name'))
                                    ->required()
                                    ->string()
                                    ->maxLength(255),
                            ]),
                        TextInput::make('name')
                            ->label(__('place.category.fields.name'))
                            ->required()
                            ->string()
                            ->maxLength(255),
                    ])
                    ->editOptionForm([
                        Select::make('parent_id')
                            ->relationship(name: 'parent', titleAttribute: 'name')
                            ->label(__('place.category.fields.parent'))
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label(__('place.category.fields.name'))
                                    ->required()
                                    ->string()
                                    ->maxLength(255),
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->label(__('place.category.fields.name'))
                                    ->required()
                                    ->string()
                                    ->maxLength(255),
                            ]),
                        TextInput::make('name')
                            ->label(__('place.category.fields.name'))
                            ->required()
                            ->string()
                            ->maxLength(255),
                    ]),
                TextInput::make('name')
                    ->label(__('place.category.fields.name'))
                    ->required()
                    ->string()
                    ->maxLength(255),
                TextInput::make('address')
                    ->label(__('place.fields.address'))
                    ->required()
                    ->string()
                    ->maxLength(255),
                RichEditor::make('description')
                    ->label(__('place.fields.description'))
                    ->required()
                    ->string()
                    ->maxLength(2500),
                FileUpload::make('images')
                    ->label(__('place.fields.images'))
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->disk('public')
                    ->directory('places')
                    ->required()
                    ->minFiles(1)
                    ->maxFiles(5),
                TextInput::make('phone_number')
                    ->label(__('place.fields.phone_number'))
                    ->string()
                    ->mask('+375 (99) 999-99-99')
                    ->maxLength(255),
                TextInput::make('opening_hours')
                    ->label(__('place.fields.opening_hours'))
                    ->string()
                    ->maxLength(255),
                TextInput::make('instagram')
                    ->label(__('place.fields.instagram'))
                    ->string()
                    ->prefix('https://instagram.com/')
                    ->maxLength(255),
                TextInput::make('yandex_maps')
                    ->label(__('place.fields.yandex_maps'))
                    ->string()
                    ->prefix('https://yandex.by/maps/')
                    ->maxLength(255),
                Checkbox::make('active')
                    ->label(__('place.fields.active'))
                    ->required()
                    ->default(true),
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
                Tables\Columns\ImageColumn::make('images')
                    ->square()
                    ->getStateUsing(fn(Place $record) => $record->images->map(fn(Upload $image) => asset(sprintf('storage/%s/%s.%s', $record->getImagesPath(), $image->name, $image->extension)))->reverse())
                    ->label(__('place.fields.images')),
                Tables\Columns\CheckboxColumn::make('active')
                    ->sortable()
                    ->label(__('place.fields.active')),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label(__('place.category.fields.name')),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label(__('place.category.fields.created_at')),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label(__('place.fields.active'))
                    ->native(false),
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
            'index' => Pages\ListPlaces::route('/'),
            'create' => Pages\CreatePlace::route('/create'),
            'edit' => Pages\EditPlace::route('/{record}/edit'),
        ];
    }
}
