<?php
declare(strict_types=1);
/**
 * Kooser PasswordLock - Secure your password using password lock.
 * 
 * @package Kooser\PasswordLock.
 */

namespace Kooser\PasswordLock;

/**
 * Any extra functions.
 */
abstract class AbstractLock
{

    /**
     * Get informtion on a hash.
     *
     * @param string $hash The hash to get info on.
     *
     * @return array Info on the hash.
     */
    public function getInfo(string $hash): array
    {
        if (\is_pbkdf2($hash)) {
            return [
                'algo'     => \PASSWORD_PBKDF2,
                'algoName' => 'pbkdf2',
                'options'  => ['[%secret%]'],
            ];
        }
        $info = \password_get_info($hash);
        unset($info['options']);
        $info['options'] = ['[%secret%]'];
        return $info;
    }
}