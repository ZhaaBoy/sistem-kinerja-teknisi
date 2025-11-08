<div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
    <div class="overflow-x-auto">
        <table class="table">
            {{-- Header --}}
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach

                    @if ($hasActions)
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>

            {{-- Body --}}
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        @foreach ($headers as $key => $header)
                            @php
                                // Ambil kunci field (jika $headers dikirim sebagai ['name' => 'Nama'])
                                $field = is_string($key) ? $key : \Illuminate\Support\Str::snake(strtolower($header));
                            @endphp
                            <td>{{ data_get($row, $field, '-') }}</td>
                        @endforeach

                        {{-- Slot untuk tombol aksi (optional) --}}
                        @if ($hasActions)
                            <td>
                                {{ $actions($row) }}
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) + ($hasActions ? 1 : 0) }}"
                            class="text-center text-gray-500 py-4">
                            Tidak ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
