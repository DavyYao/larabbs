@extends('layouts.app')
@section('title', '首页')

@section('content')
    <?php
        echo date('Y-m-d H:i:s',1726836015).'<br />';
        echo date('Y-m-d H:i:s',1726772290).'<br />';
        echo strtotime('2024-09-19 07:40:01').'<br />';
        echo strtotime('2024-09-19 08:36:39').'<br />';
        echo hash('sha256','2ed20b76-80c0-18cf-9760-84563e5849ef').'<br />';
        echo mb_substr('粤A1234OO', -2, 2)
    ?>
  <h1>这里是首页ssss</h1>
@stop