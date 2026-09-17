@extends('layouts.app')

@section('title', 'Audit Login')
@section('header_title', 'Riwayat Login')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200">
        <h2 class="text-lg font-semibold text-slate-800">Riwayat Login Pengguna</h2>
        <p class="text-sm text-slate-500 mt-1">Daftar seluruh percobaan login yang berhasil, diurutkan dari yang terbaru.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Dirección IP</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Fecha y Hora</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($loginAudits as $audit)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm mr-3">
                                    {{ strtoupper(substr($audit->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-slate-800">{{ $audit->user->name ?? 'Usuario eliminado' }}</div>
                                    <div class="text-xs text-slate-500">{{ $audit->user->username ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            {{ ucfirst($audit->user->role ?? '-') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            {{ $audit->ip_address }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            {{ \Carbon\Carbon::parse($audit->logged_in_at)->translatedFormat('d M Y, H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-sm">
                            Belum ada riwayat login.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($loginAudits->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $loginAudits->links() }}
        </div>
    @endif
</div>
@endsection