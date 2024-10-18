@extends('layouts.app')
@section('title', '首页')

@section('content')
    <?php
        echo date('Y-m-d H:i:s',1729177448).'<br />';
        echo date('Y-m-d H:i:s',1729094150).'<br />';
        echo strtotime('2024-10-16 00:00:00').'<br />';
        echo strtotime('2024-10-16 23:59:59').'<br />';
        echo hash('sha256','acfc106d-7bb9-9f28-3536-4ee292cbebd8').'<br />';
        echo mb_substr('粤A1234OO', -2, 2)
    ?>
  <h1>这里是首页ssss</h1>
@stop
<script>
    class Person {
        constructor(name, age) {
            this.name = name;
            this.age = age;
        }

        getInfo() {
            return `Name: ${this.name}, Age: ${this.age}`;
        }
    }

    const p1 = new Person('张三', 18);
    console.log(p1.getInfo());
    const multiLineString = `This is a
multi-line string.`;
    console.log(multiLineString);
    const obj = {color:'red' ,shape:'dick' };
    obj.fck = 'you';
    obj.color = 'blue';
    console.log(obj);
    const arr = [1,2,3,4];
    arr.push(6,7,8,9,5);
    console.log(arr);
    let person = '张三';
    console.log(`我是渣渣辉${person}`);
    const str = "Hello\x00\x09\x0A\x0D\x7F\u200B\u200C\u200D\uFEFF World";
    const pattern=/[\s\x00-\x1F\x7F\u200B\u200C\u200D\uFEFF]/gu;
    const matches = str.match(pattern);
    // 输出匹配结果
    console.log("匹配到的特殊字符数量: " + (matches ? matches.length : 0));
    // 移除特殊字符
    const cleanedStr = str.replace(pattern, '');
    // 输出移除后的字符串
    console.log("移除特殊字符后的字符串: " + cleanedStr);
    navigator.bluetooth.getAvailability().then((available) => {
        if (available) {
            console.log("This device supports Bluetooth!");
        } else {
            console.log("Doh! Bluetooth is not supported");
        }
    });
</script>