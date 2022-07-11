@extends('backend.layouts.app')
@section('content')
<div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $pageInfo->title }}</h3>
         </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
            {!! $pageInfo->content !!}
            
                <div class="bk-btn">
                <a href="{{ route('page.edit', $pageInfo->id)}}" class="btn btn-secondary">EDIT</a>
                  <a href="#" onclick="history.go(-1)" class="btn btn-info">BACK</a>
                </div>
                </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
        @endsection