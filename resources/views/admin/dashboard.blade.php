<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard - Administration Manna')

@section('content')
    <div class="page-header">
        <h1>Tableau de bord</h1>
        <p>Bienvenue dans l'espace d'administration CL SKY</p>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['donators'] }}</h3>
                <p>Donateurs</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['donations'] }}</h3>
                <p>Donations</p>
            </div>
        </div>

        {{-- <div class="stat-card">
        <div class="stat-icon warning">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['membres'] }}</h3>
            <p>Membres d'équipe</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon danger">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['contacts'] }}</h3>
            <p>Messages reçus</p>
        </div>
    </div> --}}
    </div>

    <!-- Recent Content -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px;">
        <!-- Recent Contacts -->
        <div class="card">
            <div class="card-header">
                <h2>Messages récents</h2>
                {{-- <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-primary">
                Voir tous
            </a> --}}
            </div>
            <div class="card-body">
                @if ($recentContacts->count() > 0)
                    <div class="list-group">
                        @foreach ($recentContacts as $contact)
                            <div style="padding: 15px; border-bottom: 1px solid #e2e8f0;">
                                <div style="display: flex; justify-content: space-between; align-items: start;">
                                    <div>
                                        <h4 style="font-size: 14px; font-weight: 600; margin-bottom: 5px;">
                                            {{ $contact->name }}
                                        </h4>
                                        <p style="font-size: 13px; color: #64748b; margin-bottom: 5px;">
                                            {{ $contact->email }}
                                        </p>
                                        <p style="font-size: 13px; color: #334155;">
                                            {{ Str::limit($contact->message, 60) }}
                                        </p>
                                    </div>
                                    <span style="font-size: 12px; color: #64748b;">
                                        {{ $contact->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="text-align: center; color: #64748b; padding: 20px;">
                        Aucun message pour le moment
                    </p>
                @endif
            </div>
        </div>

        <!-- Recent Announcements -->
        {{-- <div class="card">
            <div class="card-header">
                <h2>Annonces récentes</h2>
                <a href="{{ route('admin.annonces.index') }}" class="btn btn-sm btn-primary">
                    Voir toutes
                </a>
            </div>
            <div class="card-body">
                @if ($recentAnnonces->count() > 0)
                    <div class="list-group">
                        @foreach ($recentAnnonces as $annonce)
                            <div style="padding: 15px; border-bottom: 1px solid #e2e8f0;">
                                <div style="display: flex; justify-content: space-between; align-items: start;">
                                    <div>
                                        <h4 style="font-size: 14px; font-weight: 600; margin-bottom: 5px;">
                                            {{ $annonce->title }}
                                        </h4>
                                        <p style="font-size: 13px; color: #334155;">
                                            {{ Str::limit($annonce->description, 80) }}
                                        </p>
                                    </div>
                                    <span style="font-size: 12px; color: #64748b;">
                                        {{ $annonce->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="text-align: center; color: #64748b; padding: 20px;">
                        Aucune annonce pour le moment
                    </p>
                @endif
            </div>
        </div> --}}
    </div>
@endsection
