<?php

namespace App\Filament\Resources\PenjualanDetails\Schemas;

use Filament\Schemas\Schema;

class PenjualanDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('penjualan_id')
                    ->relationship('penjualan', 'penjualan_kode')
                    ->label('Kode Penjualan')
                    ->required(),
                \Filament\Forms\Components\Select::make('barang_id')
                    ->relationship('barang', 'barang_nama')
                    ->label('Barang')
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $barang = \App\Models\Barang::find($state);
                            if ($barang) {
                                $set('harga', $barang->harga_jual);
                            }
                        }
                    }),
                \Filament\Forms\Components\TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->required(),
                \Filament\Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required()
                    ->minValue(1),
            ]);
    }
}
