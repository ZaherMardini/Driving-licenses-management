@php
  $statusColors = [
    'Active' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
    'Expired' => 'bg-red-500/20 text-red-400 border-red-500/30',
    'Suspended' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
  ];
  $status = $licence['status'];
  $statusClass = $statusColors[$status] ?? $statusColors['Active'];
@endphp

<div class="w-full max-w-md mx-auto">
    <div class="relative rounded-2xl overflow-hidden shadow-2xl 
                bg-zinc-900 border border-zinc-700">

        <!-- Top Official Strip -->
        <div class="bg-linear-to-r from-indigo-600 via-blue-600 to-cyan-500 p-3">
            <div class="flex justify-between items-center text-white">
                <h2 class="text-sm sm:text-base font-semibold tracking-widest uppercase">
                    Government Driving Licence
                </h2>
                <span class="text-xs opacity-80">ID: {{ $licence['licence_number'] }}</span>
            </div>
        </div>

        <div class="p-5 space-y-5">

            <!-- Profile Section -->
            <div class="flex flex-col sm:flex-row gap-4 sm:items-center">

                <div class="flex justify-center sm:justify-start">
                    <img 
                        src="{{ $licence['image'] ?? 'https://i.pravatar.cc/150?img=3' }}"
                        alt="Licence Holder"
                        class="w-24 h-28 object-cover rounded-lg border-2 border-indigo-500 shadow-md"
                    >
                </div>

                <div class="flex-1 text-center sm:text-left">
                    <h3 class="text-xl font-bold text-white">
                        {{ $licence['person']['name'] }}
                    </h3>
                    <p class="text-indigo-400 font-semibold mt-1">
                        Class: {{ $licence['licence_class']['title'] }}
                    </p>

                    <div class="mt-3">
                        <span class="px-3 py-1 text-xs font-medium rounded-full border {{ $statusClass }}">
                            {{ $status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-zinc-700"></div>

            <!-- Information Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

                <div>
                    <p class="text-zinc-400 text-xs uppercase tracking-wide">Issue Date</p>
                    <p class="text-white font-medium mt-1">{{ $licence['issue_date'] }}</p>
                </div>

                <div>
                    <p class="text-zinc-400 text-xs uppercase tracking-wide">Expiry Date</p>
                    <p class="text-white font-medium mt-1">{{ $licence['expiry_date'] }}</p>
                </div>

                <div class="sm:col-span-2">
                    <p class="text-zinc-400 text-xs uppercase tracking-wide">Notes</p>
                    <p class="text-white font-medium mt-1">
                        {{ $licence['notes'] }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Subtle Bottom Accent -->
        <div class="absolute bottom-0 left-0 w-full h-1 bg-linear-to-r from-indigo-600 via-blue-600 to-cyan-500"></div>

    </div>
</div>