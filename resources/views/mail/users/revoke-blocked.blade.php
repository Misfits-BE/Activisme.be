@component('mail::message')
# Uw account is terug geactiveerd.

Via deze weg willen we je laten weten dat je account op {{ config('app.name') }}
terug is geactiveerd. Wat betekend dat uw zich terug kunt aanmelden.

@component('mail::button', ['url' => route('login')])
Aanmelden
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent
