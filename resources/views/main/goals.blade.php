@extends('layouts.main')

@section('content')
    <section class="welcome-section education">
        @include('ads.ad-container-970')
        <div class="container">
            @include('include.leftMenuUser')

            <div class="main">
                @include('include.alert')

                <form action="{{ route('user.goals.update', ['username' => Auth::user()->username]) }}" method="POST">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="My goal or ambition is..." required />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="start_month">Enter start date:</label>
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
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="message-box">
                        <textarea name="description" id="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                    </div>
                    <div class="btn-section">
                        <button type="submit" class="next-btn">Save</button>
                    </div>
                </form>

                <!-- goals -->
                <form action="{{ route('user.goals.update', ['username' => Auth::user()->username]) }}" method="POST" class="pt-5">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Realtion Goal is..." required />

                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="start_month">Enter start date:</label>
                            <div class="input-part">
                                <select name="start_month" id="start_month" required>
                                    <option value="">Month</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                <select name="start_year" id="start_year" required>
                                    <option value="">Year</option>
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
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
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="message-box">
                        <textarea name="description" id="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                    </div>
                    <div class="btn-section">
                        <button type="submit" class="next-btn">Save</button>
                    </div>
                </form>

                <!-- goals -->
                <form action="{{ route('user.goals.update', ['username' => Auth::user()->username]) }}" method="POST" class="pt-5">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Education Goal is..." required />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="start_month">Enter start date:</label>
                            <div class="input-part">
                                <select name="start_month" id="start_month" required>
                                    <option value="">Month</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                <select name="start_year" id="start_year" required>
                                    <option value="">Year</option>
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
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
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="message-box">
                        <textarea name="description" id="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                    </div>
                    <div class="btn-section">
                        <button type="submit" class="next-btn">Save</button>
                    </div>
                </form>

                <!-- goals -->
                <form action="{{ route('user.goals.update', ['username' => Auth::user()->username]) }}" method="POST" class="pt-5">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Vocation Goal is..." required />

                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="start_month">Enter start date:</label>
                            <div class="input-part">
                                <select name="start_month" id="start_month" required>
                                    <option value="">Month</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                <select name="start_year" id="start_year" required>
                                    <option value="">Year</option>
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
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
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="message-box">
                        <textarea name="description" id="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                    </div>
                    <div class="btn-section">
                        <button type="submit" class="next-btn">Save</button>
                    </div>
                </form>

                <!-- goals -->
                <form action="{{ route('user.goals.update', ['username' => Auth::user()->username]) }}" method="POST" class="pt-5">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Spritual Goal is..." required />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="start_month">Enter start date:</label>
                            <div class="input-part">
                                <select name="start_month" id="start_month" required>
                                    <option value="">Month</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                <select name="start_year" id="start_year" required>
                                    <option value="">Year</option>
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
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
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="message-box">
                        <textarea name="description" id="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                    </div>
                    <div class="btn-section">
                        <button type="submit" class="next-btn">Save</button>
                    </div>
                </form>

                <!-- goals -->
                <form action="{{ route('user.goals.update', ['username' => Auth::user()->username]) }}" method="POST" class="pt-5">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Personal Goal is..." required />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="start_month">Enter start date:</label>
                            <div class="input-part">
                                <select name="start_month" id="start_month" required>
                                    <option value="">Month</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                <select name="start_year" id="start_year" required>
                                    <option value="">Year</option>
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
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
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="message-box">
                        <textarea name="description" id="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                    </div>
                    <div class="btn-section">
                        <button type="submit" class="next-btn">Save</button>
                    </div>
                </form>

                <!-- goals -->
                <form action="{{ route('user.goals.update', ['username' => Auth::user()->username]) }}" method="POST" class="pt-5">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Economic Goal is..." required />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="start_month">Enter start date:</label>
                            <div class="input-part">
                                <select name="start_month" id="start_month" required>
                                    <option value="">Month</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                                <select name="start_year" id="start_year" required>
                                    <option value="">Year</option>
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
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
                                    @for($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="message-box">
                        <textarea name="description" id="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                    </div>
                    <div class="btn-section">
                        <button type="submit" class="next-btn">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
