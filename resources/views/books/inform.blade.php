<x-app-layout>

 <section class="bg-gray-50 dark:bg-gray-900 min-h-screen p-3 sm:pl-64 md:pl-64 lg:pl-64">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h1 class="text-2xl font-semibold text-white mb-5">Riwayat Buku Perpustakaan</h1>
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="py-2 px-4 text-left">Judul Buku</th>
                                <th class="py-2 px-4 text-left">Penulis</th>
                                <th class="py-2 px-4 text-left">Tanggal Pinjam</th>
                                <th class="py-2 px-4 text-left">Tanggal Kembali</th>
                                <th class="py-2 px-4 text-left">Perpanjang</th>
                                <th class="py-2 px-4 text-left">Pengingat</th>
                                <th class="py-2 px-4 text-left">Status</th>
                                
                            </tr>
                        </thead>

                        @foreach ($riwayatPeminjaman as $isi)

                        @php
                            $time = date('Y-m-d');
                            $timeClass = $isi->tanggal_kembali === $time ? 'text-red-500' : '';
                            $timeClass2 = $isi->tanggal_kembali < $time ? 'bg-red-500 text-white' : '';

                           
                            $tanggal_kembali = \Carbon\Carbon::parse($isi->tanggal_kembali)->startOfDay();
                            $now = \Carbon\Carbon::now()->startOfDay();
                            $days = $now->diffInDays($tanggal_kembali);
                            

                                    $years      = $now->diffInYears($tanggal_kembali);
                                    $months     = $now->diffInMonths($tanggal_kembali);
                                    $weeks      = $now->diffInWeeks($tanggal_kembali);
                                    $days       = $now->diffInDays($tanggal_kembali);
                                    $hours      = $now->diffInHours($tanggal_kembali);
                                    $minutes    = $now->diffInMinutes($tanggal_kembali);
                                    $seconds    = $now->diffInSeconds($tanggal_kembali);
                        @endphp

                        
                        <tbody>
                            <tr class="border-b dark:border-gray-700 {{ $timeClass. ' ' .$timeClass2 }}">
                                <td class="py-2 px-4">{{ $isi->book->judul_buku }}</td>
                                <td class="py-2 px-4">{{ $isi->book->penulis }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($isi->tanggal_pinjam)->format('d/m/Y') }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($isi->tanggal_kembali)->format('d/m/Y') }}</td>
                                <td> 
                                    <form action="{{ route('books.perpanjang', $isi->id) }}" method="POST">
                                        @csrf
                                        <div class="flex items-center space-x-2">
                                            <!-- Input Tanggal -->
                                            <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required min="{{ date('Y-m-d') }}">
                                  
                                            <!-- Tombol Perpanjang -->
                                            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                                Perpanjang
                                            </button>
                                        </div>
                                    </form> 
                                </td>
                                <td class="py-2 px-4">{{ $isi->status === 'available' ? '0' : $days }} hari</td>
                                <td class="py-2 px-4" data-modal-target="modal-{{ $isi->id }}"
                                    data-modal-toggle="modal-{{ $isi->id }}" style="{{ $isi->status === 'available' ? '' : 'cursor: pointer' }}"><span class="text-xs font-medium rounded-full px-1 py-1 {{ $isi->status === 'borrowed' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'}}">
                                    {{ Str::ucfirst($isi->status)}}</span></td>
                                    
                            </tr>

                            @if($isi->status !== 'available')
                            <div id="modal-{{ $isi->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Edit
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="modal-{{ $isi->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->

                                        <?php
                                        $status = $isi->status == 'borrowed' ? 'available' : 'borrowed';
                                        ?>
                                        
                                        <form class="p-4 md:p-5" action="{{ route('books.status', $isi->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="book_id" value="{{ $isi->id }}">
                                            <div class=" mb-4">
                                                <div class="sm:col-span-2 lg:px-16 md:px-10 sm:px-5">
                                                    <label for="status"
                                                        class="block mb-2 text-sm font-medium text-white dark:text-white">Status</label>
                                                    <select name="status" id="status"
                                                        class="w-full rounded-md border-gray-300">
                                                                <option value="{{ $isi->status }}">{{Str::ucfirst($isi->status)}}</option>
                                                                <option value="{{ $status }}">{{Str::ucfirst($status)}}</option>
                                                    </select>
                                                </div>
                                                <div class="lg:pl-16 md:px-10 py-5 sm:px-5">
                                                <button type="submit"
                                                    class=" px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                                    Pinjam Buku
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                                
                            </tr>
                        </tbody>
                        
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        </section>

</x-app-layout>