@component('mail::message')
# Uw account is tijdelijk geblokkeerd.

Via deze weg delen we je mee dat je accout op {{ config('app.name') }} tijdelijk is geblokkeerd. 

Indien je denkt dat dit een vergissing is kan je de persoon die je geblokkeerd heeft bereiken. Door op de contact button te klikken.

@component('mail::button', ['url' => 'mailto:' . $user['email']])
Contact
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent