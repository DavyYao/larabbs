<?php
/*
RSA私钥密钥位数除以8为最大加密长度
分段加密时，长度可以取小于等于最大加密长度的值
解密时直接以最大加密长度解密。

*/ 
class RSAEncryptor
{
    private $rsaPublicKey;

    public function __construct($publicKey)
    {
        $this->rsaPublicKey = $publicKey;
    }

    public function longEncrypt($msg)
    {
        $msg = utf8_encode($msg);
        $length = strlen($msg);
        $defaultLength = 128; // 2048 位密钥 RSA 最大加密长度
        // 每次加密块的最大长度（假设使用 1024 位的 RSA 密钥，PKCS1 填充）
        
        // 导入公钥
        $pubKeyResource = openssl_pkey_get_public($this->rsaPublicKey);
        $key_length = openssl_pkey_get_details($pubKeyResource)['bits'] / 8;
        $max_block_size = $key_length - 11;  // 11 字节是 PKCS1 填充的空间
        // return $max_block_size."\n";
        if (!$pubKeyResource) {
            throw new Exception("Invalid public key");
        }

        $encryptedData = '';

        // 如果长度小于默认加密块，直接加密
        if ($length <= $defaultLength) {
            openssl_public_encrypt($msg, $encryptedData, $pubKeyResource);
            return base64_encode($encryptedData);
        }

        // 长文本分段加密
        $offset = 0;
        $result = [];
        while ($length - $offset > 0) {
            $chunk = substr($msg, $offset, $defaultLength);
            openssl_public_encrypt($chunk, $encryptedChunk, $pubKeyResource);
            $result[] = $encryptedChunk;
            $offset += $defaultLength;
        }

        // 合并加密后的数据
        $byteData = implode('', $result);
        return base64_encode($byteData);
    }
}

// 示例使用
$publicKey = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAv2tDR/EnzO71yU59N7IT
iAVcmY0dJhJyC4kZ3ppUI2xCByC3+q6l9cUYQVPaNDrL1BGAH4ePo8sqyRCk8JGh
FP1uv8Pg9WXkYk60wAQ4t/zqvL/rHfEowTFZ+MQZqGN13KogkvZJdLkjn+/28CLP
dkOIIGk5hTFKo+zaLpuUBY+NvqVRK09vd9jYh8TRZRpvflJUvg/OJ7/+HlQ7s1cT
LYUkD4nbFeAwTF6c4KFBtOL9FKCxXDFRAUV1SLyYbVfZ/wzhtbaK4d25rolkbQR4
HrzXcIcPb2zI7od3W3GtLcCqueAV+GLVeLLF1tWcY7goa12lKAcBD7xAAGFepndd
ywIDAQAB
-----END PUBLIC KEY-----";

$encryptor = new RSAEncryptor($publicKey);
echo strlen(trim($publicKey))."\n".
$encryptedMsg = $encryptor->longEncrypt("这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本这是要加密的长消息文本");
echo $encryptedMsg. "\n";


