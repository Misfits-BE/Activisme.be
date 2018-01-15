@component('mail::message')
# Bedankt om je in te schrijven. 

Via deze weg zouden wij je willen laten weten dat je successvol bent in geschreven. Op de nieuwsbrief van {{ config('app.name') }}

*Indien u zichzelf niet hebt ingeschreven kunt u zich hier weer [uitschrijven]().*

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent
