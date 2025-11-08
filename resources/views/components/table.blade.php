<div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
    <div class="overflow-x-auto">
        <table class="table">
            {{-- Header --}}
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>

            {{-- Body --}}
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td>{!! $cell !!}</td> {{-- 🟢 Pakai {!! !!} biar HTML bisa dirender --}}
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) }}" class="text-center text-gray-500 py-4">
                            Tidak ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
