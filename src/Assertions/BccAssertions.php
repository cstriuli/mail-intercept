<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Illuminate\Support\Arr;
use Symfony\Component\Mime\Email;

trait BccAssertions
{
    /**
     * Assert mail was BCC'd to address.
     *
     * @param array|string $expected
     * @param Email $mail
     */
    public function assertMailBcc(array|string $expected, Email $mail)
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getBcc', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertContains(
                $address,
                $actualAddresses,
                "Mail was not BCC'd to the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail was not BCC'd to address.
     *
     * @param array|string $expected
     * @param Email $mail
     */
    public function assertMailNotBcc(array|string $expected, Email $mail)
    {
        $addresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getBcc', $mail);

        foreach ($addresses as $address) {
            $this->assertNotContains(
                $address,
                $actualAddresses,
                "Mail was BCC'd to the expected address [{$address}]."
            );
        }
    }
}
