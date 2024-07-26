@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection

@section('content')
@if (session('message'))
    <div class="message-success">
        {{ session('message') }}
    </div>
@endif

@if ($errors->any())
    <div class="message-error" style="color:red">
        <ul>
            @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    </ul>
                </div>
            @endforeach
@endif


<div class="content" style="max: width 1500px">
    <form class="form-content" action="/todos" method="post">
        @csrf
        <div class="contents">
            <input class="form-input" type="text" name="content" value="{{ old('content') }}">
        </div>
        <div class="button">
            <button class="form-submit" type="submit" value="{{ old('content') }}">作成</button>
        </div>
    </form>
</div>

<div class="lists">
    <table class="lists-content">
        <tr class="lists-content-ttl">
            <th class="lists-ttl">Todo</th>
            <td></td>
        </tr>

        @foreach ($todos as $todo)
                    <tr class="lists-content-ttl">
                        <td class="list-ttl">
                            <form class="form-list" action="/todos/update" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="form-content">
                                    <input class="update-form__item-input" type="text" name="content"
                                        value="{{ $todo['content'] }}">
                                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
                                </div>

                                <div class="form-content-update">
                                    <button class="form-submits" type="submit">更新</button>
                                </div>
                            </form>
                        </td>

                        <td class="list-ttl">
                            <form class="form-list-delete" action="/todos/delete" method="post">
                                @method('delete')
                                @csrf
                                <div class="delete">
                                    <div class="button-delete">
                                        <button class="delete-submit" type="submit">削除</button>
                                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                                    </div>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        @endforeach
@endsection