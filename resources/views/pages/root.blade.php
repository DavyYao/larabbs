@extends('layouts.app')
@section('title', '首页')

@section('content')
    <?php
        echo date('Y-m-d H:i:s',1725849907).'<br />';
        echo mb_substr('粤A1234OO', -2, 2)
    ?>
  <h1>这里是首页ssss</h1>
@stop