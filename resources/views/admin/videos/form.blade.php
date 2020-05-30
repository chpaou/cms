<div class="row">
    <div class="col-md-4">
        <div class="form-group row">
            <label for="titre" class="col-md-4 col-form-label">{{ __('Titre') }}</label>

            <div class="col-md-12">
                <input id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre"
                    autocomplete="off" value="{{ old('titre', $video->titre ?? null) }}" required>

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
                        {{ ($video->enligne ?? null) == true ? 'checked' : ''}} required>
                    <label class="custom-control-label" for="enligne">Publier</label>
                </div>
                <div class="custom-control custom-radio mb-3">
                    <input type="radio" class="custom-control-input" id="enligne2" name="enligne" value="0"
                        {{ ($video->enligne ?? null) == false ? 'checked' : '' }} required>
                    <label class="custom-control-label" for="enligne2">Ne pas publier</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="url" class="col-md-4 col-form-label">{{ __('URL') }}</label>

            <div class="col-md-12">
                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                    autocomplete="off" value="{{ old('url', $video->url ?? null) }}" required>

                @error('url')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group row">
            <label for="contenu" class="col-md-4 col-form-label">{{ __('Contenu') }}</label>

            <div class="col-md-12">
                <textarea class="form-control contenu" name="contenu" cols="30" rows="10"
                    id="contenu">{{ old('contenu', $video->contenu ?? null) }}</textarea>

                @error('contenu')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
</div>