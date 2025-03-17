@extends('layouts.main')

@section('content')
    <section class="join-us">
        <div class="left-section">
            <img src="{{ asset('images/join-us.png') }}" alt="Join Us" />
            <div class="title">Join Us in Preserving Memories</div>
        </div>

        <div class="right">
            @include('include/alert')
            <form method="POST" action="{{ route('register.form') }}" enctype="multipart/form-data">
                @csrf

                <!-- First section -->
                <div class="input-section" id="inputSection1">
                    <div class="input-item">
                        <div class="left">
                            <label class="titleLabel" for="title">Title</label><br />
                            <select name="title" id="title">
                                <option value="">Title</option>
                                <option value="Mr" {{ old('title') == 'Mr' ? 'selected' : '' }}>Mr</option>
                                <option value="Mrs" {{ old('title') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                <option value="Ms" {{ old('title') == 'Ms' ? 'selected' : '' }}>Ms</option>
                                <option value="Miss" {{ old('title') == 'Miss' ? 'selected' : '' }}>Miss</option>
                                <option value="Dr" {{ old('title') == 'Dr' ? 'selected' : '' }}>Dr</option>
                            </select>
                        </div>
                        <div class="upload-img">
                            <div class="icon-circle" id="imageCircle" style="display: flex; justify-content: center; align-items: center; overflow: hidden; border-radius: 50%; width: 100px; height: 100px; background-color: #ddd;">
                                <input type="file" name="photo" id="imageUpload" style="display:none;" />
                                <label for="imageUpload" style="cursor: pointer;">
                                    <img id="previewImage" src="{{ asset('images/camera-icon.png') }}" alt="Upload Preview" style="width: 80%; height: 80%; object-fit: cover;" />
                                </label>
                            </div>
                            <div class="up-text">Upload new image</div>
                        </div>
                    </div>

                    <div class="input-item-grid">
                        <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" />
                        <input type="text" placeholder="Surname" name="surname" value="{{ old('surname') }}" />
                    </div>

                    <div class="input-item-grid">
                        <input type="email" placeholder="Email" name="email" id="email" value="{{ old('email') }}"/>
                        <input type="text" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" />
                    </div>

                    <div class="input-item-grid">
                        <input type="password" placeholder="Password" name="password" />
                        <input type="text" placeholder="Username" name="username" id="username" value="{{ old('username') }}" />
                    </div>

                    <div class="input-item-grid btn-item-grid">
                        <div class="input-with-label">
                            <label for="dob">Enter date of birth</label>
                            <div class="input-item-three">
                                <select name="dob_day" id="dob_day">
                                    <option value="">Day</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ old('dob_day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="dob_month" id="dob_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('dob_month') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="dob_year" id="dob_year">
                                    <option value="">Year</option>
                                    @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                                        <option value="{{ $i }}" {{ old('dob_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="btn-fnc ps-lg-3 ps-md-0 ps-0">
                            <div class="creating-account">I’m creating an account for?</div>
                            <div class="btn-selection">
                                <button type="button" class="family-mem-btn" id="familyMemberBtn">Family Member</button>
                                <button type="button" class="myself-btn activeBar" id="mySelfBtn">Myself</button>
                            </div>
                        </div>
                    </div>

                    <div class="for-family-member" id="forFamily" style="display:none;">
                        <div class="input-item-grid">
                            <input type="text" placeholder="Name" name="family_name" value="{{ old('family_name') }}" />
                            <input type="text" placeholder="Surname" name="family_surname" value="{{ old('family_surname') }}" />
                        </div>

                        <div class="input-with-label">
                            <label for="family_dob">Enter their date of Birth</label>
                            <div class="input-item-three">
                                <select name="family_dob_day" id="family_dob_day">
                                    <option value="">Day</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ old('family_dob_day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_dob_month" id="family_dob_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('family_dob_month') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_dob_year" id="family_dob_year">
                                    <option value="">Year</option>
                                    @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                                        <option value="{{ $i }}" {{ old('family_dob_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="input-with-label">
                            <label for="">Enter transition date</label>
                            <div class="input-item-three">
                                <select name="family_transition_day" id="family_transition_day">
                                    <option value="">Day</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ old('family_transition_day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_transition_month" id="family_transition_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('family_transition_month') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_transition_year" id="family_transition_year">
                                    @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                                        <option value="{{ $i }}" {{ old('family_transition_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="next-btn-sec">
                        <button type="submit" class="next-btn">Next</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.getElementById('imageUpload').addEventListener('change', function (event) {
            const preview = document.getElementById('previewImage');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        let familyMemberBtn = document.getElementById("familyMemberBtn");
        let mySelfBtn = document.getElementById("mySelfBtn");
        let forFamily = document.getElementById("forFamily");

        mySelfBtn.addEventListener("click", () => {
            forFamily.style.display = "none";
        });
        familyMemberBtn.addEventListener("click", () => {
            forFamily.style.display = "block";
        });

        let btnItems = [familyMemberBtn, mySelfBtn];

        btnItems.forEach((item) => {
            if (item) {
                item.addEventListener("click", () => {
                    btnItems.forEach((removeClass) => {
                        removeClass.classList.remove("activeBar");
                    });

                    item.classList.add("activeBar");
                });
            }
        });

    </script>
@endsection
