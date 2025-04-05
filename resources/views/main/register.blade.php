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
                                <option value="Mr" {{ old('title', session('registration_data.title')) == 'Mr' ? 'selected' : '' }}>Mr</option>
                                <option value="Mrs" {{ old('title', session('registration_data.title')) == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                <option value="Ms" {{ old('title', session('registration_data.title')) == 'Ms' ? 'selected' : '' }}>Ms</option>
                                <option value="Miss" {{ old('title', session('registration_data.title')) == 'Miss' ? 'selected' : '' }}>Miss</option>
                                <option value="Dr" {{ old('title', session('registration_data.title')) == 'Dr' ? 'selected' : '' }}>Dr</option>
                            </select>
                        </div>
                        <div class="upload-img">
                            <div class="icon-circle" id="imageCircle">
                                <input type="file" name="photo" id="imageUpload" style="display:none;" />
                                <label for="imageUpload" style="cursor: pointer;">
                                    <img id="previewImage" src="{{asset('images/camera-icon.png') }}" alt="Upload Preview" style="width: 80%; height: 80%; object-fit: cover;" />
                                </label>
                            </div>
                            <div class="up-text">Upload new image</div>
                        </div>
                    </div>

                    <div class="input-item-grid">
                        <input type="text" placeholder="Name" name="name" value="{{ old('name', session('registration_data.name')) }}" />
                        <input type="text" placeholder="Surname" name="surname" value="{{ old('surname', session('registration_data.surname')) }}" />
                    </div>

                    <div class="input-item-grid">
                        <input type="email" placeholder="Email" name="email" value="{{ old('email', session('registration_data.email')) }}" />
                        <input type="text" placeholder="Phone Number" name="phone" value="{{ old('phone', session('registration_data.phone')) }}" />
                    </div>

                    <div class="input-item-grid">
                        <input type="password" placeholder="Password" name="password" />
                        <input type="text" placeholder="Username" name="username" value="{{ old('username', session('registration_data.username')) }}" />
                    </div>

                    <div class="input-item-grid btn-item-grid">
                        <div class="input-with-label">
                            <label for="dob">Enter date of birth</label>
                            <div class="input-item-three">
                                <select name="dob_day">
                                    <option value="">Day</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ old('dob_day', session('registration_data.dob_day')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="dob_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('dob_month', session('registration_data.dob_month')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="dob_year">
                                    <option value="">Year</option>
                                    @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                                        <option value="{{ $i }}" {{ old('dob_year', session('registration_data.dob_year')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="for-family-member" id="forFamily" style="display:none;">
                        <div class="input-item-grid">
                            <input type="text" placeholder="Name" name="family_name" value="{{ old('family_name', session('registration_data.family_name')) }}" />
                            <input type="text" placeholder="Surname" name="family_surname" value="{{ old('family_surname', session('registration_data.family_surname')) }}" />
                        </div>

                        <div class="input-with-label">
                            <label for="family_dob">Enter their date of Birth</label>
                            <div class="input-item-three">
                                <select name="family_dob_day">
                                    <option value="">Day</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ old('family_dob_day', session('registration_data.family_dob_day')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_dob_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('family_dob_month', session('registration_data.family_dob_month')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_dob_year">
                                    <option value="">Year</option>
                                    @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                                        <option value="{{ $i }}" {{ old('family_dob_year', session('registration_data.family_dob_year')) == $i ? 'selected' : '' }}>{{ $i }}</option>
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
