<div class="form-body">
         <div class="row">
             <div class="col-lg-3 col-md-3 center-block center-block text-center">
                <div id="imgHolder" class="fileinput-new center-block" style="height: 135px !important;">
                     <img id="blah"
                      src="../../{{$obj->banner}}"
                      alt="avatar" class="img-responsive center-block"
                      style="width:75% !important; height: 135px !important; padding-bottom:10px !important;"
                     />
                 </div>
                 <div class="fileinput fileinput-new" data-provides="fileinput">
                     <div>
                         <span class="btn btn-success" id="verkennerButton" onclick="$(this).parent().find('input[type=file]').click();">Verkenner</span>
                         <input name="banner" id="imgInp"  style="display: none;" type='file'>
                     </div>
                 </div>
           </div>
            <div class="col-lg-4 col-md-4">
                <div class="form-group form-md-line-input">
                    <div class="input-icon">
                        <input type="text" name="link" class="form-control" id="link" value="{{$obj->link}}">
                        <label for="link">Link</label>
                        <i class="fa fa-link"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="form-group form-md-line-input">
                    <div class="input-icon">
                        <input type="text" name="title" class="form-control" id="title" value="{{$obj->title}}">
                        <label for="title">Titel</label>
                        <i class="fa fa-link"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="form-group form-md-line-input">
                    <div class="input-icon">
                        <input type="text" name="location" class="form-control" id="locatie"
                        value="{{$obj->central_location}}">
                        <label for="locatie">Locatie</label>
                        <i class="fa fa-map-marker"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="form-group form-md-line-input">
                    <div class="input-icon">
                        <input type="number" class="form-control" id="radius" name="radius" value="{{$obj->radius}}">
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
                <button type="submit" class="btn green-meadow"><i class="fa fa-check" aria-hidden="true"></i>Opslaan</button>
            </div>
        </div>
    </div>
</div>