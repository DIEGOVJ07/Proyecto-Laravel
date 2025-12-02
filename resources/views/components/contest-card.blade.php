@props(['contest'])

@php

    $statusColors = match($contest->status) {
        'Activo'       => 'text-badge-green bg-badge-green/10 border-badge-green/20',
        'Próximamente' => 'text-badge-blue bg-badge-blue/10 border-badge-blue/20',
        'Finalizado'   => 'text-badge-gray bg-badge-gray/10 border-badge-gray/20',
        default        => 'text-gray-400 bg-gray-400/10'
    };

    $diffColors = match($contest->difficulty) {
        'Fácil'   => 'text-badge-green border-badge-green/20',
        'Medio'   => 'text-badge-blue border-badge-blue/20',
        'Difícil' => 'text-badge-red border-badge-red/20',
        default   => 'text-gray-400'
    };
@endphp

<div class="bg-dark-card rounded-2xl p-6 border border-dark-border hover:border-brand/50 transition duration-300 flex flex-col h-full shadow-lg shadow-black/20">
    <div class="flex justify-between items-start mb-4">
        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors }}">
            {{ $contest->status }}
        </span>
        <span class="px-3 py-1 rounded-full text-xs font-bold border bg-dark-input {{ $diffColors }}">
            {{ $contest->difficulty }}
        </span>
    </div>

    <h3 class="text-white text-xl font-bold mb-2 tracking-tight">{{ $contest->title }}</h3>
    <p class="text-gray-400 text-sm mb-6 flex-grow leading-relaxed">
        {{ $contest->description }}
    </p>

    <div class="space-y-3 text-sm text-gray-300 mb-6 font-medium">
        <div class="flex items-center">
            <i class="far fa-clock w-5 mr-3 text-brand"></i>
            {{ $contest->start_date instanceof \Carbon\Carbon ? $contest->start_date->format('d M Y') : $contest->start_date }}
        </div>
        
        <div class="flex items-center">
            <i class="fas fa-users w-5 mr-3 text-brand"></i>
            {{ number_format($contest->participants_count) }} participantes
        </div>

        <div class="flex items-center text-brand font-semibold">
            <i class="fas fa-trophy w-5 mr-3"></i>
            Premio: {{ $contest->prize }}
        </div>
    </div>

    <div class="flex flex-wrap gap-2 mt-auto pt-4 border-t border-gray-800">
        @if(is_array($contest->tech_stack))
            @foreach($contest->tech_stack as $tech)
                <span class="px-3 py-1 bg-dark-input rounded text-xs font-semibold text-gray-400 border border-gray-700">
                    {{ $tech }}
                </span>
            @endforeach
        @endif
    </div>
</div>
