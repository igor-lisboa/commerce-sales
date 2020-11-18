@extends('layout.dashboard')

@section('content')
<form method="POST" onsubmit="alert('<?= __('msg_change_password_mail_send') ?>')" action="<?= route('user_request_change_password') ?>">
    <fieldset>
        @csrf
        <input placeholder="Seu E-Mail" type="email" name="email" required value="<?= old('email') ?>" />
        <button type="submit">Trocar senha</button>
    </fieldset>
</form>
@endsection