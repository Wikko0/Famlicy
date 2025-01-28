@extends('layouts.main')

@section('content')
    <section class="welcome-section education">
        <div class="container">
            @include('include.leftMenuUser')

            <div class="main">
                @include('include.alert')

                <form method="POST" action="{{ route('user.employment.update', $user->username) }}">
                    @csrf
                    <div class="">
                        <div class="first-input">
                            <input type="text" name="name" placeholder="Company Name" required />
                            <input class="mt-3" type="text" name="title" placeholder="Job title" required />
                        </div>
                        <div class="date-grid">
                            <div class="start-date">
                                <label for="start_date">Enter start date:</label>
                                <div class="input-part">
                                    <select name="start_month" id="start_month" required>
                                        <option value="">Month</option>
                                        @for($month = 1; $month <= 12; $month++)
                                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                    <select name="start_year" id="start_year" required>
                                        <option value="">Year</option>
                                        @php
                                            $currentYear = date('Y');
                                            $startYear = $currentYear - 100;
                                        @endphp
                                        @for($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="end-date">
                                <label for="end_date">Enter end date:</label>
                                <div class="input-part">
                                    <select name="end_month" id="end_month">
                                        <option value="">Month</option>
                                        @for($month = 1; $month <= 12; $month++)
                                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                    <select name="end_year" id="end_year">
                                        <option value="">Year</option>
                                        @for($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="message-box">
                            <textarea name="description" placeholder="Describe role and responsibilities" required></textarea>
                        </div>

                        <div class="btn-section">
                            <button type="submit" class="next-btn">Save</button>
                        </div>
                    </div>
                </form>

                @if(!$employments->isEmpty())
                    <div class="employment-list mt-4">
                        <h3>Your Employment History</h3>
                        @foreach($employments as $employment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $employment->name }}</h5>
                                    <p><strong>Job Title:</strong> {{ $employment->title }}</p>
                                    <p><strong>Start Date:</strong> {{ $employment->start_date }}</p>
                                    <p><strong>End Date:</strong> {{ $employment->end_date }}</p>
                                    <p><strong>Description:</strong> {{ $employment->description }}</p>

                                    <!-- Бутон за изтриване на работно място -->
                                    <form method="POST" action="{{ route('user.employment.delete', $employment->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
