<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use App\Models\Category;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // KIRI (FORM UTAMA)
                Group::make([
                    Section::make('Post Details')
                        ->description('Isi detail post')
                        ->icon('heroicon-o-document-text')
                        ->schema([

                            Group::make([
                                TextInput::make('title')
                                    ->required()
                                    ->minLength(5)
                                    ->validationMessages([
                                        'required' => 'Title wajib diisi!',
                                        'min' => 'Title minimal 5 karakter!',
                                    ]),

                                TextInput::make('slug')
                                    ->required()
                                    ->minLength(3)
                                    ->unique(ignoreRecord: true)
                                    ->validationMessages([
                                        'required' => 'Slug wajib diisi!',
                                        'min' => 'Slug minimal 3 karakter!',
                                        'unique' => 'Slug harus unik!',
                                    ]),

                                Select::make('category_id')
                                    ->relationship('category', 'nama')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                            ])->columns(2),

                            MarkdownEditor::make('body')
                                ->columnSpanFull(),

                        ]),
                ])->columnSpan(2),

                // KANAN (META & IMAGE)
                Group::make([

                    Section::make('Image Upload')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('posts')
                                ->image()
                                ->required()
                                ->validationMessages([
                                    'required' => 'Image wajib diupload!',
                                ]),
                        ]),

                    Section::make('Meta')
                        ->icon('heroicon-o-information-circle')
                        ->schema([

                            // ✅ INI YANG PENTING (Many-to-Many)
                            Select::make('tags')
                                ->relationship('tags', 'name')
                                ->multiple()
                                ->preload()
                                ->searchable(),

                            Checkbox::make('published'),

                            DatePicker::make('published_at'),

                        ]),

                ])->columnSpan(1),

            ])
            ->columns(3);
    }
}