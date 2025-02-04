@extends('layouts.main')

@section('content')
    <section class="welcome-section education">
        @include('ads.ad-container-970')
        <div class="container">
            @include('include.leftMenuUser')

            <div class="main">
                @include('include.alert')

                <form action="{{ route('user.life.update', ['username' => Auth::user()->username]) }}" method="POST">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Life event name" required />
                        <input class="mt-3" type="text" name="type" placeholder="Type of goal (education, health, lifestyle, etc)" required />
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

                <!-- personal events -->
                <form action="{{ route('user.life.update', ['username' => Auth::user()->username]) }}" method="POST" class="personal-event pt-5">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Personal/Professional event or accomplishment..." required />
                        <input class="mt-3" type="text" name="type" placeholder="Type of goal (education, health, lifestyle, etc)" required />
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

                <!-- parental events -->
                <form action="{{ route('user.life.update', ['username' => Auth::user()->username]) }}" method="POST" class="education-goal pt-5">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Parental event or accomplishment..." required />
                        <input class="mt-3" type="text" name="type" placeholder="Type of goal (education, health, lifestyle, etc)" required />
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

                <!-- lifestyle event -->
                <form action="{{ route('user.life.update', ['username' => Auth::user()->username]) }}" method="POST" class="lifestyle-event pt-5">
                    @csrf
                    <div class="first-input">
                        <input type="text" name="name" placeholder="Lifestyle event or accomplishment..." required />
                        <input class="mt-3" type="text" name="type" placeholder="Type of goal (education, health, lifestyle, etc)" required />
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


                <form action="{{ route('user.life.update', ['username' => Auth::user()->username]) }}" method="POST">
                    @csrf

                    <!-- Vocation Event -->
                    <div class="vocation-event pt-5">
                        <div class="first-input">
                            <input type="text" name="name" placeholder="Vocation event or accomplishment..." />
                            <input
                                class="mt-3"
                                type="text"
                                name="type"
                                placeholder="Type of goal (education, health, lifestyle, etc)"
                            />
                        </div>

                        <div class="date-grid">
                            <div class="start-date">
                                <label for="start-month">Enter start date:</label>
                                <div class="input-part">
                                    <select name="start_month" id="start-month">
                                        <option value="">Month</option>
                                        @for($month = 1; $month <= 12; $month++)
                                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>

                                    <select name="start_year">
                                        <option value="">Year</option>
                                        @for($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="end-date">
                                <label for="end-month">Enter end date:</label>
                                <div class="input-part">
                                    <select name="end_month" id="end-month">
                                        <option value="">Month</option>
                                        @for($month = 1; $month <= 12; $month++)
                                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>

                                    <select name="end_year">
                                        <option value="">Year</option>
                                        @for($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="message-box">
                            <textarea name="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                        </div>

                        <div class="btn-section">
                            <button class="next-btn" type="submit">Save</button>
                        </div>
                    </div>
                </form>

                <!-- Spritual Event -->
                <form action="{{ route('user.life.update', ['username' => Auth::user()->username]) }}" method="POST">
                    @csrf

                    <div class="spritual-event pt-5">
                        <div class="first-input">
                            <input type="text" name="name" placeholder="Spritual event or accomplishment..." />
                            <input
                                class="mt-3"
                                type="text"
                                name="type"
                                placeholder="Type of goal (education, health, lifestyle, etc)"
                            />
                        </div>

                        <div class="date-grid">
                            <div class="start-date">
                                <label for="start-month">Enter start date:</label>
                                <div class="input-part">
                                    <select name="start_month" id="start-month">
                                        <option value="">Month</option>
                                        @for($month = 1; $month <= 12; $month++)
                                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>

                                    <select name="start_year">
                                        <option value="">Year</option>
                                        @for($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="end-date">
                                <label for="end-month">Enter end date:</label>
                                <div class="input-part">
                                    <select name="end_month" id="end-month">
                                        <option value="">Month</option>
                                        @for($month = 1; $month <= 12; $month++)
                                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>

                                    <select name="end_year">
                                        <option value="">Year</option>
                                        @for($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="message-box">
                            <textarea name="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                        </div>

                        <div class="btn-section">
                            <button class="next-btn" type="submit">Save</button>
                        </div>
                    </div>
                </form>

                <!-- Financial Event -->
                <form action="{{ route('user.life.update', ['username' => Auth::user()->username]) }}" method="POST">
                    @csrf

                    <div class="financial-event pt-5">
                        <div class="first-input">
                            <input type="text" name="name" placeholder="Financial event or accomplishment..." />
                            <input
                                class="mt-3"
                                type="text"
                                name="type"
                                placeholder="Type of goal (education, health, lifestyle, etc)"
                            />
                        </div>

                        <div class="date-grid">
                            <div class="start-date">
                                <label for="start-month">Enter start date:</label>
                                <div class="input-part">
                                    <select name="start_month" id="start-month">
                                        <option value="">Month</option>
                                        @for($month = 1; $month <= 12; $month++)
                                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>

                                    <select name="start_year">
                                        <option value="">Year</option>
                                        @for($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="end-date">
                                <label for="end-month">Enter end date:</label>
                                <div class="input-part">
                                    <select name="end_month" id="end-month">
                                        <option value="">Month</option>
                                        @for($month = 1; $month <= 12; $month++)
                                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>

                                    <select name="end_year">
                                        <option value="">Year</option>
                                        @for($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="message-box">
                            <textarea name="description" placeholder="Why is/was important to you? How does it feel to achieve this?"></textarea>
                        </div>

                        <div class="btn-section">
                            <button class="next-btn" type="submit">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
