@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    
    <div class="mb-4">
        <div style="font-size: 13px; color: #888888; margin-bottom: 6px; font-weight: 400;">
            <span>Admin</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span>Utama</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span style="color: #333; font-weight: 500;">Dashboard</span>
        </div>
        <h1 class="font-weight-bold mb-1" style="color: #111111; font-size: 28px; letter-spacing: -0.5px;">Dashboard Ringkasan</h1>
        <p class="text-muted mb-0" style="font-size: 14.5px;">Pantau grafik aktivitas sewa, ketersediaan stok alat, dan log operasional store Selekta Adventure.</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; border-left: 5px solid #f96d00 !important;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="mr-3 text-center" style="width: 45px; height: 45px; background: #fff3e0; border-radius: 50%; line-height: 45px;">
                        <i class="fa fa-shopping-cart" style="color: #f96d00; font-size: 18px;"></i>
                    </div>
                    <div>
                        <div class="text-muted font-weight-bold" style="font-size: 11px; letter-spacing: 1px;">BOOKING BARU</div>
                        <h3 class="font-weight-bold mb-0 text-dark" style="font-size: 26px;">{{ $booking_baru }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; border-left: 5px solid #16a34a !important;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="mr-3 text-center" style="width: 45px; height: 45px; background: #dcfce7; border-radius: 50%; line-height: 45px;">
                        <i class="fa fa-check-circle" style="color: #16a34a; font-size: 18px;"></i>
                    </div>
                    <div>
                        <div class="text-muted font-weight-bold" style="font-size: 11px; letter-spacing: 1px;">TERVALIDASI</div>
                        <h3 class="font-weight-bold mb-0 text-dark" style="font-size: 26px;">{{ $tervalidasi }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; border-left: 5px solid #0284c7 !important;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="mr-3 text-center" style="width: 45px; height: 45px; background: #e0f2fe; border-radius: 50%; line-height: 45px;">
                        <i class="fa fa-refresh" style="color: #0284c7; font-size: 18px;"></i>
                    </div>
                    <div>
                        <div class="text-muted font-weight-bold" style="font-size: 11px; letter-spacing: 1px;">SEWA AKTIF</div>
                        <h3 class="font-weight-bold mb-0 text-dark" style="font-size: 26px;">{{ $sewa_aktif }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; border-left: 5px solid #dc2626 !important;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="mr-3 text-center" style="width: 45px; height: 45px; background: #fee2e2; border-radius: 50%; line-height: 45px;">
                        <i class="fa fa-exclamation-triangle" style="color: #dc2626; font-size: 18px;"></i>
                    </div>
                    <div>
                        <div class="text-muted font-weight-bold" style="font-size: 11px; letter-spacing: 1px;">TELAT KEMBALI</div>
                        <h3 class="font-weight-bold mb-0 text-dark" style="font-size: 26px;">{{ $telat_kembali }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 15px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="font-weight-bold text-dark mb-1">Tren Pesanan Sewa (7 Hari Terakhir)</h5>
                        <p class="text-muted mb-0" style="font-size: 13px;">Pantau grafik aktivitas masuknya reservasi alat</p>
                    </div>
                    <div class="font-weight-bold" style="font-size: 15px;">
                        Bulan {{ \Carbon\Carbon::now()->translatedFormat('F') }} <i class="fa fa-angle-down ml-1"></i>
                    </div>
                </div>
                <div style="height: 300px; width: 100%;">
                    <canvas id="trenSewaChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 15px;">
                <h5 class="font-weight-bold text-dark mb-1">Alat Terlaris</h5>
                <p class="text-muted mb-4" style="font-size: 13px;">Unit dengan frekuensi sewa tertinggi</p>

                <div class="d-flex flex-column gap-3">
                    @forelse($alat_terlaris as $alat)
                        <div class="d-flex align-items-center mb-4">
                            @if($alat->gambar)
                                <img src="{{ asset('images/alat/' . $alat->gambar) }}" alt="Alat" class="rounded shadow-sm mr-3" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded shadow-sm mr-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fa fa-image text-muted"></i>
                                </div>
                            @endif
                            
                            <div class="w-100">
                                <h6 class="font-weight-bold mb-1" style="font-size: 14.5px;">{{ $alat->nama_alat }}</h6>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="text-muted" style="font-size: 12px;">{{ $alat->detail_pesanans_count }}x Disewa</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 10px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ min(($alat->detail_pesanans_count / 10) * 100, 100) }}%; background-color: #f96d00; border-radius: 10px;"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="fa fa-box-open mb-2" style="font-size: 24px;"></i>
                            <p style="font-size: 13px;">Belum ada data persewaan alat.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('trenSewaChart').getContext('2d');
        
        // Gradient Fill untuk warna di bawah garis kurva
        var gradientFill = ctx.createLinearGradient(0, 0, 0, 300);
        gradientFill.addColorStop(0, 'rgba(249, 109, 0, 0.4)'); // Oranye Selekta transparan
        gradientFill.addColorStop(1, 'rgba(249, 109, 0, 0.0)'); 

        var trenSewaChart = new Chart(ctx, {
            type: 'line',
            data: {
                // Data Tanggal & Jumlah Pesanan hasil injeksi dari Controller
                labels: {!! json_encode($chart_labels) !!},
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: {!! json_encode($chart_data) !!},
                    borderColor: '#f96d00',
                    backgroundColor: gradientFill,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#f96d00',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4 // Membuat garisnya melengkung (kurva)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // Sembunyikan legenda atas
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f0f0',
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 10,
                            color: '#888'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#888' }
                    }
                }
            }
        });
    });
</script>
@endsection