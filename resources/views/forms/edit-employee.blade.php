
<label for="form-label form-label-lg">Name</label>
<input class="form-control form-control-xlg' " type="text" name="name" value="{{$name}}" id="">


<label for="form-label form-label-lg">Email</label>
<input class="form-control form-control-xlg' " type="email" name="email" value="{{$email}}" id="">


    <div class="mb-3">
        <label for="formFile" class="form-label">image</label>
        <input class="form-control" type="file" id="formFile" name="profile_image">
        <br>
        <img src="/storage/{{ $profile_image }}" width="75" alt="">

    </div>
