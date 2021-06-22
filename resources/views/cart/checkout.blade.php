@extends('layouts.app')
@section('style')

@endsection
@section('content')
   <div class="container">
      <div class="row">
          <div class="col-md-9">
              <p class="mb-4">
                 total amount is <strong>{{$amount}}</strong>
              </p>
              <form action="/charge" method="post" id="payment-form">
              @csrf
              <input type="hidden" name="amount" value={{$amount}}>
                <div class="form">
                    <label for="card-element">
                    Credit or debit card
                    </label>
                    <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display Element errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>

  <button class="btn btn-primary">Submit Payment</button>
  <p id="loading" style="display:none;">payment is in process please wait</p>

</form>
          </div>
      </div>
   </div>
@endsection

@section('script')


<script>
   window.onload=function()
   {
    var stripe = Stripe('pk_test_51J21EbJY0lehGeNaEjm5L9ljgsTBQrNGKfVYDfdrkQdJjxZgCgaVm9fkp1fbm59u9fgZ7x9g86GxUDli7mvFdV4E00Wdo6O12A');
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
            var style = {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: '#32325d',
            },
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');



                    // Create a token or display an error when the form is submitted.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                        }
                    });
                    });

                    function stripeTokenHandler(token) {
                    // Insert the token ID into the form so it gets submitted to the server
                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    var loading=document.getElementById('loading');
                    loading.style.display="block";
                    form.submit();
                    }
                
            }
</script>
@endsection