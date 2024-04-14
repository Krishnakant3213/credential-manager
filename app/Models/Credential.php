<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ParagonIE\CipherSweet\BlindIndex;
use ParagonIE\CipherSweet\EncryptedRow;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;

class Credential extends Model implements CipherSweetEncrypted
{
    use UsesCipherSweet;

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addField('password')
            ->addBlindIndex('password', new BlindIndex('password_index'));
    }
}
