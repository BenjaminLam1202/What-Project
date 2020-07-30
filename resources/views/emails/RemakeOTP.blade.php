@component('mail::message')
<strong>Hey</strong>

This is yours new OTP my friend <br>

<p>your secret key is : <strong>{{$secret}}</strong></p>



<img src="{{$qr}}" alt="image">


Thanks,<br>
Hilton
@endcomponent
