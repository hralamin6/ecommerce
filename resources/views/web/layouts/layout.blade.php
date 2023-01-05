<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="B2E">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>{{ ucwords(str_replace('.', ' ', request()->route()->getName())) }}
        | {{ strtoupper(config('app.name')) }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap">
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('frontend/img/icons/icon-72x72.jpg')}}">
    <!-- Apple Touch Icon-->
    @include('web.layouts.style')
    @stack('front-style')
</head>
<body>
<!-- Preloader-->
<div class="preloader" id="preloader">
    <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
    </div>
</div>
@php use App\Helper;$cart_object = Helper::getCartTotal();  $wish = Helper::getWishlistCount()@endphp
<!-- Header Area-->
@includeWhen(in_array(request()->route()->getName(), ['shop']), 'web.layouts.header', ['cart'=> $cart_object['count'], 'wish'=> $wish['count']])
@includeWhen(!in_array(request()->route()->getName(), ['shop']), 'web.layouts.header2',['cart'=> $cart_object['count'], 'wish'=> $wish['count']])
<!-- Sidenav Black Overlay-->
<div class="sidenav-black-overlay"></div>
<!-- Side Nav Wrapper-->
@include('web.layouts.sidenav')
{{--@includeWhen(in_array(request()->route()->getName(), ['all.products','shop.category']), 'web.layouts.productnav')--}}
<div class="page-content-wrapper">
    @yield('content')
</div>
<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="work-modal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

            </div>
            <div class="modal-body">
                <iframe src="" frameborder="0" class="min-vh-100 w-100"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Footer Nav-->
@include('web.layouts.scripts', ['cart'=> $cart_object['count'], 'wish'=> $wish['count']])
<!-- All JavaScript Files-->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{ asset('frontend/js/waypoints.min.js')}}"></script>
<script src="{{ asset('frontend/js/jquery.easing.min.js')}}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('frontend/js/jquery.countdown.min.js')}}"></script>
<script src="{{ asset('frontend/js/default/active.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
@stack('front-script')

