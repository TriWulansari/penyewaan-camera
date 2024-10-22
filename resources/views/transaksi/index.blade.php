@extends('layout.template')
@section('title', 'Sales-Transactions - Camera_Sell')

@section('content')
@livewire('LihatTransaksi')
    @livewire('TransaksiComponent')
@endsection
