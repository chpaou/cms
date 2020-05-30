<div class="row">

    <div class="form-group col-md-12">
        <label for="titre" class="col-md-4 col-form-label">{{ __('Titre') }}</label>

        <div class="col-md-12">
            <input id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre"
                autocomplete="off" value="{{ old('titre', $photoaccueil->titre ?? null) }}" required>

            @error('titre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group col-md-12 ml-4 mt-2">
        <label for="exampleFormControlFile1">Photo</label>
        <input type="file" name="profile_image" id="profile_image" class="form-control-file"
            id="exampleFormControlFile1" value="{{ old('filename', $photoaccueil->filename ?? null) }}">
        <span class="text-danger"> {{ $errors->first('profile_image') }}</span>
    </div>
    @if ($photoaccueil ?? '' && $photoaccueil->filename)
    <img src="/profile_images/{{ $photoaccueil->filename }}" class="img-fluid img-thumbnails">
    @endif
    <div class="row col-md-12 ml-4">
        <label class="col-md-2">Etat</label>
        <div class="col-md-5">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="enligne" name="enligne" value="1"
                    {{ ($photoaccueil->enligne ?? null) == true ? 'checked' : ''}} required>
                <label class="custom-control-label" for="enligne">Publier</label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="custom-control custom-radio mb-3">
                <input type="radio" class="custom-control-input" id="enligne2" name="enligne" value="0"
                    {{ ($photoaccueil->enligne ?? null) == false ? 'checked' : '' }} required>
                <label class="custom-control-label" for="enligne2">Ne pas publier</label>
            </div>
        </div>
    </div>
</div>