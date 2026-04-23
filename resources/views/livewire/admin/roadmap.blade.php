<div class="py-4 sm:py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-start justify-between gap-4 flex-wrap">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">স্মার্ট প্লান ও রোডম্যাপ</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        পেমেন্ট ও সদস্য ব্যবস্থাপনার মডিউলগুলোর বর্তমান ও ভবিষ্যৎ অবস্থা। পরিকল্পিত ফিচারগুলো এখানে সাজানো আছে
                        — যেকোনো সময় এগুলো চালু করা যাবে।
                    </p>
                </div>
                <a href="{{ route('admin.settings') }}" wire:navigate
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-indigo-700 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 dark:bg-indigo-900 dark:text-indigo-200 dark:border-indigo-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    সেটিংসে যান
                </a>
            </div>
        </div>

        <!-- Filter chips -->
        <div class="mb-6 flex flex-wrap gap-2">
            @php
                $chips = [
                    'all'         => ['সবগুলো',      'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200', 'bg-gray-600 text-white'],
                    'done'        => ['চালু আছে',    'bg-green-50 text-green-800 dark:bg-green-900 dark:text-green-200', 'bg-green-600 text-white'],
                    'in_progress' => ['চলমান',      'bg-amber-50 text-amber-800 dark:bg-amber-900 dark:text-amber-200', 'bg-amber-600 text-white'],
                    'planned'     => ['পরিকল্পিত',  'bg-indigo-50 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200', 'bg-indigo-600 text-white'],
                ];
            @endphp

            @foreach($chips as $key => [$label, $idle, $active])
                <button wire:click="setFilter('{{ $key }}')"
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold transition-colors {{ $filter === $key ? $active : $idle }}">
                    {{ $label }}
                    <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1 text-[10px] rounded-full {{ $filter === $key ? 'bg-white/20' : 'bg-white dark:bg-gray-800' }}">
                        {{ $counts[$key] }}
                    </span>
                </button>
            @endforeach
        </div>

        <!-- Feature groups -->
        @forelse($features as $group => $items)
            <div class="mb-8">
                <h2 class="mb-3 text-sm font-bold text-gray-500 uppercase tracking-wider dark:text-gray-400">{{ $group }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($items as $feature)
                        @php
                            $statusMeta = match($feature['status']) {
                                'done'        => ['চালু', 'bg-green-100 text-green-800 border-green-200 dark:bg-green-900 dark:text-green-200 dark:border-green-800', 'ring-green-200 dark:ring-green-800'],
                                'in_progress' => ['চলমান', 'bg-amber-100 text-amber-800 border-amber-200 dark:bg-amber-900 dark:text-amber-200 dark:border-amber-800', 'ring-amber-200 dark:ring-amber-800'],
                                default       => ['পরিকল্পিত', 'bg-indigo-100 text-indigo-800 border-indigo-200 dark:bg-indigo-900 dark:text-indigo-200 dark:border-indigo-800', 'ring-indigo-200 dark:ring-indigo-800'],
                            };
                        @endphp

                        <div class="relative overflow-hidden bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow">
                            @if($feature['status'] === 'done')
                                <div class="absolute top-0 right-0 w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full -mr-8 -mt-8 opacity-40"></div>
                            @elseif($feature['status'] === 'in_progress')
                                <div class="absolute top-0 right-0 w-16 h-16 bg-amber-100 dark:bg-amber-900 rounded-full -mr-8 -mt-8 opacity-40"></div>
                            @else
                                <div class="absolute top-0 right-0 w-16 h-16 bg-indigo-100 dark:bg-indigo-900 rounded-full -mr-8 -mt-8 opacity-40"></div>
                            @endif

                            <div class="relative">
                                <div class="flex items-start justify-between gap-2 mb-2">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 leading-snug">
                                        {{ $feature['title'] }}
                                    </h3>
                                    <span class="shrink-0 inline-flex items-center px-2 py-0.5 text-[10px] font-semibold border rounded-full {{ $statusMeta[1] }}">
                                        {{ $statusMeta[0] }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                                    {{ $feature['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="py-16 text-center">
                <div class="mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 mb-3">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">এই ফিল্টারে কোনো ফিচার নেই।</p>
            </div>
        @endforelse

        <!-- Footer note -->
        <div class="mt-10 p-4 rounded-lg bg-blue-50 dark:bg-blue-900/40 border border-blue-200 dark:border-blue-800">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-300 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div class="text-xs text-blue-800 dark:text-blue-200 leading-relaxed">
                    বিস্তারিত পরিকল্পনা, ডেটা মডেল এবং টাস্ক লিস্ট আছে রিপোজিটরির
                    <code class="px-1 py-0.5 bg-white dark:bg-gray-800 rounded border border-blue-200 dark:border-blue-800">docs/payment-modules-roadmap.md</code>
                    ফাইলে।
                </div>
            </div>
        </div>
    </div>
</div>
