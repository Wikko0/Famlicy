@extends('layouts.main')

@section('content')
    <section class="welcome-section education">
        @include('ads.ad-container-970')
        <div class="container">
            @include('include.leftMenuUser')

            <div class="main">
                @include('include.alert')

                <form action="{{ route('user.goals.update', ['username' => Auth::user()->username]) }}" method="POST" enctype="multipart/form-data" id="post-form">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="My goal or ambition is..." required />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="start_month">Enter start date:</label>
                            <div class="input-part">
                                <select name="start_month" id="start_month">
                                    <option value="">Month</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                <select name="start_year" id="start_year">
                                    <option value="">Year</option>
                                    @php
                                        $currentYear = date('Y');
                                        $startYear = $currentYear + 20;
                                        $endYear = $currentYear - 100;
                                    @endphp
                                    @for ($i = $startYear; $i >= $endYear; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="end-date">
                            <label for="end_month">Enter end date:</label>
                            <div class="input-part">
                                <select name="end_month" id="end_month">
                                    <option value="">Month</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                <select name="end_year" id="end_year">
                                    <option value="">Year</option>
                                    @for ($i = $startYear; $i >= $endYear; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="message-box">
                        <textarea name="description" id="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                    </div>

                    {{--  Post Start --}}
                    @if(Auth::user()->transitioned_id)
                        <div class="input-box w-100 mt-4">

                            <select name="from" id="contentType" class="form-select w-100">
                                <option value="{{Auth::id()}}" selected>From : Myself</option>
                                @if(!empty($userTransmited) && $userTransmited->count())
                                    @foreach ($userTransmited as $transmited)
                                        <option value="{{ $transmited->id }}">From : {{ $transmited->name }}</option>
                                    @endforeach
                                @else
                                    <option disabled>No transitioned users</option>
                                @endif
                            </select>
                        </div>
                    @endif

                    <input type="hidden" name="location" id="location">
                    <div class="input-box m-2 d-flex justify-content-end">
                        <input type="file" name="file" id="file-input" accept="image/*,audio/*,video/*" style="display: none;" onchange="previewFile()" />

                        <svg width="40" height="40" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg"
                             onclick="document.getElementById('file-input').click();">
                            <path d="M3.8125 16L11.7812 8.5L15.5312 12.25M3.8125 16H13.1875C14.7408 16 16 14.7408 16 13.1875V8.5M3.8125 16C2.2592 16 1 14.7408 1 13.1875V3.8125C1 2.2592 2.2592 1 3.8125 1H9.90625M12.25 2.90826L14.1674 1M14.1674 1L16 2.822M14.1674 1V5.6875M6.625 5.21875C6.625 5.9954 5.9954 6.625 5.21875 6.625C4.4421 6.625 3.8125 5.9954 3.8125 5.21875C3.8125 4.4421 4.4421 3.8125 5.21875 3.8125C5.9954 3.8125 6.625 4.4421 6.625 5.21875Z"
                                  stroke="#2A804E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>

                    <div class="first-input">
                        <div class="img" id="preview-container" style="display: none"></div>
                    </div>

                    {{-- Post End --}}

                    <div class="btn-section">
                        <button type="submit" class="next-btn">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
