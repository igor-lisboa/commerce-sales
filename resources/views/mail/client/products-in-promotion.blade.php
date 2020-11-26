@component('mail::message')
# Olá {{$client->name}}!

Você é um cliente preferencial!
Por essa razão estamos te mandando uma lista de produtos em promoção!

@foreach($products as $product)
- {{$product->name}} | Preço Original: R${{$product->price}} | Promoção: R${{$product->price_promotion}}
@endforeach

Atenciosamente,<br />
{{ config('app.name') }}
@endcomponent