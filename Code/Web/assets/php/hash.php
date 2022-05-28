<?php

function hashPasswordv1($password, $email) {
    $data = [
        "jas3bdAY3H7fKnl63fvc38IkpaN0KEq63OsHlcgiTKFX3p2vkS561iEXfCSwY8o3",
        "LiFzGOsFRC7qlqCz7e8gC1FM1F1XyLuf4B62y5HvKriN1EkllHHbs1srFZ1DJNVe",
        "kI7ZZGE1SIRV6H2546oA7nkMLqxilvhCBpWzvqWCxm2B5kgg12dayudFqyAoUXGJ",
        "7fr31i2i0kK1tKJQZEfTx1Zukjz3tkhOCy48reJeOV7z2jbT2Rmes6drqk1LMc03",
        "ctEhQ1e7hRYUv0bLY9mrWh9i38aRq28jjJ872JBGZfCH5vEiJfQ6S2p1Q033OWJw",
        "02dESlWeE3tHNJxFr5w2jF2pr4zn8z8ZM4bmxA8FvMsJfM3h7GVOc8v6DkbeQVO6",
        "g2K3A46v3IrHjZGCs3WaX0DI2m5Xk1R69kMXNPmQVG8DbMy5Dpr7uIA3YtCSXj7I",
        "aYP2iUjUZh42M78Lpw2f47QRU70xV662Sb7oa1k99QoGukX3134h4ckNkqY3feTo",
        "l0MWUqzXtFOTLCmatMrntY6PB1waA58qdfz5D7Wj1qIbvVYPDGQ7EqbVGPEGxq1l",
        "yKIZ9672pLAcjQ43IrRK2r7873q3Vn4c2tVL3M5864sedGM1vqtd6S9G37S8axd8",
        "1VXmTWz2tr980mI8fWufB3ZpkUxJp867tA31nb3Tl1DEPoVX8OE0kdB6T5JA7yas",
        "J3Rt4l6tBs0yGWQHRvPN1L1NRykL0c83cVihd8q8ffuUgS996HNx5xVdaTwT4JDp",
        "f1Xe6mJ6z7j52SX7Yz1qhjNq0kUMX0uagI21cntq1V7q1ZI3MF739g2qA4eD8ata",
        "ABJmz0OrnpeBkmx1SDz9J1yZ443ab01om4r21530AcdLT81277MUkD041Ax3jaRE",
        "Y2k3tr9odo0jUTg35mw5c1Qe2TG8CE9buQ8dOchOthwEzz4KK5u1ROxhGe0AW1Cp",
        "8z9n8tPJR763UqnSDEGsjpmdSmKcc1i49KZj72qnJvxjZt016BLrb5I4L1tDEsQL"
    ];

    $hash = hash("sha512", $data[0].$data[1].$password.$data[2].$email.$data[3]);

    for ($i=0; $i < 1337; $i++) { 
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[5].$hash.$data[1]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[8].$hash.$data[9]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[2].$hash.$data[12]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[7].$hash.$data[8]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[13].$hash.$data[13]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[15].$hash.$data[13].$email);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[4].$hash.$data[2]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[1].$hash.$data[9]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[0].$hash.$data[4]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[3].$hash.$data[7]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[10].$hash.$data[2]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[14].$hash.$data[9]);
        $hash = hash("sha512", $hash);
        $hash = hash("sha512", $data[2].$hash.$data[11]);
        $hash = hash("sha512", $hash);
    }

    for ($i=0; $i < 74; $i++) { 
        $hash = hash("sha512", $hash);
        $hash = hash("md2", $hash);
        $hash = hash("sha512", $hash);
        $hash = hash("ripemd320", $hash);
        $hash = hash("haval192,5", $hash);
        $hash = hash("snefru", $hash);
        $hash = hash("sha3-256", $hash);
        $hash = hash("crc32b", $hash);
        $hash = hash("joaat", $hash);
        $hash = hash("haval224,4", $hash.$data[5]);
        $hash = hash("gost", $hash);
        $hash = hash("whirlpool", $hash);
        $hash = hash("fnv132", $hash);
        $hash = hash("haval192,3", $hash);
        $hash = hash("haval256,5", $hash);

        for ($i=0; $i < 173; $i++) { 
            $hash = hash("sha512", $hash);
            $hash = hash("crc32b", $hash);
            $hash = hash("md2", $hash);
            $hash = hash("sha512", $hash);
            $hash = hash("ripemd320", $hash);
            $hash = hash("haval192,5", $hash.$hash.$data[11]);
            $hash = hash("whirlpool", $hash);
            $hash = hash("adler32", $hash);
            $hash = hash("haval224,5", $hash);
            $hash = hash("snefru", $hash);
            if($i % 6 == 0){
                $hash = hash("whirlpool", $hash);
                $hash = hash("fnv132", $hash);
                $hash = hash("haval192,3", $email.$hash);
            }
            $hash = hash("haval256,5", $hash);
            $hash = hash("sha3-256", $hash.$hash.$hash.$hash.$hash.$hash.$hash.$hash.$hash);
            $hash = hash("crc32b", $hash);
            $hash = hash("adler32", $hash);
            $hash = hash("sha512", $hash);
            $hash = hash("sha512", $hash);
            $hash = hash("sha512", $hash);
            $hash = hash("whirlpool", $hash);
            $hash = hash("adler32", $hash);
            $hash = hash("whirlpool", $hash);
            $hash = hash("joaat", $hash);
            $hash = hash("haval224,4", $hash.$hash.$hash);
            $hash = hash("gost", $hash);
            $hash = hash("whirlpool", $hash);
            $hash = hash("sha512", $hash);
            $hash = hash("ripemd320", $hash.$hash.$hash.$hash.$hash.$hash);
            $hash = hash("sha512", $hash);
            $hash = hash("whirlpool", $hash);
            $hash = hash("sha256", $hash);
            $hash = hash("crc32b", $hash);
            $hash = hash("whirlpool", $hash.$hash.$hash.$hash.$hash.$hash.$hash.$hash.$hash.$hash);
            $hash = hash("adler32", $hash);
            $hash = hash("sha512", $hash);
            $hash = hash("haval224,5", $hash);
            $hash = hash("crc32b", $hash);
            $hash = hash("sha512", $hash);
            $hash = hash("whirlpool", $hash);
        }

        $hash = hash("whirlpool", $hash);
        $hash = hash("sha512", $hash);
        $hash = hash("ripemd320", $hash);
        $hash = hash("whirlpool", $hash);
        $hash = hash("sha256", $hash);
        $hash = hash("whirlpool", $hash."oliverwashere");
        $hash = hash("adler32", $hash);
        $hash = hash("whirlpool", $hash);
        $hash = hash("adler32", $hash);
        $hash = hash("whirlpool", $hash);
        $hash = hash("adler32", $hash);
        $hash = hash("haval224,5", $hash);
        $hash = hash("whirlpool", $hash);
    }

    for ($i=0; $i < 572; $i++) {
        $hash = hash("whirlpool", $hash);
        $hash = hash("sha512", $hash);
        $hash = hash("gost", $hash);
        $hash = hash("whirlpool", $hash.$hash);
        $hash = hash("sha384", $hash);
    }

    $hash = hash("adler32", $hash);
    $hash = "001:".$hash;
    
    return $hash;
}

?>