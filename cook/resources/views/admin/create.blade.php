@extends('layouts.app')

@section('content')
    <div class="container mt-4 wrap">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                レシピ作成
            </h1>

            <form method="POST" action="{{ route('store') }}" enctype='multipart/form-data' onSubmit="return checkSubmit()">
                @csrf

                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="title">
                            料理名
                        </label>
                        <input
                            id="name"
                            name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name') }}"
                            type="text"
                        >
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="profile_image">
                            料理画像
                        </label>
                        <input
                            id="profile_image"
                            name="profile_image"
                            class="form-control {{ $errors->has('profile_image') ? 'is-invalid' : '' }}"
                            value="{{ old('profile_image') }}"
                            type="file"
                        >
                        @if ($errors->has('profile_image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('profile_image') }}
                            </div>
                        @endif
                    </div>

                    

                    <div class="form-group">
                        <label for="text1">
                            材料
                        </label>

                        <textarea
                            id="botext1dy"
                            name="text1"
                            class="form-control {{ $errors->has('text1') ? 'is-invalid' : '' }}"
                            rows="4"
                        >{{ old('text1') }}</textarea>
                        @if ($errors->has('text1'))
                            <div class="invalid-feedback">
                                {{ $errors->first('text1') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="text2">
                            レシピ
                        </label>

                        <textarea
                            id="text2"
                            name="text2"
                            class="form-control {{ $errors->has('text2') ? 'is-invalid' : '' }}"
                            rows="4"
                        >{{ old('text2') }}</textarea>
                        @if ($errors->has('text2'))
                            <div class="invalid-feedback">
                                {{ $errors->first('text2') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="tags">
                            タグ
                        </label>
                        <input id="tags" name="tags"  class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" value="{{ old('tags') }}"type="text">
                        @if ($errors->has('tags'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tags') }}
                            </div>
                        @endif
                    </div>
                    <div class="mt-5">
                        <a class="btn btn-secondary" href="{{ route('admin') }}">
                            キャンセル
                        </a>
                        <button type="submit" class="btn btn-primary" >
                            登録する
                        </button>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
@endsection
