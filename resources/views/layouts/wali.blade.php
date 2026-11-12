@extends('layouts.app')

@section('title', 'SIAKAD Wali Murid | SIAKAD Panel')
@section('shell_class', 'wali-app-shell')
@section('main_class', 'wali-app-main')

@section('shell_attributes')
x-show="@yield('shell_visibility', 'true')"
@endsection

@push('styles')
<link href="{{ asset('css/layout-wali.css') }}" rel="stylesheet">
@endpush

@section('sidebar')
    <div x-cloak x-show="sidebar" x-transition.opacity @click="sidebar = false"
         class="wali-sidebar-overlay"></div>
    @include('partials.sidebar-wali')
@endsection

@section('topbar')
    @php
        $waliUser = \Illuminate\Support\Facades\Auth::user();
        $waliName = $waliUser->name;
        $waliNameParts = array_slice(preg_split('/\s+/', trim($waliName)), 0, 2);
        $waliInitials = mb_strtoupper(implode('', array_map(
            fn ($part) => mb_substr($part, 0, 1),
            $waliNameParts
        )));
        $waliRole = $waliUser->role === 'orang_tua' ? 'Orang Tua' : $waliUser->role;
    @endphp
    <header class="wali-topbar">
        <div class="flex items-center gap-3">
            <button type="button" @click="sidebar = true" aria-label="Buka menu"
                    class="wali-menu-toggle">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
            </button>
            @yield('page_title_prefix')
            <h2 class="@yield('page_title_class', 'text-base text-slate-900')">@yield('page_title')</h2>
        </div>

        <div class="flex items-center gap-3 sm:gap-4">
            <span class="@yield('year_badge_class', 'hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex')">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                @yield('year_label', 'Tahun Ajaran 2026/2027')
            </span>
            @yield('year_divider')
            <div class="flex items-center gap-3">
                <div class="@yield('profile_badge_class', 'flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-medium text-white')">{{ $waliInitials }}</div>
                <div class="hidden leading-tight sm:block">
                    <p class="@yield('profile_name_class', 'text-xs text-slate-900')">{{ $waliName }}</p>
                    <p class="@yield('profile_role_class', 'text-[10px] text-slate-500')">{{ $waliRole }}</p>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('shell_visibility', 'true')
