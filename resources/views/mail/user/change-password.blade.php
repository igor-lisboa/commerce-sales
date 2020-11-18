@component('mail::message')
# Olá {{$user->name}}!

Para alterar sua senha clique no botão abaixo!

@component('mail::button', ['url' => route('change_password',[$user->remember_token])])
Clique aqui para alterar sua senha!
@endcomponent

Se não foi você que solicitou essa alteração de senha, ignore este email.

Atenciosamente,<br />
{{ config('app.name') }}
@endcomponent