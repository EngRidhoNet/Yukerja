<?php

namespace App\Filament\Resources;

use App\Models\JobPost;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\{TextInput, Textarea, DateTimePicker, Repeater, Select, Card, Grid, Section, Hidden, FileUpload};
use Humaidem\FilamentMapPicker\Fields\OSMMap;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\JobPostResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class JobPostResource extends Resource
{
    protected static ?string $model = JobPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Job Posts';
    protected static ?string $pluralModelLabel = 'Job Posts';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->description('Informasi utama lowongan pekerjaan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('customer_id')
                                    ->relationship('customer', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->label('Pelanggan'),

                                Select::make('service_category_id')
                                    ->relationship('serviceCategory', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->label('Kategori Layanan'),
                            ]),

                        TextInput::make('title')
                            ->label('Judul Pekerjaan')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4),

                        TextInput::make('category')
                            ->label('Kategori Tambahan')
                            ->maxLength(255),
                    ]),

                Section::make('Lokasi Pekerjaan')
                    ->description('Detail lokasi pekerjaan akan dilakukan')
                    ->schema([
                        Textarea::make('address')
                            ->label('Alamat')
                            ->required()
                            ->rows(2)
                            ->placeholder('Masukkan alamat lengkap'),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->numeric()
                                    ->step('any')
                                    ->formatStateUsing(fn ($state): string => $state ? number_format((float) $state, 8) : ''),

                                TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->numeric()
                                    ->step('any')
                                    ->formatStateUsing(fn ($state): string => $state ? number_format((float) $state, 8) : ''),

                                Forms\Components\Actions::make([
                                    FormAction::make('getCurrentLocation')
                                        ->label('Lokasi Saat Ini')
                                        ->icon('heroicon-o-map-pin')
                                        ->color('primary')
                                        ->action(function (callable $set) {
                                            // This will be handled by JavaScript
                                        })
                                        ->extraAttributes([
                                            'onclick' => "
                                                if (navigator.geolocation) {
                                                    navigator.geolocation.getCurrentPosition(function(position) {
                                                        const lat = position.coords.latitude;
                                                        const lng = position.coords.longitude;
                                                        
                                                        // Update the latitude and longitude inputs
                                                        const latInput = document.querySelector('input[wire\\:model*=\"latitude\"]');
                                                        const lngInput = document.querySelector('input[wire\\:model*=\"longitude\"]');
                                                        
                                                        if (latInput) {
                                                            latInput.value = lat.toFixed(8);
                                                            latInput.dispatchEvent(new Event('input', { bubbles: true }));
                                                            latInput.dispatchEvent(new Event('change', { bubbles: true }));
                                                        }
                                                        
                                                        if (lngInput) {
                                                            lngInput.value = lng.toFixed(8);
                                                            lngInput.dispatchEvent(new Event('input', { bubbles: true }));
                                                            lngInput.dispatchEvent(new Event('change', { bubbles: true }));
                                                        }
                                                        
                                                        // Update the OSM map using Livewire
                                                        setTimeout(() => {
                                                            // Trigger Livewire component update for the location field
                                                            const locationField = document.querySelector('[wire\\:model*=\"location\"]');
                                                            if (locationField && window.Livewire) {
                                                                // Update the location data through Livewire
                                                                const component = locationField.closest('[wire\\:id]');
                                                                if (component) {
                                                                    const wireId = component.getAttribute('wire:id');
                                                                    window.Livewire.find(wireId).set('data.location', {
                                                                        lat: lat,
                                                                        lng: lng
                                                                    });
                                                                }
                                                            }
                                                            
                                                            // Also try to find and update the map directly
                                                            const mapContainer = document.querySelector('.leaflet-container');
                                                            if (mapContainer && mapContainer._map) {
                                                                const map = mapContainer._map;
                                                                map.setView([lat, lng], 15);
                                                                
                                                                // Update marker if exists
                                                                if (map._marker) {
                                                                    map._marker.setLatLng([lat, lng]);
                                                                } else {
                                                                    // Create new marker if doesn't exist
                                                                    map._marker = L.marker([lat, lng]).addTo(map);
                                                                }
                                                            }
                                                        }, 500);
                                                        
                                                        // Show success notification
                                                        if (window.FilamentNotification) {
                                                            new FilamentNotification()
                                                                .title('Lokasi berhasil diambil')
                                                                .success()
                                                                .send();
                                                        } else {
                                                            alert('Lokasi berhasil diambil');
                                                        }
                                                    }, function(error) {
                                                        let errorMsg = 'Gagal mengambil lokasi';
                                                        switch(error.code) {
                                                            case error.PERMISSION_DENIED:
                                                                errorMsg = 'Izin lokasi ditolak. Silakan aktifkan GPS dan izinkan akses lokasi.';
                                                                break;
                                                            case error.POSITION_UNAVAILABLE:
                                                                errorMsg = 'Informasi lokasi tidak tersedia.';
                                                                break;
                                                            case error.TIMEOUT:
                                                                errorMsg = 'Waktu tunggu habis saat mengambil lokasi.';
                                                                break;
                                                        }
                                                        
                                                        if (window.FilamentNotification) {
                                                            new FilamentNotification()
                                                                .title(errorMsg)
                                                                .danger()
                                                                .send();
                                                        } else {
                                                            alert(errorMsg);
                                                        }
                                                    }, {
                                                        enableHighAccuracy: true,
                                                        timeout: 10000,
                                                        maximumAge: 0
                                                    });
                                                } else {
                                                    const errorMsg = 'Geolocation tidak didukung oleh browser ini';
                                                    if (window.FilamentNotification) {
                                                        new FilamentNotification()
                                                            .title(errorMsg)
                                                            .danger()
                                                            .send();
                                                    } else {
                                                        alert(errorMsg);
                                                    }
                                                }
                                            "
                                        ])
                                ])
                                ->alignCenter(),
                            ]),

                        OSMMap::make('location')
                            ->label('Pilih Lokasi pada Peta')
                            ->showMarker()
                            ->draggable()
                            ->tilesUrl("https://tile.openstreetmap.org/{z}/{x}/{y}.png")
                            ->zoom(15)
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, callable $set, ?array $state): void {
                                if ($state !== null && isset($state['lat']) && isset($state['lng'])) {
                                    $set('latitude', number_format((float) $state['lat'], 8, '.', ''));
                                    $set('longitude', number_format((float) $state['lng'], 8, '.', ''));
                                }
                            })
                            ->afterStateHydrated(function (callable $get, callable $set, ?array $state): void {
                                $lat = $get('latitude');
                                $lng = $get('longitude');
                                
                                if ($lat && $lng) {
                                    $set('location', [
                                        'lat' => (float) $lat,
                                        'lng' => (float) $lng,
                                    ]);
                                } else {
                                    // Default location (Malang, Indonesia)
                                    $set('location', [
                                        'lat' => -7.9666,
                                        'lng' => 112.6326,
                                    ]);
                                }
                            })
                            ->extraAttributes([
                                'x-data' => '',
                                'x-init' => "
                                    setTimeout(() => {
                                        const mapContainer = \$el.querySelector('.leaflet-container');
                                        if (mapContainer && mapContainer._map) {
                                            // Store map reference globally for easier access
                                            window.currentJobMap = mapContainer._map;
                                        }
                                    }, 1000);
                                "
                            ]),
                    ]),

                Section::make('Detail Waktu & Anggaran')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('budget')
                                    ->label('Anggaran (IDR)')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->minValue(0)
                                    ->step(1000)
                                    ->placeholder('0'),

                                Select::make('status')
                                    ->label('Status')
                                    ->options(JobPost::getStatusOptions())
                                    ->default(JobPost::STATUS_OPEN)
                                    ->disabled(fn ($context) => $context === 'create')
                                    ->required(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                DateTimePicker::make('scheduled_date')
                                    ->label('Tanggal Mulai')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d/m/Y H:i')
                                    ->after('now')
                                    ->timezone('Asia/Jakarta'),

                                DateTimePicker::make('completion_deadline')
                                    ->label('Tenggat Waktu')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d/m/Y H:i')
                                    ->after('scheduled_date')
                                    ->timezone('Asia/Jakarta'),
                            ]),
                    ]),

                Section::make('Lampiran')
                    ->description('Upload file pendukung untuk pekerjaan ini')
                    ->schema([
                        Repeater::make('attachments')
                            ->relationship('attachments')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('file_name')
                                            ->label('Nama File')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Masukkan nama file'),

                                        Select::make('file_type')
                                            ->label('Tipe File')
                                            ->options([
                                                'image' => 'Gambar',
                                                'document' => 'Dokumen',
                                                'video' => 'Video',
                                                'other' => 'Lainnya',
                                            ])
                                            ->required()
                                            ->default('document'),
                                    ]),

                                FileUpload::make('file_path')
                                    ->label('Upload File')
                                    ->disk('public')
                                    ->directory('job-attachments')
                                    ->preserveFilenames()
                                    ->maxSize(10240) // 10MB
                                    ->acceptedFileTypes(['image/*', 'application/pdf', '.doc', '.docx', '.xls', '.xlsx', '.txt'])
                                    ->afterStateUpdated(function (callable $get, callable $set, ?string $state): void {
                                        if ($state) {
                                            // Auto-fill file_name if empty
                                            if (!$get('file_name')) {
                                                $fileName = pathinfo($state, PATHINFO_FILENAME);
                                                $set('file_name', $fileName);
                                            }
                                            
                                            // Auto-detect file type
                                            $extension = strtolower(pathinfo($state, PATHINFO_EXTENSION));
                                            $fileType = match($extension) {
                                                'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp' => 'image',
                                                'pdf', 'doc', 'docx', 'txt' => 'document',
                                                'mp4', 'avi', 'mov', 'wmv', 'flv' => 'video',
                                                default => 'other'
                                            };
                                            $set('file_type', $fileType);
                                        }
                                    })
                                    ->required(),

                                Textarea::make('description')
                                    ->label('Deskripsi File')
                                    ->rows(2)
                                    ->placeholder('Deskripsi opsional untuk file ini'),
                            ])
                            ->label('Lampiran Job')
                            ->createItemButtonLabel('Tambah Lampiran')
                            ->deleteAction(
                                fn (FormAction $action) => $action
                                    ->requiresConfirmation()
                                    ->modalDescription('Apakah Anda yakin ingin menghapus lampiran ini?')
                            )
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['file_name'] ?? 'Lampiran Baru')
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(30)
                    ->sortable()
                    ->weight('bold'),
                    
                TextColumn::make('customer.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                    
                TextColumn::make('serviceCategory.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->toggleable(),
                    
                TextColumn::make('budget')
                    ->label('Anggaran')
                    ->money('IDR')
                    ->sortable()
                    ->alignEnd(),
                    
                TextColumn::make('scheduled_date')
                    ->label('Tanggal Mulai')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('completion_deadline')
                    ->label('Deadline')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->color(fn (JobPost $record): string => $record->isOverdue() ? 'danger' : 'primary')
                    ->weight(fn (JobPost $record): string => $record->isOverdue() ? 'bold' : 'normal'),
                    
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        JobPost::STATUS_OPEN => 'primary',
                        JobPost::STATUS_ASSIGNED => 'warning',
                        JobPost::STATUS_IN_PROGRESS => 'info',
                        JobPost::STATUS_COMPLETED => 'success',
                        JobPost::STATUS_CANCELLED => 'danger',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn (string $state): string => JobPost::getStatusOptions()[$state] ?? $state)
                    ->sortable(),

                TextColumn::make('address')
                    ->label('Lokasi')
                    ->limit(30)
                    ->tooltip(fn (JobPost $record): string => $record->address ?? '')
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                TextColumn::make('attachments_count')
                    ->label('Lampiran')
                    ->counts('attachments')
                    ->badge()
                    ->color('info')
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(JobPost::getStatusOptions())
                    ->label('Status')
                    ->multiple(),
                    
                Tables\Filters\SelectFilter::make('service_category_id')
                    ->relationship('serviceCategory', 'name')
                    ->label('Kategori Layanan')
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('overdue')
                    ->label('Terlambat')
                    ->query(fn ($query) => $query->overdue())
                    ->toggle(),

                Tables\Filters\Filter::make('budget_range')
                    ->form([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('budget_from')
                                    ->label('Anggaran Dari')
                                    ->numeric()
                                    ->prefix('Rp'),
                                TextInput::make('budget_to')
                                    ->label('Anggaran Sampai')
                                    ->numeric()
                                    ->prefix('Rp'),
                            ]),
                    ])
                    ->query(function ($query, array $data): mixed {
                        return $query
                            ->when(
                                $data['budget_from'],
                                fn ($query, $budget): mixed => $query->where('budget', '>=', $budget),
                            )
                            ->when(
                                $data['budget_to'],
                                fn ($query, $budget): mixed => $query->where('budget', '<=', $budget),
                            );
                    })
                    ->label('Filter Anggaran'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),

                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->visible(fn (JobPost $record): bool => $record->canBeEdited()),
                    
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation(),

                Action::make('cancel')
                    ->label('Batalkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (JobPost $record): bool => $record->canBeCancelled())
                    ->requiresConfirmation()
                    ->modalDescription('Anda yakin ingin membatalkan pekerjaan ini?')
                    ->action(function (JobPost $record, array $data): void {
                        $record->update([
                            'status' => JobPost::STATUS_CANCELLED,
                            'cancellation_reason' => $data['reason'] ?? null,
                        ]);
                    })
                    ->form([
                        Textarea::make('reason')
                            ->label('Alasan Pembatalan')
                            ->required()
                            ->rows(3)
                            ->placeholder('Masukkan alasan pembatalan pekerjaan'),
                    ]),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make()
                    ->requiresConfirmation(),
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
            'index' => Pages\ListJobPosts::route('/'),
            'create' => Pages\CreateJobPost::route('/create'),
            'edit' => Pages\EditJobPost::route('/{record}/edit'),
            // 'view' => Pages\ViewJobPost::route('/{record}'),
        ];
    }
}