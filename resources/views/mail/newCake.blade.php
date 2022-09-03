@component('mail::message')
<h1>Novidades!</h1>

<p>Olá chegou um novo bolo de e ví que você tem enteresse.</p>
<p> {{ $cakes['nome'] }}, {{ $cakes['peso'] }}gr  {{ 'R$ '.number_format($cakes['valor'], 2, ',', '.') }}</p>
<p>Então corra para garantir o seu, pois o estoque pode acabar logo.</p>

@endcomponent
