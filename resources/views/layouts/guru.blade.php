@extends('layouts.app')

@section('title', 'SIAKAD Guru | SIAKAD Panel')
@section('shell_class', 'guru-app-shell')
@section('main_class', 'guru-app-main')

@push('styles')
<link href="{{ asset('css/layout-guru.css') }}" rel="stylesheet">
@endpush

@section('sidebar')
    <div x-cloak x-show="sidebar" x-transition.opacity @click="sidebar = false"
         class="guru-sidebar-overlay"></div>
    @include('partials.sidebar-guru')
@endsection

@section('topbar')
    @php
        $guruUser = \Illuminate\Support\Facades\Auth::user();
        $guruName = $guruUser?->name ?? '-';
        $guruNameParts = array_slice(preg_split('/\s+/', trim($guruName)) ?: [], 0, 2);
        $guruInitials = mb_strtoupper(implode('', array_map(
            fn ($part) => mb_substr($part, 0, 1),
            $guruNameParts
        ))) ?: '-';
        $guruRoleLabel = $guruUser?->role === 'wali_kelas' ? 'Wali Kelas' : 'Guru';
    @endphp
    <header class="guru-topbar">
        <div class="flex items-center gap-3">
            <button type="button" @click="sidebar = true" aria-label="Buka menu"
                    class="guru-menu-toggle">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
            </button>
            <h2 class="text-base text-slate-900">@yield('page_title')</h2>
        </div>

        <div class="flex items-center gap-3 sm:gap-4">
            <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                Tahun Ajaran {{ $tahunAjaran ?? '-' }}
            </span>
            <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-xs font-medium text-blue-700 ring-1 ring-blue-100">{{ $guruInitials }}</div>
                <div class="hidden leading-tight sm:block">
                    <p class="text-xs text-slate-900">{{ $guruName }}</p>
                    <p class="text-[10px] text-slate-500">{{ $guruRoleLabel }}</p>
                </div>
            </div>
        </div>
    </header>
@endsection

