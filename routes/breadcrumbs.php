<?php

Breadcrumbs::register('users-index', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Gebruikersbeheer', route('admin.users.index'));
});

Breadcrumbs::register('users-create', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Gebruikersbeheer', route('admin.users.index'));
    $breadcrumbs->push('Nieuwe gebruiker', route('admin.users.create'));
});

Breadcrumbs::register('logs-index', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Logs', route('admin.logs.index'));
});

Breadcrumbs::register('articles-index', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Artikelen', route('admin.articles.index'));
});

Breadcrumbs::register('articles-create', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Artikelen', route('admin.articles.index'));
    $breadcrumbs->push('Nieuw artikel', route('admin.articles.create'));
});

Breadcrumbs::register('articles-edit', function ($breadcrumbs, $article): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Artikelen', route('admin.articles.index'));
    $breadcrumbs->push('Wijzig: ' . ucfirst($article->title), route('admin.articles.edit', $article));
});

Breadcrumbs::register('calendar-index', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Kalender', route('admin.calendar.index'));
});

Breadcrumbs::register('calendar-create', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Kalender', route('admin.calendar.index'));
    $breadcrumbs->push('Nieuw evenement', route('admin.calendar.create'));
});

Breadcrumbs::register('contacts-index', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Contacten', route('admin.contacts.index'));
});

Breadcrumbs::register('contacts-create', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Contacten', route('admin.contacts.index'));
    $breadcrumbs->push('Contact toevoegen', route('admin.contacts.create'));
});

Breadcrumbs::register('newsletter-create', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Nieuwsbrieven', route('admin.nieuwsbrief.index'));
    $breadcrumbs->push('Creer nieuwsbrief', route('admin.nieuwsbrief.create'));
});

Breadcrumbs::register('newsletter-edit', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Nieuwsbrieven', route('admin.nieuwsbrief.index')); 
    $breadcrumbs->push('Wijzig nieuwsbrief', route('admin.nieuwsbrief.index'));
});

Breadcrumbs::register('categories-index', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home')); 
    $breadcrumbs->push('Nieuws', route('admin.articles.index'));
    $breadcrumbs->push('Categorieen', route('admin.categories.index'));
});

Breadcrumbs::register('categories-create', function ($breadcrumbs): void {
    $breadcrumbs->push('Home', url('home')); 
    $breadcrumbs->push('Nieuws', route('admin.articles.index'));
    $breadcrumbs->push('Categorieen', route('admin.categories.index'));
    $breadcrumbs->push('Nieuw', route('admin.categories.create'));
});