$privateKey= "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC/a0NH8SfM7vXJ
Tn03shOIBVyZjR0mEnILiRnemlQjbEIHILf6rqX1xRhBU9o0OsvUEYAfh4+jyyrJ
EKTwkaEU/W6/w+D1ZeRiTrTABDi3/Oq8v+sd8SjBMVn4xBmoY3XcqiCS9kl0uSOf
7/bwIs92Q4ggaTmFMUqj7Noum5QFj42+pVErT2932NiHxNFlGm9+UlS+D84nv/4e
VDuzVxMthSQPidsV4DBMXpzgoUG04v0UoLFcMVEBRXVIvJhtV9n/DOG1torh3bmu
iWRtBHgevNdwhw9vbMjuh3dbca0twKq54BX4YtV4ssXW1ZxjuChrXaUoBwEPvEAA
YV6md13LAgMBAAECggEBAK4lQJ2n2QTJdZTCMotEGB7MefU8e4NSjqzN+1oYX2mm
qN9hNd/7mgLhX/K2/bI8t4lkroKAyv5B7Nflq5ktdDXrZyFRbEz1ePSzFCAI9yz0
DP7RP28LIn+4jVkT1x/p9KVfpajuJd/qO23bW3YWxVWblLGf6XOyZ2yBI/H5Go5+
+lFHt7nnH6aqDFCrWSJcIKbqn4JmGa42Vr399IbhGMWcoY1nGVXV2/WGVQLx8PWH
itwPGGBj32Qu7H/4TzxSv0QmEOF2GFMtBl7VhpjIi59VFSMQRXMS3UrJWlglnbu+
me55pqbzE8PgMPetDUU/GCDLuwHWTdTGekAUrcF1o7kCgYEA8IitWbdUxIsoFuQz
voeWyVTDEyzq87+IhdkhZA+N8Tns1FGrOu0efJ81iyvgZSyzlTqrOc8q5GI7/hwV
6D9RkgRqqzqXcH6sD6YH7ML4TudsS7PG2GVHr2XLXE/rb2IFe7T3OOXv76DSgRv4
39g8OXijJdzZTdzRnjlVkG++tbcCgYEAy7ogeiUHPLHaBLco+IeB0wAtH38uV34V
iY4bIojYPCB5hn1joG8tBtWGE2e4petI3p6gCwXKl+I+eeoKU12aPNZk05H9U21p
T9DVs95QPUJjoz6QKrpvtF1NQqW/fBqJCiHUQOap0+D8wwPjc7Xh3gGDGxPagxV+
wh+aVFi8+I0CgYAn9g0WwqaKoLPgWblfBhe/Cx39qZC/PiroUdKCVTM3yG/YNllE
SPCvs6Opo3h8VpjfSgf4arqthsSAyxm4pAxhPeqa1/kg72qWjvbyFtI6CaisSwnW
Gb13HmpSw9RRhO90RfRst4bNQOK4IHWQetRGmAxC1hYkIXOR3eShQm9ksQKBgBbd
4V9UYKeTXuFAnbynmQ7R6j6qy8zOPiSearVJntvA2WMbF9+eGvO1a8Mp1TPqYNd7
/oK+N6ssnc6ZUmdhDjrd5ZtJu6FtmnB3BEWYInF9zik4kH37RyZ7gnyEliWb5N3a
RjSyr0U076oD+be3Jo8ApHKZm+EyvHOVkID/JNbRAoGAA6F4r/j6XXo9wWcFfqyj
SSc/LPGgOHrFNCG9t7MtcW376bVnlELjnY6egD2Lht1LbE33wy0p3XDbwNrVkr/Q
33/nV8piHFKPHWIgnNukOf5tsxWsjdRWGPqdD0WzNcTWcE9sgyCfkE29cO2Fb38T
TLWhuhDtSKHluIHLbESHTp0=
-----END PRIVATE KEY-----";

echo strlen(trim($privateKey))."\n";
//分段解密
function longDecrypt($encryptedMsg,$privateKey){
    

    $privateKeyResource = openssl_pkey_get_private($privateKey);
    if (!$privateKeyResource) {
        return '私钥获取失败';
    }

    $encrypted = base64_decode($encryptedMsg); // 解密的内容通常是base64编码后的
    $encrypted_length = strlen($encrypted);
    $max_block_size = 256; // 根据RSA私钥的长度来设置（比如2048位RSA密钥对应128字节）

    $offset = 0;
    $decrypted = '';
    
    // 分段解密
    while ($encrypted_length - $offset > 0) {
        $block = substr($encrypted, $offset, $max_block_size);
        $decrypted_block = '';
        if (!openssl_private_decrypt($block, $decrypted_block, $privateKeyResource)) {
            return '失败';
        }
        $decrypted .= $decrypted_block;
        $offset += $max_block_size;
    }
    return utf8_decode($decrypted);
}
echo "解密后的数据: " . longDecrypt($encryptedMsg,$privateKey) . "\n";
function rsa_decrypt_long_data($encryptedMsg, $privateKey)
{
    // 每次解密块的最大长度
    $privateKey = openssl_pkey_get_private($privateKey);
    $key_length = openssl_pkey_get_details($privateKey)['bits'] / 8;
    $max_block_size = $key_length;  // 假设使用 PKCS1 padding
    return $max_block_size;
    // 解密的结果
    $decrypted = '';

    // 使用 base64_decode 解码数据（如果加密后进行了 base64 编码）
    $encryptedData = base64_decode($encryptedMsg);

    // 将数据分段
    $total_length = strlen($encryptedData);
    $offset = 0;

    while ($total_length - $offset > 0) {
        $block = substr($encryptedData, $offset, $max_block_size);
        $partial_decrypted = '';

        // 使用私钥进行解密
        if (openssl_private_decrypt($block, $partial_decrypted, $privateKey, OPENSSL_PKCS1_PADDING)) {
            $decrypted .= $partial_decrypted;
        } else {
            return false; // 解密失败时返回 false
        }

        $offset += $max_block_size;
    }

    return utf8_decode($decrypted);
}

// 使用方法
$decrypted = rsa_decrypt_long_data($encryptedMsg, $privateKey);

if ($decrypted !== false) {
    echo "解密成功: " . $decrypted."<br/>";
} else {
    echo "解密失败";
}
function time_diff($timestamp1, $timestamp2)
{
    $datetime1 = new DateTime("@$timestamp1");
    $datetime2 = new DateTime("@$timestamp2");

    $interval = $datetime1->diff($datetime2);
    return $interval;
    // return [
    //     'day' => $interval->d,
    //     'hour' => $interval->h,
    //     'minute' => $interval->i,
    //     'second' => $interval->s
    // ];
}

var_dump(time_diff(1696089600,1731294671));
?>
