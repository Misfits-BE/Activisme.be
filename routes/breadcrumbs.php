<?php

Breadcrumbs::register('users-index', function ($breadcrumbs) {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Gebruikersbeheer', route('admin.users.index'));
});

Breadcrumbs::register('users-create', function ($breadcrumbs) {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Gebruikersbeheer', route('admin.users.index'));
    $breadcrumbs->push('Nieuwe gebruiker', route('admin.users.create'));
});

Breadcrumbs::register('logs-index', function ($breadcrumbs) {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Logs', route('admin.logs.index'));
});

Breadcrumbs::register('articles-index', function ($breadcrumbs) {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Artikelen', route('admin.articles.index'));
});

Breadcrumbs::register('articles-create', function ($breadcrumbs) {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Artikelen', route('admin.articles.index'));
    $breadcrumbs->push('Nieuw artikel', route('admin.articles.create'));
});

Breadcrumbs::register('articles-edit', function ($breadcrumbs, $article) {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Artikelen', route('admin.articles.index'));
    $breadcrumbs->push('Wijzig: ' . ucfirst($article->title), route('admin.articles.edit', $article));
});

Breadcrumbs::register('calendar-index', function ($breadcrumbs) {
    $breadcrumbs->push('Home', url('home'));
    $breadcrumbs->push('Kalender', route('admin.calendar.index'));
});