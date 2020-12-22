<?php

use ArtisanBuild\WaitingList\Controllers\JoinWaitingList;
use Illuminate\Support\Facades\Route;

Route::post('/join_waiting_list', JoinWaitingList::class)->name('waiting_list__join');
Route::view('/joined_waiting_list', 'waiting_list::joined')->name('waiting_list__joined');
Route::view('/join_waiting_list_form', 'waiting::join_form')->name('waiting_list__form');