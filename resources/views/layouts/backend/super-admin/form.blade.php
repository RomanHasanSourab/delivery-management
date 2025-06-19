<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="bmd-label-floating">Name <span style="color: red">*</span></label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="bmd-label-floating">Email <span style="color: red">*</span></label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="bmd-label-floating">Address <span style="color: red">*</span></label>
            <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" rows="3" spellcheck="false"  name="address" value="{{ old('address') }}" required></textarea>
{{--            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" spellcheck="false" required></textarea>--}}
            @error('address')
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="bmd-label-floating">District</label>
            <select style="width: 100%" class="select2" name="district_id">
                @foreach ($districts as $district)
                    <option></option>
                    <option value="{{$district->id}}">{{$district->title}}</option>
                @endforeach
            </select>
            @error('district_id')
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
        </div>
    </div>

</div>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="bmd-label-floating">Phone <span style="color: red">*</span></label>
            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>

            @error('phone')
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="bmd-label-floating">Password <span style="color: red">*</span></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
        </div>
    </div>
</div>

