<div class="row">
    <div class="col-md-4">
        <div class="form-group row">
            <label for="titre" class="col-md-4 col-form-label">{{ __('Titre') }}</label>

            <div class="col-md-12">
                <input id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre"
                    autocomplete="off" value="{{ old('titre', $evenement->titre ?? null) }}" required>

                @error('titre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="enligne" name="enligne" value="1"
                        {{ ($evenement->enligne ?? null) == true ? 'checked' : ''}} required>
                    <label class="custom-control-label" for="enligne">Publier</label>
                </div>
                <div class="custom-control custom-radio mb-3">
                    <input type="radio" class="custom-control-input" id="enligne2" name="enligne" value="0"
                        {{ ($evenement->enligne ?? null) == false ? 'checked' : '' }} required>
                    <label class="custom-control-label" for="enligne2">Ne pas publier</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlFile1">Photo</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control-file"
                        id="exampleFormControlFile1" value="{{ old('filename', $evenement->filename ?? null) }}">
                    <span class="text-danger"> {{ $errors->first('profile_image') }}</span>
                </div>
                @if ($evenement ?? '' && $evenement->filename)
                <img src="/profile_images/{{ $evenement->filename }}" class="img-fluid img-thumbnails">
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group row">
            <label for="contenu" class="col-md-4 col-form-label">{{ __('Contenu') }}</label>

            <div class="col-md-12">
                <textarea class="form-control contenu" name="contenu" cols="30" rows="10"
                    id="contenu">{{ old('contenu', $evenement->contenu ?? null) }}</textarea>

                @error('contenu')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
</div>