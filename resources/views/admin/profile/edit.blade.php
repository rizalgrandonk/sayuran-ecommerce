@extends('admin.layouts.main')

@section('content')

<div class="container-fluid p-0">
    <h1 class="display-6 mb-3">{{ $title }} </h1>
    <div class="row">
        <div class="col-lg-12">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card">
                <div class="card-header">

                    <h5 class="card-title mb-0">User info</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="province" value="{{ auth()->user()->province }}">
                        <input type="hidden" name="city" value="{{ auth()->user()->city }}">
                        <input type="hidden" name="province_id" value="{{ auth()->user()->province_id }}">
                        <input type="hidden" name="city_id" value="{{ auth()->user()->city_id }}">

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="firstname">First name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname"
                                    placeholder="First name" value="{{ auth()->user()->firstname }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="lastname">Last name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname"
                                    placeholder="Last name" value="{{ auth()->user()->lastname }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                value="{{ auth()->user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address"
                                placeholder="Street Name, etc" value="{{ auth()->user()->address }}">
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="province_list">Province</label>
                                <select id="province_list" class="form-control">
                                    <option value=""> -- Select Province -- </option>
                                    @foreach ($listProvince as $province)
                                    @if ($province['province_id'] == auth()->user()->province_id)
                                    <option selected
                                        value="{{ $province['province_id'] }}__{{ $province['province'] }}">
                                        {{ $province['province'] }}
                                    </option>
                                    @else
                                    <option value="{{ $province['province_id'] }}__{{ $province['province'] }}">
                                        {{ $province['province'] }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="city_list">City</label>
                                <select id="city_list" class="form-control">
                                    <option value=""> -- Select City -- </option>
                                    @foreach ($listCity as $city)
                                    @if ($city['city_id'] == auth()->user()->city_id)
                                    <option selected
                                        value="{{ $city['city_id'] }}__{{ $city['type'] }} {{ $city['city_name'] }}">
                                        {{ $city['type'] }} {{ $city['city_name'] }}
                                    </option>
                                    @else
                                    <option
                                        value="{{ $city['city_id'] }}__{{ $city['type'] }} {{ $city['city_name'] }}">
                                        {{ $city['type'] }} {{ $city['city_name'] }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    placeholder="Street Name, etc" value="{{ auth()->user()->phone }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="postal_code">Postal Code</label>
                                <input type="text" class="form-control" name="postal_code" id="postal_code"
                                    placeholder="Postal Code" value="{{ auth()->user()->postal_code }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    const provinceSelect = document.querySelector('#province_list');
    const citySelect = document.querySelector('#city_list');
    const cityInput = document.querySelector('[name="city"]');
    const cityIdInput = document.querySelector('[name="city_id"]');
    const provinceInput = document.querySelector('[name="province"]');
    const provinceIdInput = document.querySelector('[name="province_id"]');

    provinceSelect.addEventListener('change', (e) => {
        const provinceValues = e.target.value.split('__')
        provinceIdInput.value = provinceValues[0]
        provinceInput.value = provinceValues[1]

        const provinceId = provinceValues[0]
        if (provinceId) {
            fetch(`/cities?province_id=${provinceId}`)
                .then((response) => response.json())
                .then((data) => {

                    citySelect.innerHTML = ''
                    citySelect.innerHTML = citySelect.innerHTML + '<option value=""> -- Select City -- </option>'

                    data.forEach(value => {
                        citySelect.innerHTML = citySelect.innerHTML + 
                        `<option value="${value.city_id}__${value.type} ${value.city_name}">
                            ${value.type} ${value.city_name}
                        </option>`
                    });
                })
                .catch((error) => {
                    console.error(error)
                })

            
        } else {
            citySelect.innerHTML = citySelect.innerHTML + '<option value=""> -- Select City -- </option>'
        }
    })

    citySelect.addEventListener('change', (e) => {
        const cityValues = e.target.value.split('__')
        cityIdInput.value = cityValues[0]
        cityInput.value = cityValues[1]
    })

</script>

@endsection