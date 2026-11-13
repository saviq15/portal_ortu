@extends('layouts.app')

@section('title', 'SIAKAD Admin | SIAKAD Panel')
@section('shell_class', 'admin-app-shell')
@section('main_class', 'admin-app-main')

@push('styles')
<link href="{{ asset('css/layout-admin.css') }}" rel="stylesheet">
@endpush

@section('sidebar')
    <div x-cloak x-show="sidebar" x-transition.opacity @click="sidebar = false"
         class="admin-sidebar-overlay"></div>
    @include('partials.sidebar-admin')
@endsection

@section('topbar')
    @php
        $adminUser = \Illuminate\Support\Facades\Auth::user();
        $adminName = $adminUser?->name ?? '-';
        $adminNameParts = array_slice(preg_split('/\s+/', trim($adminName)) ?: [], 0, 2);
        $adminInitials = mb_strtoupper(implode('', array_map(
            fn ($part) => mb_substr($part, 0, 1),
            $adminNameParts
        )));
        $adminRole = $adminUser?->role === 'admin' ? 'Super Administrator' : ($adminUser?->role ?? '-');
    @endphp
    <header class="admin-topbar">
        <div class="flex items-center gap-3">
            <button type="button" @click="sidebar = true" aria-label="Buka menu"
                    class="admin-menu-toggle">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
            </button>
            <h2 class="text-lg font-bold text-slate-900">@yield('page_title')</h2>
        </div>

        <div class="flex items-center gap-3 sm:gap-4">
            <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 sm:inline-flex">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                @yield('year_label', 'Tahun Ajaran -')
            </span>
            <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-slate-100 text-xs font-semibold text-slate-600">{{ $adminInitials }}</div>
                <div class="hidden leading-tight sm:block">
                    <p class="text-xs font-bold text-slate-900">{{ $adminName }}</p>
                    <p class="text-[11px] text-slate-500">{{ $adminRole }}</p>
                </div>
            </div>
        </div>
    </header>
@endsection
