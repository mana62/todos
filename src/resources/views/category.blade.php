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


<div class="content">
    <div class="todo-content__title">
        <h2>新規作成</h2>
    </div>
    <form class="form-content" action="/todos" method="post">
        @csrf
        <div class="form-content__item">
            <input class="form-content__item-input" type="text" name="content" value="{{ old('content') }}">
            <select class="form-content__item-select" name="" id="">
                <option value="カテゴリ"></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="button">
            <button class="form-submit" type="submit" value="{{ old('content') }}">作成</button>
        </div>
    </form>

    <div class="todo-content__title">
        <h2>Todo検索</h2>
    </div>
    <form class="form-search" action="/todos" method="post">
        @csrf
        <div class="form-search__item">
            <input class="form-search__item-input" type="text" name="content" value="">
            <select class="form-search__item-select" name="" id="">
                <option value="カテゴリ"></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="button">
            <button class="form-submit" type="submit" value="{{ old('content') }}">作成</button>
        </div>
    </form>

</div>

<div class="todo-table">
    <table class="todo-table__inner">
        <tr class="todo-table__row">
            <th class="todo-table__header">
                <span class="todo-table__header-span">Todo</span>
                <span class="todo-table__header-span">カテゴリ</span>
            </th>
        </tr>

        @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form class="update-form" action="/todos/update" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                            <input class="update-form__item-input" type="text" name="content"
                                value="{{ $todo['content'] }}">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>

                        <div class="update-form__item">
                            <p class="update-form__item-p">{{ $todo->category->name }}</p>
                        </div>

                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>

                <td class="todo-table__item">
                    <form class="delete-form" action="/todos/delete" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

@endsection