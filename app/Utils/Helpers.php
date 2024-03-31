<?php

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

if(!function_exists('encoder')){
  function encoder(int|string $value): string
  {
    return Crypt::encryptString($value);
  }
}

if(!function_exists('decoder')) {
  function decoder(string $encrypted): mixed
  {
     try{
      return Crypt::decryptString($encrypted);
     } catch(DecryptException $e) {
        abort(404);
     }
  }
}