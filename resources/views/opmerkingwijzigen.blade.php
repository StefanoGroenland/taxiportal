@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-grey-gallery">
                            <i class="fa fa-cog font-grey-gallery"></i>
                            <span class="caption-subject bold uppercase"> Wijzig/accepteren opmerking </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="kenteken" value="06-ZGD-0">
                                                <label for="kenteken">Kenteken</label>
                                                <i class="fa fa-taxi"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="chauffeur" value="Richard Perdaan">
                                                <label for="chauffeur">Chauffeur</label>
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                               
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <select class="form-control" id="status">
                                                    <option value="not-accepted">Niet geaccepteerd</option>
                                                    <option value="accepted">Geaccepteerd</option>
                                                </select>
                                                <label for="status">Status</label>
                                                <i class="fa fa-tag"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <textarea class="form-control" rows="5" id="comment"></textarea>
                                                <label for="comment">Opmerking</label>
                                            </div>
                                        </div>
                                    </div>
                                   
                               </div>
                               <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-actions noborder pull-right">
                                        <button type="button" class="btn green-meadow"><i class="fa fa-plus" ></i>Toevoegen</button>
                                        <button type="button" class="btn default">Annuleren</button>
                                    </div>
                                </div>
                                </div>
                            </div>
        
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>

@endsection
