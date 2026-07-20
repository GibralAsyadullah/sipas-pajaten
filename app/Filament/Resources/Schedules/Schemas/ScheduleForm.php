<?php

namespace App\Filament\Resources\Schedules\Schemas;

use App\Support\ImageConverter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('minggu')
                    ->label('Pekan')
                    ->options(collect(config('sipas.pekan'))->map(
                        fn ($p) => $p['label'].' — '.$p['rentang']
                    ))
                    ->default(1)
                    ->required(),
                DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->helperText('Kosongkan untuk agenda rutin tanpa tanggal pasti, lalu isi "Periode".'),
                TextInput::make('jam')
                    ->label('Jam')
                    ->placeholder('09:00 atau 16:30 - 17:30')
                    ->maxLength(20),
                TextInput::make('periode')
                    ->label('Periode (cadangan)')
                    ->helperText('Hanya dipakai bila Tanggal kosong, mis. "Setiap Jumat".')
                    ->maxLength(60),
                TextInput::make('judul')
                    ->label('Kegiatan')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('tempat')
                    ->label('Tempat')
                    ->maxLength(120)
                    ->columnSpanFull(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi singkat')
                    ->columnSpanFull(),
                Textarea::make('hasil')
                    ->label('Hasil yang dicapai')
                    ->helperText('Diisi setelah kegiatan berlangsung — tampil sebagai kotak hijau di kartu agenda.')
                    ->columnSpanFull(),
                FileUpload::make('foto')
                    ->label('Foto dokumentasi')
                    ->helperText('Foto otomatis dikompres & dikonversi ke WebP saat disimpan. Format: JPG/PNG/WebP — foto iPhone (HEIC) harap disimpan ulang sebagai JPG dulu. Klik ✕ pada foto untuk menghapusnya.')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->disk('public')
                    ->directory('jadwal')
                    ->maxSize(8192)
                    ->saveUploadedFileUsing(fn (TemporaryUploadedFile $file) => ImageConverter::toWebp($file, 'jadwal'))
                    // Jangan tunggu metadata file — file rusak/0 byte membuat kartu macet "Memuat"
                    // sehingga tombol hapusnya tidak pernah muncul.
                    ->fetchFileInformation(false)
                    ->deletable()
                    // Saat dihapus dari form, filenya ikut dibersihkan dari disk.
                    ->deleteUploadedFileUsing(fn (string $file) => Storage::disk('public')->delete($file))
                    ->columnSpanFull(),
                FileUpload::make('foto_2')
                    ->label('Foto dokumentasi #2 (opsional)')
                    ->helperText('Foto kedua — tampil berdampingan dengan foto pertama di kartu agenda. Klik ✕ pada foto untuk menghapusnya.')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->disk('public')
                    ->directory('jadwal')
                    ->maxSize(8192)
                    ->saveUploadedFileUsing(fn (TemporaryUploadedFile $file) => ImageConverter::toWebp($file, 'jadwal'))
                    ->fetchFileInformation(false)
                    ->deletable()
                    ->deleteUploadedFileUsing(fn (string $file) => Storage::disk('public')->delete($file))
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['done' => 'Selesai', 'ongoing' => 'Berlangsung', 'upcoming' => 'Akan datang'])
                    ->default('upcoming')
                    ->required(),
                TextInput::make('ikon')
                    ->label('Ikon (emoji)')
                    ->required()
                    ->default('📌'),
                TextInput::make('urutan')
                    ->label('Urutan dalam pekan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
