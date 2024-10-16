@extends('layout.template')
@section('title', 'Sales-Transactions - Camera Sell')

@section('content')
@livewire('LihatTransaksi')
    @livewire('TransaksiComponent')
@endsection
