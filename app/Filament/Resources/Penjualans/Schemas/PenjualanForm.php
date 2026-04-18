<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use Filament\Schemas\Schema;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('user_id')
                    ->relationship('user', 'nama')
                    ->label('Kasir / User')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('pembeli')
                    ->label('Pembeli')
                    ->required()
                    ->maxLength(50),
                \Filament\Forms\Components\TextInput::make('penjualan_kode')
                    ->label('Kode Penjualan')
                    ->required()
                    ->maxLength(20),
                \Filament\Forms\Components\DateTimePicker::make('penjualan_tanggal')
                    ->label('Tanggal Penjualan')
                    ->required()
                    ->default(now()),
                \Filament\Forms\Components\Repeater::make('details')
                    ->relationship('details')
                    ->label('Detail Penjualan')
                    ->minItems(1)
                    ->schema([
                        \Filament\Forms\Components\Select::make('barang_id')
                            ->relationship('barang', 'barang_nama')
                            ->label('Barang')
                            ->required()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
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
                            ->label('Harga Satuan')
                            ->numeric()
                            ->required()
                            ->live(onBlur: true),
                        \Filament\Forms\Components\TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->live(onBlur: true),
                        \Filament\Forms\Components\Placeholder::make('subtotal')
                            ->label('Subtotal')
                            ->content(function ($get) {
                                $harga = floatval($get('harga') ?: 0);
                                $jumlah = intval($get('jumlah') ?: 0);
                                return 'Rp ' . number_format($harga * $jumlah, 0, ',', '.');
                            }),
                    ])
                    ->columns(4),
                \Filament\Forms\Components\Placeholder::make('total_harga')
                    ->label('Total Harga')
                    ->content(function ($get) {
                        $total = 0;
                        foreach ($get('details') ?? [] as $detail) {
                            $total += floatval($detail['harga'] ?? 0) * intval($detail['jumlah'] ?? 0);
                        }
                        return 'Rp ' . number_format($total, 0, ',', '.');
                    }),
            ]);
    }
}
