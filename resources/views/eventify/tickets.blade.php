@extends('index')

@section('title')
    Tickets - Eventify
@endsection

@section('content')
    <div class="content">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center mb-4">Tickets for {{ $event->name }}</h1>
                    <div class="card">
                        <div class="card-header">Purchase Tickets</div>

                        <div class="card-body">
                            <form method="POST" action="">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <div class="form-group row">
                                    <label for="event_name" class="col-md-4 col-form-label text-md-right">Event</label>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" value="{{ $event->name }}" readonly="readonly"
                                            id="event_name" class="form-control" name="event_name">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon1"
                                                onclick="decreaseQuantity()">
                                                -</button>
                                            <input id="quantity" type="number" class="form-control" name="quantity" onchange="document.getElementById('price').value = parseFloat(this.value * document.getElementById('price').value).toFixed(2)"
                                            value="1" min="1">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                                onclick="increaseQuantity()">+</button>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
                                    <div class="col-md-6">
                                        <input type="number" step="0.01" name="price" value="{{ $event->price }}"
                                            class="form-control" readonly id="price">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Purchase
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        let quantity = 1;

        function increaseQuantity() {
            quantity++;
            document.getElementById('quantity').value = quantity;
            document.getElementById('price').value = parseFloat({{ $event->price }} * quantity).toFixed(2);
        }

        function decreaseQuantity() {
            if (quantity > 1) {
                quantity--;
                document.getElementById('quantity').value = quantity;
                document.getElementById('price').value = parseFloat({{ $event->price }} * quantity).toFixed(2);
            }

        }
    </script>
@endsection
