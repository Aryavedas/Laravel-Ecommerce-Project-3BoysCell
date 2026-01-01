<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required() // Sebaiknya tambah required
                    ->columnSpan(4),
                
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->columnSpan(4)
                    ->numeric()
                    ->inputMode('decimal'),
                
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->columnSpan(4),
                
                Forms\Components\TextInput::make('stok')
                    ->required()
                    ->columnSpan(4)
                    ->numeric(),

                // --- PERUBAHAN PENTING DI SINI ---
                Forms\Components\FileUpload::make('gambar')
                    ->required()
                    ->disk('supabase')           // 1. Wajib: Gunakan disk supabase
                    ->directory('products')      // 2. Opsional: Masukkan ke folder 'products' di bucket
                    ->visibility('public')       // 3. Wajib: Agar gambar bisa dilihat pengunjung
                    ->image()                    // 4. Validasi: Pastikan yg diupload gambar
                    ->columnSpan(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable(),
                TextColumn::make('harga')->money('IDR'), // Format Rupiah otomatis
                TextColumn::make('deskripsi')->limit(50),
                TextColumn::make('stok'),
                
                // --- TABLE JUGA HARUS TAHU DISKNYA ---
                ImageColumn::make('gambar')
                    ->disk('supabase') // Wajib: Beritahu table ambil gambar di supabase
                    ->size(100),       // Ukuran preview di table
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}