@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

    {{-- HEADER + FILTER --}}
    <div class="card bg-base-100 shadow-md p-6 mb-6">
        <div class="text-center mb-5">
            <h2 class="text-2xl font-bold text-primary">
                Dashboard {{ ucwords(str_replace('_', ' ', $user->role)) }}
            </h2>
            <p class="text-gray-500 text-sm">
                Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d M Y') }}
                - {{ \Carbon\Carbon::parse($end)->translatedFormat('d M Y') }}
            </p>
        </div>

        <div class="flex flex-col lg:flex-row justify-center items-center gap-3">
            {{-- Filter --}}
            <form method="GET"
                class="flex flex-wrap justify-center items-center gap-3 bg-base-200/60 px-4 py-3 rounded-xl shadow-sm">
                <div class="flex items-center gap-2">
                    <input type="date" name="start_date" value="{{ $start }}"
                        class="input input-sm input-bordered rounded-lg focus:outline-none focus:ring-2 focus:ring-info" />
                    <span class="text-gray-400">s/d</span>
                    <input type="date" name="end_date" value="{{ $end }}"
                        class="input input-sm input-bordered rounded-lg focus:outline-none focus:ring-2 focus:ring-info" />
                </div>
                <x-button type="submit" size="sm" variant="info" class="px-4">
                    <span class="icon-[tabler--filter] mr-1"></span> Filter
                </x-button>
            </form>

            {{-- Cetak Button --}}
            @if ($user->role === \App\Models\User::ROLE_KEPALA_GUDANG)
                <form action="{{ route('dashboard.cetak') }}" method="GET" target="_blank">
                    <input type="hidden" name="start_date" value="{{ $start }}">
                    <input type="hidden" name="end_date" value="{{ $end }}">
                    <x-button variant="primary" size="sm" class="px-4">
                        <span class="icon-[tabler--printer] mr-1"></span> Cetak Nilai
                    </x-button>
                </form>
            @endif
        </div>
    </div>

    {{-- CHART SECTION --}}
    @if ($user->role === \App\Models\User::ROLE_KEPALA_GUDANG || $user->role === \App\Models\User::ROLE_TEKNISI)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 w-full">
            {{-- Bar Chart --}}
            <div class="card bg-base-100 shadow-md p-6 w-full">
                <h3 class="text-lg font-semibold mb-4">Grafik Nilai Poin Teknisi</h3>
                <div id="barChart" class="h-[350px]"></div>
            </div>

            {{-- Pie Chart --}}
            <div class="card bg-base-100 shadow-md p-6 w-full">
                <h3 class="text-lg font-semibold mb-4">Persentase Nilai Poin Teknisi (%)</h3>
                <div id="pieChart" class="h-[350px]"></div>
            </div>
        </div>
    @endif

    {{-- TABLE SECTION --}}
    <div class="card bg-base-100 shadow-md p-6">
        <h3 class="text-lg font-semibold mb-4">Rekap Penugasan Teknisi</h3>
        @php
            $headers = ['Nama Teknisi', 'Jumlah Tugas', 'Status Selesai', 'Status Dikerjakan', 'Total Poin'];
            $rows = collect($stats)->map(
                fn($s) => [e($s['nama']), e($s['jumlah']), e($s['selesai']), e($s['dikerjakan']), e($s['poin'])],
            );
        @endphp
        <x-table :headers="$headers" :rows="$rows" />
    </div>

    {{-- APEXCHARTS --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const labels = @json($chartLabels);
            const values = @json($chartValues);
            const pieData = @json($pieData);
            const isDark = document.documentElement.classList.contains('dark');
            // === Bar Chart ===
            const barOptions = {
                chart: {
                    type: 'bar',
                    height: 350,
                    foreColor: isDark ? '#ffffff' : '#374151',
                    toolbar: {
                        show: false
                    },
                    background: 'transparent'
                },
                series: [{
                    name: 'Total Poin',
                    data: values
                }],
                colors: ['#3b82f6'],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '45%',
                    },
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: labels,
                    labels: {
                        style: {
                            colors: isDark ? '#ffffff' : '#374151', // <-- nama teknisi
                            fontSize: '12px',
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Poin',
                        style: {
                            color: isDark ? '#ffffff' : '#374151'
                        }
                    },
                    labels: {
                        style: {
                            colors: isDark ? '#ffffff' : '#374151', // <-- angka sumbu
                            fontSize: '12px'
                        }
                    }
                },
                grid: {
                    borderColor: isDark ? '#374151' : '#e5e7eb'
                },
                tooltip: {
                    theme: isDark ? 'dark' : 'light', // <-- tooltip ikut tema
                    y: {
                        formatter: (val) => val + " Poin"
                    }
                },
                theme: {
                    mode: isDark ? 'dark' : 'light', // <-- penting agar chart style ikut mode
                }
            };

            new ApexCharts(document.querySelector("#barChart"), barOptions).render();


            // === Pie Chart ===
            const pieOptions = {
                chart: {
                    type: 'donut',
                    height: 350,
                },
                series: pieData,
                labels: labels,
                colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#14b8a6'],
                legend: {
                    position: 'bottom',
                    labels: {
                        colors: '#6b7280'
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%'
                        },
                    },
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '13px',
                        fontWeight: 600
                    },
                    formatter: (val) => val.toFixed(1) + '%',
                },
                tooltip: {
                    y: {
                        formatter: (val) => val.toFixed(1) + '%'
                    }
                }
            };
            new ApexCharts(document.querySelector("#pieChart"), pieOptions).render();
        });
    </script>
@endsection
