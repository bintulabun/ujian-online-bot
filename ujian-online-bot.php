<?php

$token = "1313557270:AAHfO53KVYg8FhrIC3WGZQdO4jwlhG5yI-8"; //ganti dengan token botmu

$tg = file_get_contents("php://input");

$tg = json_decode($tg,true);

$chat_id = $tg[message][from][id];

$first_name = $tg[message][chat][first_name];

$last_name = $tg[message][chat][last_name];

$callback_id = $tg[callback_query][from][id];

$text = $tg[message][text];

$data = $tg[callback_query][data];

function kirim(){

if(!isset($GLOBALS[chat_id])){

if (isset($GLOBALS[callback_id])){

$GLOBALS[chat_id] = $GLOBALS[callback_id];

  }

}

$hasil = 'https://api.telegram.org/bot'.$GLOBALS[token].'/sendMessage?chat_id='.$GLOBALS[chat_id].'&text='.$GLOBALS[hasil];

file_get_contents($hasil);

$pertanyaan = 'https://api.telegram.org/bot'.$GLOBALS[token].'/sendMessage?chat_id='.$GLOBALS[chat_id].'&text='.$GLOBALS[pertanyaan].'&reply_markup={"inline_keyboard":[ [{ "text": "A", "callback_data": "'.$GLOBALS[id_soal].'_A"},{ "text": "B", "callback_data": "'.$GLOBALS[id_soal].'_B"},{ "text": "C", "callback_data": "'.$GLOBALS[id_soal].'_C"},{ "text": "D", "callback_data": "'.$GLOBALS[id_soal].'_D"} ] ] }';

file_get_contents($pertanyaan);

}


if ($text == "/start"){

$hasil = "Selamat datang $first_name $last_name di Ujian Online. Sebentar lagi ujian akan dimulai. Silahkan persiapkan diri anda😊";

kirim();

$hasil = NULL;

sleep(3);

$pertanyaan = urlencode("Pertanyan pertama:\nApakah yang dimaksud dengan komputer? \n\nPilih jawaban yang benar di bawah ini:\nA. Makanan\nB. Minuman\nC. Alat menghitung\nD. Kolam renang");

$id_soal = 1;

kirim();
}

if (isset($data)){

$pecahan = explode("_",$data);

$id_soal = $pecahan[0];
$jawaban = $pecahan[1];

$hasil = "Pertanyaan no $id_soal. Jawaban anda adalah: $jawaban";

$id_soal = $id_soal + 1;

$pertanyaan = urlencode("Pertanyaan ke $id_soal: Apakah yang dimaksud dengan... \n\nPilih jawaban yang benar berikut ini\n\nA...\nB...\nC...\nD...");

kirim();
}


?>
