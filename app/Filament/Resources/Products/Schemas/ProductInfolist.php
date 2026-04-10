<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Tabs::make('Product Tabs')
                    // ->vertical() // hapus kalau mau horizontal

                    ->tabs([

                        // ======================
                        // TAB 1: PRODUCT INFO
                        // ======================
                        Tab::make('Product Info')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('sku')
                                    ->label('SKU')
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('description')
                                    ->label('Description'),
                                TextEntry::make('created_at')
                                    ->label('Created At')
                                    ->date('d M Y')
                                    ->color('info'),
                            ])
                            ->columnSpanFull(),

                        // ======================
                        // TAB 2: PRICING & STOCK
                        // ======================
                        Tab::make('Pricing & Stock')
                            ->icon('heroicon-o-currency-dollar')
                            // BADGE DINAMIS
                            ->badge(fn ($record) => $record->stock)
                            // WARNA BADGE
                            ->badgeColor(fn ($record) =>
                                $record->stock > 10 ? 'success' : 'danger'
                            )
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Price')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                                TextEntry::make('stock')
                                    ->label('Stock')
                                    ->icon('heroicon-o-cube'),
                            ]),

                        // ======================
                        // TAB 3: MEDIA & STATUS
                        // ======================
                        Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([

                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),

                                IconEntry::make('is_active')
                                    ->label('Active')
                                    ->boolean(),

                                IconEntry::make('is_featured')
                                    ->label('Featured')
                                    ->boolean(),
                            ]),
                    ])
             ->columnSpanFull(),
            ]);
    }
}