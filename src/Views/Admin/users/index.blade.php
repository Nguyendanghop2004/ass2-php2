@extends('layouts.master')
@section('title')
    danh sach user
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1 class="m-0">DANH SACH USER</h1>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <a href=" <?= $_ENV['BASE_URL'] ?>admin/users/create">them moi</a>

                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form Active="#">
                                        <div class="search_field">
                                            <input type="text" placeholder="Search content here..." />
                                        </div>
                                        <button type="submit">
                                            <i class="ti-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn_1">Add
                                    New</a>
                            </div>
                        </div>
                    </div>
                    @if (isset($_SESSION['status']) && $_SESSION['status'])
                        <div class="alert alert-warning">
                            {{ $_SESSION['lmg'] }}
                            @php
                                unset($_SESSION['lmg']);
                                unset($_SESSION['status']);
                            @endphp
                        </div>
                    @endif
                    <div class="QA_table mb_30">
                        <table class="table lms_table">
                            <thead>
                                <tr>
                                    <th>id </th>
                                    <th>name </th>
                                    <th>avatar </th>
                                    <th> email</th>
                                    <th> created_at</th>
                                    <th>updated_at </th>
                                    <th>Thao tac </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $users)
                                    <tr>
                                        <td> <?= $users['id'] ?></td>
                                        <td><?= $users['name'] ?></td>
                                        <td>
                                            <img src="<?= $_ENV['BASE_URL'] . $users['avatar'] ?> " alt=""
                                                width="50px">

                                        </td>
                                        <td><?= $users['email'] ?></td>
                                        <td><?= $users['created_at'] ?></td>
                                        <td><?= $users['updated_at'] ?></td>
                                        <td>
                                            <a href=" <?= $_ENV['BASE_URL'] ?>admin/users/{{ $users['id'] }}/show">show</a>
                                            <a href=" <?= $_ENV['BASE_URL'] ?>admin/users/{{ $users['id'] }}/edit">sua</a>
                                            <a href=" <?= $_ENV['BASE_URL'] ?>admin/users/{{ $users['id'] }}/delete"
                                                onclick=" confirm ('chắc chán k')">xoa</a>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
