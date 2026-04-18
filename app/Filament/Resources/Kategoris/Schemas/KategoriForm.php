<?php

namespace App\Filament\Resources\Kategoris\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput; // Ini wajib ditambahkan agar TextInput terbaca

class KategoriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kategori_kode')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(10)
                    ->label('Kode Kategori'),
                    
                TextInput::make('kategori_nama')
                    ->required()
                    ->maxLength(100)
                    ->label('Nama Kategori'),
            ]);
    }
}
