@extends('layout.template')
@section('title', 'Transaksi - Rent Cam')

@section('content')
@livewire('LihatTransaksi')
    @livewire('TransaksiComponent')
@endsection
