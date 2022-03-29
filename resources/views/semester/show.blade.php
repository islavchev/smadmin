@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row p-2 p-md-0">

        {{-- Looping first column with period labels --}}
        <div class="col-lg-1 col-md-3 col-sm-6 mt-3 border border-secondary h-auto" style="background-color:lightgray">
            <div class="row text-center"><strong>Period</strong></div>
            @foreach ( config('enums.class_periods') as $key => $class_period)
                <div class="row border-top border-secondary text-center Row{{$loop -> iteration}} align-items-center">
                    <div class="col-1 d-block d-md-none">
                        {{$loop->iteration}}
                    </div>
                    <div class="col">
                    <strong>{{ $class_period }}</strong>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Looping through the weekdays --}}
        @foreach (config('enums.weekdays') as $num_weekday => $weekday)
        @if ($loop->first==false && $num_weekday != 6)
        <div class="col-lg col-md-3 col-sm-6 mt-3 border border-start-0 border-secondary" style="{{ $loop->odd ? "background-color:lightgray;":"" }}">
            <div class="row text-center" style="background-color: lightgray"><strong>{{$weekday}}</strong></div>
            @foreach ( config('enums.class_periods') as $key => $class_period)
                <div class="row border-top border-secondary justify-content-center text-center Row{{$loop -> iteration}}">
                    <div class="col-1 d-block d-md-none">
                        {{$loop->iteration}}
                    </div>
                    @php
                        $seminars_count = 0;
                    @endphp
                    <div class="col">
                        @isset($schedule[$num_weekday][$key])
                        @foreach ($schedule[$num_weekday][$key] as $seminar_info)
                        <div class="row {{$seminars_count>0 ? 'border-top':''}}" style="font-size:0.6rem">
                            <div class="col-4 col-md-8 p-0">{{$seminar_info['start_time'].'-'.$seminar_info['end_time']}}</div>
                            <div class="col-4 p-0">
                                @isset($seminars->find($seminar_info['seminar_id'])->subject)
                                {{$seminars->find($seminar_info['seminar_id'])->subject['code']}}
                                @else
                                N/A        
                                @endisset
                            </div>
                            <div class="col-4 p-0">
                                @isset($seminars->find($seminar_info['seminar_id'])->academic)
                                {{$seminars->find($seminar_info['seminar_id'])->academic['abbreviation']}}
                                @else
                                N/A        
                                @endisset
                            </div>
                            <div class="col-4 p-0 offset-4 offset-md-0">
                                @isset($seminars->find($seminar_info['seminar_id'])->group)
                                {{$seminars->find($seminar_info['seminar_id'])->group['name']}}
                                @else
                                N/A        
                                @endisset
                            </div>
                            <div class="col-4 p-0">
                                @isset($seminars->find($seminar_info['seminar_id'])->room)
                                {{$seminars->find($seminar_info['seminar_id'])->room['room_name']}}
                                @else
                                N/A        
                                @endisset
                            </div>
                        </div>  
                        @php
                            $seminars_count++;
                        @endphp                          
                        @endforeach
                        @endisset
                    </div>
                </div>
            @endforeach
        </div>
        @endif
        @endforeach    

        {{-- Add saturday and sunday if there are classes --}}
        @php
            $weekend_days = [6, 0];
        @endphp
        @foreach ($weekend_days as $weekend)
            <div class="col-lg col-md-3 col-sm-6 mt-3 border border-start-0 border-secondary" style="{{ $loop->even ? "background-color: #fdf5e6 ;":"background-color: #ffe4e1;" }}">
                <div class="row text-center" style="background-color: lightgray">               
                    <strong>{{config('enums.weekdays')[$weekend]}}</strong>
                </div>
                @foreach ( config('enums.class_periods') as $key => $class_period)
                    <div class="row border-top border-secondary justify-content-center text-center Row{{$key}}">
                        <div class="col-1 d-block d-md-none">
                            {{$loop->iteration}}
                        </div>
                        @php
                            $period = $loop->iteration;
                            $seminars_count = 0;
                        @endphp
                        <div class="col">
                            
                        @isset($schedule[$weekend][$key])
                        @foreach ($schedule[$weekend][$key] as $seminar_info)
                        <div class="row {{$seminars_count>0 ? 'border-top':''}}" style="font-size:0.6rem">
                            <div class="col-4 col-md-8 p-0">{{$seminar_info['start_time'].'-'.$seminar_info['end_time']}}</div>
                            <div class="col-4 p-0">
                                @isset($seminars->find($seminar_info['seminar_id'])->subject)
                                {{$seminars->find($seminar_info['seminar_id'])->subject['code']}}
                                @else
                                N/A        
                                @endisset
                            </div>
                            <div class="col-4 p-0">
                                @isset($seminars->find($seminar_info['seminar_id'])->academic)
                                {{$seminars->find($seminar_info['seminar_id'])->academic['abbreviation']}}
                                @else
                                N/A        
                                @endisset
                            </div>
                            <div class="col-4 p-0 offset-4 offset-md-0">
                                @isset($seminars->find($seminar_info['seminar_id'])->group)
                                {{$seminars->find($seminar_info['seminar_id'])->group['name']}}
                                @else
                                N/A        
                                @endisset
                            </div>
                            <div class="col-4 p-0">
                                @isset($seminars->find($seminar_info['seminar_id'])->room)
                                {{$seminars->find($seminar_info['seminar_id'])->room['room_name']}}
                                @else
                                N/A        
                                @endisset
                            </div>
                        </div>  
                        @php
                            $seminars_count++;
                        @endphp                          
                        @endforeach
                        @endisset
                        </div>
                    </div>
                @endforeach
            </div> 
        @endforeach   
    </div>
</div>

<script type="application/javascript">
    $(document).ready(function() {
        var periods = @json(config('enums.class_periods'));
        $.each(periods, function( index, value ) {
            var maxHeightRow = -1;
            $('.Row'+index).each(function() {
                maxHeightRow = maxHeightRow > $(this).height() ? maxHeightRow : $(this).height();
            });
            $('.Row'+index).each(function() {
                $(this).height(maxHeightRow);
            });
        });
    });  
</script>
@endsection