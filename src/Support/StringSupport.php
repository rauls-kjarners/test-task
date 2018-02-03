<?php

namespace App\Support;

class StringSupport
{
    /**
     * @param string $input
     * @param int    $minLength
     * @param array  $substrings
     *
     * @return array
     */
    public function getSubstrings(string $input, int $minLength, array $substrings = []): array
    {
        $strLength = \strlen($input);

        if ($strLength < $minLength && $strLength > 0) {
            $last = end($substrings);
            $substrings[key($substrings) ?? 0] = $input . $last;
        }

        if ($strLength < $minLength || 0 === $strLength || $minLength <= 0) {
            return $substrings;
        }

        $strLength   -= $minLength;
        $substrings[] = substr($input, $strLength, $minLength);

        return $this->getSubstrings(substr($input, 0, $strLength), $minLength, $substrings);
    }
}
