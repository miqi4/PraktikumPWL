<?php
namespace App\Filament\Resources\Posts\Schemas;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;
class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Group::make([
                Section::make('Post Details')
                    ->description('Isi detail post')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Group::make([
                            TextInput::make('title')
                        ->required()
                        ->rules('min:5')
                        ->validationMessages([
                            'required' => 'Title wajib diisi!',
                            'min' => 'Title minimal 5 karakter!',]),
                    TextInput::make('slug')
                        ->required()
                        ->rules('min:3')
                        ->unique()
                        ->validationMessages([
                            'required' => 'Slug wajib diisi!',
                            'min' => 'Slug minimal 3 karakter!',
                            'unique' => 'Slug harus unik, tidak boleh sama!', ]),
                    Select::make('category_id')
                        ->required()
                          ->options( \App\Models\Category::all()                         
                          ->pluck('nama', 'id') )                          
                          ->preload()                         
                          ->searchable()                         
                          ->required()
                        ->validationMessages(['required' => 'Category wajib dipilih!',]),
                    FileUpload::make('image')
                        ->required()
                        ->validationMessages(['required' => 'Image wajib diupload!',]),
                        ])->columns(2),
                        MarkdownEditor::make('content')
                            ->columnSpanFull(),]),
            ])->columnSpan(2),
            Group::make([
                Section::make('Image Upload')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('image')
                            ->disk('public')
                            ->directory('posts')
                            ->required()
                        ->validationMessages([
                            'required' => 'Image wajib diupload!',
                        ]),
                        ]),
                Section::make('Meta')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TagsInput::make('tags'),
                        Checkbox::make('published'),
                        DatePicker::make('published_at'),
                    ]),

            ])->columnSpan(1),

        ])
        ->columns(3);
}

}
