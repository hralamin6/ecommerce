<div class="accordion" id="accordion{{$i+1}}">
    <!-- Single Accordian-->
    <div class="accordian-header" id="headingOne">
        <button class="d-flex align-items-center justify-content-between w-100 collapsed btn" type="button"
            data-bs-toggle="collapse" data-bs-target="#collapse{{$i+1}}" aria-expanded="false"
            aria-controls="collapse{{$i+1}}"><span><i class="lni lni-users"></i> Level {{$i+1}} (Member
                {{ count($team) }})</span><i class="lni lni-chevron-right"></i></button>
    </div>
    <div class="collapse" id="collapse{{$i+1}}" aria-labelledby="headingOne" data-bs-parent="#accordion{{$i+1}}">
        <table class="table table-borderless">
            @foreach($team as $member)
            <tr>
                <td style="max-width: 10vw">#{{ $loop->iteration }}</td>
                <td class="text-start" style="max-width: 40vw"><img class="accrodion-avater"
                        src="{{ asset('frontend/img/user/level_user.png') }}" alt=""></td>

                <td class="text-end" style="max-width: 50px;">{{ $member }}</td>

            </tr>
            @endforeach
        </table>
    </div>

</div>