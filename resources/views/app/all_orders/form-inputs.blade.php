@php $editing = isset($orders) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="user_id" label="User">
            @php $selected = old('user_id', ($editing ? $orders->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="code"
            label="Code"
            value="{{ old('code', ($editing ? $orders->code : '')) }}"

        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="shipping_address"
            label="Shipping Address"

            required
        >{!! old('shipping_address', ($editing ? $orders->shipping_address :
            '')) !!}</x-inputs.textarea>
    </x-inputs.group>
    @if($orders->payment_type == 'mobile banking')
    <div class="col-12 mb-4">
        <strong>
            Payment from {{ $orders->payment_number }} and TRX ID: {{ $orders->trx }}
        </strong>
    </div>
    @endif
    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="delivery_status" label="Delivery Status">
            @php $selected = old('delivery_status', ($editing ? $orders->delivery_status : 'ordered')) @endphp
            <option value="ordered" {{ $selected == 'ordered' ? 'selected' : '' }} >Ordered</option>
            <option value="accepted" {{ $selected == 'accepted' ? 'selected' : '' }} >Accepted</option>
            <option value="processing" {{ $selected == 'processing' ? 'selected' : '' }} >Processing</option>
            <option value="delivered" {{ $selected == 'delivered' ? 'selected' : '' }} >Delivered</option>
            <option value="canceled" {{ $selected == 'canceled' ? 'selected' : '' }} >Canceled</option>
        </x-inputs.select>
    </x-inputs.group>

{{--    <x-inputs.group class="col-sm-12 col-lg-4">--}}
{{--        <x-inputs.select name="payment_type" label="Payment Type">--}}
{{--            @php $selected = old('payment_type', ($editing ? $orders->payment_type : '')) @endphp--}}
{{--            <option value="cash on delivery" {{ $selected == 'cash on delivery' ? 'selected' : '' }} >Cash on delivery--}}
{{--            </option>--}}
{{--            <option value="ssl commerce" {{ $selected == 'ssl commerce' ? 'selected' : '' }} >Ssl commerce</option>--}}
{{--        </x-inputs.select>--}}
{{--    </x-inputs.group>--}}

    @if($orders->payment_status != 'paid')
        <x-inputs.group class="col-sm-12 col-lg-4">
            <x-inputs.select name="payment_status" label="Payment Status">
                @php $selected = old('payment_status', ($editing ? $orders->payment_status : 'unpaid')) @endphp
                <option value="unpaid" {{ $selected == 'unpaid' ? 'selected' : '' }} >Unpaid</option>
                <option value="paid" {{ $selected == 'paid' ? 'selected' : '' }} >Paid</option>
            </x-inputs.select>
        </x-inputs.group>
    @endif
    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.number
            name="grand_total"
            label="Grand Total"
            value="{{ old('grand_total', ($editing ? $orders->grand_total : '0')) }}"

            step="0.01"
            :required="$editing"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.number
            name="coupon_discount"
            label="Coupon Discount"
            value="{{ old('coupon_discount', ($editing ? $orders->coupon_discount : '')) }}"

            step="0.01"
            :required="$editing"
        ></x-inputs.number>
    </x-inputs.group>


    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.number
            name="shipping_cost"
            label="Shipping Cost"
            value="{{ old('shipping_cost', ($editing ? $orders->shipping_cost : '')) }}"
            step="0.01"
            :required="$editing"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.text
            name="shipping_district"
            label="Shipping District"
            value="{{ old('shipping_district', ($editing ? $orders->shipping_district : '')) }}"

            required
        ></x-inputs.text>
    </x-inputs.group>


</div>
