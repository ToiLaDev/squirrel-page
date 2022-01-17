@extends('layouts.admin')
@section('title', __('Edit Page'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form -->
                    <form class="mt-2" action="{{ route('admin.pages.update', $page->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" value="{{ $page->id }}" >
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <x-forms.input name="name" :value="$page->name" />
                            </div>
                            <div class="col-md-6 col-12">
                                <x-forms.input name="slug" :value="$page->slug" />
                            </div>
                            <div class="col-12">
                                <x-forms.input name="title" :value="$page->title" />
                            </div>
                            <div class="col-12">
                                <x-forms.textarea name="excerpt" :value="$page->excerpt" />
                            </div>
                            <div class="col-12">
                                <x-forms.quill name="body" :value="$page->body" />
                            </div>
                            <div class="col-12 mt-50">
                                <x-forms.action />
                            </div>
                        </div>
                    </form>
                    <!--/ Form -->
                </div>
            </div>
        </div>
    </div>
@endsection