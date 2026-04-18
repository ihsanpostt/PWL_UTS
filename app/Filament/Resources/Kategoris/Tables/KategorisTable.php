<?php

namespace App\Filament\Resources\Kategoris\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class KategorisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori_kode')
                    ->searchable()
                    ->label('Kode Kategori'),
                    
                TextColumn::make('kategori_nama')
                    ->searchable()
                    ->label('Nama Kategori'),
            ]);
    }
}
