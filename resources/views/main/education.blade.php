@extends('layouts.main')

@section('content')
    <section class="welcome-section education">
        @include('ads.ad-container-970')
        <div class="container">
            @include('include.leftMenuUser')

            <div class="main">
                @include('include.alert')
                <!-- Primary Education -->
                <form method="POST" action="{{ route('user.education.primary') }}" enctype="multipart/form-data" id="post-form">
                    @csrf
                <div class="primary">
                    <div class="first-input">
                        <input type="text" name="primary_school" placeholder="Primary or Junior school" />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="">Enter start date:</label>
                            <div class="input-part">
                                <select name="primary_start_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>

                                <select name="primary_start_year">
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
                            <label for="">Enter end date:</label>
                            <div class="input-part">
                                <select name="primary_end_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>

                                <select name="primary_end_year">
                                    <option value="">Year</option>
                                    @for ($i = $startYear; $i >= $endYear; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="subject-grade" id="subject-container-primary">
                        <div class="item">
                            <input type="text" name="primary_subjects[]" placeholder="Subject" />
                            <select name="primary_grades[]">
                                <option value="">Grade</option>
                                @foreach (['W', 'E', 'G'] as $grade)
                                    <option value="{{ $grade }}">{{ $grade }}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <button type="button" class="add-an-btn" id="add-subject-primary">add another</button>
                        <button type="submit" class="next-btn">save</button>
                    </div>
                </div>
                </form>
                <!-- Secondary Education -->
                <form method="POST" action="{{ route('user.education.secondary') }}" enctype="multipart/form-data" id="post-form">
                    @csrf
                <div class="secondary pt-5">
                    <div class="first-input">
                        <input type="text" name="secondary_school" placeholder="Secondary/High School" />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label>Enter start date:</label>
                            <div class="input-part">
                                <select name="secondary_start_month">
                                    <option value="">Grade</option>
                                    @foreach (['9', '8', '7', '6', '5', '4', '3', '2', '1', 'U'] as $grade)
                                        <option value="{{ $grade }}">{{ $grade }}</option>
                                    @endforeach
                                </select>

                                <select name="secondary_start_year">
                                    <option value="">Year</option>
                                    @for ($i = $startYear; $i >= $endYear; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="end-date">
                            <label>Enter end date:</label>
                            <div class="input-part">
                                <select name="secondary_end_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>

                                <select name="secondary_end_year">
                                    <option value="">Year</option>
                                    @for ($i = $startYear; $i >= $endYear; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="subject-grade" id="subject-container-secondary">
                        <div class="item">
                            <input type="text" name="secondary_subjects[]" placeholder="Subject" />
                            <select name="secondary_grades[]">
                                <option value="">Grade</option>
                                @foreach (['A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'F'] as $grade)
                                    <option value="{{ $grade }}">{{ $grade }}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <button type="button" class="add-an-btn" id="add-subject-secondary">add another</button>
                        <button type="submit" class="next-btn">save</button>
                    </div>
                </div>
                </form>
                <!-- College Education -->
                <form method="POST" action="{{ route('user.education.college') }}" enctype="multipart/form-data" id="post-form">
                        @csrf
                <div class="college pt-5">
                    <div class="first-input">
                        <input type="text" name="college" placeholder="College/Sixth-Form" />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label>Enter start date:</label>
                            <div class="input-part">
                                <select name="college_start_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>

                                <select name="college_start_year">
                                    <option value="">Year</option>
                                    @for ($i = $startYear; $i >= $endYear; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="end-date">
                            <label>Enter end date:</label>
                            <div class="input-part">
                                <select name="college_end_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>

                                <select name="college_end_year">
                                    <option value="">Year</option>
                                    @for ($i = $startYear; $i >= $endYear; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="subject-grade" id="subject-container-college">
                        <div class="item">
                            <input type="text" name="college_subjects[]" placeholder="Subject" />
                            <select name="college_grades[]">
                                <option value="">Grade</option>
                                @foreach (['A', 'B', 'C', 'D', 'E', 'U'] as $grade)
                                    <option value="{{ $grade }}">{{ $grade }}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <button type="button" class="add-an-btn" id="add-subject-college">add another</button>
                        <button type="submit" class="next-btn">save</button>
                    </div>
                </div>
                    </form>
                <!-- University Education -->
                <form method="POST" action="{{ route('user.education.university') }}" enctype="multipart/form-data" id="post-form">
                            @csrf
                <div class="university pt-5">
                    <div class="first-input">
                        <input type="text" name="university" placeholder="University" />
                    </div>
                    <div class="date-grid">
                        <div class="start-date">
                            <label for="">Enter start date:</label>
                            <div class="input-part">
                                <select name="university_start_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>

                                <select name="university_start_year">
                                    <option value="">Year</option>
                                    @for ($i = $startYear; $i >= $endYear; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="end-date">
                            <label for="">Enter end date:</label>
                            <div class="input-part">
                                <select name="university_end_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>

                                <select name="university_end_year">
                                    <option value="">Year</option>
                                    @for ($i = $startYear; $i >= $endYear; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="subject-grade" id="subject-container-university">
                        <div class="item">
                            <input type="text" name="university_subjects[]" placeholder="Subject" />
                            <select name="university_grades[]">
                                <option value="">Grade</option>
                                @foreach (['1st', '2:1', '2:2', '3rd', 'Pass', 'Fail'] as $grade)
                                    <option value="{{ $grade }}">{{ $grade }}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <button type="button" class="add-an-btn" id="add-subject-university">add another</button>
                        <button type="submit" class="next-btn">save</button>
                    </div>
                </div>
                        </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Similar to what you had earlier, append subjects dynamically
        document.addEventListener("DOMContentLoaded", function() {
            function addSubject(buttonId, containerId, subjectName, gradeName) {
                document.getElementById(buttonId).addEventListener('click', function() {
                    let container = document.getElementById(containerId);
                    if (!container) return;

                    let newItem = document.createElement('div');
                    newItem.classList.add('item');
                    newItem.innerHTML = `
              <input type="text" name="${subjectName}[]" placeholder="Subject" />
                        <select name="${gradeName}[]">
                            <option value="">Grade</option>
                            <option value="A+">A+</option>
                            <option value="A">A</option>
                            <option value="B+">B+</option>
                            <option value="B">B</option>
                            <option value="C+">C+</option>
                            <option value="C">C</option>
                            <option value="D+">D+</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
            `;
                    container.appendChild(newItem);
                });
            }

            addSubject('add-subject-primary', 'subject-container-primary', 'primary_subjects', 'primary_grades');
            addSubject('add-subject-secondary', 'subject-container-secondary', 'secondary_subjects', 'secondary_grades');
            addSubject('add-subject-college', 'subject-container-college', 'college_subjects', 'college_grades');
            addSubject('add-subject-university', 'subject-container-university', 'university_subjects', 'university_grades');
        });

    </script>
@endsection