<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    const startTimer = data => {
        let c = data.duration;
        let t;
        timedCount();

        function timedCount() {
            const hours = parseInt(c / 3600) % 24;
            const minutes = parseInt(c / 60) % 60;
            const seconds = c % 60;
            const result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds);
            $('#timer').html(result);
            if (c === 0) $('#work-modal > div > div > div.modal-header').html(`<button type="button" class="btn btn-light btn-round text-dark" onclick="submitWork(${data.id});$(this).attr('disabled', 'disabled');">Submit Work</button>`);
            if (c !== -1) c = c - 1; t = setTimeout(() => timedCount(), 1000);
        }
    }, notyf = new Notyf({
        duration: 1800,
        icon: true,
        ripple: true,
        dismissible: true,
        position: {
            x: 'right',
            y: 'top',
        },
    }), addToCart = (id, quantity, variant) => {
        $.get("{{ route('shop.cart.add') }}", {
            id: id,
            quantity: quantity ?? 1,
            variant: variant ?? null
        }).success(response => {
            $("#cart-count-footer").text(response.count);
            $("#header-cart-count").text(response.count);
            notyf.success(response.message);
        }).error(error => {
            notyf.error(JSON.parse(error.responseText).message);
        });
    }, cartIncrement = cart => {
        $.get("{{ route('cart.incrementQuantity') }}", {cart: cart}).success(response => {
            $('#cart-view').html(response.view);
            $("body > div.page-content-wrapper > div > div > div > div.card.cart-amount-area > div > h5 > span").text(response.total);
            $("#header-cart-count").text(response.count);
            $("#cart-count-footer").text(response.count);
            notyf.success(response.message);
        }).error(error => {
            notyf.error(JSON.parse(error.responseText).message);
        });
    }, cartDecrement = cart => {
        $.get("{{ route('cart.decrementQuantity') }}", {cart: cart}).success(response => {
            $('#cart-view').html(response.view);
            $("#cart-count-footer").text(response.count);
            $("body > div.page-content-wrapper > div > div > div > div.card.cart-amount-area > div > h5 > span").text(response.total);
            $("#header-cart-count").text(response.count);
            notyf.success(response.message);
        }).error(error => {
            notyf.error(JSON.parse(error.responseText).message);
        });
    }, addToWishlist = id => {
        let url = "{{route('shop.add.wish', ['id'=>'product_id']) }}";
        $.get(url.replace('product_id', id)).success(response => {
            $("#wish-count-footer").empty().text(response.count);
            $("#header-wish-count").empty().text(response.count);
            notyf.success(response.message);
        }).error(error => {
            notyf.error(JSON.parse(error.responseText).message);
        });
    }, removeFromWishlist = id => {
        let url = "{{route('b2e.remove.wish', ['id'=>'product_id']) }}";
        $.get(url.replace('product_id', id)).success(response => {
            $("#wishlist-content").empty().html(response.view).fadeIn();
            $("#wish-count-footer").text(response.count);
        }).error(error => {
            notyf.error(JSON.parse(error.responseText).message);
        });
    }, removeFromCart = id => {
        let url = "{{route('shop.cart.remove', ['id'=>'product_id']) }}";
        $.get(url.replace('product_id', id)).success(response => {
            $('#cart-view').html(response.view);
            $("#cart-count-footer").text(response.count);
            $("body > div.page-content-wrapper > div > div > div > div.card.cart-amount-area > div > h5 > span").text(response.total);
            $("#header-cart-count").text(response.count);
            notyf.success(response.message);
        }).error(error => {
            notyf.error(JSON.parse(error.responseText).message);
        });
    }, startWork = data => {
        $('#work-modal > div > div > div.modal-header').html('<span class="position-fixed badge badge-warning" id="timer"></span>');
        $("#work-modal > div > div > div.modal-body").empty();
        if (data.file) {
            if (data.type == 'image') {
                $('<img>', {
                    src: data.file_url,
                }).appendTo('#work-modal > div > div > div.modal-body');
            } else {
                let html = `<video controls  autoplay muted> <source src="${data.file_url}"> Your browser does not support the video tag. </video>`;
                $('#work-modal > div > div > div.modal-body').html(html);
            }
            $("#work-modal").modal("show");
            startTimer(data)

        } else {
            $('<iframe>', {
                src: new URL(data.url).host === "www.youtube.com" ? data.url + '?autoplay=1' : data.url,
                id: 'myFrame',
                class: "min-vh-87 w-100",
                frameborder: 0,
                scrolling: 'no',
                allowfullscreen: "allowfullscreen",
                mozallowfullscreen: "mozallowfullscreen",
                msallowfullscreen: "msallowfullscreen",
                oallowfullscreen: "oallowfullscreen",
                webkitallowfullscreen: "webkitallowfullscreen",
                allow: "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            }).appendTo('#work-modal > div > div > div.modal-body');
            $("#work-modal").modal("show");
            $("#work-modal iframe").on('load', () => {
                startTimer(data)
            });
        }


    }, submitWork = id => {
        $.post("{{ route('b2e.submit.work') }}", {id: id}).done(response => {
            notyf.success(response.message);
            $('#work-modal > div > div > div.modal-header').html('<strong>You can close this window</strong><button type="button" class="btn btn-light btn-round text-dark" onclick="closeWork()"><i class="lni lni-close"></i></button>');
        }).fail(response => {
            notyf.error(response.message);
        });
    }, closeWork = () => {
        event.preventDefault();
        window.location.reload();
    }, sku = (name, color, size) => {
        return name
            .toLowerCase().split(/\s/).reduce((response, word) => response += word.slice(0, 5), '') + (color ? '_' + color.toLowerCase() : "") + (size ? '_' + size.toLowerCase() : "");
    };
</script>
@if(session()->has('code'))
    <script>
        setTimeout(function () {
            $("#order-success-container").hide();
        }, 6000)
    </script>
@endif
@if(session()->has('success'))
    <script>
        notyf.success("{{ session()->get('success') }}")
    </script>
@endif
@if(session()->has('error'))
    <script>
        notyf.error("{{ session()->get('error') }}")
    </script>
@endif
</body>
</html>
