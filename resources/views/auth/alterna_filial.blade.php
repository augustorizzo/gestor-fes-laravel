@extends('layouts.'.env('APP_LAYOUT').'.alterna_filial',
[
    'rota_seta_filial'=>route('filial.alternar.setar'),
    'filiais'=>$filiais
])