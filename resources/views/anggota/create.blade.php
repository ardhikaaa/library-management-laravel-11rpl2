<x-app-layout>

    <section class="bg-gray-50 dark:bg-gray-900 min-h-screen p-3 sm:p-5 lg:pl-64">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h1 class="text-2xl font-semibold text-white mb-5">Riwayat Buku Perpustakaan</h1>
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="py-2 px-4 text-left">Nama</th>
                                <th class="py-2 px-4 text-left">Judul Buku</th>
                                <th class="py-2 px-4 text-left">Penulis</th>
                                <th class="py-2 px-4 text-left">Tanggal Pinjam</th>
                                <th class="py-2 px-4 text-left">Tanggal Kembali</th>
                                <th class="py-2 px-4 text-left">Pengingat</th>
                                <th class="py-2 px-4 text-left">Status</th>
                                
                            </tr>
                        </thead>
                        @foreach ($riwayatPeminjaman as $isi)

                        @php
                            $time = date('Y-m-d');
                            $timeClass = $isi->tanggal_kembali === $time ? 'text-red-500' : '';
                            $timeClass2 = $isi->tanggal_kembali < $time ? 'bg-red-500 text-white' : '';

                            $tanggal_pinjam = \Carbon\Carbon::parse($isi->tanggal_pinjam);
                            $tanggal_kembali = \Carbon\Carbon::parse($isi->tanggal_kembali);

                                    $years = $tanggal_pinjam->diffInYears($tanggal_kembali);
                                    $months = $tanggal_pinjam->diffInMonths($tanggal_kembali);
                                    $weeks = $tanggal_pinjam->diffInWeeks($tanggal_kembali);
                                    $days = $tanggal_pinjam->diffInDays($tanggal_kembali);
                                    $hours = $tanggal_pinjam->diffInHours($tanggal_kembali);
                                    $minutes = $tanggal_pinjam->diffInMinutes($tanggal_kembali);
                                    $seconds = $tanggal_pinjam->diffInSeconds($tanggal_kembali);
                        @endphp

                        <tbody>
                            <tr class="border-b dark:border-gray-700 {{ $timeClass. ' ' .$timeClass2 }}">
                                <td class="py-2 px-4">{{ $isi->user->name }}</td>
                                <td class="py-2 px-4">{{ $isi->book->judul_buku }}</td>
                                <td class="py-2 px-4">{{ $isi->book->penulis }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($isi->tanggal_pinjam)->format('d/m/Y') }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($isi->tanggal_kembali)->format('d/m/Y') }}</td>
                                <td class="py-2 px-4">{{ $isi->status === 'available' ? '0' : $days }}</td>
                                <td class="py-2 px-4"><span class="text-xs font-medium rounded-full px-1 py-1 {{ $isi->status === 'borrowed' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'}}">
                                    {{ Str::ucfirst($isi->status)}}</span></td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        </section>

</x-app-layout>