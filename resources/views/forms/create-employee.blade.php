<label for="form-label form-label-lg">Name</label>
<input class="form-control form-control-xlg' " type="text" name="name" id="">


<label for="form-label form-label-lg">Email</label>
<input class="form-control form-control-xlg' " type="email" name="email" id="">

<label for="form-label form-label-lg">Password</label>
<input class="form-control form-control-xlg' " type="password" name="password" id="">

<label for="number" class="form-label form-label-lg" ">Confirm Password<span
        style="color:red"> * </span></label>

<input required name="password_confirmation" type="password" class="form-control form-control-xlg" id="password"
    placeholder="Confirm Password" value="{{ old('password_confirmation') }}">

<input type="text" name ="company_id" value="{{ $id }}" hidden>
    <div class="mb-3">
        <label for="formFile" class="form-label">image</label>
        <input class="form-control" type="file" id="formFile" name="profile_image">
    </div>
