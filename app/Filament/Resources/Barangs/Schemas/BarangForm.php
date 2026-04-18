<?php

namespace App\Filament\Resources\Barangs\Schemas;

use App\Models\Kategori;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori_id')
                    ->label('Kategori')
                    ->options(Kategori::all()->pluck('kategori_nama', 'kategori_id'))
                    ->searchable()
                    ->required(),
                TextInput::make('barang_kode')
                    ->label('Kode Barang')
                    ->required()
                    ->maxLength(10),
                TextInput::make('barang_nama')
                    ->label('Nama Barang')
                    ->required()
                    ->maxLength(100),
                TextInput::make('harga_beli')
                    ->label('Harga Beli')
                    ->numeric()
                    ->required(),
                TextInput::make('harga_jual')
                    ->label('Harga Jual')
                    ->numeric()
                    ->required(),
            ]);
    }
}
