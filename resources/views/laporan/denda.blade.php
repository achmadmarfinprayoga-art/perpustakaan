@extends('layout.master')

@section('header', 'Laporan Denda')

@section('content')
    <!-- Script untuk Chart.js (hanya dimuat di halaman ini) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Hide nav & header elements when printing -->
    <style>
        @media print {
            aside, header, .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            main {
                padding: 0 !important;
                background: white !important;
            }
            .shadow-sm, .shadow-md, .shadow-lg {
                box-shadow: none !important;
            }
            .rounded-2xl {
                border-radius: 0 !important;
            }
            body {
                background: white !important;
            }
        }
        .print-only { display: none; }
    </style>

    <div class="print-only text-center mb-8">
        <h1 class="text-3xl font-bold">Laporan Penerimaan Denda</h1>
        <p class="text-gray-600">Bulan: {{ $arrBulan[(int)$bulan] }} {{ $tahun }}</p>
        <hr class="my-4 border-2 border-black">
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 md:p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 no-print border-b border-slate-100 pb-6 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Laporan Penerimaan Denda</h1>
                <p class="text-slate-500 text-sm mt-1">Pantau tren penerimaan denda dan rekapitulasi data telat pengembalian.</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <form action="/laporan/denda" method="GET" class="flex gap-2">
                    <select name="bulan" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 font-medium">
                        @foreach($arrBulan as $key => $namaBulan)
                            <option value="{{ $key }}" {{ $key == $bulan ? 'selected' : '' }}>{{ $namaBulan }}</option>
                        @endforeach
                    </select>
                    <select name="tahun" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 font-medium">
                        @php $currentYear = date('Y'); @endphp
                        @for($y = $currentYear; $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="bg-indigo-600 text-white rounded-xl px-4 py-2.5 text-sm font-bold hover:bg-slate-800 transition-colors shadow-sm">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                </form>
                
                <button onclick="window.print()" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 rounded-xl px-4 py-2.5 text-sm font-bold transition-colors shadow-sm flex-shrink-0">
                    <i class="fas fa-print mr-1"></i> Cetak Dokumen
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl p-5 text-white relative overflow-hidden shadow-lg shadow-indigo-500/30">
                <div class="absolute right-0 top-0 -mr-8 -mt-8 w-32 h-32 bg-white rounded-full opacity-10 blur-2xl"></div>
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-lg mb-3 relative z-10 backdrop-blur-sm">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="relative z-10">
                    <div class="text-[10px] font-bold text-indigo-100 uppercase tracking-wider mb-1">Sisa Kas Saat Ini</div>
                    <div class="text-2xl font-black">Rp{{ number_format($sisaKas, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200 flex flex-col justify-between relative overflow-hidden shadow-sm">
                <div class="flex items-start gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Pemasukan</div>
                        <div class="text-xl font-black text-slate-800">Rp{{ number_format($totalKeseluruhan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200 flex flex-col justify-between relative overflow-hidden shadow-sm">
                <div class="flex items-start gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center text-lg shrink-0">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div class="w-full">
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex justify-between items-center w-full">
                            <span>Total Pengeluaran</span>
                        </div>
                        <div class="text-xl font-black text-rose-600 mb-2">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                        <button onclick="document.getElementById('modalPengeluaran').classList.remove('hidden')" class="w-full text-[10px] bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white font-bold px-2 py-1.5 rounded-lg border border-rose-100 hover:border-rose-500 transition-colors">
                            Kurangi Kas
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200 flex flex-col justify-between relative overflow-hidden shadow-sm">
                <div class="flex items-start gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg shrink-0">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tunggakan (Bulan Ini)</div>
                        <div class="text-xl font-black text-amber-600">Rp{{ number_format($totalDendaBelumDibayar, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8 no-print">
            <div class="lg:col-span-2 bg-slate-50 rounded-2xl p-6 border border-slate-200">
                <h3 class="font-bold text-slate-700 mb-4 flex items-center">
                    <i class="fas fa-chart-line text-indigo-500 mr-2"></i> Grafik Penerimaan Denda Tahun {{ $tahun }}
                </h3>
                <div class="relative h-64 w-full">
                    <canvas id="dendaChart"></canvas>
                </div>
            </div>
            <div class="lg:col-span-1 bg-slate-50 border border-slate-200 rounded-2xl p-6">
                <h3 class="font-bold text-slate-700 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-amber-500 mr-2"></i> Ringkasan
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed mb-4">
                    Data denda di atas merangkum semua pembayaran telat pengembalian buku siswa. Denda yang statusnya belum dibayar (Tunggakan) tidak diakumulasikan ke dalam grafik bulanan mapun total kas keseluruhan, sampai siswa tersebut melunasinya melalui menu <strong>Peminjaman</strong>.
                </p>
                <div class="bg-white border text-center border-slate-200 p-4 rounded-xl text-sm font-medium text-slate-700">
                    Siswa Telat Terbanyak: <br> <span class="font-bold text-indigo-600 mt-1 inline-block">Bisa dikembangkan</span>
                </div>
            </div>
        </div>

        <div class="mb-4 text-lg font-bold text-slate-800 flex items-center">
            <i class="fas fa-table mr-2 text-slate-400 no-print"></i> Rincian Transaksi Denda ({{ $arrBulan[(int)$bulan] }} {{ $tahun }})
        </div>

        <div>
            @if ($peminjamans->count() > 0)
                <div class="overflow-x-auto border border-slate-200/60 rounded-xl">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="tracking-wide border-b border-slate-200/60 bg-slate-50/50 text-slate-500">
                            <tr>
                                <th scope="col" class="px-5 py-4 font-bold w-12 text-center">No</th>
                                <th scope="col" class="px-5 py-4 font-bold">Peminjam</th>
                                <th scope="col" class="px-5 py-4 font-bold">Buku</th>
                                <th scope="col" class="px-5 py-4 font-bold">Tanggal Kembali</th>
                                <th scope="col" class="px-5 py-4 font-bold">Terlambat</th>
                                <th scope="col" class="px-5 py-4 font-bold text-right">Nominal Denda</th>
                                <th scope="col" class="px-5 py-4 font-bold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($peminjamans as $p)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                    <th scope="row" class="px-5 py-3 font-medium text-slate-400 text-center">{{ $loop->iteration }}</th>
                                    <td class="px-5 py-3 font-bold text-slate-800">{{ $p->siswa?->nama ?? '-' }}</td>
                                    <td class="px-5 py-3 text-slate-600 font-medium">{{ $p->buku?->judul ?? '-' }}</td>
                                    <td class="px-5 py-3 text-slate-500 text-xs">{{ $p->tanggal_kembali ?? '-' }}</td>
                                    <td class="px-5 py-3"><span class="text-rose-500 font-bold text-xs">{{ $p->hari_terlambat }} Hari</span></td>
                                    <td class="px-5 py-3 text-right">
                                        <div class="font-bold text-slate-800">Rp{{ number_format($p->denda, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-5 py-3 text-center">
                                        @if($p->is_paid)
                                            <span class="inline-flex items-center px-2 py-1 rounded bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase"><i class="fas fa-check mr-1 opacity-50"></i> Lunas</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded bg-rose-100 text-rose-700 text-[10px] font-black uppercase"><i class="fas fa-times mr-1 opacity-50"></i> Tunggakan</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-4 border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center bg-slate-50/50">
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400 text-2xl">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700 mb-1">Nihil</h3>
                    <p class="text-slate-500 mb-4 text-sm">Tidak ada catatan denda untuk bulan {{ $arrBulan[(int)$bulan] }} {{ $tahun }}.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Script Init Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('dendaChart').getContext('2d');
            
            // Prepare Data from Backend
            const rawData = @json($summaryBulanan);
            const arrBulan = @json($arrBulan);
            
            const labels = [];
            const dataTotals = [];
            
            // Populate arrays for chart
            for (let i = 1; i <= 12; i++) {
                labels.push(arrBulan[i]);
                dataTotals.push(rawData[i] ? rawData[i].total : 0);
            }

            // Create gradient
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(79, 70, 229, 0.5)'); // Indigo-600
            gradient.addColorStop(1, 'rgba(79, 70, 229, 0.05)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Denda Terkumpul (Rp)',
                        data: dataTotals,
                        borderColor: '#4f46e5',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#4f46e5',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // curve
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            titleFont: { size: 13, family: "'Inter', sans-serif" },
                            bodyFont: { size: 14, weight: 'bold', family: "'Inter', sans-serif" },
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) { label += ': '; }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            border: { display: false },
                            grid: { color: '#f1f5f9', drawBorder: false },
                            ticks: {
                                color: '#64748b',
                                font: { size: 11, family: "'Inter', sans-serif" },
                                callback: function(value) {
                                    return 'Rp ' + (value/1000) + 'k';
                                }
                            }
                        },
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: {
                                color: '#64748b',
                                font: { size: 11, family: "'Inter', sans-serif" }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <!-- Modal Pengeluaran -->
    <div id="modalPengeluaran" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm overflow-y-auto">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden animate-fade-in-up">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 flex items-center">
                        <i class="fas fa-money-bill-wave text-rose-500 mr-2"></i> Kurangi Kas Denda
                    </h3>
                    <button onclick="document.getElementById('modalPengeluaran').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="/laporan/denda/pengeluaran" method="POST" class="p-6" data-confirm="Apakah Anda yakin ingin mencatat pengeluaran ini? Tindakan ini akan mengurangi sisa kas denda secara permanen.">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Keterangan / Tujuan Pengeluaran</label>
                        <input type="text" name="keterangan" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-sm" placeholder="Contoh: Beli buku baru, biaya admin...">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah (Rp)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 font-bold">Rp</span>
                            <input type="number" name="jumlah" required min="1" max="{{ $sisaKas }}" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 text-sm font-bold" placeholder="0">
                        </div>
                        <p class="text-[10px] text-slate-500 mt-1">Maksimal: Rp{{ number_format($sisaKas, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" onclick="document.getElementById('modalPengeluaran').classList.add('hidden')" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-colors text-sm">Batal</button>
                        <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-rose-600 text-white font-bold hover:bg-rose-700 transition-colors shadow-sm shadow-rose-500/30 text-sm">Simpan Pengeluaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
