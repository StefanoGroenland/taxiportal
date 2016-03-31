<div class="form-body">
    <div class="row">
            <div class="col-lg-3 col-md-12 center-block text-center">
                <div id="imgHolder" class="fileinput-new center-block" style="height: 300px !important;">
                    <img id="jcrop_target"
                     src="https://placeholdit.imgix.net/~text?txtsize=33&txt=160%C3%97600&w=160&h=600"
                     alt="avatar" class="img-responsive center-block"
                     style=" height: 300px !important; padding-bottom:10px !important;"
                    />
                    
                </div>

                <div class="fileinput fileinput-new " data-provides="fileinput">
                    <div>
                        <span class="btn btn-success" id="verkennerButton" onclick="$(this).parent().find('input[type=file]').click();">Verkenner</span>
                        <input name="banner" id="imgInp"  style="display: none;" type='file'>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 ">
                <div class="form-group form-md-line-input">
                    <div class="input-icon">
                        <input type="text" class="form-control" id="link" name="link" value="">
                        <label for="link">Link</label>
                        <i class="fa fa-link"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 ">
                <div class="form-group form-md-line-input">
                    <div class="input-icon">
                        <input type="text" class="form-control" id="locatie" name="location" value="">
                        <label for="locatie">Centrale locatie</label>
                        <i class="fa fa-map-marker"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 ">
                <div class="form-group form-md-line-input">
                    <div class="input-icon">
                        <input type="number" class="form-control" id="radius" name="radius" value="0">
                        <label for="locatie">Straal reclame bereik in kilometers</label>
                        <i class="fa fa-map-marker"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="row">
         <div class="col-lg-12">
             <div class="form-actions noborder pull-right">
                 <a type="button" href="/reclames" class="btn default">Annuleren</a>
                 <button type="submit" class="btn green-meadow"><i class="fa fa-plus" aria-hidden="true"></i>Toevoegen</button>
             </div>
         </div>
     </div>