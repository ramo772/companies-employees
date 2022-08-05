
<label for="form-label form-label-lg">Name</label>
<input class="form-control form-control-xlg' " type="text" name="name"value="{{ $name }}">


<label for="form-label form-label-lg">Address</label>
<input class="form-control form-control-xlg' " type="text" name="address"value="{{ $address }}">

<div class="mb-3">
    <label for="formFile" class="form-label">Logo</label>
    <input class="form-control" type="file" id="formFile" name="logo">
    <br>
    <img src="{{ $logo }}" alt="">
</div>
