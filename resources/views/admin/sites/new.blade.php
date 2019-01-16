@extends('layouts.admin_dash')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('site_all')}}">Sites</a>
        </li>
        <li class="breadcrumb-item active">New Site</li>
    </ol>
    <div class="row">
        <div class="col-9">
            <h2>Create A New Site</h2>
            <p>Starting point for creating new sites.</p>

            <form id="newSiteForm" method="post" action="{{route('site_save')}}">
                @csrf
                <div class="form-group row">
                    <label for="siteTitle" class="col-sm-2 col-form-label @if ($errors->has('title')) text-danger @endif">Title</label>
                    <div class="col-sm-10">
                        <input
                                name="title"
                                type="text"
                                class="form-control @if ($errors->has('title')) is-invalid @endif"
                                placeholder="title"
                                value="{{old('title')}}"
                                id="siteTitle"
                        >
                    </div>

                </div>
                <div class="form-group row">
                    <label for="siteDescription" class="col-sm-2 col-form-label @if ($errors->has('description')) text-danger @endif">Description</label>
                    <div class="col-sm-10">
                        <textarea id="siteDescription" class="form-control @if ($errors->has('description')) is-invalid @endif" name="description" rows="3"></textarea>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Web</label>
                    <div class="col-sm-10">
                        <div class="form-group row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="url" name="url" value="{{old('url')}}" id="url">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="analytics code" name="ga" value="{{old('ga')}}" id="ga">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="git_tag" class="col-sm-2 col-form-label">Git Repo</label>
                    <div class="col-sm-10">
                        <input name="git_url" type="text" class="form-control" placeholder="git url" value="{{old('git_url')}}" id="git_url">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="git_tag" class="col-sm-2 col-form-label">Submitted</label>
                    <div class="col-sm-10">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="submitted" id="submitted1" value="1" checked>
                            <label class="form-check-label" for="submitted">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="submitted" id="submitted0" value="0">
                            <label class="form-check-label" for="submitted">
                                No
                            </label>
                        </div>
                    </div>
                </div>




                <div class="form-group row">
                    <div class="col-sm-10">
                        <button id="newSiteFormBtn" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection
