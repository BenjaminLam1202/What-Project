@component('mail::message')
<strong>Welcome to our world</strong>

this is your qr code please do not share this code to anyone <br>

<p>your secret key is : <strong>{{$secret}}</strong></p>



<img src="{{$qr}}" alt="image">


Thanks,<br>
Hilton
@endcomponent
