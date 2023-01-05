<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title', 'Home') &mdash; {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"/>
    @stack('stylesheet')
    @livewireStyles
</head>

<body>
<div id="app">
    <div class="main-wrapper ">
        <div class="navbar-bg d-print-none"></div>
        <nav class="navbar navbar-expand-lg main-navbar d-print-none">
            @include('partials.topnav')
        </nav>
        <div class="main-sidebar d-print-none">
            @include('partials.sidebar')
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header d-print-none">
                    <h1>@yield('section-title')</h1>
                    @yield('title-action')
                </div>
                <div class="section-body">
                    @yield('section-content')
                    {{@$slot}}
                </div>
            </section>
        </div>
        <footer class="main-footer d-print-none">
            @include('partials.footer')
        </footer>
    </div>
</div>


<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
<script>
    const notyf = new Notyf({duration: 4000, dismissible: true});
</script>
@if (session()->has('success'))
    <script>
        notyf.success('{{ session('success') }}')
    </script>
@endif
@if (session()->has('error'))
    <script>
        notyf.error('{{ session('error') }}')
    </script>
@endif
@stack('scripts')
<script>
    /* Simple Alpine Image Viewer */
    const imageViewer = (src = '') => ({
        imageUrl: src,

        fileChosen(event) {
            this.fileToDataUrl(event, src => this.imageUrl = src)
        },

        fileToDataUrl(event, callback) {
            if (!event.target.files.length) return

            let file = event.target.files[0],
                reader = new FileReader()

            reader.readAsDataURL(file)
            reader.onload = e => callback(e.target.result)
        },
    }), sku = (name, color, size) => {
        return name
            .toLowerCase().split(/\s/).reduce((response, word) => response += word.slice(0, 5), '') + (color ? '_' + color.toLowerCase() : "") + (size ? '_' + size.toLowerCase() : "");
    }, update_sku = () => {
        let name = $("#name").val().toLowerCase();
        let colors = $('#colors').val();
        let size = $("#sizes").tagsinput('items');
        let sale_price = $("#sale_price").val();
        let stock = $("#stock").val();
        $("#stock").parent().hide().attr('disabled', true);
        let skus = [];
        if (colors.length > 0) {
            $.each(colors, (indexInArray, valueOfElement) => {
                if (size.length > 0) {
                    $.each(size, function (indexInSize, valueOfSize) {
                        skus.push(sku(name, valueOfElement, valueOfSize));
                    });
                } else skus.push(sku(name, valueOfElement, undefined))

            });
        } else {
            $.each(size, function (indexInSize, valueOfSize) {
                skus.push(sku(name, undefined, valueOfSize));
            });
        }
        let table = `<input type="hidden" name="is_variant" value="1"><table class="table table-borderless table-sm"><thead><tr><th scope="col">SKU</th><th scope="col">Quantity</th><th scope="col">Price</th></tr></thead><tbody>`;
        $.each(skus, function (indexInArray, valueOfSKU) {
            table += `<tr><th scope="row">${valueOfSKU}</th><td><input class="form-control" type="number" name="${valueOfSKU}_quantity" value="${stock}"/></td><td><input class="form-control" type="number" name="${valueOfSKU}_price" value="${sale_price}" /></td></tr>`;
        });
        table += `</tbody></table>`;
        $("#product-variation-holder").html(table);

    }, acceptWithdraw = async id => {
        await $.get("{{ route('confirm.withdraw') }}", {id: id}).then(response => {
            window.LaravelDataTables["transactions-table"].ajax.reload();
            notyf.success(response.message);
        });
    };


</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<x-livewire-alert::scripts />
@livewireScripts
</body>

</html>
