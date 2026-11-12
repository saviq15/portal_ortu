@extends('layouts.app')

@section('title', 'SIAKAD Tata Usaha | SIAKAD Panel')
@section('shell_class', 'tu-app-shell')
@section('main_class', 'tu-app-main')

@section('shell_attributes')
x-show="@yield('shell_visibility', 'true')"
@endsection

@push('styles')
<link href="{{ asset('css/layout-tu.css') }}" rel="stylesheet">
@endpush

@section('sidebar')
    <div x-cloak x-show="sidebar" x-transition.opacity @click="sidebar = false"
         class="tu-sidebar-overlay"></div>
    @include('partials.sidebar-tu')
@endsection

@section('topbar')
    @php
        $tuUser = \Illuminate\Support\Facades\Auth::user();
        $tuName = $tuUser->name;
        $tuNameParts = array_slice(preg_split('/\s+/', trim($tuName)), 0, 2);
        $tuInitials = mb_strtoupper(implode('', array_map(
            fn ($part) => mb_substr($part, 0, 1),
            $tuNameParts
        )));
        $tuRole = $tuUser->role === 'pihak_yayasan' ? 'Staf TU' : $tuUser->role;
    @endphp
    <header class="tu-topbar">
        <div class="flex items-center gap-3">
            <button type="button" @click="sidebar = true" aria-label="Buka menu"
                    class="tu-menu-toggle">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
            </button>
            @yield('page_title_prefix')
            <h2 class="text-base text-slate-900">@yield('page_title')</h2>
        </div>

        <div class="flex items-center gap-3 sm:gap-4">
            <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                @yield('year_label', 'Tahun Ajaran 2026/2027')
            </span>
            <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
            <div class="flex items-center gap-3">
                <div class="{{ trim($__env->yieldContent('profile_badge_class', 'flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-medium text-white')) }}">{{ $tuInitials }}</div>
                <div class="hidden leading-tight sm:block">
                    <p class="{{ trim($__env->yieldContent('profile_name_class', 'text-sm text-slate-900')) }}">{{ $tuName }}</p>
                    <p class="{{ trim($__env->yieldContent('profile_role_class', 'text-[11px] text-slate-500')) }}">{{ $tuRole }}</p>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('shell_visibility', 'true')
